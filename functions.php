<?php
    ob_start(); // Starts output buffering

    /**
     * Plugin Name: Barcode Scanner
     * Description: Plugin to search and manage product SKUs using a barcode scanner.
     * Version: 1.0
     * Author: Giuseppe Puleri
     */

    // Function to add the plugin's main page to the WordPress admin menu
    function barcode_scanner_menu() {
        add_menu_page(
            'Barcode Scanner', // Page title
            'Barcode Scanner', // Menu text
            'manage_woocommerce', // Capability required (WooCommerce manager permission)
            'barcode-scanner', // Page slug
            'barcode_scanner_search_page', // Function to render the main page
            'dashicons-camera', // Menu icon (dashicons camera icon)
            6 // Position in the menu
        );
    }
    add_action('admin_menu', 'barcode_scanner_menu'); // Adds the menu item

    // Main page: Search for SKUs and display results on the same page
    function barcode_scanner_search_page() {
        global $wpdb; // Access the global WordPress database object

        // Handle form submission for SKU search
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sku'])) {
            // Sanitize the SKU field to ensure safe data handling
            $sku = sanitize_text_field($_POST['sku']);

            // Execute the database query to find product variations by SKU
            $results = $wpdb->get_results($wpdb->prepare("
                SELECT 
                    pv.ID AS variation_id, 
                    pv.post_title AS name, 
                    pm_price.meta_value AS price, 
                    pm_size.meta_value AS size, 
                    pm_color.meta_value AS color 
                FROM 
                    {$wpdb->prefix}posts pv 
                JOIN 
                    {$wpdb->prefix}postmeta pm_parent ON pm_parent.post_id = pv.post_parent 
                LEFT JOIN 
                    {$wpdb->prefix}postmeta pm_price ON pm_price.post_id = pv.ID AND pm_price.meta_key = '_price' 
                LEFT JOIN 
                    {$wpdb->prefix}postmeta pm_size ON pm_size.post_id = pv.ID AND pm_size.meta_key = 'attribute_pa_misura' 
                LEFT JOIN 
                    {$wpdb->prefix}postmeta pm_color ON pm_color.post_id = pv.ID AND pm_color.meta_key = 'attribute_pa_colore' 
                WHERE 
                    pm_parent.meta_key = '_sku' AND pm_parent.meta_value = %s 
                AND 
                    pv.post_type = 'product_variation'", $sku));
            
            // Display a message based on whether results were found
            $esito = empty($results) ? "No products found" : "Products found:";
        }

        // Include the unified template page for display
        include(plugin_dir_path(__FILE__) . 'templates/pagina_unificata_sku.php');
    }

    // AJAX handler to delete a product variation
    function delete_variation() {
        // Check if the request is valid
        if (!isset($_POST['variation_id'])) {
            wp_send_json_error(['message' => 'Variation ID not specified.']);
            return;
        }

        // Sanitize and cast the variation ID
        $variation_id = intval($_POST['variation_id']);

        // Logic to delete the variation
        $deleted = wp_delete_post($variation_id, true); // `true` for permanent deletion

        // Return a success or error response
        if ($deleted) {
            wp_send_json_success(['message' => 'Variation successfully deleted.']);
        } else {
            wp_send_json_error(['message' => 'Error deleting variation.']);
        }
    }
    // Register the AJAX actions for logged-in and non-logged-in users
    add_action('wp_ajax_delete_variation', 'delete_variation');
    add_action('wp_ajax_nopriv_delete_variation', 'delete_variation');
?>
