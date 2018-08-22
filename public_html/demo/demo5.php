<?php
/* Config */
require_once 'demoBase.php';
$I18N = new Intuition( 'demo' );

/* Demonstration */

echo $I18N->dashboardBacklink();

// The default is TSINT_HELP_CURRENT
echo $I18N->getFooterLine();

echo $I18N->getFooterLine( 'orphantalk' );

echo $I18N->getFooterLine( TSINT_HELP_NONE );

echo $I18N->getFooterLine( TSINT_HELP_ALL );

echo $I18N->getPromoBox( 32, TSINT_HELP_ALL );

/* View source */
closeDemo( __FILE__ );
