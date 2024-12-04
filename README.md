# Barcode-Scanner-WordPress-Plugin
This WordPress plugin is designed to simplify the management and search of product SKUs in a WooCommerce store. It provides an admin interface that allows users to search SKUs and display results directly in the WordPress dashboard. Additionally, it includes an AJAX endpoint for deleting product variations.

---

## Key Features

### Integration with the Admin Menu
- The plugin adds a **"Barcode Scanner"** menu item to the WordPress admin main menu using the `admin_menu` hook.
- This menu item opens a dedicated page where users can search for products based on their SKU.

### SKU Search Functionality
- An HTML form on the plugin’s admin page allows users to input an SKU to perform a search.
- The plugin uses the `$wpdb` (WordPress Database API) to query the database:
  - Searches in the `posts` and `postmeta` tables of WordPress.
  - Returns product variations linked to the SKU, including details such as:
    - Variation ID
    - Price
    - Size
    - Color

### Data Security
- SQL queries are prepared using `$wpdb->prepare()` to prevent SQL injection attacks.
- Input data from the search form is sanitized using `sanitize_text_field()`.

### Interface Management
- The search results page uses a separate PHP template (`pagina_unificata_sku.php`) for rendering the user interface.
- This modular approach separates logic from presentation, ensuring better maintainability and scalability.

### Product Variation Deletion
- Uses WordPress’s AJAX API to provide functionality for deleting product variations.
- AJAX requests are handled via the hooks:
  - `wp_ajax_delete_variation` (for authenticated users)
  - `wp_ajax_nopriv_delete_variation` (for unauthenticated users, if needed)
- Deletion is performed using `wp_delete_post()`, which permanently removes the product variation.

---

## Technologies Used
- **WordPress API**: Integrates seamlessly with WordPress's plugin architecture and admin menu.
- **WooCommerce**: Specifically designed to work with WooCommerce product variations and metadata.
- **PHP**: Core programming language for backend logic and database queries.
- **AJAX**: Enables dynamic and asynchronous deletion of product variations.
- **MySQL**: Queries performed directly on WordPress's database schema using `$wpdb`.

---

## Modular Design
The plugin is designed with scalability in mind:
- All logic is contained in clearly defined functions.
- Presentation is handled by a dedicated PHP template.
- AJAX endpoints are modular, making it easy to add additional actions in the future.

---

## Author
**Giuseppe Puleri**

This plugin was created to enhance the usability and efficiency of WooCommerce SKU management. If you have any questions or suggestions, feel free to contribute or contact the author.
