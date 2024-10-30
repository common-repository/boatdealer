<?php
/**
 * Front-facing functionality.
 * 2023-05-31
 */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}
/**
 * Print inline style element.
 *
 */
function boatdealer_enqueue_dynamic_styles() {
    // Generate the dynamic CSS code
	$dynamic_styles = boatdealer_the_css();
		wp_register_style( 'boatdealer-plugin-dynamic-styles', false ); 
		wp_enqueue_style( 'boatdealer-plugin-dynamic-styles' ); 
		$r = wp_add_inline_style( 'boatdealer-plugin-dynamic-styles', $dynamic_styles ); 
}
 add_action( 'wp_enqueue_scripts', 'boatdealer_enqueue_dynamic_styles', 99999 );
/*
 function boatdealer_enqueue_dynamic_script2() {
	$boatdealer_template_button_color =	get_option( 'boatdealer-plugin-template-button-color', 'white' );
	$boatdealer_template_button_bkg_color =	get_option( 'boatdealer-plugin-template-button-bkg-color', 'gray' );
	$boatdealer_template_button_radius =	get_option( 'boatdealer-plugin-template-button-radius', '0 px' );
	$set_border =  $boatdealer_template_button_radius.'px';
	$set_bkg_color = $boatdealer_template_button_bkg_color;
	$set_color = $boatdealer_template_button_color;
	$boatdealer_slider_color =	get_option( 'boatdealer-plugin-search-slider-control-bkg-color', '0 px' );
	$boatdealer_template_single_features_border_color = get_option( 'boatdealer-plugin-template-single-features-border-color', 'gray' );
    $dynamic_script = "
        jQuery(document).ready(function($) {
			var count = $('[id^=\"boatdealer_btn_view-\"]').length;
			for (let i = 1; i <= count; i++) {
				let elementId = '#boatdealer_btn_view-' + i;
				//console.log(elementId);
				$(elementId).css('background', '$set_bkg_color');
				$(elementId).css('color', '$set_color');
				$(elementId).css('border-radius', '$set_border');
			}
			var setcolor = '1px solid $boatdealer_template_single_features_border_color';
			$('.featuredCar').css('border', 'setcolor');
		});
    ";
    $handle = 'dynamic-script';
	wp_register_script( 'boatdealer-plugin-dynamic-script', false ); 
	wp_enqueue_script( 'boatdealer-plugin-dynamic-script' ); 
    wp_add_inline_script( 'boatdealer-plugin-dynamic-script', $dynamic_script );
}
*/
function boatdealer_enqueue_dynamic_script2() {
    // Sanitizar as opções do plugin
    $boatdealer_template_button_color = sanitize_text_field(get_option('boatdealer-plugin-template-button-color', 'white'));
    $boatdealer_template_button_bkg_color = sanitize_text_field(get_option('boatdealer-plugin-template-button-bkg-color', 'gray'));
    $boatdealer_template_button_radius = sanitize_text_field(get_option('boatdealer-plugin-template-button-radius', '0px'));
    $set_border = esc_attr($boatdealer_template_button_radius);
    $set_bkg_color = esc_attr($boatdealer_template_button_bkg_color);
    $set_color = esc_attr($boatdealer_template_button_color);
    $boatdealer_slider_color = sanitize_text_field(get_option('boatdealer-plugin-search-slider-control-bkg-color', '0px'));
    $boatdealer_template_single_features_border_color = sanitize_text_field(get_option('boatdealer-plugin-template-single-features-border-color', 'gray'));

    // Gerar o script dinâmico e sanitizar as variáveis dentro do JavaScript
    $dynamic_script = "
        jQuery(document).ready(function($) {
            var count = $('[id^=\"boatdealer_btn_view-\"]').length;
            for (let i = 1; i <= count; i++) {
                let elementId = '#boatdealer_btn_view-' + i;
                $(elementId).css('background', '" . esc_js($set_bkg_color) . "');
                $(elementId).css('color', '" . esc_js($set_color) . "');
                $(elementId).css('border-radius', '" . esc_js($set_border) . "');
            }
            var setcolor = '1px solid " . esc_js($boatdealer_template_single_features_border_color) . "';
            $('.featuredCar').css('border', setcolor);
        });
    ";

    // Registrar e enfileirar o script dinâmico
    wp_register_script('boatdealer-plugin-dynamic-script', false);
    wp_enqueue_script('boatdealer-plugin-dynamic-script');
    wp_add_inline_script('boatdealer-plugin-dynamic-script', $dynamic_script);
}


// add_action( 'wp_enqueue_scripts', 'boatdealer_enqueue_dynamic_script2','99999' );
/**
 * Echo the CSS.
 *
 */
function boatdealer_the_css() { ?>
	<style type='text/css'>
	/* Car Template */
	.boatdealer-plugin-item-grid { 
	   border : 1px solid #3f3f3f;
	}
	.boatdealer_gallery_2016 { 
	   border : 1px solid #515151;
	   border-radius : 3px 3px 0px 0px; 
	}
	.sideTitle, .boatdealer_caption_img, .boatdealer_caption_text, .boatdealer_gallery_2016 { 
	    border-radius : 3px 3px 0px 0px; 
	}
	 .sideTitle, .multiTitle-widget { 
	   background : #595959;
	   color: #ffffff; 
	   border-radius : 3px 3px 0px 0px; 
	}
	.carTitle{
		background : #595959;
	   color: #ffffff; 
	}
	#boatdealer_content { 
	    background : #ffffff;
	}
	.billcar-belt2, .multiTitle17, .multiInforightText17  {
		color : #595959;
	}
    .boatdealer_description, #boatdealer_content, .multiBasicRow, .multi-content-modal {
		color : #5b5b5b;
		width : 150px; ;
		background', '$set_bkg_color');
		color', '$set_color');
		'border-radius', '$set_border');
	}
	.boatdealer_container17 {
		border-bottom:  1px solid #999999 ;
	}
    /* Single Car Template */
	#content2 {
		background : #ffffff;
	}
	.multiContent, #content2, .boatdealer-plugin-featuredList, .multicontentWrap {
		color : #595959;
	}
	.boatdealer-plugin-featuredTitle {
		color : #ffffff;	
		background : #919191;
		border-radius : 6px 6px 0px 0px ;
	}
	.featuredCar {
		/* color : #595959; */
		border : 1px solid #969696;
		border-radius : 0px 0px 6px 6px;
	}
	.boatdealer-plugin-featuredList {
		color : #595959;
	}
	#boatdealer_goback, #boatdealer_cform  {
		color : white;	
		background : #7a7a7a;
		border-radius : 5px;;
		width: 170px;;	
	}
	#boatdealer-plugin-submitBtn, #boatdealer-plugin-submitBtn-widget  {
		color : #ffffff;	
		background : #5b5b5b;
		border-radius : 4px;;
		width : 170px;;
	}
	.boatdealer-plugin-search-box {
		background-color : #ededed;
		border : 6px;
		border-radius : 4px;;
		border-color : #067e8d;
    }
	#boatdealer-plugin-search-box {
		margin-bottom: 26px;;
    }
    .boatdealer-plugin-search-label, .search-label-widget {
		color : #636363;
	}
	.boatdealer-plugin-select-box-meta, .boatdealer-plugin-select-box-meta-widget  {
		color : #4f4f4f;	
		background : white;
		border-radius : 3px;;
	}
	.boatdealerlabelprice , #meta_price, .boatdealerlabelprice2 , #meta_price2 {
      color : #494949;
    }
	/* slider */
	.ui-slider .ui-slider-range{
		/* margin-top: 20px; */
		background : #7c7c7c; 
	}
	.ui-state-default, .ui-widget-content .ui-state-default{
		/* margin-top: 20px; */
		background : #7c7c7c; /*!important; */ 
	}
	#slider-button-0, #slider-button-1, #slider-button-2, #slider-button-3  {
		background: #999999;
		width: 1.0em;
		height: 1.0em;
		border-radius: 50%
	}
	.boatdealer-plugin-price-slider, .boatdealer-plugin-price-slider2 {
		background: #d1d1d1; 
		border-radius: 5px;;
		border: 1px solid #f25310;
	}
	#boatdealer-plugin-search-box-widget {
		background: #e0e0e0;	
	}
	[id^="boatdealer_btn_view-"] {
		width: 150px;;
    }
</style>
<?php
}
