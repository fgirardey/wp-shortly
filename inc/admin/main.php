<?php

// Init the Admin side of the plugin
add_action( 'admin_init', 'register_options_setting' );
function register_options_setting() {
	register_setting( 'shortly_options', WP_SHORTLY_SLUG, 'sanitize_settings_callback' );
}

/**
 * shortly_option_page
 * 
 * @access public
 * 
 * @since Version 0.2
 *
 * @return mixed Value.
 */
add_action( 'admin_menu', 'shortly_option_page' );
function shortly_option_page() {
	add_options_page(
		'WP Shortly', // The text to be displayed in the title tags of the page when the menu is selected
		'WP Shortly', // The on-screen name text for the menu
		'manage_options', // The capability required for this menu to be displayed to the user. User levels are deprecated and should not be used here!
		'wp_shortly', // The slug name to refer to this menu by (should be unique for this menu).
		'shortly_render_option_page' // The function that displays the page content for the menu page.
	);
}

add_action( 'admin_enqueue_scripts', 'shortly_add_admin_css_js' );
function shortly_add_admin_css_js() {
	wp_enqueue_style( 'options-shortly', WP_SHORTLY_ADMIN_CSS_URL . 'options.css', array(), WP_SHORTLY_VERSION );
}

function shortly_render_option_page() {
	add_settings_section( 'shortly_settings_display', __('WP Shortly Settings', WP_SHORTLY_DOMAIN), '__return_false', 'wp_shortly' );
	?>
	<div class="wrap">
		<div id="icon-link-manager" class="icon32"></div>
		<h2>WP Shortly <sub>v<?php echo WP_SHORTLY_VERSION; ?></sub></h2>
		<?php settings_errors(); ?>  
		<form action="options.php" method="post">
			<?php settings_fields( 'shortly_options' ); ?>
			<?php do_settings_sections( 'wp_shortly' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php

}