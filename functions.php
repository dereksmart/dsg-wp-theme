<?php
/**
 * DSG Theme — functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dsg_theme_extras() {
	$css = "
		a { text-decoration: none; transition: color 0.2s; }
		p a, li a { border-bottom: 1px solid rgba(37,99,235,0.3); }
		p a:hover, li a:hover { border-bottom-color: currentColor; }
		.wp-block-navigation a { border-bottom: none; }
		.wp-block-site-title a { border-bottom: none; }
		body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
		::selection { background: #2563eb; color: #fff; }
	";
	wp_add_inline_style( 'global-styles', $css );
}
add_action( 'wp_enqueue_scripts', 'dsg_theme_extras', 20 );
