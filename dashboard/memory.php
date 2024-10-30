<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Exit if accessed directly
$boatdealer_memory = boatdealer_check_memory();

echo '<div id="boatdealer-plugin-memory-page">';
echo '<div class="boatdealer-plugin-block-title">';

if ($boatdealer_memory['msg_type'] === 'notok') {
    echo esc_html__('Unable to get your Memory Info', 'boatdealer');
    echo '</div>';
} else {
    echo esc_html__('Memory Info', 'boatdealer');
    echo '</div>';
    echo '<div id="memory-tab">';
    echo '<br />';

    $mb = ($boatdealer_memory['msg_type'] === 'ok') ? 'MB' : '';
    echo esc_html__('Current memory WordPress Limit:', 'boatdealer') . ' ' . esc_attr($boatdealer_memory['wp_limit']) . esc_attr($mb);
    echo '&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;';

    $perc = $boatdealer_memory['usage'] / $boatdealer_memory['wp_limit'];
    $color = ($perc > 0.7) ? esc_attr($boatdealer_memory['color']) : '#000'; // Fallback color if none specified

    echo '<span style="color:' . $color . ';">';
    echo esc_html__('Your usage now:', 'boatdealer') . ' ' . esc_attr($boatdealer_memory['usage']) . ' MB';
    echo '</span>';
    echo '&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp; ';
    echo esc_html__('Total Server Memory:', 'boatdealer') . ' ' . esc_attr($boatdealer_memory['limit']) . ' MB';
    echo '<br /><br /><br />';
?>

    <strong><?php esc_html_e('Fix it...', 'boatdealer'); ?></strong>
    <br />
    <?php esc_html_e('If you want to adjust and control your WordPress Memory Limit and PHP Memory Limit quickly and without editing any files, try our free plugin WPmemory:', 'boatdealer'); ?>
    <br />
    <a href="https://wordpress.org/plugins/wp-memory/" target="_blank"><?php esc_html_e('Learn More', 'boatdealer'); ?></a>
    <br /><br />
    <hr />
    <?php esc_html_e('Follow these instructions to do it manually:', 'boatdealer'); ?>
    <br />

    <strong><?php esc_html_e('To increase the WordPress memory limit, add this info to your file wp-config.php (located in the root folder of your server):', 'boatdealer'); ?></strong>
    <br /><br />
    <code>define('WP_MEMORY_LIMIT', '128M');</code>
    <br /><br />
    <?php esc_html_e('before this line:', 'boatdealer'); ?>
    <br />
    <code>/* That's all, stop editing! Happy blogging. */</code>
    <br /><br />
    <?php esc_html_e('If you need more, just replace 128 with the new memory limit.', 'boatdealer'); ?>
    <br />
    <?php esc_html_e('To increase your total server memory, talk with your hosting company.', 'boatdealer'); ?>
    <br /><br />
    <hr />
    <br />

    <strong><?php esc_html_e('How to Tell if Your Site Needs More Memory:', 'boatdealer'); ?></strong>
    <br /><br />
    <?php esc_html_e('If your site is behaving slowly, or pages fail to load, you get random white screens of death or 500 internal server errors, you may need more memory. Several things consume memory, such as WordPress itself, the plugins installed, the theme you\'re using, and the site content.', 'boatdealer'); ?>
    <br />
    <?php esc_html_e('Basically, the more content and features you add to your site, the bigger your memory limit has to be. If you\'re only running a small site with basic functions without a Page Builder and Theme Options (for example, the native Twenty Sixteen). However, once you use a Premium WordPress theme and you start encountering unexpected issues, it may be time to adjust your memory limit to meet the standards for a modern WordPress installation.', 'boatdealer'); ?>
    <br /><br />

    </div>
    </div>
<?php
}
?>