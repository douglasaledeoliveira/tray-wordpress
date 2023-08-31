<?php
class API_Produtos_Tray {
    private $api_url;

    public function __construct($api_url) {
        $this->api_url = $api_url;
    }

    public function fetch_products() {
        $response = wp_safe_remote_get($this->api_url);

        if (is_wp_error($response)) {
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        $json = json_decode($body);
        return $json;
    }
}
