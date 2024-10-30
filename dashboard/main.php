<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
define('BOATDEALERHOMEURL', admin_url());
$urlfields = BOATDEALERHOMEURL . "/edit.php?post_type=boatdealerfields";
$urlboats = BOATDEALERHOMEURL . "/edit.php?post_type=boats";
$urlmodels = BOATDEALERHOMEURL . "/edit-tags.php?taxonomy=model&post_type=boats";
$urlfeatures =  BOATDEALERHOMEURL . "/edit-tags.php?taxonomy=features&post_type=boats";
$urlsettings = BOATDEALERHOMEURL . "/options.php?page=boatdealer_settings";
$urlteam =  BOATDEALERHOMEURL . "/edit-tags.php?taxonomy=team&post_type=cars";
// ob_start();
add_action('admin_init', 'boatdealer_plugin_settings_init');
add_action('admin_menu', 'boatdealer_plugin_add_admin_menu');
function boatdealer_plugin_enqueue_scripts()
{
    wp_enqueue_style('bill-help-boatdealer', BOATDEALERPLUGINURL . '/dashboard/css/help.css');
    wp_enqueue_style('bill-pointer', BOATDEALERPLUGINURL . '/dashboard/css/pointer.css');
    if (! boatdealer_boatdealer_is_bill_theme()) {
        wp_register_script('boatdealer-plugin-fix-config-manager', BOATDEALERPLUGINURL . 'dashboard/js/fix-config-manager.js', array('jquery'), BOATDEALERPLUGINVERSION, true);
        wp_enqueue_script('boatdealer-plugin-fix-config-manager');
    }
}
//add_action('admin_init', 'boatdealer_plugin_enqueue_scripts');
function boatdealer_fields_callback()
{
    global $urlfields;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_attr($urlfields); ?>";
        -->
    </script>
<?php
}
function boatdealer_boats_callback()
{
    global $urlboats;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_attr($urlboats); ?>";
        -->
    </script>
<?php
}
function boatdealer_models_callback()
{
    global $urlmodels;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_attr($urlmodels); ?>";
        -->
    </script>
<?php
}
function boatdealer_features_callback()
{
    global $urlfeatures;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_attr($urlfeatures); ?>";
        -->
    </script>
<?php
}
function boatdealer_team_callback()
{
    global $urlteam;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_attr($urlteam); ?>";
        -->
    </script>
<?php
}
function boatdealer_settings_callback()
{
    global $urlsettings;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_attr($urlsettings); ?>";
        -->
    </script>
<?php
}
function boatdealer_plugin_add_admin_menu()
{
    //   global $vmtheme_hook;
    //   $vmtheme_hook = add_theme_page( 'For Dummies', 'For Dummies Help', 'manage_options', 'for_dummies', 'boatdealer_options_page' );
    //   add_action('load-'.$vmtheme_hook, 'vmtheme_contextual_help');     
    global $menu;
    add_menu_page(
        'Boat Dealer',
        'Boat Dealer',
        'manage_options',
        'boat_dealer_plugin',
        'boatdealer_plugin_options_page',
        BOATDEALERPLUGINURL . 'assets/images/ancora-ico.png',
        '30'
    );
    include_once(ABSPATH . 'wp-includes/pluggable.php');
    $link_our_new_CPT = urlencode('edit.php?post_type=boatdealerfields');
    add_submenu_page('boat_dealer_plugin', 'Fields Table', __('Fields Table', 'boatdealer'), 'manage_options', 'fields-table', 'boatdealer_fields_callback');
    add_submenu_page('boat_dealer_plugin', 'Boats table',  __('Boats Table', 'boatdealer'), 'manage_options', 'boats-table', 'boatdealer_boats_callback');
    add_submenu_page('boat_dealer_plugin', 'Models', __('Models', 'boatdealer'), 'manage_options', 'md-makes', 'boatdealer_models_callback');
    add_submenu_page('boat_dealer_plugin', 'Features', __('Features', 'boatdealer'), 'manage_options', 'md-locations', 'boatdealer_features_callback');
    add_submenu_page('boat_dealer_plugin', 'Team', __('Team', 'boatdealer'), 'manage_options', 'md-team', 'boatdealer_team_callback');
    add_submenu_page('boat_dealer_plugin', 'Settings', __('Settings', 'boatdealer'), 'manage_options', 'boatdealer-plugin-settings', 'boatdealer_settings_callback');
    add_submenu_page('boat_dealer_plugin', 'Designer', 'Boatdealer Designer', 'manage_options', 'md-designer', 'boatdealer_designer_callback', 7);
}
function boatdealer_designer_callback()
{
    if (strpos(wp_get_referer(), 'bill_designer') == false) {
        $boatdealer_temp = home_url() . '/wp-admin/customize.php?autofocus[panel]=bill_designer';
    } else {
        $boatdealer_temp = home_url() . '/wp-admin/index.php?customize_changeset_uuid=';
    }
    echo '<script>';
    // echo 'console.log("$boatdealer_temp");';
    echo 'window.location.href = "' . esc_url($boatdealer_temp) . '";';
    echo '</script>';
}
function boatdealer_plugin_settings_init()
{
    register_setting('boatdealer', 'boatdealer_plugin_settings');
}
function boatdealer_plugin_options_page()
{
    global $activated, $boatdealer_update_theme;
    $wpversion = get_bloginfo('version');
    $current_user = wp_get_current_user();
    $plugin = plugin_basename(__FILE__);
    $email = $current_user->user_email;
    $username =  trim($current_user->user_firstname);
    $user = $current_user->user_login;
    $user_display = trim($current_user->display_name);
    if (empty($username))
        $username = $user;
    if (empty($username))
        $username = $user_display;
    $theme = wp_get_theme();
    $themeversion = $theme->version;
?>
    <!-- Begin Page -->
    <div id="boatdealer-plugin-theme-help-wrapper">
        <div id="boatdealer-plugin-not-activated"></div>
        <div id="boatdealer-plugin-logo">
            <img alt="logo" src="<?php echo esc_url(BOATDEALERIMAGES); ?>logosmall.png" />
        </div>

        <div id="boatdealer-plugin-social">
            <a href="http://boatdealerplugin.com/share/"><img alt="social bar" src="<?php echo esc_url(BOATDEALERIMAGES); ?>/social-bar.png" width="250px" /></a>
        </div>


        <div id="boatdealer_help_title">
            <?php esc_html_e('Help and Support Page', 'boatdealer'); ?>
        </div>





        <?php
        if (isset($_GET['tab']))
            $active_tab = sanitize_text_field($_GET['tab']);
        else
            $active_tab = 'dashboard';
        ?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=boat_dealer_plugin&tab=memory&tab=dashboard" class="nav-tab">Dashboard</a>
            <a href="?page=boat_dealer_plugin&tab=memory" class="nav-tab">Memory Check Up</a>
            <a href="?page=boat_dealer_plugin&tab=tools" class="nav-tab">More Tools</a>
        </h2>
    <?php

    echo '<div id="boatdealer-dashboard-wrap">';
    echo '<div id="boatdealer-dashboard-left">';


    if ($active_tab == 'memory') {
        require_once(BOATDEALERPLUGINPATH . 'dashboard/memory.php');
    } elseif ($active_tab == "tools") {
        $plugin = new boatdealer_Bill_show_more_plugins();
        $plugin->bill_show_plugins();
    } else {
        require_once(BOATDEALERPLUGINPATH . 'dashboard/dashboard.php');
    }

    // echo '</div> <!-- "boatdealer-plugin-theme_help-wrapper"> -->';





    echo '</div> <!-- "boatdealer-dashboard-left"> -->';
    echo '<div id="boatdealer-dashboard-right">';
    echo '<div id="boatdealer-containerright-dashboard">';
    require_once(BOATDEALERPLUGINPATH . 'dashboard/mybanners.php');
    echo '</div>';
    echo '</div> <!-- "boatdealer-dashboard-right"> -->';
    echo '</div> <!-- "boatdealer-dashboard-wrap"> -->';


    echo '</div> <!-- "boatdealer-plugin-theme_help-wrapper"> -->';
} // end Function boatdealer_options_page


require_once(ABSPATH . 'wp-admin/includes/screen.php');
// ob_end_clean();
include_once(ABSPATH . 'wp-includes/pluggable.php');


if (! function_exists('boatdealer_boatdealer_is_bill_theme')) {
    function boatdealer_boatdealer_is_bill_theme()
    {
        $my_theme = wp_get_theme();
        $theme = trim($my_theme->get('Name'));
        $mythemes = array(
            'boatdealer',
            'KarDealer',
            'verticalmenu',
            'fordummies',
            'Real Estate Right Now'
        );
        // boatseller
        $count = count($mythemes);
        $theme =  strtolower(trim($theme));
        for ($i = 0; $i < $count; $i++) {
            if ($theme == strtolower(trim($mythemes[$i])))
                return true;
        }
        return false;
    }
}
    ?>