<?php /*
Plugin Name: boatdealer 
Plugin URI: http://boatdealerplugin.com
Description: The easiest way to manage, list and sell your boats and PWC online.
Version: 3.19
Text Domain: boatdealer
Domain Path: /language
Author: Bill Minozzi
Author URI: http://billminozzi.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
define('BOATDEALERPLUGINVERSION', '3.19');
define('BOATDEALERPLUGINPATH', plugin_dir_path(__file__));
define('BOATDEALERPLUGINURL', plugin_dir_url(__file__));
define('BOATDEALERIMAGES', plugin_dir_url(__file__) . 'assets/images/');
include_once(ABSPATH . 'wp-includes/pluggable.php');
$boatdealer_plugin = plugin_basename(__file__);
function boatdealer_plugin_settings_link($links)
{
    $settings_link = '<a href="options.php?page=boatdealer_settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
//
/*
if (is_admin()) {
    // $path = dirname(plugin_basename(__file__)) . '/language/';
    $path = basename( dirname( __FILE__ ) ) . '/language';
    $loaded = load_plugin_textdomain('boatdealer', false, $path);
    if (!$loaded and get_locale() <> 'en_US') {
        if (function_exists('boatdealer_localization_init_fail'))
            add_action('admin_notices', 'boatdealer_localization_init_fail');
    }
} else {
    add_action('plugins_loaded', 'boatdealer_localization_init');
}
*/
add_filter(
    "plugin_action_links_$boatdealer_plugin",
    'boatdealer_plugin_settings_link'
);
require_once(BOATDEALERPLUGINPATH . "settings/load-plugin.php");
require_once(BOATDEALERPLUGINPATH . "settings/options/plugin_options_tabbed.php");
require_once(BOATDEALERPLUGINPATH . 'includes/help/help.php');
require_once(BOATDEALERPLUGINPATH . 'includes/functions/functions.php');
require_once(BOATDEALERPLUGINPATH . 'includes/post-type/meta-box.php');
require_once(BOATDEALERPLUGINPATH . 'includes/post-type/post-functions.php');
require_once(BOATDEALERPLUGINPATH . 'includes/templates/template-functions.php');
require_once(BOATDEALERPLUGINPATH . 'includes/templates/redirect.php');
require_once(BOATDEALERPLUGINPATH . 'includes/widgets/widgets.php');
require_once(BOATDEALERPLUGINPATH . 'includes/search/search-function.php');
require_once(BOATDEALERPLUGINPATH . 'includes/multi/multi.php');
require_once(BOATDEALERPLUGINPATH . 'dashboard/main.php');
require_once(BOATDEALERPLUGINPATH . 'includes/contact-form/multi-contact-form.php');
$boatdealer_auto_updates = trim(get_option('boatdealer_auto_updates',  ''));

$boatdealer_is_admin = boatdealer_check_wordpress_logged_in_cookie();



//
$boatdealer_template_gallery = trim(get_option(
    'boatdealer_template_gallery',
    'yes'
));

$boatdealer_template_gallery = trim(get_option(
    'boatdealer_template_gallery',
    'yes'
));
if ($boatdealer_template_gallery == 'yes')
    require_once(BOATDEALERPLUGINPATH . 'includes/templates/template-showroom.php');
else
    require_once(BOATDEALERPLUGINPATH . 'includes/templates/template-showroom1.php');
require_once(BOATDEALERPLUGINPATH . 'includes/multi/multi-functions.php');
require_once(BOATDEALERPLUGINPATH . 'includes/team/team.php');
if ($boatdealer_is_admin) {
    require_once(BOATDEALERPLUGINPATH . 'includes/functions/health.php');
    require_once(BOATDEALERPLUGINPATH . 'includes/functions/health_permalink.php');
}
require_once(BOATDEALERPLUGINPATH . 'includes/functions/health.php');
$boatdealerurl = sanitize_text_field($_SERVER['REQUEST_URI']);
if (strpos($boatdealerurl, 'product') !== false) {
    $boatdealer_overwrite_gallery = strtolower(get_option(
        'boatdealer_overwrite_gallery',
        'yes'
    ));
    if ($boatdealer_overwrite_gallery == 'yes')
        require_once(BOATDEALERPLUGINPATH . 'includes/gallery/gallery.php');
}
add_action('wp_enqueue_scripts', 'boatdealer_add_files');
function boatdealer_add_files()
{
    wp_enqueue_script("jquery");
    wp_enqueue_style('show-room', BOATDEALERPLUGINURL . 'includes/templates/show-room.css');
    wp_enqueue_style('pluginStyleGeneral', BOATDEALERPLUGINURL .
        'includes/templates/template-style.css');
    wp_enqueue_style('pluginStyleSearch2', BOATDEALERPLUGINURL .
        'includes/search/style-search-box.css');
    wp_enqueue_style('pluginStyleSearchwidget', BOATDEALERPLUGINURL .
        'includes/widgets/style-search-widget.css');
    wp_enqueue_style('pluginStyleGeneral4', BOATDEALERPLUGINURL .
        'includes/gallery/css/flexslider.css');
    wp_register_style(
        'jqueryuiSkin',
        BOATDEALERPLUGINURL . 'assets/jquery/jqueryui.css',
        array(),
        '1.12.1'
    );
    wp_enqueue_style('jqueryuiSkin');
    wp_enqueue_style('bill-caricons', BOATDEALERPLUGINURL . 'assets/icons/icons-style.css');
    wp_enqueue_style('pluginTeam2', BOATDEALERPLUGINURL .
        'includes/team/team-custom.css');
    wp_enqueue_style('pluginTeam1', BOATDEALERPLUGINURL .
        'includes/team/team-custom-bootstrap.css');
    wp_register_style('fontawesome-css', BOATDEALERPLUGINURL . 'assets/fonts/font-awesome/css/font-awesome.min.css', array(), BOATDEALERPLUGINVERSION);
    wp_enqueue_style('fontawesome-css');
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_style('pluginStyleGeneral5', BOATDEALERPLUGINURL .
        'includes/contact-form/css/multi-contact-form.css');
}

add_action('admin_enqueue_scripts', 'boatdealer_enqueue_admin_scripts');
function boatdealer_enqueue_admin_scripts()
{
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('bill-help-boatdealer', BOATDEALERPLUGINURL . '/dashboard/css/help.css');
    wp_enqueue_style('bill-pointer', BOATDEALERPLUGINURL . '/dashboard/css/pointer.css');
}

function boatdealer_activated()
{
    $boatdealer_plugin_version = get_site_option('boatdealer_plugin_version', '');
    if ($boatdealer_plugin_version < BOATDEALERPLUGINVERSION) {
        if ($boatdealer_plugin_version < '2.3') {
            if (boatdealer_howmanyboats() > 0) {
                ob_start();
                boatdealer_add_default_fields();
                ob_end_clean();
            }
            add_action('wp_loaded', 'boatdealer_update_files');
        }
        if (!add_option('boatdealer_plugin_version', BOATDEALERPLUGINVERSION))
            update_option('boatdealer_plugin_version', BOATDEALERPLUGINVERSION);
    }
    if (trim(get_option('boatdealer_activated', '')) != '')
        return;
    $w = update_option('boatdealer_activated', '1');
    if (!$w)
        add_option('boatdealer_activated', '1');
    add_action('admin_notices', 'boatdealer_plugin_was_activated');
    $admin_email = get_option('admin_email');
    $old_admin_email = trim(get_option('boatdealer_recipientEmail', ''));
    if (empty($old_admin_email)) {
        $w = update_option('boatdealer_recipientEmail', $admin_email);
        if (!$w)
            add_option('boatdealer_recipientEmail', $admin_email);
    }
    $a = array(
        'boatdealer_show_make',
        'boatdealer_show_type',
        'boatdealer_show_price',
        'boatdealer_show_year',
        'boatdealer_show_condition',
        'boatdealer_show_transmission',
        'boatdealer_show_fuel',
        'boatdealer_show_orderby',
        'boatdealer_show_price'
    );
    $q = count($a);
    for ($i = 0; $i < $q; $i++) {
        $x = trim(get_option($a[$i], ''));
        if ($x != 'yes' and $x != 'no') {
            $w = update_option($a[$i], 'yes');
            if (!$w)
                add_option($a[$i], 'yes');
        }
    }
}
register_activation_hook(__file__, 'boatdealer_activated');
/*
function boatdealer_localization_init()
{
    // $path = BOATDEALERPLUGINPATH . '/language/';
    $path = basename(dirname(__FILE__)) . '/language';
    $loaded = load_plugin_textdomain('boatdealer', false, $path);
}
    */
function boatdealerplugin_load_bill_stuff()
{
    global $boatdealer_is_admin;
    wp_enqueue_script('jquery-ui-core');
    if ($boatdealer_is_admin) {
        if (isset($_GET['taxonomy']))
            $active_tax = sanitize_text_field($_GET['taxonomy']);
        if (isset($active_tax))
            if ($active_tax == 'team')
                wp_enqueue_media();
    }
}
add_action('wp_loaded', 'boatdealerplugin_load_bill_stuff');
function boatdealerplugin_load_feedback()
{
    global $boatdealer_is_admin;
    if ($boatdealer_is_admin) {
        //ob_start();
        //require_once (BOATDEALERPLUGINPATH . "includes/feedback/feedback.php");
        //if (get_option('bill_last_feedback', '') != '1')
        //require_once (BOATDEALERPLUGINPATH . "includes/feedback/feedback-last.php");
        //       ob_end_clean();
    }
}
function boatdealerplugin_load_activate()
{
    global $boatdealer_is_admin;
    if ($boatdealer_is_admin) {
        // require_once (BOATDEALERPLUGINPATH . 'includes/feedback/activated-manager.php');
    }
}
add_action('wp_loaded', 'boatdealerplugin_load_feedback');
add_action('in_admin_footer', 'boatdealerplugin_load_activate');
if ($boatdealer_is_admin) {
    if (get_option('boatdealer_activated', '0') == '1') {
        add_action('admin_notices', 'boatdealer_plugin_was_activated');
        $r = update_option('boatdealer_activated', '0');
        if (!$r)
            add_option('boatdealer_activated', '0');
    }
}
add_action('admin_menu', 'boatdealer_add_menu_gopro2');
$makework = __('Make', 'boatdealer');
$boatwork = __('Boat Type', 'boatdealer');
$conditionwork = __('Condition', 'boatdealer');
//////////////////////////  CUSTOMIZER PREVIEW  //
function boatdealer_add_custom_submenu_page()
{
    add_theme_page(
        'Boat_Dealer_Designer', // Page title
        'Boatdealer Designer',  // Menu title
        'manage_options',  // Capability required to access the page
        'Boat_Dealer_Designer', // Unique identifier for the page
        '__return_null' // Callback function to display
    );
}
add_action('admin_menu', 'boatdealer_add_custom_submenu_page');
function boatdealer_plugin_customize_preview_js()
{
    $file =  BOATDEALERPLUGINURL . 'assets/js/boatdealer_customizer-preview.js';
    $r = wp_enqueue_script(
        "my-customize-preview222",
        $file,
        array('jquery'),
        '1.99'
    );
    // Localize script and pass the variable
    $boatdealer_previewUrl =  home_url() . '/' . boatdealer_find_single_url();
    wp_localize_script('my-customize-preview222', 'boatdealer_my_data', array(
        'boatdealer_previewUrl' => $boatdealer_previewUrl,
    ));
}
add_action('customize_preview_init', 'boatdealer_plugin_customize_preview_js');
function boatdealer_customize_controls_js()
{
    $file =  BOATDEALERPLUGINURL . 'js/boatdealer_customize_events.js';
    wp_enqueue_script(
        "my-customize-events222",
        BOATDEALERPLUGINURL . 'assets/js/boatdealer_customize_events.js',
        array('jquery'),
        '1.99'
    );
    $file =  BOATDEALERPLUGINURL . 'assets/js/boatdealer_customize-controls.js';
    wp_enqueue_script(
        "my-customize-controls222",
        BOATDEALERPLUGINURL . 'assets/js/boatdealer_customize-controls.js',
        array('customize-preview'),
        '1.99'
    );
    // Localize script and pass the variable
    $boatdealer_previewUrl =  home_url() . '/' . boatdealer_find_single_url();
    wp_localize_script('my-customize-controls222', 'boatdealer_my_data', array(
        'boatdealer_previewUrl' => $boatdealer_previewUrl,
    ));
}
add_action('admin_enqueue_scripts', 'boatdealer_customize_controls_js');
///////////////////////////// find single url
function boatdealer_find_single_url()
{
    global $wp;
    global $query;
    global $wp_query;
    global $wp_the_query;
    $args = array(
        'post_type' => 'boats'
    );
    wp_reset_query();
    $boat_query = new WP_Query($args);
    $boat_posts = get_posts($args);
    if (!isset($boat_posts[0]->ID))
        return '-1';
    $post_name = basename(get_permalink($boat_posts[0]->ID));
    return $post_name;
}
function boatdealer_last()
{
    include_once BOATDEALERPLUGINPATH . '/includes/customizer/customizer.php';
    include_once  BOATDEALERPLUGINPATH  . '/includes/customizer/public.php';
}
add_action('plugins_loaded', 'boatdealer_last');
//////////////////////////          END CUSTOMIZER PREVIEW  //

// 08 2023
// require_once ABSPATH . 'wp-includes/pluggable.php';
// check 4 errors...
/*
if(is_admin() and current_user_can("manage_options")){
    if (!class_exists('Bill_Class_Diagnose') and !function_exists('boatdealer_my_custom_hooking_function')) {
		function boatdealer_my_custom_hooking_function() {
            $plugin_slug = "boatdealer"; // Replace with your actual text domain
            $plugin_text_domain = "boatdealer"; // Replace with your actual text domain
                $notification_url = "https://wpmemory.com/fix-low-memory-limit/";
			$notification_url2 =
				"https://wptoolsplugin.com/site-language-error-can-crash-your-site/";
            require_once(BOATDEALERPLUGINPATH . "includes/checkup/bill_class_diagnose.php");
            }
		add_action('init', 'boatdealer_my_custom_hooking_function');
    }
}
*/



function boatdealer_currency()

{
    /*
    $currencies = array(
        'AED'  => __( 'United Arab Emirates Dirham (&#1583;.&#1573;)', 'boatdealer' ),
        'AFN'  => __( 'Afghan Afghani (&#1547;)', 'boatdealer' ),
        'AOA'  => __( 'Angolan Kwanza', 'boatdealer' ),
        'ARS'  => __( 'Argentine Pesos (&#36;)', 'boatdealer' ),
        'AUD'  => __( 'Australian Dollars (&#36;)', 'boatdealer' ),
        'BRL'  => __( 'Brazilian Real (R&#36;)', 'boatdealer' ),
        'BGN'  => __( 'Bulgarian Lev', 'boatdealer' ),
        'CAD'  => __( 'Canadian Dollars (&#36;)', 'boatdealer' ),
        'CHF'  => __( 'Swiss Franc', 'boatdealer' ),
        'CNY'  => __( 'Chinese Yuan (&yen;)', 'boatdealer' ),
        'CZK'  => __( 'Czech Koruna', 'boatdealer' ),
        'DKK'  => __( 'Danish Krone', 'boatdealer' ),
        'EUR'  => __( 'Euros (&euro;)', 'boatdealer' ),
        'GBP'  => __( 'Pound Sterling (&pound;)', 'boatdealer' ),
        'HKD'  => __( 'Hong Kong Dollar (&#36;)', 'boatdealer' ),
        'HRK'  => __( 'Croatian Kuna', 'boatdealer' ),
        'HUF'  => __( 'Hungarian Forint', 'boatdealer' ),
        'IDR'  => __( 'Indonesian Rupiah (Rp)', 'boatdealer' ),
        'ILS'  => __( 'Israeli Shekel (&#8362;)', 'boatdealer' ),
        'INR'  => __( 'Indian Rupee (&#8377;)', 'boatdealer' ),
        'JPY'  => __( 'Japanese Yen (&yen;)', 'boatdealer' ),
        'KRW'  => __( 'South Korean Won (&#8361;)', 'boatdealer' ),
        'MXN'  => __( 'Mexican Peso (&#36;)', 'boatdealer' ),
        'MYR'  => __( 'Malaysian Ringgits', 'boatdealer' ),
        'NOK'  => __( 'Norwegian Krone', 'boatdealer' ),
        'NZD'  => __( 'New Zealand Dollar (&#36;)', 'boatdealer' ),
        'PHP'  => __( 'Philippine Pesos', 'boatdealer' ),
        'PLN'  => __( 'Polish Zloty', 'boatdealer' ),
        'PKR'  => __( 'Pakistani Rupee (₨)', 'boatdealer' ),
        'RON'  => __( 'Romanian Leu', 'boatdealer' ),
        'RUB'  => __( 'Russian Rubles', 'boatdealer' ),
        'SAR'  => __( 'Saudi Riyal (&#65020;)', 'boatdealer' ),
        'SEK'  => __( 'Swedish Krona', 'boatdealer' ),
        'SGD'  => __( 'Singapore Dollar (&#36;)', 'boatdealer' ),
        'THB'  => __( 'Thai Baht (&#3647;)', 'boatdealer' ),
        'TRY'  => __( 'Turkish Lira (&#8378;)', 'boatdealer' ),
        'TWD'  => __( 'Taiwan New Dollars', 'boatdealer' ),
        'USD'  => __( 'US Dollars (&#36;)', 'boatdealer' ),
        'VND'  => __( 'Vietnamese Dong (&#8363;)', 'boatdealer' ),
        'YEN'  => __( 'Yen (&yen;)', 'boatdealer' ),
        'ZAR'  => __( 'South African Rand', 'boatdealer' ),
    );
    */




    $currency =  get_option('boatdealercurrency');
    //

    $currencies = array(
        'AED'  => '&#1583;.&#1573;',
        'AFN'  => '&#1547;',
        'AOA'  => 'Kz',
        'ARS'  => '&#36;',
        'AUD'  => '&#36;',
        'BRL'  => 'R&#36;',
        'BGN'  => 'лв',
        'CAD'  => '&#36;',
        'CHF'  => 'CHF',
        'CNY'  => '&yen;',
        'CZK'  => 'Kč',
        'DKK'  => 'kr',
        'EUR'  => '&euro;',
        'GBP'  => '&pound;',
        'HKD'  => '&#36;',
        'HRK'  => 'kn',
        'HUF'  => 'Ft',
        'IDR'  => 'Rp',
        'ILS'  => '&#8362;',
        'INR'  => '&#8377;',
        'JPY'  => '&yen;',
        'KRW'  => '&#8361;',
        'MXN'  => '&#36;',
        'MYR'  => 'RM',
        'NOK'  => 'kr',
        'NZD'  => '&#36;',
        'PHP'  => '&#8369;',
        'PLN'  => 'zł',
        'PKR'  => '₨',
        'RON'  => 'lei',
        'RUB'  => '&#8381;',
        'SAR'  => '&#65020;',
        'SEK'  => 'kr',
        'SGD'  => '&#36;',
        'THB'  => '&#3647;',
        'TRY'  => '&#8378;',
        'TWD'  => 'NT$',
        'USD'  => '&#36;',
        'VND'  => '&#8363;',
        'ZAR'  => 'R',
    );




    if (array_key_exists($currency, $currencies)) {

        return $currencies[$currency];
    } else {

        return '&curren;'; // Retorna vazio se a moeda não estiver na array
    }
}
//
//
//
function boatdealer_localization_init()
{
    $path = BOATDEALERPLUGINPATH . 'language/';
    $locale = apply_filters('plugin_locale', determine_locale(), 'boatdealer');

    // Exibe o caminho e o locale para debug
    //wp_die('<strong>Path1:</strong> ' . $path . '<br><strong>Locale:</strong> ' . $locale);

    // Full path of the specific translation file (e.g., es_AR.mo)
    $specific_translation_path = $path . "boatdealer-$locale.mo";
    $specific_translation_loaded = false;

    // Check if the specific translation file exists and try to load it
    if (file_exists($specific_translation_path)) {
        $specific_translation_loaded = load_textdomain('boatdealer', $specific_translation_path);
    }

    // Exibe se a tradução específica foi carregada ou não
    // wp_die('<strong>Specific Translation Loaded:</strong> ' . ($specific_translation_loaded ? 'Yes' : 'No'));
    //
    //

    // List of languages that should have a fallback to a specific locale
    $fallback_locales = [
        'de' => 'de_DE',  // German
        'fr' => 'fr_FR',  // French
        'it' => 'it_IT',  // Italian
        'es' => 'es_ES',  // Spanish
        'pt' => 'pt_BR',  // Portuguese (fallback to Brazil)
        'nl' => 'nl_NL'   // Dutch (fallback to Netherlands)
    ];

    // If the specific translation was not loaded, try to fallback to the generic version
    if (!$specific_translation_loaded) {
        $language = explode('_', $locale)[0];  // Get only the language code, ignoring the country (e.g., es from es_AR)

        if (array_key_exists($language, $fallback_locales)) {
            // Full path of the generic fallback translation file (e.g., es_ES.mo)
            $fallback_translation_path = $path . "boatdealer-{$fallback_locales[$language]}.mo";

            // Exibe o caminho da tradução fallback para debug
            //wp_die('<strong>Fallback Translation Path:</strong> ' . $fallback_translation_path);

            // Check if the fallback generic file exists and try to load it
            if (file_exists($fallback_translation_path)) {
                load_textdomain('boatdealer', $fallback_translation_path);
            }
        }
    }

    // Load the plugin
    load_plugin_textdomain('boatdealer', false, plugin_basename(BOATDEALERPLUGINPATH) . '/language/');
}

if ($boatdealer_is_admin) {
    add_action('plugins_loaded', 'boatdealer_localization_init');
}
// ------------------

function boatdealer_check_wordpress_logged_in_cookie()
{
    // Percorre todos os cookies definidos
    foreach ($_COOKIE as $key => $value) {
        // Verifica se algum cookie começa com 'wordpress_logged_in_'
        if (strpos($key, 'wordpress_logged_in_') === 0) {
            // Cookie encontrado
            return true;
        }
    }
    // Cookie não encontrado
    return false;
}

//

function boatdealer_new_more_plugins()
{
    $plugin = new boatdealer_Bill_show_more_plugins();
    $plugin->bill_show_plugins();
}

function boatdealer_bill_more()
{
    global $boatdealer_is_admin;
    //if (function_exists('is_admin') && function_exists('current_user_can')) {
    if ($boatdealer_is_admin and current_user_can("manage_options")) {
        $declared_classes = get_declared_classes();
        foreach ($declared_classes as $class_name) {
            if (strpos($class_name, "Bill_show_more_plugins") !== false) {
                //return;
            }
        }
        require_once dirname(__FILE__) . "/includes/more-tools/class_bill_more.php";
    }
    // }
}
add_action("init", "boatdealer_bill_more", 5);

// -------------------------------------


function boatdealer_bill_hooking_diagnose()
{
    global $boatdealer_is_admin;
    // if (function_exists('is_admin') && function_exists('current_user_can')) {
    if ($boatdealer_is_admin and current_user_can("manage_options")) {
        $declared_classes = get_declared_classes();
        foreach ($declared_classes as $class_name) {
            if (strpos($class_name, "Bill_Diagnose") !== false) {
                return;
            }
        }
        $plugin_slug = 'real-estate-right-now';
        $plugin_text_domain = $plugin_slug;
        $notification_url = "https://wpmemory.com/fix-low-memory-limit/";
        $notification_url2 =
            "https://wptoolsplugin.com/site-language-error-can-crash-your-site/";
        require_once dirname(__FILE__) . "/includes/diagnose/class_bill_diagnose.php";
    }
    // } 
}
add_action("init", "boatdealer_bill_hooking_diagnose", 10);
//
//



function boatdealer_bill_hooking_catch_errors()
{
    global $boatdealer_plugin_slug;
    global $boatdealer_is_admin;

    $declared_classes = get_declared_classes();
    foreach ($declared_classes as $class_name) {
        if (strpos($class_name, "bill_catch_errors") !== false) {
            return;
        }
    }
    $boatdealer_plugin_slug = 'real-estate-right-now';
    require_once dirname(__FILE__) . "/includes/catch-errors/class_bill_catch_errors.php";
}
add_action("init", "boatdealer_bill_hooking_catch_errors", 15);

function BoatDealer_customize_enqueue()
{
    // Enfileirar o estilo do Color Picker
    wp_enqueue_style('wp-color-picker');

    // Enfileirar o script do Color Picker
    wp_enqueue_script('wp-color-picker');

    // Adicionar o seu script de inicialização
    wp_add_inline_script('wp-color-picker', '
        jQuery(document).ready(function($) {
            $(".color-field").wpColorPicker();
        });
    ');
}

add_action('customize_controls_enqueue_scripts', 'BoatDealer_customize_enqueue');


// ------------------------