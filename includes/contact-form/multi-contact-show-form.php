<?php
/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$aurl = "#";
$boatdealer_recipientEmail = trim(get_option('boatdealer_recipientEmail', ''));
if ( ! is_email($boatdealer_recipientEmail)) {
    $boatdealer_recipientEmail = '';
    update_option('boatdealer_recipientEmail', '');
}
if (empty($boatdealer_recipientEmail))
    $boatdealer_recipientEmail = get_option('admin_email');

global $boatdealer_the_title;
?>
<form id="boatdealer_contactForm" style="display: none;">
    <!-- action="<?php echo esc_url($aurl); ?>" method="post"> -->
    <input type="hidden" name="boatdealer_recipientEmail" id="boatdealer_recipientEmail" value="<?php echo esc_attr($boatdealer_recipientEmail); ?>" />
    <input type="hidden" name="boatdealer_the_title" id="boatdealer_the_title" value="<?php echo esc_attr($boatdealer_the_title); ?>" />
    <h2><?php echo esc_html__('Request Information', 'boatdealer'); ?>...</h2>
    <ul>
        <li>
            <label for="boatdealer_senderName" class="boatdealer_contact"><?php echo esc_html(__('Your Name', 'boatdealer')); ?>:&nbsp;</label>
            <input type="text" name="boatdealer_senderName" id="boatdealer_senderName" placeholder="<?php echo esc_attr(__('Please type your name', 'boatdealer')); ?>" required="required" maxlength="40" />
        </li>
        <li>
            <label for="boatdealer_senderEmail" class="boatdealer_contact"><?php echo esc_html(__('Your Email', 'boatdealer')); ?>:&nbsp;</label>
            <input type="email" name="boatdealer_senderEmail" id="boatdealer_senderEmail" placeholder="<?php echo esc_attr(__('Please type your email', 'boatdealer')); ?>" required="required" maxlength="50" />
        </li>
        <li>
            <label for="boatdealer_sendermessage" class="boatdealer_contact" style="padding-top: .5em;"><?php echo esc_html(__('Your Message', 'boatdealer')); ?>:&nbsp;</label>
            <textarea name="boatdealer_sendermessage" id="boatdealer_sendermessage" placeholder="<?php echo esc_attr(__('Please type your message', 'boatdealer')); ?>" required="required" maxlength="10000"></textarea>
        </li>
    </ul>
    <br />
    <div id="formButtons">
        <input type="submit" id="boatdealer_sendMessage" name="sendMessage" value="<?php echo esc_attr(__('Send', 'boatdealer')); ?>" />
        <input type="button" id="boatdealer_cancel" name="cancel" value="<?php echo esc_attr(__('Cancel', 'boatdealer')); ?>" />
    </div>
    <?php wp_nonce_field('boatdealer_cform'); ?>
</form>
<div id="boatdealer_sendingMessage" class="boatdealer_statusMessage" style="display: none; z-index:999;">
    <p><?php echo esc_html__('Sending your message. Please wait...', 'boatdealer'); ?></p>
</div>
<div id="boatdealer_successMessage" class="boatdealer_statusMessage" style="display: none; z-index:999;">
    <p><?php echo esc_html__('Thanks for your message! We\'ll get back to you shortly.', 'boatdealer'); ?></p>
</div>
<div id="boatdealer_failureMessage" class="boatdealer_statusMessage" style="display: none; z-index:999;">
    <p><?php echo esc_html__('There was a problem sending your message. Please try again.', 'boatdealer'); ?></p>
</div>
<div id="boatdealer_email_error" class="boatdealer_statusMessage" style="display: none; z-index:999;">
    <p><?php echo esc_html__('Please enter a valid email address.', 'boatdealer'); ?></p>
</div>
<div id="boatdealer_incompleteMessage" class="boatdealer_statusMessage" style="display: none; z-index:999;">
    <p><?php echo esc_html__('Please complete all the fields in the form before sending.', 'boatdealer'); ?></p>
</div>
<div id="boatdealer_name_error" class="boatdealer_statusMessage" style="display: none; z-index:999;">
    <p><?php echo esc_html__('Name Error. Use only alpha characters.', 'boatdealer'); ?></p>
</div>
<div id="boatdealer_message_error" class="boatdealer_statusMessage" style="display: none; z-index:999;">
    <p><?php echo esc_html__('Message Error. Use only alpha and numeric characters.', 'boatdealer'); ?></p>
</div>
