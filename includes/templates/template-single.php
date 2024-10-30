<?php
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function boatdealer_add_custom_js_to_header() {
    ?>
    <script type="text/javascript">
        function boatdealer_goBack() {
            window.history.back(); 
        }
    </script>
    <?php
}
add_action('wp_head', 'boatdealer_add_custom_js_to_header');


$my_theme =  strtolower(wp_get_theme());
if ($my_theme == 'twenty fourteen')
{
?>
<style type="text/css">
<!--
	.site::before {
    width: 0px !important;
}
-->
</style>
<?php 
}
define('BOATDEALERSINGLE_TITLE', get_the_title() );
 get_header();
  ?>
	    <div id="container2"> 
        <?php 
        if(isset($_SERVER['HTTP_REFERER']))
         {?>
          <center>
          <button id="boatdealer_goback" onclick="boatdealer_goBack()">
          <?php 
          echo esc_attr__('Back', 'boatdealer');?> 
          </button>
          <br /><br />
          </center>
        <?php } ?>


           <?php boatdealer_profile(); ?>  

            <div id="content2" role="main">
				<?php boatdealer_detail();
               $boatdealer_enable_contact_form = trim(get_option('boatdealer_enable_contact_form', 'yes'));
               if ($boatdealer_enable_contact_form == 'yes')
               {               
                ?>
                 <br />
                 <center>
                 <button id="boatdealer_cform">
                 <?php echo esc_attr__('Contact Us', 'boatdealer'); ?>
                 </button>
                 </center>
                 <br />
			</div> 
            <?php 
            } 
            //
            //   $boatdealer_the_title = get_the_title();
               if ($boatdealer_enable_contact_form == 'yes') 
               {
                   include_once (BOATDEALERPLUGINPATH . 'includes/contact-form/multi-contact-show-form.php');  
               }
         ?>  
		</div>
<?php 
        $registered_sidebars = wp_get_sidebars_widgets();
        foreach( $registered_sidebars as $sidebar_name => $sidebar_widgets ) {
        	unregister_sidebar( $sidebar_name );
        }
get_footer(); 
?>