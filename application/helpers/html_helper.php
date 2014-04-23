<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_parser')){

	function css_parser( $styles ){

        foreach( $styles as $style ){
        ?>
        <link rel="stylesheet" href="<?php echo site_url( 'assets' ) . '/'. $style; ?>">
        <?php
        }

	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('script_parser')){

	function script_parser( $scripts ){
		
        foreach( $scripts as $script ){
        ?>
        <script type="text/javascript" src="<?php echo site_url( 'assets' ) .'/'. $script; ?>"></script>
        <?php
        }

	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('google_font_parser')){

    function google_font_parser( $googleFonts ){
        foreach( $googleFonts as $googleFont ){
        ?>
        <link href="http://fonts.googleapis.com/css?family=<?= $googleFont; ?>" rel="stylesheet" type="text/css">
        <?php
        }
    }
}