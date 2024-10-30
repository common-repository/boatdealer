<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined("ABSPATH")) {
    exit();
} // Exit if accessed directly
function boatdealer_show_boats($atts)
{
    $output = '<div id="boatdealer_content">';
    if (isset($atts["onlybar"])) {
        $output .= boatDealer_search(1);
        $output .= "</div";
        return $output;
    }
    $boatdealer_pagination = "yes";
    if (!isset($postNumber)) {
        $postNumber = get_option("boatdealer_quantity", 6);
    }
    if (empty($postNumber)) {
        $postNumber = get_option("boatdealer_quantity", 6);
    }
    $output .= boatdealer_search(1);
    if (get_query_var("paged")) {
        $paged = get_query_var("paged");
    } elseif (get_query_var("page")) {
        $paged = get_query_var("page");
    }
    if (!isset($paged)) {
        $paged = boatdealer_get_page();
    }
    global $wp_query;
    wp_reset_query();
    $args = [
        "post_type" => "boats",
        "showposts" => $postNumber,
        "paged" => $paged,
        "orderby" => "date",
        "order" => "ASC",
    ];
    // orderby
    if (!empty($orderby)) {
        $args["orderby"] = "meta_value";
        $args["meta_type"] = "NUMERIC";
        if ($orderby == "price_high") {
            $args["meta_key"] = "boat-price";
            $args["order"] = "DESC";
        }
        if ($orderby == "price_low") {
            $args["meta_key"] = "boat-price";
            $args["order"] = "ASC";
        }
        if ($orderby == "year_high") {
            $args["meta_key"] = "boat-year";
            $args["order"] = "DESC";
        }
        if ($orderby == "year_low") {
            $args["meta_key"] = "boat-year";
            $args["order"] = "ASC";
        }
    } else {
        $args["orderby"] = "date";
        $args[] = "ASC";
    }
    /*    
    echo '<pre>';
    print_r($args);
    echo '</pre>';
    */
    $wp_query = new WP_Query($args);
    $qposts = $wp_query->post_count;
    $ctd = 0;
    $boatdealer_measure = get_option("boatdealer_measure", "M2");
    $output .= '<div class="multiGallery">';
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        $ctd++;
        $price = get_post_meta(get_the_ID(), "boat-price", true);
        if (!empty($price)) {
            $price = number_format_i18n($price, 0);
        }
        $image_id = get_post_thumbnail_id();
        if (empty($image_id)) {
            $image = BOATDEALERIMAGES . "image-no-available-800x400_br.jpg";
            $image = str_replace("-", "", $image);
        } else {
            $image_url = wp_get_attachment_image_src($image_id, "medium", true);
            $image = str_replace(
                "-" . $image_url[1] . "x" . $image_url[2],
                "",
                $image_url[0]
            );
        }
        $boatdealer_thumbs_format = trim(
            get_option("boatdealer_thumbs_format", "1")
        );
        if ($boatdealer_thumbs_format == "2") {
            $thumb = boatdealer_theme_thumb($image, 300, 225, "br");
        }
        // Crops from bottom right
        else {
            $thumb = boatdealer_theme_thumb($image, 400, 200, "br");
        } // Crops from bottom right
        $year = get_post_meta(get_the_ID(), "boat-year", true);
        $hp = get_post_meta(get_the_ID(), "boat-hp", true);
        $year = get_post_meta(get_the_ID(), "boat-year", true);
        /*
        $fuel =  __(
            get_post_meta(get_the_ID(), "boat-fuel", true),
            "boatdealer"
        );
        */
        $fuel =  get_post_meta(get_the_ID(), "boat-fuel", true);
        $transmission = get_post_meta(get_the_ID(), "transmission-type", true);
        $miles = get_post_meta(get_the_ID(), "boat-miles", true);
        $output .= '<br /><div class="boatdealer_container17">';
        $output .= '<div class="boatdealer_gallery_17">';
            $output .= '<a class="nounderline" href="' . get_permalink() . '">';
            $output .=
                '<img class="boatdealer_caption_img17" src="' . $thumb . '" />';
            $output .= "</a>";
        $output .= "</div>";
        // >>
        $output .= '<div class="multiInfoRight17">';
            $output .= '<a class="nounderline" href="' . get_permalink() . '">';
            $output .= '<div class="multiTitle17">' . get_the_title() . "</div>";
            $output .= "</a>";
        $output .= '<div class="multiInforightText17">';
        $output .= '<div class="multiInforightbold">';
            $output .= '<div class="boatdealer_smallblock">';
                if ($price != "" and $price != "0") {
                    $output .= boatdealer_currency() . $price;
                } else {
                    $output .= __("Call for Price", "boatdealer");
                }
            $output .= "</div>";
        if ($hp != "") {
            $output .= '<div class="boatdealer_smallblock">';
            $output .= '<span class="billcar-belt2">';
            $output .= " " . $hp . __("HP", "boatdealer");
            $output .= "</div>";
        }
        if ($year != "") {
          $output .= '<span class="billcar-calendar">';
            $output .= " " . $year;            
            $output .= '<div class="boatdealer_smallblock">';
            $output .= "</div>";
        }
        if ($fuel != "") {
            $output .= '<div class="boatdealer_smallblock">';
                $output .= '<span class="billcar-gas-station">';
                $output .= " " . $fuel;
            $output .= "</div>";
        }
        if ($transmission != "") {
            $output .= '<div class="boatdealer_smallblock">';
                $output .= '<span class="billcar-gearshift">';
                $output .= " " . $transmission;
            $output .= "</div>";
        }
        if ($miles != "") {
            $output .= '<div class="boatdealer_smallblock">';
                $output .= '<span class="billcar-dashboard">';
                $output .= " " . $miles;
                $output .= " " . $boatdealer_measure;
            $output .= "</div>";
        }
        $content_post = get_post(get_the_ID());
        $desc = sanitize_text_field($content_post->post_content);
        $desc = preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $desc);
        $output .= '<div class="boatdealer_description">';
            $output .= substr($desc, 0, 100);
            if (substr($desc, 200) != "") {
                $output .= "...";
            }
        $output .= "</div>";
        $output .= "</div>";
        // $output .= '<input type="submit" class="boatdealer_btn_view"';
        //$output .= '</a>';
        //$output .= '</div>';
        $output .= '</br>';
        $output .=
            '<input type="submit" class="boatdealer_btn_view" id="boatdealer_btn_view-' .
            strval($ctd) .
            '"';
        $output .= ' onClick="location.href=\'' . get_permalink() . '\'"';
        $output .= ' value="' . __("View", "boatdealer") . '" />';
        $output .= "</div>";
        //$output .= '</a>';
        $output .= "</div>";
        $output .= "</div>"; 
    endwhile;
    if ($boatdealer_pagination == "yes") {
        $output .= '<div class="boatdealer_navigation">';
        $output .= "";
        ob_start();
        the_posts_pagination([
            "mid_size" => 2,
            "prev_text" => __("Back", "textdomain"),
            "next_text" => __("Onward", "textdomain"),
        ]);
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= "</div>"; // boatdealer_container17
    }
    $output .= "</div>";  //$output .= '<div class="multiGallery">';
    wp_reset_postdata();
    wp_reset_query();
    if ($qposts < 1) {
        $output .= "<h4>" . __("Not Found !",'boatdealer') . "</h4>";
    }
    $output .= "</div>"; /* boatdealer_content */
    return $output;
}
add_shortcode("boat_dealer", "boatdealer_show_boats"); ?>
