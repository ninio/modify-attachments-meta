<?php
/**
 * @package   Modify Attachments Meta
 * @author    Vladimir Vassilev <vlood.vassilev@gmail.com>
 * @license   GPL-2.0+
 * @link      http://shtrak.eu
 *
 * @wordpress-plugin
 * Plugin Name:       Modify Attachments Meta
 * Plugin URI:        http://shtrak.eu
 * Description:       Allows modification of meta data of attachments, such as date fields (soon to add more, I guess)
 * Version:           0.1b
 * Author:            vloo
 * Author URI:        http://profiles.wordpress.org/vloo
 * Text Domain:       mod-att-meta
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages/
 * GitHub Plugin URI: https://github.com/vlood/modify-attachments-meta
 */

if ( ! defined( 'WPINC' ) ) {
        die;
}

/* Set attachment post date (thanks to http://wordpress.org/support/profile/herrvollbaer, posting a solution here: http://wordpress.org/support/topic/modify-date-of-attachments?replies=5#post-3070220) */

// Add a custom field to an attachment in WordPress
function attachment_date_edit($form_fields, $post) {
    $form_fields['post_date']['label'] = __('Date', 'mod-att-meta');
    $form_fields['post_date']['value'] = $post->post_date;
    $form_fields['post_date']['helps'] = __('Modify the original post date', 'mod-att-meta');
    return $form_fields;
}

// save custom field to post_meta
function attachment_date_save($post, $attachment) {
	$post['post_date'] = $attachment['post_date'];
    return $post;
}

add_filter( 'attachment_fields_to_edit', 'attachment_date_edit', 10, 2);
add_filter( 'attachment_fields_to_save', 'attachment_date_save', 10, 2);