<?php

/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (! defined('ABSPATH')) exit; // Exit if accessed directly
if (is_admin()) {
    add_action('current_screen', 'boatdealer_this_screen');
    function boatdealer_this_screen()
    {
        require_once(ABSPATH . 'wp-admin/includes/screen.php');
        $current_screen = get_current_screen();
        //echo $current_screen->id;
        //die();
        //boat-dealer_page_md-locations
        if ($current_screen->id === "edit-boatdealerfields") {
            boatdealer_contextual_help_fields($current_screen);
        } elseif ($current_screen->id === "boats") {
            boatdealer_contextual_help_boats($current_screen);
        } elseif ($current_screen->id === "edit-model") {
            boatdealer_contextual_help_models($current_screen);
        } elseif ($current_screen->id === "edit-team") {
            boatdealer_contextual_help_agents($current_screen);
        } elseif ($current_screen->id === "edit-features") {
            boatdealer_contextual_help_features($current_screen);
        } elseif ($current_screen->id === "edit-locations") {
            boatdealer_contextual_help_locations($current_screen);
        } elseif ($current_screen->id === "toplevel_page_boat_dealer_plugin" or  $current_screen->id === "admin_page_boatdealer_settings") {
            boatdealer_main_help($current_screen);
        } else {
            if (isset($_GET['page'])) {
                if (sanitize_text_field($_GET['page']) == 'boat_dealer_plugin') {
                    boatdealer_main_help($current_screen);
                }
            }
        }
    }
}
function boatdealer_main_help($screen)
{
    $myhelp = '<br>' . esc_attr__('The easiest way to manage, list and sell your boats online.', 'boatdealer');
    $myhelp .= '<br />';
    $myhelp .= esc_attr__('Follow the 3 steps in this main screen after installing the plugin.', 'boatdealer') . '<br />';
    $myhelp .= '<br />';
    $myhelp .= esc_attr__('You will find Context Help in many screens.', 'boatdealer');
    $myhelp .= '<br />';
    $myhelp .= esc_attr__('You can also find our complete Online Guide', 'boatdealer') . ' <a href="http://boatdealerplugin.com/help/index.html" target="_self">' . esc_attr__('here.', 'boatdealer') . '</a>';
    
    $myhelpdemo = '<br />';
    $myhelpdemo .= esc_attr__('If you want to import demo data, download the demo data from this link:', 'boatdealer');
    $myhelpdemo .= '<br />';
    $myhelpdemo .= 'http://boatdealerplugin.com/demo-data/download-demo.php';
    $myhelpdemo .= '<br /><br />';
    $myhelpdemo .= esc_attr__('After download:', 'boatdealer');
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '1. ' . esc_attr__('Log in to that site as an administrator.', 'boatdealer');
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '2. ' . esc_attr__('Go to Tools: Import in the WordPress admin panel.', 'boatdealer');
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '3. ' . esc_attr__('Install the "WordPress" importer from the list.', 'boatdealer');
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '4. ' . esc_attr__('Activate & Run Importer.', 'boatdealer');
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '5. ' . esc_attr__('Upload the file downloaded using the form provided on that page.', 'boatdealer');
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '6. ' . esc_attr__('You will first be asked to map the authors in this export file to users on the site.', 'boatdealer');
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '7. ' . esc_attr__('WordPress will then import the demo data into your site.', 'boatdealer');
    $myhelpdemo .= '<br />';

    // Adicionando as abas de ajuda com as traduções
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-overview-tab',
        'title' => esc_attr__('Overview', 'boatdealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'import-demo',
        'title' => esc_attr__('Import Demo Data', 'boatdealer'),
        'content' => '<p>' . $myhelpdemo . '</p>',
    ));

    return;
}

function boatdealer_contextual_help_fields($screen)
{
    $myhelp = esc_attr__('In the FIELDS screen you can manage the main table fields. These fields will show up in your main boats form management, search bar, and search widget.', 'boatdealer');
    $myhelp .= '<br />';
    $myhelp .= esc_attr__('Each row represents one field.', 'boatdealer') . '<br />';
    $myhelp .= esc_attr__('For example:', 'boatdealer') . '<br />';
    $myhelp .= '<ul>
        <li>' . esc_attr__('Hull Material', 'boatdealer') . '</li>
        <li>' . esc_attr__('Number Passengers', 'boatdealer') . '</li>
        <li>' . esc_attr__('Interior Color', 'boatdealer') . '</li>
        <li>' . esc_attr__('And So On', 'boatdealer') . '</li>
    </ul>';
    $myhelp .= '<br />';
    $myhelp .= esc_attr__('You don\'t need to include these fields: Boat Type, Make, Price, Year, Miles, Engine, Interior Color, HP, Loa, Fuel Type, and Featured.', 'boatdealer') . '<br /><br />';
    $myhelp .= esc_attr__('Technical WordPress guys call this Metadata.', 'boatdealer') . '<br />';
    $myhelp .= esc_attr__('Don\'t create 2 fields with the same name.', 'boatdealer') . '<br /><br />';

    $myhelpAdd = esc_attr__('To add fields in the table, click the "Add New" button. This will open an empty window to include your information:', 'boatdealer');
    $myhelpAdd .= '<br />
    <ul>
        <li>' . esc_attr__('Field Name', 'boatdealer') . '</li>
        <li>' . esc_attr__('Field Label', 'boatdealer') . '</li>
        <li>' . esc_attr__('Field Order', 'boatdealer') . '</li>
        <li>' . esc_attr__('Show in Search Bar (your front page)', 'boatdealer') . '</li>
        <li>' . esc_attr__('Show in Search Widget (your front page)', 'boatdealer') . '</li>
        <li>' . esc_attr__('Type of Field', 'boatdealer') . '</li>
        <li>' . esc_attr__('And So On', 'boatdealer') . '</li>
    </ul>';
    $myhelpAdd .= esc_attr__('In that screen, move the mouse pointer over each field to get help about that field. Just fill it out and click the OK button.', 'boatdealer') . '<br /><br />';

    $myhelpTypes = esc_attr__('You have available these types of fields (Control Types):', 'boatdealer') . '<br />';
    $myhelpTypes .= '<ul>
        <li>' . esc_attr__('Text (Used by text and numbers). It is not possible to include this type of field in Search Bars.', 'boatdealer') . '</li>
        <li>' . esc_attr__('CheckBox', 'boatdealer') . '</li>
        <li>' . esc_attr__('Drop Down (also called select box)', 'boatdealer') . '</li>
        <li>' . esc_attr__('Range Select (you can define the min, max, and step values)', 'boatdealer') . '</li>
    </ul>';
    $myhelpTypes .= '<br />' . esc_attr__('For more details about HTML input types, please, check this page:', 'boatdealer');
    $myhelpTypes .= '<a href="https://www.w3schools.com/html/html_form_input_types.asp">https://www.w3schools.com/html/html_form_input_types.asp</a><br />';

    $myhelpEdit = esc_attr__('You can manage the table, i.e., Add, Edit, and Trash Fields.', 'boatdealer') . '<br />';
    $myhelpEdit .= esc_attr__('At the Add Fields and Edit Fields forms, put the mouse over each row, and the menu will show up. Then, click Edit or Trash.', 'boatdealer') . '<br />';
    $myhelpEdit .= esc_attr__('To know more about Edit Fields, please check the Add Fields Form option in this help menu.', 'boatdealer') . '<br />';

    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-overview-tab',
        'title' => esc_attr__('Overview', 'boatdealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-field-types',
        'title' => esc_attr__('Field Types', 'boatdealer'),
        'content' => '<p>' . $myhelpTypes . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-overview-add',
        'title' => esc_attr__('Add Fields Form', 'boatdealer'),
        'content' => '<p>' . $myhelpAdd . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-field-edit',
        'title' => esc_attr__('Edit and Trash Fields', 'boatdealer'),
        'content' => '<p>' . $myhelpEdit . '</p>',
    ));

    return;
}

function boatdealer_contextual_help_boats($screen)
{
    $myhelp = esc_attr__('In the BOATS screen you can manage (include, edit or delete) items in your Boats table. These boats will show up on your site front page.', 'boatdealer');
    $myhelp .= '<br />' . esc_attr__('We suggest you take some time to complete your Field table before this step.', 'boatdealer');
    $myhelp .= '<br />' . esc_attr__('Dashboard => Boat Dealer => Fields Table.', 'boatdealer');
    $myhelp .= '<br />' . esc_attr__('You will find some fields automatically included by the system (Price, Year, Miles, HP, Transmission type, Type, Fuel and Featured).', 'boatdealer') . '<br /><br />';

    $myhelpAdd = esc_attr__('To add fields in the table, click the "Add New" button. This will open an empty window to include your information:', 'boatdealer');
    $myhelpAdd .= '<br />
    <ul>
        <li>' . esc_attr__('Field Name', 'boatdealer') . '</li>
        <li>' . esc_attr__('Field Label', 'boatdealer') . '</li>
        <li>' . esc_attr__('Field Order', 'boatdealer') . '</li>
        <li>' . esc_attr__('Show in Search Bar (your front page)', 'boatdealer') . '</li>
        <li>' . esc_attr__('Show in Search Widget (your front page)', 'boatdealer') . '</li>
        <li>' . esc_attr__('Type of Field', 'boatdealer') . '</li>
        <li>' . esc_attr__('And So On', 'boatdealer') . '</li>
    </ul>';
    $myhelpAdd .= esc_attr__('In that screen, move the mouse pointer over each field to get help about that field. Just fill it out and click the OK button.', 'boatdealer') . '<br /><br />';

    $myhelpAgents = esc_attr__('Using the Team control is optional. To add new members, go to:', 'boatdealer');
    $myhelpAgents .= '<br />' . esc_attr__('Dashboard => Boat Dealer => Team', 'boatdealer') . '<br /><br />';

    $myhelpFeatures = esc_attr__('Using the Features control is optional. To add new features, go to:', 'boatdealer');
    $myhelpFeatures .= '<br />' . esc_attr__('Dashboard => Boat Dealer => Features', 'boatdealer') . '<br />';
    $myhelpFeatures .= '<ul>
        <li>' . esc_attr__('WC', 'boatdealer') . '</li>
        <li>' . esc_attr__('Barbecue', 'boatdealer') . '</li>
        <li>' . esc_attr__('And So On...', 'boatdealer') . '</li>
    </ul><br /><br />';

    $myhelpModel = esc_attr__('Using the Models control is optional. To add new models, go to:', 'boatdealer');
    $myhelpModel .= '<br />' . esc_attr__('Dashboard => Boat Dealer => Models', 'boatdealer') . '<br />';
    $myhelpModel .= '<ul>
        <li>' . esc_attr__('Open', 'boatdealer') . '</li>
        <li>' . esc_attr__('Fishing', 'boatdealer') . '</li>
        <li>' . esc_attr__('And So On...', 'boatdealer') . '</li>
    </ul><br /><br />';

    $myhelpEdit = esc_attr__('You can manage the table, i.e., Add, Edit, and Trash Boats.', 'boatdealer');
    $myhelpEdit .= '<br />' . esc_attr__('Use the "Add New" button or, to edit, put the mouse over each row and the menu will show up. Then, click Edit or Trash.', 'boatdealer') . '<br /><br />';

    $myhelpFeatured = esc_attr__('You can add one main image to each boat. In the Boats Form, click the button "Set Featured Image" at the bottom right corner.', 'boatdealer');
    $myhelpFeatured .= '<br />' . esc_attr__('Read below the "Images and Gallery" section for more information about creating a gallery to display at the top of your boat\'s page.', 'boatdealer') . '<br /><br />';

    $myhelpGallery = esc_attr__('You can add many images or a gallery for each boat. Just go to the Boats Form and add the images (or the gallery) in the main description field (click the "Add Media" button).', 'boatdealer');
    $myhelpGallery .= '<br />' . esc_attr__('Use the default WordPress Gallery, or our plugin will automatically create a slider gallery. To enable the plugin gallery, go to:', 'boatdealer');
    $myhelpGallery .= '<br />' . esc_attr__('Dashboard => Boat Dealer => Settings', 'boatdealer') . '<br />';
    $myhelpGallery .= esc_attr__('Look for the option "Replace the WordPress Gallery with Flexslider Gallery?". Then, check "Yes" and save changes.', 'boatdealer') . '<br />';
    $myhelpGallery .= esc_attr__('These images and galleries will be visible on the single boat page.', 'boatdealer') . '<br />';
    $myhelpGallery .= esc_attr__('Check out our demo on how to upload and crop images easily (less than 2 minutes):', 'boatdealer') . ' <a href="http://boatdealerplugin.com/how-upload-images/">' . esc_attr__('here', 'boatdealer') . '</a>.<br />';
    $myhelpGallery .= esc_attr__('For more info about galleries, visit the WordPress Help site:', 'boatdealer') . ' <a href="https://en.support.wordpress.com/gallery/" target="_blank">WordPress Help</a>.<br /><br />';

    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-overview-tab',
        'title' => esc_attr__('Overview', 'boatdealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-boats-team',
        'title' => esc_attr__('Team', 'boatdealer'),
        'content' => '<p>' . $myhelpAgents . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-boats-model',
        'title' => esc_attr__('Models', 'boatdealer'),
        'content' => '<p>' . $myhelpModel . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-boats-features',
        'title' => esc_attr__('Features', 'boatdealer'),
        'content' => '<p>' . $myhelpFeatures . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-boats-edit',
        'title' => esc_attr__('Edit and Trash Boats', 'boatdealer'),
        'content' => '<p>' . $myhelpEdit . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-boats-featured',
        'title' => esc_attr__('Featured Images', 'boatdealer'),
        'content' => '<p>' . $myhelpFeatured . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-boats-gallery',
        'title' => esc_attr__('Images and Gallery', 'boatdealer'),
        'content' => '<p>' . $myhelpGallery . '</p>',
    ));

    return;
}

function boatdealer_contextual_help_agents($screen)
{
    $myhelpAgents = esc_attr__('Use the Team table. It is optional.', 'boatdealer');
    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-overview-tab',
        'title' => esc_attr__('Overview', 'boatdealer'),
        'content' => '<p>' . $myhelpAgents . '</p>',
    ));
    return;
}

function boatdealer_contextual_help_locations($screen)
{
    $myhelpLocation = esc_attr__('Use the Location table. It is optional. Maybe you want to use it if you have more than one location.', 'boatdealer');
    $myhelpLocation .= '<br />' . esc_attr__('If you are, for example, in Florida, maybe you want to add:', 'boatdealer');
    $myhelpLocation .= '
    <ul>
        <li>' . esc_attr__('Fort Lauderdale', 'boatdealer') . '</li>
        <li>' . esc_attr__('Miami', 'boatdealer') . '</li>
        <li>' . esc_attr__('And So On...', 'boatdealer') . '</li>
    </ul><br />';

    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-overview-tab',
        'title' => esc_attr__('Overview', 'boatdealer'),
        'content' => '<p>' . $myhelpLocation . '</p>',
    ));
    return;
}

function boatdealer_contextual_help_features($screen)
{
    $myhelpFeatures = esc_attr__('Use the Features table. It is optional.', 'boatdealer');
    $myhelpFeatures .= '<br />' . esc_attr__('Maybe you want to include, for example:', 'boatdealer');
    $myhelpFeatures .= '
    <ul>
        <li>' . esc_attr__('WC', 'boatdealer') . '</li>
        <li>' . esc_attr__('Barbecue', 'boatdealer') . '</li>
        <li>' . esc_attr__('And So On...', 'boatdealer') . '</li>
    </ul><br />';

    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-overview-tab',
        'title' => esc_attr__('Overview', 'boatdealer'),
        'content' => '<p>' . $myhelpFeatures . '</p>',
    ));
    return;
}

function boatdealer_contextual_help_models($screen)
{
    $myhelpModel = esc_attr__('Use the Models table. It is optional.', 'boatdealer');
    $myhelpModel .= '<br />' . esc_attr__('Maybe you want to include, for example:', 'boatdealer');
    $myhelpModel .= '
    <ul>
        <li>' . esc_attr__('Open', 'boatdealer') . '</li>
        <li>' . esc_attr__('Fishing', 'boatdealer') . '</li>
        <li>' . esc_attr__('And So On...', 'boatdealer') . '</li>
    </ul><br />';

    $screen->add_help_tab(array(
        'id' => 'boatdealer-plugin-overview-tab',
        'title' => esc_attr__('Overview', 'boatdealer'),
        'content' => '<p>' . $myhelpModel . '</p>',
    ));
    return;
}


/////////// Pointers ////////////////
add_action('admin_enqueue_scripts', 'boatdealer_adm_enqueue_scripts');
function boatdealer_adm_enqueue_scripts()
{
    global $bill_current_screen;
    // wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script('wp-pointer');
    require_once(ABSPATH . 'wp-admin/includes/screen.php');
    $myscreen = get_current_screen();
    $bill_current_screen = $myscreen->id;
    if ($bill_current_screen == 'boats' or $bill_current_screen == 'toplevel_page_boat_dealer_plugin' or $bill_current_screen == 'edit-boatdealerfields') {
    } else
        return;
    $dismissed = explode(',', (string) get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));

    if (in_array($bill_current_screen, $dismissed))
        return;

    add_action('admin_print_footer_scripts', 'boatdealer_admin_print_footer_scripts');
}
function boatdealer_admin_print_footer_scripts()
{
    global $bill_current_screen;
    //$pointer_content = 'Help Available for this Window!';
    //$pointer_content2 = 'Just Click Help Button to get content help for this window.';
    $pointer_content = esc_attr__('Help Available for this Window!', 'boatdealer');
    $pointer_content2 = esc_attr__('Just Click the Help Button to get contextual help for this window.', 'boatdealer');

?>
    <script type="text/javascript">
        //<![CDATA[
        // setTimeout( function() { this_pointer.pointer( 'close' ); }, 400 );
        jQuery(document).ready(function($) {
            $('#contextual-help-link').pointer({
                content: '<?php echo '<h3>' . esc_attr($pointer_content) . '</h3>' . '<p>' . esc_attr($pointer_content2) . '</p>'; ?>',

                position: {
                    edge: 'top',
                    align: 'right'
                },
                close: function() {
                    // Once the close button is hit
                    $.post(ajaxurl, {
                        pointer: '<?php echo esc_html($bill_current_screen); ?>',
                        action: 'dismiss-wp-pointer'
                    });
                }
            }).pointer('open');
            /* $('.wp-pointer-undefined .wp-pointer-arrow').css("right", "50px"); */
        });
        //]]>
    </script>
<?php
}
?>