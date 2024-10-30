<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div id="boatdealer-plugin-services3">
    <div class="boatdealer-plugin-block-title">
        <?php esc_html_e('Server Check', 'boatdealer'); ?>
    </div>
    <div class="boatdealer-plugin-help-container1">
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-1">
            <h3><?php esc_html_e('Memory Status', 'boatdealer'); ?></h3>
            <?php
            $ds = 256;
            $du = 60;
            $boatdealer_memory = boatdealer_check_memory();

            if ($boatdealer_memory['msg_type'] === 'notok') {
                echo esc_html__('Unable to get your Memory Info', 'boatdealer');
            } else {
                $ds = $boatdealer_memory['wp_limit'];
                $du = $boatdealer_memory['usage'];

                if ($ds > 0) {
                    $perc = number_format(100 * $du / $ds, 2);
                } else {
                    $perc = 0;
                }

                if ($perc > 100) {
                    $perc = 100;
                }

                $color = ($perc > 70) ? '#ff0000' : (($perc > 50) ? '#F7D301' : '#029E26');

                echo '<p><li style="max-width:50%;font-weight:bold;padding:5px 15px;border-radius:4px;background-color:#0073aa;margin-left:13px;color:white;">' .
                    esc_html__('Memory Usage', 'boatdealer') . '<div style="border:1px solid #ccc;background:white;width:100%;margin:2px 5px 2px 0;padding:1px">' .
                    '<div style="width:' . esc_attr($perc) . '%;background-color:' . esc_attr($color) . ';height:6px"></div></div>' .
                    esc_attr($du) . ' ' . esc_html__('of', 'boatdealer') . ' ' . esc_attr($ds) . ' MB ' . esc_html__('Usage', 'boatdealer') . '</li>';
            ?>
                <br /><br />
                <?php esc_html_e('For details, click the Memory Checkup Tab above.', 'boatdealer'); ?>
                <br /><br />
            <?php } ?>
        </div>
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-2">
            <h3><?php esc_html_e('Permalink Settings', 'boatdealer'); ?></h3>
            <?php
            $permalinkopt = get_option('permalink_structure');

            if ($permalinkopt !== '/%postname%/') {
            ?>
                <img alt="<?php esc_attr_e('Error', 'boatdealer'); ?>" width="40px" src="<?php echo esc_url(BOATDEALERPLUGINURL . 'assets/images/noktick.png'); ?>" />
                <br /><br />
                <?php esc_html_e('Wrong Permalink settings!', 'boatdealer'); ?>
                <br />
                <?php esc_html_e('Please, fix it to avoid 404 error page.', 'boatdealer'); ?>
                <br />
                <?php esc_html_e('To correct, follow these steps:', 'boatdealer'); ?>
                <br />
                <?php esc_html_e('Dashboard => Settings => Permalinks => Post Name (check)', 'boatdealer'); ?>
                <br />
                <?php esc_html_e('Click Save Changes', 'boatdealer'); ?>
            <?php
            } else {
                echo '<img alt="' . esc_attr__('Success', 'boatdealer') . '" width="40px" src="' . esc_url(BOATDEALERPLUGINURL . 'assets/images/oktick.png') . '" />';
            }
            ?>
            <br /><br />
        </div>
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-3">
            <h3 style="color:red;"><?php esc_html_e('Premium Version Disabled.', 'boatdealer'); ?></h3>

            <?php esc_html_e('Many Features are not included in the free version.', 'boatdealer'); ?>
            <br />




            <?php esc_html_e('Complete real time visual template design functionality.', 'boatdealer'); ?>
            <br />


            <?php esc_html_e('Get Color Options, more templates and more pages:', 'boatdealer'); ?>
            <br />



            <?php esc_html_e('- Order by (Price, Year, ascending, descending)', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Last Boats', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Featured Boats', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Number of Boats to show', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Filter Boats for Type (Sail, PWC, Power)', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Show or Hide Search Box, Pagination', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('More...', 'boatdealer'); ?>
            <br />
            <a href="<?php echo esc_url('http://boatdealerplugin.com/premium/'); ?>" class="button button-primary">
                <?php esc_html_e('Learn More', 'boatdealer'); ?>
            </a>
        </div>
    </div>
</div>

<div id="boatdealer-plugin-steps3">
    <div class="boatdealer-plugin-block-title">
        <img alt="<?php esc_attr_e('Steps', 'boatdealer'); ?>" src="<?php echo esc_url(BOATDEALERPLUGINURL . 'assets/images/3steps.png'); ?>" />
        <br /><br />
        <?php esc_html_e('Follow these 3 steps after installing the plugin:', 'boatdealer'); ?>
    </div>
    <div class="boatdealer-plugin-help-container1">
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-1">
            <img alt="<?php esc_attr_e('Step 1', 'boatdealer'); ?>" src="<?php echo esc_url(BOATDEALERPLUGINURL . 'assets/images/step1.png'); ?>" />
            <h3><?php esc_html_e('Configure Settings', 'boatdealer'); ?></h3>
            <?php esc_html_e('Go to Dashboard => Boat Dealer => Settings', 'boatdealer'); ?>
            <br />
            <em><?php esc_html_e('Fill out the information', 'boatdealer'); ?></em>:
            <br />
            <?php esc_html_e('- Your Currency', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Miles - Km', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Your Contact eMail', 'boatdealer'); ?>
            <br /><br />
            <?php esc_html_e('If you want to import demo data, click the Help Button at the top right corner and check out Import Demo Data.', 'boatdealer'); ?>
            <br /><br />
        </div>
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-2">
            <img alt="<?php esc_attr_e('Step 2', 'boatdealer'); ?>" src="<?php echo esc_url(BOATDEALERPLUGINURL . 'assets/images/step2.png'); ?>" />
            <h3><?php esc_html_e('Fill Out the Fields and Boats Table', 'boatdealer'); ?></h3>
            <strong><?php esc_html_e('Go to Fields Table:', 'boatdealer'); ?></strong><br />
            <?php esc_html_e('Dashboard => Boat Dealer => Fields Table', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('These are the fields that will appear on your boats form:', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Hull Material', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Passenger Capacity', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Interior Color', 'boatdealer'); ?>
            <br /><br />
            <?php esc_html_e('You don\'t need to include these fields: Boat Type, Make, Price, Year, Miles, Engine, Interior Color, HP, Loa, Fuel Type, and Featured.', 'boatdealer'); ?>
            <br /><br />
            <strong><?php esc_html_e('Go to Boats Table:', 'boatdealer'); ?></strong><br />
            <?php esc_html_e('Dashboard => Boat Dealer => Boats Table', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('Fill out this table with your products:', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- Boats', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- PWC', 'boatdealer'); ?>
            <br />
            <?php esc_html_e('- And So On.', 'boatdealer'); ?>
            <br /><br />
        </div>
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-3">
            <img alt="<?php esc_attr_e('Step 3', 'boatdealer'); ?>" src="<?php echo esc_url(BOATDEALERPLUGINURL . 'assets/images/step3.png'); ?>" />
            <h3><?php esc_html_e('Paste the Code in Your Page', 'boatdealer'); ?></h3>
            <?php esc_html_e('Copy and paste this code to your page:', 'boatdealer'); ?>
            <br />
            <strong>[boat_dealer]</strong>
            <br /><br />
            <?php esc_html_e('To create a Team page, use this shortcode:', 'boatdealer'); ?>
            <br />
            <strong>[boatdealer_team]</strong>
            <br /><br />
            <?php esc_html_e('To show only the Search Bar, use this shortcode:', 'boatdealer'); ?>
            <br />
            <strong>[boat_dealer onlybar="yes"]</strong>
            <br /><br />
            <?php esc_html_e('The Premium Version has dozens of extra shortcodes...', 'boatdealer'); ?>
            <br /><br />
            <?php esc_html_e('That\'s all! Enjoy it!', 'boatdealer'); ?>
        </div>
    </div>
</div>

<div id="boatdealer-plugin-services3">
    <div class="boatdealer-plugin-block-title">
        <?php esc_html_e('Help, Demo, Support, Troubleshooting:', 'boatdealer'); ?>
    </div>
    <div class="boatdealer-plugin-help-container1">
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-1">
            <img alt="<?php esc_attr_e('Support', 'boatdealer'); ?>" src="<?php echo esc_url(BOATDEALERPLUGINURL . 'assets/images/support.png'); ?>" />
            <h3><?php esc_html_e('Help and More Tips', 'boatdealer'); ?></h3>
            <?php esc_html_e('Just click the HELP button at the top right corner of this page for context help. Tooltips are also available in the Fields form.', 'boatdealer'); ?>
            <br /><br />
        </div>
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-2">
            <img alt="<?php esc_attr_e('Guide', 'boatdealer'); ?>" src="<?php echo esc_url(BOATDEALERPLUGINURL . 'assets/images/service_configuration.png'); ?>" />
            <h3><?php esc_html_e('Online Guide, Support, Demo, Demo Video, FAQ...', 'boatdealer'); ?></h3>
            <?php esc_html_e('Find our complete and updated Online guide, demo, demo video, FAQs page, support link, and more on our site.', 'boatdealer'); ?>
            <br /><br />
            <a href="<?php echo esc_url('http://boatdealerplugin.com'); ?>" class="button button-primary">
                <?php esc_html_e('Go', 'boatdealer'); ?>
            </a>
        </div>
        <div class="boatdealer-plugin-help-column boatdealer-plugin-help-column-3">
            <img alt="<?php esc_attr_e('Troubleshooting', 'boatdealer'); ?>" src="<?php echo esc_url(BOATDEALERPLUGINURL . 'assets/images/system_health.png'); ?>" />
            <h3><?php esc_html_e('Troubleshooting Guide', 'boatdealer'); ?></h3>
            <?php esc_html_e('Old WordPress versions, low memory, JavaScript errors from other plugins, or incorrect permalink settings can cause issues. Read this guide to fix problems quickly!', 'boatdealer'); ?>
            <br /><br />
            <a href="http://siterightaway.net/troubleshooting/" class="button button-primary">
                <?php esc_html_e('Troubleshooting Page', 'boatdealer'); ?>
            </a>
        </div>
    </div>
</div>