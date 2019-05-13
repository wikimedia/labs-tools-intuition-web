<?php
/* Config */

use Krinkle\Intuition\Intuition;

require_once 'demoBase.php';

/* Demonstration */

// 1) Init $I18N
$I18N = new Intuition( 'demo' );

// 2) Get domain info (eg. url)
var_dump(
	$I18N->getDomainInfo( 'general' )
);

/* View source */
closeDemo( __FILE__ );
