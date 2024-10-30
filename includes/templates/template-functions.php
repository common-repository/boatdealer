<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
 function boatdealer_content_detail(){
    Global $post_product_id;
    $post_product_id = get_the_ID();
    ?>
    <div class="multi-content">
         <div id="sliderWrapper">
        </div> <!-- end featuredCar -->      
             <div class="boatdealer-plugin-featuredTitle"> 
             <?php echo esc_attr__('Details', 'boatdealer');?> 
             </div>
             <?php 
        $afieldsId = boatdealer_get_fields('all');
        $totfields = count($afieldsId);
        $ametadataoptions = array();
        echo '<div class="featuredCar">';
        for ($i = 0; $i < $totfields; $i++) {
            $post_id = $afieldsId[$i];
            $ametadata = boatdealer_get_meta($post_id);        
            if (!empty($ametadata[0]))
                $label = $ametadata[0];
            else
                $label = $ametadata[12];
            $field_id = 'boat-'.$ametadata[12];
            $value = get_post_meta($post_product_id, $field_id, true);
             $typefield = $ametadata[1];
             if ($value != '') 
             { 
                 if ($typefield == 'checkbox')
                 {
                   if($value == 'enabled')
                     $value = __('Yes', 'boatdealer');
                   else
                     $value = __('No', 'boatdealer');
                 }
                  ?>
                 <div class="boatdealer-plugin-featuredList">             
                 <span class="multiBold"> <?php echo esc_attr($label);?>: </span><?php echo '<b>'.esc_attr($value).'</b>';?> 
                 </div><!-- End of featured list -->
             <?php }
        } // end for ?>
        </div><!-- End of featured car -->
       <div class="boatdealer-plugin-featuredTitle"> 
       <?php echo esc_attr__('Features', 'boatdealer');?> 
       </div> 
       <div class="featuredCar">
       <?php function boat_taxonomy( $taxonomy ) {
                         Global $post_product_id;
    					 $terms = get_the_terms( $post_product_id, $taxonomy );
                         $return = '';
    					 if ( $terms ) {
    						 foreach($terms as $term) {
    						       $return .= '<div class="boatdealer-plugin-featuredList">'.$term->name.'</div>';
                                } 
    					     }
    					 return $return;
                       } 
                     $output = boat_taxonomy( 'features' );
                     echo esc_attr($output);
                 ?>
        </div> <!-- end featuredCar -->
     </div> <!-- end of Multi Content --> 
     </div> <!-- end of Slider Wrapper -->
     <?php 
  } 
 function boatdealer_content_info () {
        Global $post_product_id;
    ?>
 <div class="contentInfo">
         <div class="multiPriceSingle">
         	<?php 
            $price = get_post_meta(get_the_ID(), 'boat-price', true);
           if ($price <> '' and $price != '0')
             { 
                $price =   number_format_i18n($price,0);
                $price = boatdealer_currency() . $price;
             }
             else
                $price =  __('Call for Price', 'boatdealer'); 
            echo esc_attr($price);
    		?> 
         </div>
         <div class="multiContent">
         	<?php the_content(); ?>
         </div> 
  </div>	        
         <?php
         $terms = get_the_terms( $post_product_id, 'model' );
         if ( $terms )
         {
             ?>
             <div class="boatdealer-plugin-featuredTitle"> 
             <?php echo esc_attr__('Model', 'boatdealer');
             foreach($terms as $term) {
    			echo ': '. esc_attr($term->name);
                break;
             }
            echo '</div>';
         }
         ?>
                <?php if(is_array($terms)) 
                 echo '<div class="featuredCar">'; 
                ?>    
            <div class="multiDetail">

            
            
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_html(__('Fuel', 'boatdealer')); ?>: </span><?php echo esc_html(get_post_meta(get_the_ID(), 'boat-fuel', true)); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_html(__('Year', 'boatdealer')); ?>: </span><?php echo esc_html(get_post_meta(get_the_ID(), 'boat-year', true)); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_html(get_option('boatdealer_measure', 'Miles'), 'boatdealer'); ?>: </span><?php echo esc_html(get_post_meta(get_the_ID(), 'boat-miles', true)); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_html(__('Cond', 'boatdealer')); ?>: </span><?php echo esc_html(get_post_meta(get_the_ID(), 'boat-con', true)); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_html(__('HP', 'boatdealer')); ?>: </span><?php echo esc_html(get_post_meta(get_the_ID(), 'boat-hp', true)); ?></div>
                            
                            
            
            
              </div>
             <?php if(is_array($terms)) 
              echo '</div>'; 
             ?>       
 <?php }
function boatdealer_detail() {
  echo '<div class="multi-content">';
	while ( have_posts() ) : the_post(); 
       boatdealer_title_detail();
       boatdealer_content_info();
      ?> 
      <div class="multicontentWrap">
	    <?php boatdealer_content_detail (); ?>
      </div><?php
     break;
   endwhile; // end of the loop.
   echo '</div>';
}
function boatdealer_title_detail(){
global $boatdealer_the_title;
   $boatdealer_the_title = get_the_title(); 
  ?>
    <div class="multi-detail-title">  <?php echo esc_attr(BOATDEALERSINGLE_TITLE); ?> 
    </div>
<?php }
require_once(BOATDEALERPLUGINPATH . "assets/php/boatdealer_mr_image_resize.php");
function boatdealer_theme_thumb($url, $width, $height=0, $align='') {
        if (get_the_post_thumbnail()=='') {
    	  	$url = BOATDEALERIMAGES.'image-no-available.jpg';
		}
       return boatdealer_mr_image_resize($url, $width, $height, true, $align, false);
}
function boatdealer_profile()
{
global $post;
$taxonomies = get_taxonomies();
$terms = get_the_terms( $post->ID, 'team' );
 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    foreach ( $terms as $term ) {
    }
 }
 if( !isset($term->term_id))
    return;
  $termId = $term->term_id;
 $termName = $term->name;
 $termMeta = get_option( 'team_' . $termId );
  echo '<div class = "boatdealer_profile">';
    echo '<div class = "boatdealer_wrapprofile">';
      echo '<div class = "boatdealer_fotoprofile">';
          if(! empty($termMeta['image']))
          {
            echo '<img class="boatdealerimg-circle" src="' . esc_url($termMeta["image"]) . '" />';
          }
          else
          {
             $image = BOATDEALERMAGES . 'imagenoavailable800x400_br.jpg';
             echo '<img class="reatestateimg-circle" src="' . esc_url($image) . '" />';

          }
      echo '</div>'; 
     echo '<div class = "boatdealer_textoprofile">';
      echo '<div class = "boatdealer_nameprofile">';

      // if(!empty($termName)){ esc_attr_e($termName,'boatdealer'); }
      if(!empty($termName)){ echo esc_attr($termName); }

      echo '</div>';
      echo '<div class = "boatdealer_titleprofile">';

      //if(!empty($termMeta['function'])){ esc_attr_e($termMeta['function'],'>>>>>>boatdealer'); }
      if(!empty($termMeta['function'])){ echo esc_attr($termMeta['function']); }
  
      echo '</div>';     
      echo '<div class = "boatdealer_descriptionprofile">';
      //echo esc_html(substr(term_description( $termId, 'agents' ),0,140));
      echo esc_html(substr(term_description($termId), 0, 140));

      //echo 'description description description description description ';
      echo '</div>';
    ?>
     <div class = "boatdealer_iconsprofile"> 
      <?php 
          if(! empty($termMeta['phone']))
          {
            echo '<i class="fa fa-phone" aria-hidden="true"></i>';
            echo '&nbsp;'. esc_attr($termMeta['phone']);
            echo '<br />';
          }
          if(! empty($termMeta['skype']))
          {
            echo '<i class="fa fa-skype" aria-hidden="true"></i>';
            echo '&nbsp;'. esc_attr($termMeta['skype']);
            echo '<br />';
          }
          if(! empty($termMeta['email']))
          {
            echo ' <a href="mailto:'.esc_attr($termMeta['email']).'"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }      
          if(! empty($termMeta['facebook']))
          {
            echo ' <a href="http://facebook.com/'. esc_attr($termMeta['facebook']).'"><i class="fa fa-facebook" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }
          if(! empty($termMeta['twitter']))
          {
            echo ' <a href="http://twitter.com/'. esc_attr($termMeta['twitter']).'"><i class="fa fa-twitter" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }   
          if(! empty($termMeta['linkedin']))
          {
            echo ' <a href="http://linkedin.com/'. esc_attr($termMeta['linkedin']).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }
          if(! empty($termMeta['instagram']))
          {
            echo ' <a href="http://instagram.com/'. esc_attr($termMeta['instagram']).'"><i class="fa fa-instagram" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          } 
          if(! empty($termMeta['vimeo']))
          {
            echo '<a href="http://vimeo.com/'. esc_attr($termMeta['vimeo']).'"><i class="fa fa-vimeo" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }       
          if(! empty($termMeta['youtube']))
          {
            echo '<a href="http://youtube.com/'. esc_attr($termMeta['youtube']).'"><i class="fa fa-youtube" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }          
      ?>
  </div>
  <?php
      echo '</div>'; 
   echo '</div>';      
   echo '</div>';  
 echo '</div>';     
}
