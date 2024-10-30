<?php
/**
 * Customizer functionality.
 *
 */
if (!defined("ABSPATH")) {
    die();
}
function boatdealer_plugin_customize_register($wp_customize)
{
    $section_id = "bill_section";
    /*            ///  PANEL //////     */
    $r = $wp_customize->add_panel("bill_designer", [
        "title" => esc_html__("boatdealer Custom Design", "boatdealer"),
        "capability" => "edit_theme_options",
        "description" => esc_html__(
            'Click the Templates icon at the top left of the preview window to change your template. To customize further, simply click on any element, or it\'s corresponding shortcut icon, to edit it\'s styling. ',
            "boatdealer"
        ),
        "priority" => 150,
    ]);
    /*            ///  END PANEL //////             */
    /*            ///   SECTION HELP  //////     */
    $section_id = "boatdealer_help_section";
    $wp_customize->add_section($section_id, [
        "title" => __("Help", "boatdealer"),
        "capability" => "manage_options",
        "panel" => "bill_designer",
    ]);
    function boatdealer_custom_customize_render_section($section)
    {
        echo '<div style="text-align: center;">';
        submit_button("Help", "secondary", "submit_button_id", false, [
            "onclick" =>
                'window.open("https://boatdealerplugin.com/help/#91", "_blank"); return false;',
            "style" => "margin-bottom: 15px",
        ]);
        echo "&nbsp;&nbsp;&nbsp;";
        submit_button("Demo Video", "secondary", "submit_button_id", false, [
            "onclick" =>
                'window.open("https://cardealerplugin.com/movies/customizer.mp4", "_blank"); return false;',
            "style" => "margin-bottom: 15px",
        ]);
        echo "</div>";
    }
    add_action(
        "customize_render_section_boatdealer_help_section",
        "boatdealer_custom_customize_render_section"
    );
    // Section Template //
    $section_id = "template name";
    $wp_customize->add_section($section_id, [
        "title" => __("Templates", "boatdealer") . " (2 FREE)",
        "capability" => "manage_options",
        "description" => __(
            "Choose the Boat Dealer Template to Use.",
            "boatdealer"
        ),
        "panel" => "bill_designer",
    ]);
    /*            ///   END SECTION  //////     */
    // Single Boat Section Template //
        $section_id = "single_boat_template_name";
        $wp_customize->add_section($section_id, [
            "title" => __("Single Boat Templates", "boatdealer") . " (1 FREE)",
            "capability" => "manage_options",
            "description" => __(
                "Choose the Single Boat Template to Use.",
                "boatdealer"
            ),
            "panel" => "bill_designer",
        ]);
    /*            ///   END Single Boat SECTION  //////     */
    $section_id = "search Box";
    $wp_customize->add_section($section_id, [
        "title" => __("Search Box LayOut", "boatdealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Design the Search Box", "boatdealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("fields", [
        "title" => __("Search Box Fields", "boatdealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Manage the Design fields", "boatdealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("slider", [
        "title" => __("Search Box Slider", "boatdealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the price Slider.", "boatdealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("button", [
        "title" => __("Search Box Button", "boatdealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the Search Box Button.", "boatdealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("template", [
        "title" => __("Boat Template and Widgets", "boatdealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __(
            "Customize the Boat Template and Widgets.",
            "boatdealer"
        ),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("template-single", [
        "title" => __("Single Boat Template", "boatdealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the Single Boat Template.", "boatdealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("back-contact-us", [
        "title" => __("Buttons Back and Contact Us", "boatdealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __(
            "Customize the Buttons Back and Contact Us.",
            "boatdealer"
        ),
        "panel" => "bill_designer",
    ]);
    /* --------------------- END SECTIONS ---------------------- */
    /*    -------------  Fields --------------- */
    $wp_customize->add_setting("meu_plugin_help_link_setting", [
        "type" => "option",
    ]);
    $wp_customize->add_control("meu_plugin_help_link", [
        "label" => "Link de Ajuda aberto em nova janela.",
        "section" => "boatdealer_help_section",
        "settings" => "meu_plugin_help_link_setting",
        "type" => "url",
    ]);
    // exemplo de radio com PRO
    // Add a new setting
    $wp_customize->add_setting("myplugin_setting", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
/*
    $wp_customize->add_control("k_layout_type", [
        "section" => "fields",
        "settings" => "myplugin_setting",
        "type" => "radio",
        "label for" => __("Website Layout", "kardealer") . " -only pro-",
        "description" => "",
        "choices" => [
            "3" => "Boxed Width 1200px",
            "1" => "Boxed Width 1000px",
            "2" => "Wide",
        ],
    ]);
         ///   ADD PRO TO CONTROL   ///  */
    /*
    function boatdealer_customize_render_control($control)
    {
        ?>
			  <div>This is my custom content for the "My Plugin Setting" control.</div><div class="bill_pro" style="background:#ffab4a;border-radius: 50px;
			color: #fff; width:50px; text-align: center; padding-bottom: 4px; valign:middle;">pro</div>
			  <?php
    }
    add_action(
        "customize_render_control_k_layout_type",
        "boatdealer_customize_render_control"
    );
    */
    /*  		///   END ADD PRO TO CONTROL   ///  */
    $wp_customize->add_setting("boatdealer-plugin-search-fields-label-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-fields-label-color", [
        "label" => __("Search Fields Label Color", "boatdealer"),
        "section" => "fields",
        "settings" => "boatdealer-plugin-search-fields-label-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("boatdealer-plugin-search-fields-control-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-fields-control-color", [
        "label" => __("Search Fields Controls Color", "boatdealer"),
        "section" => "fields",
        "settings" => "boatdealer-plugin-search-fields-control-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("boatdealer-plugin-search-fields-control-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-fields-control-bkg-color", [
        "label" => __("Search Fields Controls Background Color", "boatdealer"),
        "section" => "fields",
        "settings" => "boatdealer-plugin-search-fields-control-bkg-color",
        "type" => "color",
    ]);
    //View Fields round
    $wp_customize->add_setting("boatdealer-plugin-search-fields-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-fields-radius", [
        "type" => "range",
        "section" => "fields",
        "settings" => "boatdealer-plugin-search-fields-radius",
        "label" => __("Search Fields Controls Border Radius",'boatdealer'),
        "description" => __("Border Radius: from 0 to 30.",'boatdealer'),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    // Flexslider
    $wp_customize->add_setting("boatdealer-plugin-search-slider-label-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-slider-label-color", [
        "label" => __("Search Slider Label Color", "boatdealer"),
        "section" => "slider",
        "settings" => "boatdealer-plugin-search-slider-label-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("boatdealer-plugin-search-slider-control-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-slider-control-color", [
        "label" => __("Search Slider Color", "boatdealer"),
        "section" => "slider",
        "settings" => "boatdealer-plugin-search-slider-control-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("boatdealer-plugin-search-slider-handle-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-slider-handle-color", [
        "label" => __("Search Slider Handle Color", "boatdealer"),
        "section" => "slider",
        "settings" => "boatdealer-plugin-search-slider-handle-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("boatdealer-plugin-search-slider-control-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-slider-control-bkg-color", [
        "label" => __("Search Slider Background Color", "boatdealer"),
        "section" => "slider",
        "settings" => "boatdealer-plugin-search-slider-control-bkg-color",
        "type" => "color",
    ]);
    //View Fields round
    $wp_customize->add_setting("boatdealer-plugin-search-slider-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-slider-radius", [
        "type" => "range",
        "section" => "slider",
        "label" => __("Search Slider Border Radius",'boatdealer'),
        "description" => __("Border Radius: from 0 to 30.",'boatdealer'),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    // Slider Border Color
    $wp_customize->add_setting("boatdealer-plugin-search-slider-border-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-slider-border-color", [
        "label" => __("Search Slider Border Color", "boatdealer"),
        "section" => "slider",
        "settings" => "boatdealer-plugin-search-slider-border-color",
        "type" => "color",
    ]);
    /*    -------------  END BUTTONS -------- */
    /*    -------------  BUTTON -------- */
    //Button Background
    //Button Color
    $wp_customize->add_setting("boatdealer-plugin-search-button-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-button-color", [
        "label" => __("Search Box Button Text Color", "boatdealer"),
        "section" => "button",
        "settings" => "boatdealer-plugin-search-button-color",
        "type" => "color",
    ]);
    //Button Background
    $wp_customize->add_setting("boatdealer-plugin-search-button-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-button-bkg-color", [
        "label" => __("Search Box Button Background Color", "boatdealer"),
        "section" => "button",
        "settings" => "boatdealer-plugin-search-button-bkg-color",
        "type" => "color",
    ]);
    //Search  Button width
    $wp_customize->add_setting("boatdealer-plugin-search-button-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-button-width", [
        "type" => "range",
        "section" => "button",
        "label" => __("Search Box Button Width",'boatdealer'),
        "description" => __("Button width: from 100 to 300.",'boatdealer'),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);
    $wp_customize->add_setting("boatdealer-plugin-search-button-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-button-radius", [
        "type" => "range",
        "section" => "button",
        "label" => __("Search Box Button Border Radius",'boatdealer'),
        "description" => __("Border Radius: from 0 to 30.",'boatdealer'),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    /*    -------------  END BUTTON -------- */
    /*    -------------  SLIDER -------- */
    /*    -------------  END SLIDER -------- */
    /*    -------------  TEMPLATE -------- */
    // choose template type
    $wp_customize->add_setting("boatdealer_template_gallery", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage", // 'refresh',
    ]);
    $wp_customize->add_control("boatdealer_template_gallery", [
        "section" => "template name",
        "settings" => "boatdealer_template_gallery",
        "type" => "radio",
        "label" => __("Template Name", "boatdealer"),
        "description" => "",
        "choices" => [
            "yes" => "Gallery",
            "list" => "List View",
            "grid" => "Grid",
        ],
    ]);
    function boatdealer_customize_render_control($control)
    {
        ?>
			  <div>Template Grid is Pro. You can use, for free, Gallery and List View.</div><div class="bill_pro" style="background:#ffab4a;border-radius: 50px;
			color: #fff; width:50px; text-align: center; padding-bottom: 4px; valign:middle;">pro</div>
			  <?php
    }
    add_action(
        "customize_render_control_boatdealer_template_gallery",
        "boatdealer_customize_render_control"
    );
    //$section_id = "single_boat template name";
        // choose single boat template type
        $wp_customize->add_setting("boatdealer_template_single", [
            "default" => "",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage", // 'refresh',
        ]);
        $wp_customize->add_control("boatdealer_template_single", [
            "section" => "single_boat_template_name",
            "settings" => "boatdealer_template_single",
            "type" => "radio",
            "label" => __("Single Boat Template Name", "boatdealer"),
            "description" => "",
            "choices" => [
                '1'=> 'Model 1 (free)',
				'2'=> 'Model 2 (with sidebar) (pro)',
				'3'=> 'Model 3 (pro) ',
            ],
        ]);
        // choose single boat template type
        $wp_customize->add_setting("boatdealer_modal_size", [
            "default" => "",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage", // 'refresh',
        ]);
        /*
        $wp_customize->add_control("boatdealer_modal_size", [
            "section" => "single_boat_template_name",
            "settings" => "boatdealer_modal_size",
            "type" => "radio",
            "label" => __("Single Boat Template Pop Up Modal Width", "boatdealer"),
            "description" => "",
            "choices" => [
                '1'=> '800 px',
				'2'=> '900 px',
				'3'=> '1000 px',
            ],
        ]);
        */
    //Text template page Color
    $wp_customize->add_setting("boatdealer-plugin-template-fg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-fg-color", [
        "label" => __("Template Text Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-fg-color",
        "type" => "color",
    ]);
    //Background template page
    $wp_customize->add_setting("boatdealer-plugin-template-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-bk-color", [
        "label" => __("Template Background Color (works with templates gallery and list view)", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-bk-color",
        "type" => "color",
    ]);
    //Text template title Color
    $wp_customize->add_setting("boatdealer-plugin-template-title-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-title-color", [
        "label" => __("Template Title Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-title-color",
        "type" => "color",
    ]);
    //View Button Color
    $wp_customize->add_setting("boatdealer-plugin-template-button-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-button-color", [
        "label" => __("Template Button View Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-button-color",
        "type" => "color",
    ]);
    //View Button Background Color
    $wp_customize->add_setting("boatdealer-plugin-template-button-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-button-bkg-color", [
        "label" => __("Template Button View Background Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-button-bkg-color",
        "type" => "color",
    ]);
    //View Button round
    $wp_customize->add_setting("boatdealer-plugin-template-button-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-button-radius", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Button View Border Radius",'boatdealer'),
        "description" => __("Border Radius: from 0 to 30.",'boatdealer'),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    //View Button width
    $wp_customize->add_setting("boatdealer-plugin-template-button-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-button-width", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Button View Width",'boatdealer'),
        "description" => __("Button width: from 100 to 300.",'boatdealer'),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);
    //Theme List View Separator
    $wp_customize->add_setting("boatdealer-plugin-template-list-separator", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-list-separator", [
        "label" => __("Template List View Separator Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-list-separator",
        "type" => "color",
    ]);
    //Theme Grid Border
    $wp_customize->add_setting("boatdealer-plugin-template-grid-border", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    // grid border ...
    $wp_customize->add_control("boatdealer-plugin-template-grid-border", [
        "label" => __("Template Grid Border Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-grid-border",
        "type" => "color",
    ]);
    //Theme Gallery Border color
    $wp_customize->add_setting("boatdealer-plugin-template-gallery-border", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-gallery-border", [
        "label" => __("Template Gallery and Widgets Border Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-gallery-border",
        "type" => "color",
    ]);
    //Theme Gallery Border color
    $wp_customize->add_setting("boatdealer-plugin-template-gallery-border-radius", [
        "default" => "5",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-gallery-border-radius", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Gallery and Widgets Border Radius",'boatdealer'),
        "description" => __("Border Radius: from 0 to 30.",'boatdealer'),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    $wp_customize->add_setting("boatdealer-plugin-template-gallery-title", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-gallery-title", [
        "label" => __("Template Gallery and Widgets Title Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-gallery-title",
        "type" => "color",
    ]);
    $wp_customize->add_setting("boatdealer-plugin-template-gallery-title-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-gallery-title-bkg", [
        "label" => __(
            "Template Gallery and Widgets Title Background Color",
            "boatdealer"
        ),
        "section" => "template",
        "settings" => "boatdealer-plugin-template-gallery-title-bkg",
        "type" => "color",
    ]);
    $wp_customize->add_setting("boatdealer-plugin-widget-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-widget-bkg", [
        "label" => __("Widget Search Background Color", "boatdealer"),
        "section" => "template",
        "settings" => "boatdealer-plugin-widget-bkg",
        "type" => "color",
    ]);
    /*    -------------  END TEMPLATE -------- */
    /*    -------------  SINGLE CAR -------- */
    //single Background
    $wp_customize->add_setting("boatdealer-plugin-template-single-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-single-bk-color", [
        "label" => __("Single Boat Template Background Color (works with templates 1 and 4", "boatdealer"),
        "section" => "template-single",
        "settings" => "boatdealer-plugin-template-single-bk-color",
        "type" => "color",
    ]);
    //single color
    $wp_customize->add_setting("boatdealer-plugin-template-single-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-single-color", [
        "label" => __("Single Boat Template Color", "boatdealer"),
        "section" => "template-single",
        "settings" => "boatdealer-plugin-template-single-color",
        "type" => "color",
    ]);
    // features background
    $wp_customize->add_setting("boatdealer-plugin-template-single-features-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-single-features-bkg", [
        "label" => __(
            "Single Boat Template Features Title Background Color",
            "boatdealer"
        ),
        "section" => "template-single",
        "settings" => "boatdealer-plugin-template-single-features-bkg",
        "type" => "color",
    ]);
    //features color
    $wp_customize->add_setting("boatdealer-plugin-template-single-features-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-template-single-features-color", [
        "label" => __("Single Boat Template Features Title Color", "boatdealer"),
        "section" => "template-single",
        "settings" => "boatdealer-plugin-template-single-features-color",
        "type" => "color",
    ]);
    //features Border
    $wp_customize->add_setting(
        "boatdealer-plugin-template-single-features-border-color",
        [
            "default" => "#ffffff",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage",
        ]
    );
    $wp_customize->add_control(
        "boatdealer-plugin-template-single-features-border-color",
        [
            "label" => __(
                "Single Boat Template Features Border Color",
                "boatdealer"
            ),
            "section" => "template-single",
            "settings" => "boatdealer-plugin-template-single-features-border-color",
            "type" => "color",
        ]
    );
    // Border radius
    $wp_customize->add_setting(
        "boatdealer-plugin-template-single-features-border-radius",
        [
            "default" => "#ffffff",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage",
        ]
    );
    $wp_customize->add_control(
        "boatdealer-plugin-template-single-features-border-radius",
        [
            "type" => "range",
            "section" => "template-single",
            "label" => __("Features Border Radius",'boatdealer'),
            "description" => __("Features Border Radius: from 0 to 30.",'boatdealer'),
            "settings" => "boatdealer-plugin-template-single-features-border-radius",
            "input_attrs" => [
                "min" => 0,
                "max" => 30,
                "step" => 1,
            ],
        ]
    );
    /*    -------------  END SINGLE CAR -------- */
    // Layout
    //Search Background
    $wp_customize->add_setting("boatdealer-plugin-search-box-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-box-bk-color", [
        "label" => __("Background Color", "boatdealer"),
        "section" => "search Box",
        "settings" => "boatdealer-plugin-search-box-bk-color",
        "type" => "color",
    ]);
    // Border size
    $wp_customize->add_setting("boatdealer-plugin-search-box-border-size", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-box-border-size", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Border Size",'boatdealer'),
        "description" => __(
            "Border Size: from 0 to 5. Mark 0 to hide the Boarder.", 'boatdealer'
        ),
        "input_attrs" => [
            "min" => 0,
            "max" => 5,
            "step" => 1,
        ],
    ]);
    // Border radius
    $wp_customize->add_setting("boatdealer-plugin-search-box-border-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-box-border-radius", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Border Radius",'boatdealer'),
        "description" => __("Border Radius: from 1 to 70px.",'boatdealer'),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    //Search Border Color
    $wp_customize->add_setting("boatdealer-plugin-search-box-border-color", [
        "default" => "#cccccc",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-box-border-color", [
        "label" => __("Border Color", "boatdealer"),
        "section" => "search Box",
        "settings" => "boatdealer-plugin-search-box-border-color",
        "type" => "color",
    ]);
    // Margin Bottom
    $wp_customize->add_setting("boatdealer-plugin-search-box-margin-bottom", [
        "default" => "25",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-search-box-margin-bottom", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Margin Bottom",'boatdealer'),
        "description" => __("Margin Bottom: from 0 to 30.",'boatdealer'),
        "input_attrs" => [
            "min" => 0,
            "max" => 70,
            "step" => 1,
        ],
    ]);
    // end layout
    /*    -------------  Go Back and Contact Us BUTTONs -------- */
    //Button Color
    $wp_customize->add_setting("boatdealer-plugin-back-contact-buttons-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-back-contact-buttons-color", [
        "label" => __("Back and Contact Us Buttons Color", "boatdealer"),
        "section" => "back-contact-us",
        "settings" => "boatdealer-plugin-back-contact-buttons-color",
        "type" => "color",
    ]);
    //Button Background
    $wp_customize->add_setting("boatdealer-plugin-back-contact-buttons-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("boatdealer-plugin-back-contact-buttons-bk-color", [
        "label" => __(
            "Back and Contact Us Buttons Background Color",
            "boatdealer"
        ),
        "section" => "back-contact-us",
        "settings" => "boatdealer-plugin-back-contact-buttons-bk-color",
        "type" => "color",
    ]);
    //boatdealer-plugin-back-contact-buttons-width
    $wp_customize->add_setting("boatdealer-plugin-back-contact-buttons-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "boatdealer_my_custom_callback", // sua callback function personalizada
    ]);
    $wp_customize->add_control("boatdealer-plugin-back-contact-buttons-width", [
        "type" => "range",
        "section" => "back-contact-us",
        "label" => __("Back and Contact Us Buttons width",'boatdealer'),
        "description" => __("Border Radius: from 100 to 300.",'boatdealer'),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);
    $wp_customize->add_setting("boatdealer-plugin-back-contact-buttons-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "boatdealer_my_custom_callback", // sua callback function personalizada
    ]);
    //boatdealer-plugin-back-contact-buttons-radius
    $wp_customize->add_setting("boatdealer-plugin-back-contact-buttons-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "boatdealer_my_custom_callback", // sua callback function personalizada
    ]);
    $wp_customize->add_control("boatdealer-plugin-back-contact-buttons-radius", [
        "type" => "range",
        "section" => "back-contact-us",
        "label" => __("Back and Contact Us Buttons Border Radius",'boatdealer'),
        "description" => __("Border Radius: from 0 to 30.",'boatdealer'),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    function boatdealer_my_custom_callback($value)
    {
        // código para tratar as atualizações do setting
    }
    /*    -------------  END BUTTONS -------- */
}
add_action("customize_register", "boatdealer_plugin_customize_register", 11);
