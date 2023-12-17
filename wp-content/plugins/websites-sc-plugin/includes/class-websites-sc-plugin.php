<?php

class Websites_Sc_Plugin {

  public function __construct() {
      // Add hooks and filters here
      add_shortcode('website_sc_form', array($this, 'render_form_shortcode'));
      add_action('init', array($this, 'register_custom_post_type'));
      add_action('add_meta_boxes', array($this, 'add_custom_metabox'));

      // Handle form submission
      add_action('admin_post_submit_website_form', array($this, 'submit_website_form'));
  }

  public function render_form_shortcode() {
      ob_start(); // Start output buffering

      ?>
      <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
          <?php wp_nonce_field('submit_website_form_nonce', '_wpnonce'); ?>
          <input type="hidden" name="action" value="submit_website_form">

          <label for="visitor_name">Your Name:</label>
          <input type="text" id="visitor_name" name="visitor_name" required>

          <label for="website_url">Website URL:</label>
          <input type="url" id="website_url" name="website_url" required>

          <input type="submit" value="Submit">
      </form>
      <?php

      return ob_get_clean(); // Return the buffered content
  }

  public function submit_website_form() {
      // Verify nonce
      if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'submit_website_form_nonce')) {
          // Get form data
          $visitor_name = sanitize_text_field($_POST['visitor_name']);
          $website_url = esc_url_raw($_POST['website_url']);

          // Fetch the source code
          $source_code = $this->get_website_source_code($website_url);

          // Create new post
          $post_data = array(
              'post_title'    => $visitor_name . ' - ' . $website_url,
              'post_content'  => '',
              'post_status'   => 'publish',
              'post_type'     => 'websites',
          );

          $post_id = wp_insert_post($post_data);

          // Save source code as post meta
          update_post_meta($post_id, '_website_source_code', $source_code);
      }

      // Redirect after form submission
      wp_redirect(home_url('/success'));
      exit();
  }

  private function get_website_source_code($website_url) {
      // Initialize an empty variable to store the source code
      $source_code = '';

      // Use wp_remote_get to fetch the content of the website
      $response = wp_remote_get($website_url);

      // Check if the operation was successful
      if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
          // Sanitize the fetched data (you might need to adjust this based on your requirements)
          $source_code = wp_remote_retrieve_body($response);
      }

      return $source_code;
  }

  public function register_custom_post_type() {
      $labels = array(
          'name'               => _x('Websites', 'post type general name', 'your-text-domain'),
          'singular_name'      => _x('Website', 'post type singular name', 'your-text-domain'),
          'menu_name'          => _x('Websites', 'admin menu', 'your-text-domain'),
          'name_admin_bar'     => _x('Website', 'add new on admin bar', 'your-text-domain'),
          'view_item'          => __('View Website', 'your-text-domain'),
          'all_items'          => __('All Websites', 'your-text-domain'),
          'search_items'       => __('Search Websites', 'your-text-domain'),
          'parent_item_colon'  => __('Parent Websites:', 'your-text-domain'),
          'not_found'          => __('No websites found.', 'your-text-domain'),
          'not_found_in_trash' => __('No websites found in Trash.', 'your-text-domain')
      );

      $args = array(
          'labels'             => $labels,
          'public'             => true,
          'exclude_from_search'=> false,
          'publicly_queryable' => true,
          'show_ui'            => current_user_can('edit_pages'),
          'show_in_menu'       => current_user_can('edit_pages'),
          'query_var'          => true, 
          'rewrite'            => false,
          'capability_type'    => 'post',
          'map_meta_cap'       => true,
          'capabilities' => array(
            'create_posts' => 'do_not_allow',
          ),        
          'has_archive'        => true,
          'hierarchical'       => false,
          'menu_position'      => null,
          'show_in_rest'       => true, //make websites accessible via /wp-json/wp/v2/websites using wp rest api
          'supports'           => array(''),
      );

      register_post_type('websites', $args);
  }

  public function add_custom_metabox() {
      add_meta_box(
          'website_source_code_metabox',          // Unique ID
          'Website Source Code',                  // Title of the metabox
          array($this, 'render_website_source_code_metabox'), // Callback function to render the metabox content
          'websites',                            // Post type to which the metabox is added
          'normal',                              // Context (normal, advanced, side)
          'default'                              // Priority (high, core, default, low)
      );

      remove_meta_box('submitdiv', 'websites', 'side');
  }

  public function render_website_source_code_metabox($post) {
      // Retrieve the existing value from the database
      $source_code = get_post_meta($post->ID, '_website_source_code', true);

      // Output the HTML for the metabox
      ?>
      <label for="website_source_code">Website Source Code:</label>
      <textarea id="website_source_code" name="website_source_code" style="width: 100%;" rows="10" readonly><?php echo esc_textarea($source_code); ?></textarea>
      <?php
  }

  // Populate custom columns for the websites list page
  public function populate_websites_columns($column, $post_id) {
    switch ($column) {
        case 'title':
            // Check if the current user can edit websites
            if (current_user_can('edit_websites')) {
                // Editors and above can see the link
                echo '<a href="' . esc_url(get_edit_post_link($post_id)) . '"><strong>' . get_the_title($post_id) . '</strong></a>';
            } else {
                // Editors and below see only the name without the link
                echo '<strong>' . get_the_title($post_id) . '</strong>';
            }
            break;
        case 'author':
            echo get_the_author_meta('display_name', get_post_field('post_author', $post_id));
            break;
        default:
            break;
    }
  }

}

