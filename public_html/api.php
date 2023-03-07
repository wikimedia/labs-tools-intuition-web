<?php
/**
 * Entry point for the Intuition web API.
 *
 * @copyright 2017 Timo Tijhof
 * @license MIT
 */

use Krinkle\Intuition\Intuition;

/**
 * Set up
 * -------------------------------------------------
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Don't output HTML-formatted errors
ini_set( 'display_errors', '0' );

$I18N = new Intuition( 'web' );

if ( file_exists( __DIR__ . '/../config.php' ) ) {
	require_once __DIR__ . '/../config.php';
}

/**
 * Request
 * -------------------------------------------------
 */

/**
 * @param array $data
 * @return never
 */
function i18nApiResp( array $data ) {
	global $kgReq;

	$callback = $kgReq->getVal( 'callback' );
	$jsonData = json_encode( $data );

	// Allow CORS (to avoid having to use JSON-P with cache busting callback)
	$kgReq->setHeader( 'Access-Control-Allow-Origin', '*' );
	// Whitelist of headers for cross-origin requests (T231356)
	$kgReq->setHeader( 'Access-Control-Allow-Headers', 'X-Wikimedia-Debug' );

	// - Let browser freely use it for 5 minutes without checking the server.
	// - Let browser freely use a stale copy for 1 hour, if it can update in the background
	//   with a cheap 304/ETag check.
	// - If more than an hour old, or if older than 5min in browser without background update
	//   support, then do a 304/ETag check during the web request.
	//
	// See also:
	// - <https://web.dev/stale-while-revalidate/>
	// - <https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control>
	$maxAge = 5 * 60;
	$bgMaxAge = 60 * 60;
	$kgReq->setHeader( 'Cache-Control', "public, max-age=$maxAge, stale-while-revalidate=$bgMaxAge" );

	// Quotes are part of the E-Tag!
	// See also: <https://en.wikipedia.org/wiki/HTTP_ETag>
	$etag = '"' . substr( md5( $jsonData ), 0, 10 ) . '"';
	if ( $kgReq->getHeader( 'If-None-Match' ) === $etag ) {
		http_response_code( 304 );
		exit;
	}

	$kgReq->setHeader( 'ETag', $etag );

	// Serve as JSON or JSON-P
	if ( $callback === null ) {
		$kgReq->setHeader( 'Content-Type', 'application/json; charset=utf-8' );
		echo $jsonData;
	} else {
		$kgReq->setHeader( 'Content-Type', 'text/javascript; charset=utf-8' );

		// Sanatize callback
		$callback = kfSanatizeJsCallback( $callback );
		echo $callback . '(' . $jsonData . ');';
	}

	exit;
}

$domains = $kgReq->getVal( 'domains', false );
$lang = $kgReq->getVal( 'lang', $I18N->getLang() );

/**
 * Response
 * -------------------------------------------------
 */

$resp = [];

if ( !$domains ) {
	// HTTP 400 Bad Request
	http_response_code( 400 );
	$resp['error'] = 'Parameter "domains" is required';
	i18nApiResp( $resp );
}

$domains = explode( '|', $domains );

$resp['messages'] = [];

foreach ( $domains as $domain ) {
	$exists = $I18N->getDomainInfo( $domain );

	if ( !$exists ) {
		$resp['messages'][$domain] = false;
		continue;
	}

	$keys = $I18N->listMsgs( $domain );

	foreach ( $keys as $key ) {
		$resp['messages'][$domain][$key] = $I18N->rawMsg( $domain, $lang, $key );
	}
}

i18nApiResp( $resp );
