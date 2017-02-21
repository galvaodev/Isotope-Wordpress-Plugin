<?php
/*
Plugin Name: Isotope - Load More
Plugin URI: https://github.com/jvgm/Isotope-Wordpress-Plugin
Version: Beta 1.0
Author: João Victor Galvão Modesto
Description: Presentation of gallery for portfolio or news portals using fully configured isotope.
License: https://www.gnu.org/licenses/agpl-3.0.txt
*/


// Definindo pasta onde encontra plugin
define( 'ISO_DIR', dirname( __FILE__ ) );


/*----------------------------------------------------------------------------*
 * Paginas complementares do plugin
 *----------------------------------------------------------------------------*/

//Loop (post_type end Taxonomy)
require_once( ISO_DIR . '/public/isotope-postfolio.php' );

//Requeri BFI
require_once( ISO_DIR . '/BFI_Thumb.php');

//Shortcodes
require_once( ISO_DIR . '/public/shortcode.php' );

//Functions Plugin 
require_once( ISO_DIR . '/function.php' );

//Settings Plugin
require_once( ISO_DIR . '/public/settings.php' );
