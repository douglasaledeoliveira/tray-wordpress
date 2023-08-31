<?php
add_action('admin_menu', 'api_produtos_tray_menu');
add_action('admin_init', 'api_produtos_tray_register_settings');

function api_produtos_tray_menu() {
    add_menu_page(
        'API Produtos Tray',
        'API Produtos Tray',
        'manage_options',
        'api_produtos_tray',
        'api_produtos_tray_settings_page'
    );
}

function api_produtos_tray_register_settings() {
    register_setting('api_produtos_tray_settings', 'api_produtos_tray_url');
}

function api_produtos_tray_settings_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('Você não tem permissões suficientes para acessar esta página.'));
    }
    ?>
    <div class="wrap">
        <h2>API Produtos Tray Configurações</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('api_produtos_tray_settings');
            do_settings_sections('api_produtos_tray');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">API URL</th>
                    <td><input type="text" name="api_produtos_tray_url" value="<?php echo esc_attr(get_option('api_produtos_tray_url')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
    $api_url = get_option('api_produtos_tray_url');
    $api = new API_Produtos_Tray($api_url);
    $products = $api->fetch_products();
    
    usort($products->Products, function($a, $b) {
        return $b->Product->hot <=> $a->Product->hot;
    });
    
    echo '<h2>Lista de Produtos</h2>';
    echo '<input type="text" id="productSearch" placeholder="Pesquisar produtos...">';
    echo '<table class="table-settings">';
    echo '<thead><tr><td>Nome</td><td>Preço</td><td>Destaque</td><td>Visitas</td></tr></thead>';
    echo '<tbody>';
    
    foreach ($products->Products as $product) {
        $visits = get_product_visits($product->Product->id);
        $price_formatted = 'R$ ' . number_format($product->Product->price, 2, ',', '.');
        $hot = $product->Product->hot;
        $status = ($hot == 1) ? 'Destaque' : 'Normal';
            
        echo "<tr><td>{$product->Product->name}</td><td>{$price_formatted}</td><td>{$status}</td><td>{$visits}</td></tr>";
    }

    echo '</tbody>';
    echo '</table>';
}

function enqueue_admin_styles() {
    wp_enqueue_style('my-admin-style', plugin_dir_url(__DIR__) . 'assets/css/admin.css');
}
add_action('admin_enqueue_scripts', 'enqueue_admin_styles');

