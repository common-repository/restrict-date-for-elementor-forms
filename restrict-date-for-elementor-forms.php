<?php

/**
 * Plugin Name: Restrict Date for Elementor Forms
 * Plugin URI: https://add-ons.org/plugin/elementor-form-restrict-dates-fields/
 * Description: Restrict Dates is a Elementor Forms add-on that restricts users from selecting specific dates in your Elementor Forms date picker field.
 * Version: 1.2.4
 * Requires Plugins: elementor
 * Author: add-ons.org
 * Domain Path: /languages
 * Author URI: https://add-ons.org/
 * Elementor tested up to: 3.24
 * Elementor Pro tested up to: 3.24
 */
define('SUPERADDONS_ELEMENTOR_RESTRICT_DATE_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SUPERADDONS_ELEMENTOR_RESTRICT_DATE_PLUGIN_URL', plugin_dir_url(__FILE__));
add_action('elementor_pro/forms/fields/register', 'superaddons_add_new_restrict_date_field');
function superaddons_add_new_restrict_date_field($form_fields_registrar)
{
    include SUPERADDONS_ELEMENTOR_RESTRICT_DATE_PLUGIN_PATH . "fields/restrict_date.php";
    $form_fields_registrar->register(new \Superaddons_Restrict_Date_Field());
}
include SUPERADDONS_ELEMENTOR_RESTRICT_DATE_PLUGIN_PATH . "superaddons/check_purchase_code.php";
new Superaddons_Check_Purchase_Code(
    array(
        "plugin" => "restrict-date-for-elementor-forms/restrict-date-for-elementor-forms.php",
        "id" => "1523",
        "pro" => "https://add-ons.org/plugin/elementor-form-restrict-dates-fields/",
        "plugin_name" => "Elementor Forms Restrict Date field",
        "document" => "https://add-ons.org/document-elementor-form-restrict-dates-fields/"
    )
);
if (!class_exists('Superaddons_List_Addons')) {
    include SUPERADDONS_ELEMENTOR_RESTRICT_DATE_PLUGIN_PATH . "add-ons.php";
}
