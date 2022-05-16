<?php

function villacloset_add_woocommerce_support()
{
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'villacloset_add_woocommerce_support');

function villacloset_styles()
{
  wp_register_style('villacloset-style', get_template_directory_uri() . '/style.css', [], '07.11.2021');
  wp_enqueue_style('villacloset-style');
}
add_action('wp_enqueue_scripts', 'villacloset_styles');

function villacloset_custom_images()
{
  add_image_size('slide', 600, 600, ['center', 'top']);
  update_option('medium_crop', 1);
}
add_action('after_setup_theme', 'villacloset_custom_images');

function villacloset_loop_shop_per_page()
{
  return 6;
}

add_filter('loop_shop_per_page', 'villacloset_loop_shop_per_page');

function remove_some_body_class($classes)
{
  $woo_class = array_search('woocommerce', $classes);
  $woopage_class = array_search('woocommerce-page', $classes);

  $search = in_array('archive', $classes) || in_array('product-template-default', $classes);

  if ($woo_class && $woopage_class && $search) {
    unset($classes[$woo_class]);
    unset($classes[$woopage_class]);
  }

  return $classes;
}

add_filter('woocommerce_ship_to_different_address_checked', '__return_false');

add_filter('body_class', 'remove_some_body_class');



/**
 * Add new register fields for WooCommerce registration.
 *
 * @return string Register fields HTML.
 */
function cs_wc_extra_register_fields()
{
?>
  <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e('Nome', 'textdomain'); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if (!empty($_POST['billing_first_name'])) esc_attr_e($_POST['billing_first_name']); ?>" />
  </p>
  <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e('Sobrenome', 'textdomain'); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if (!empty($_POST['billing_last_name'])) esc_attr_e($_POST['billing_last_name']); ?>" />
  </p>
<?php
}

add_action('woocommerce_register_form_start', 'cs_wc_extra_register_fields');

/**
 * Validate the extra register fields.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
function cs_wc_validate_extra_register_fields($username, $email, $validation_errors)
{
  if (isset($_POST['billing_first_name']) && empty($_POST['billing_first_name'])) {
    $validation_errors->add('billing_first_name_error', __('<strong>Erro</strong>: Digite o seu nome.', 'textdomain'));
  }

  if (isset($_POST['billing_last_name']) && empty($_POST['billing_last_name'])) {
    $validation_errors->add('billing_last_name_error', __('<strong>Erro</strong>: Digite o seu sobrenome.', 'textdomain'));
  }
}

add_action('woocommerce_register_post', 'cs_wc_validate_extra_register_fields', 10, 3);

/**
 * Save the extra register fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */

function cs_wc_save_extra_register_fields($customer_id)
{
  if (isset($_POST['billing_first_name'])) {
    // WordPress default first name field.
    update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']));

    // WooCommerce billing first name.
    update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
  }

  if (isset($_POST['billing_last_name'])) {
    // WordPress default last name field.
    update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']));

    // WooCommerce billing last name.
    update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
  }
}

add_action('woocommerce_created_customer', 'cs_wc_save_extra_register_fields');

function wc_villacloset_remove_password_strength()
{
  if (wp_script_is('wc-password-strength-meter', 'enqueued')) {
    wp_dequeue_script('wc-password-strength-meter');
  }
}
add_action('wp_print_scripts', 'wc_villacloset_remove_password_strength', 10);

include(get_template_directory() . '/inc/product-list.php');
include(get_template_directory() . '/inc/user-custom-menu.php');
include(get_template_directory() . '/inc/custom-checkout.php');
