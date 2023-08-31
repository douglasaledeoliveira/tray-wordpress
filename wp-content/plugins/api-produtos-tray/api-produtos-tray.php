<?php
/**
 * Plugin Name: api-produtos-tray
 * Author: Douglas Aleluia de Oliveira
 * Description: Trazer uma listagem de produtos da Tray via API.
 * Version: 1.0
 * License: GPL-2.0+
 */

if (!defined('ABSPATH')) {
    exit;
}

register_activation_hook(__FILE__, 'create_product_visits_table');

require_once plugin_dir_path(__FILE__) . 'includes/class-api-produtos-tray.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/settings.php';