<?php
add_action('update_option_api_produtos_tray_url', 'delete_product_visits_table', 10, 3);

function delete_product_visits_table($old_value, $value, $option_name) {
    if ($old_value !== $value) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'product_visits';
        
        $wpdb->query("DROP TABLE IF EXISTS $table_name");
        
        create_product_visits_table();
    }
}

function init_api_produtos_tray() {
    $api_url = get_option('api_produtos_tray_url');
    $api = new API_Produtos_Tray($api_url);
    $products = $api->fetch_products();
}

function create_product_visits_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'product_visits';
    
    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        product_id INT NOT NULL,
        visits INT NOT NULL DEFAULT 0,
        PRIMARY KEY (id)
    );";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function get_product_visits($product_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'product_visits';
    
    $result = $wpdb->get_var($wpdb->prepare("SELECT visits FROM $table_name WHERE product_id = %d", $product_id));
    return $result ? $result : 0;
}

function increment_product_visits($product_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'product_visits';
    
    $current_visits = get_product_visits($product_id);
    
    if ($current_visits === 0) {
        $wpdb->insert(
            $table_name,
            ['product_id' => $product_id, 'visits' => 1],
            ['%d', '%d']
        );
        return;
    }

    $new_visits = $current_visits + 1;
    
    $result = $wpdb->update(
        $table_name,
        ['visits' => $new_visits],
        ['product_id' => $product_id],
        ['%d'],
        ['%d']
    );

    if (false === $result) {
        error_log("Falha ao atualizar: " . $wpdb->last_error);
    } else {
        error_log("Atualizado com sucesso. Linhas afetadas: $result");
    }
}

function increment_product_visits_ajax_handler() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    if ($product_id > 0) {
        increment_product_visits($product_id);
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}

add_action('wp_ajax_increment_product_visits', 'increment_product_visits_ajax_handler');
add_action('wp_ajax_nopriv_increment_product_visits', 'increment_product_visits_ajax_handler');

function enqueue_admin_scripts($hook) {
    wp_enqueue_script('my-admin-js', plugin_dir_url(__DIR__) . 'assets/js/admin.js', array('jquery'), '1.0', true);
    wp_enqueue_style('my-admin-style', plugin_dir_url(__DIR__) . 'assets/css/admin.css');
    wp_localize_script('my-admin-js', 'ajax_params', array('ajaxurl' => admin_url('admin-ajax.php')));
}

function enqueue_front_end_scripts() {
    wp_enqueue_script('my-frontend-js', plugin_dir_url(__DIR__) . 'assets/js/frontend.js', array('jquery'), '1.0', true);
    wp_enqueue_style('my-frontend-style', plugin_dir_url(__DIR__) . 'assets/css/frontend.css');
    wp_localize_script('my-frontend-js', 'ajax_params', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_localize_script('my-frontend-js', 'myScriptParams', array('site_url' => get_site_url()));
}

add_action('admin_enqueue_scripts', 'enqueue_admin_scripts');
add_action('wp_enqueue_scripts', 'enqueue_front_end_scripts');



function display_products_on_home() {
    $api_url = get_option('api_produtos_tray_url');
    $api = new API_Produtos_Tray($api_url);
    $products = $api->fetch_products();

    usort($products->Products, function($a, $b) {
        return $b->Product->hot <=> $a->Product->hot;
    });

    $output = '<div class="product-list">';

        foreach ($products->Products as $product) {
            $price_formatted = 'R$ ' . number_format($product->Product->price, 2, ',', '.');
            $hot = $product->Product->hot;
            $message = ($hot == 1) ? 'DESTAQUE' : '';
            $image_https = isset($product->Product->ProductImage[0]) ? $product->Product->ProductImage[0]->https : '';
            if ($image_https) {
                $image_https = esc_url($image_https);
            } else {
                $image_https = 'https://placehold.co/600x400?text=Produto+sem+imagem';
            }
            
            $output .= '<div class="product-item" data-id="' . esc_attr($product->Product->id) . '">';
                $output .= '<a href="' . esc_url($product->Product->url->https) . '" title="' . esc_attr($product->Product->name) . '" target="_blank" rel="noopener noreferrer">';
                    $output .= '<img src="'. $image_https .'" title="' . esc_attr($product->Product->name) . '" alt="' . esc_attr($product->Product->name) . '" />';
                    
                    if (!empty($message)) {
                        $output .= '<div class="hot">'. esc_html($message) .'</div>';
                    }
                    
                    $output .= '<h2>' . esc_html($product->Product->name) . '</h2>';
                    $output .= '<p>' . esc_html($price_formatted) . '</p>';
                    $output .= '<div class="options">' . esc_html($product->Product->payment_option) . '</div>';
                $output .= '</a>';
            $output .= '</div>';
        }
    
    $output .= '</div>';

    
    return $output;
}

add_shortcode('display_products', 'display_products_on_home');