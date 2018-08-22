<?php
/* Config */
require_once 'demoBase.php';

/* Demonstration */

// 1) Init $I18N

// Pass name of domain to Intuition constructor
$I18N = new Intuition( 'demo' );
// Register the directory from which to load message files
$I18N->registerDomain( 'demo', __DIR__ . '/messages/demo' );

// 2) Get message
echo $I18N->msg( 'example' );

/* View source */
closeDemo( __FILE__ );
