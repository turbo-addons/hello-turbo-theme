<?php
/**
 * HelloTurbo Admin Dashboard.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * HelloTurbo admin menu and dashboard page.
 */
class Helloturbo_Admin {

	/**
	 * Recommended (required) plugins.
	 *
	 * Each entry:
	 * - slug:        WordPress.org plugin slug (used for install + status detection).
	 * - name:        Display name.
	 * - description: Short explanation shown in the list.
	 * - required:    Whether the plugin is marked as required.
	 *
	 * @var array
	 */
	private $recommended_plugins = array(
		array(
			'slug'        => 'elementor',
			'name'        => 'Elementor',
			'description' => 'The leading website builder that HelloTurbo is designed to complement, including full-width and canvas templates.',
			'required'    => false,
		),
		array(
			'slug'        => 'turbo-addons-elementor',
			'name'        => 'Turbo Addons Elementor',
			'description' => 'The companion widgets toolkit by Turbo Addons, adding 90+ Elementor widgets and 200+ ready templates for HelloTurbo.',
			'required'    => false,
		),
	);

	/**
	 * Register hooks.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Register the admin menu.
	 */
	public function register_menu() {
		add_menu_page(
			__( 'HelloTurbo', 'helloturbo' ),
			__( 'HelloTurbo', 'helloturbo' ),
			'manage_options',
			'helloturbo',
			array( $this, 'render_page' ),
			'dashicons-admin-appearance',
			2
		);
	}

	/**
	 * Enqueue dashboard assets only on the HelloTurbo page.
	 *
	 * @param string $hook_suffix The current admin page hook suffix.
	 */
	public function enqueue_assets( $hook_suffix ) {
		if ( 'toplevel_page_helloturbo' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style(
			'helloturbo-admin',
			TURBO_THEME_URI . '/assets/css/admin.css',
			array(),
			TURBO_THEME_VERSION
		);
	}

	/**
	 * Get the active tab.
	 *
	 * @return string
	 */
	private function get_current_tab() {
		$allowed = array( 'welcome', 'customize', 'support' );
		$tab     = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : 'welcome'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		return in_array( $tab, $allowed, true ) ? $tab : 'welcome';
	}

	/**
	 * Render the dashboard page.
	 */
	public function render_page() {
		$tab = $this->get_current_tab();
		?>
		<div class="wrap helloturbo-dashboard">
			<div class="helloturbo-dashboard__header">
				<div class="helloturbo-dashboard__brand">
					<span class="helloturbo-dashboard__logo dashicons dashicons-admin-appearance"></span>
					<div>
						<h1 class="helloturbo-dashboard__title"><?php esc_html_e( 'HelloTurbo', 'helloturbo' ); ?></h1>
						<p class="helloturbo-dashboard__version"><?php echo esc_html( sprintf( __( 'Version %s', 'helloturbo' ), TURBO_THEME_VERSION ) ); ?></p>
					</div>
				</div>
				<div class="helloturbo-dashboard__actions">
					<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'helloturbo' ); ?></a>
					<a href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>" class="button"><?php esc_html_e( 'Site Editor', 'helloturbo' ); ?></a>
				</div>
			</div>

			<nav class="helloturbo-dashboard__tabs" aria-label="<?php esc_attr_e( 'HelloTurbo sections', 'helloturbo' ); ?>">
				<?php $this->render_tab_nav( 'welcome', $tab, __( 'Welcome', 'helloturbo' ) ); ?>
				<?php $this->render_tab_nav( 'customize', $tab, __( 'Customizer', 'helloturbo' ) ); ?>
				<?php $this->render_tab_nav( 'support', $tab, __( 'Help &amp; Support', 'helloturbo' ) ); ?>
			</nav>

			<div class="helloturbo-dashboard__content">
				<?php
				switch ( $tab ) {
					case 'customize':
						$this->render_customize_tab();
						break;
					case 'support':
						$this->render_support_tab();
						break;
					default:
						$this->render_welcome_tab();
						break;
				}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render a single tab link.
	 *
	 * @param string $slug   Tab slug.
	 * @param string $active Current active tab.
	 * @param string $label  Tab label (already translated).
	 */
	private function render_tab_nav( $slug, $active, $label ) {
		$url   = add_query_arg( array( 'page' => 'helloturbo', 'tab' => $slug ), admin_url( 'admin.php' ) );
		$class = 'helloturbo-dashboard__tab' . ( $slug === $active ? ' is-active' : '' );
		?>
		<a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a>
		<?php
	}

	/**
	 * Render the welcome tab.
	 */
	private function render_welcome_tab() {
		?>
		<div class="helloturbo-card">
			<h2><?php esc_html_e( 'Welcome to HelloTurbo', 'helloturbo' ); ?></h2>
			<p><?php esc_html_e( 'HelloTurbo is a lightweight, fast, and fully customizable WordPress theme built for speed and flexibility. It works with the block editor, Elementor, and all major page builders.', 'helloturbo' ); ?></p>
			<div class="helloturbo-dashboard__quick">
				<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Start Customizing', 'helloturbo' ); ?></a>
			</div>
		</div>

		<div class="helloturbo-dashboard__grid">
			<div class="helloturbo-card">
				<h3><span class="dashicons dashicons-layout"></span> <?php esc_html_e( 'Header &amp; Footer Builder', 'helloturbo' ); ?></h3>
				<p><?php esc_html_e( 'Build your header and footer with Above, Primary, and Below rows — no code required.', 'helloturbo' ); ?></p>
			</div>
			<div class="helloturbo-card">
				<h3><span class="dashicons dashicons-admin-customizer"></span> <?php esc_html_e( 'Global Design Controls', 'helloturbo' ); ?></h3>
				<p><?php esc_html_e( 'Control colors, typography, buttons, containers, and layout from the Customizer.', 'helloturbo' ); ?></p>
			</div>
			<div class="helloturbo-card">
				<h3><span class="dashicons dashicons-editor-ul"></span> <?php esc_html_e( 'Blog &amp; Archive Layouts', 'helloturbo' ); ?></h3>
				<p><?php esc_html_e( 'Choose between list, grid, and masonry layouts with full sidebar control.', 'helloturbo' ); ?></p>
			</div>
			<div class="helloturbo-card">
				<h3><span class="dashicons dashicons-cart"></span> <?php esc_html_e( 'WooCommerce Ready', 'helloturbo' ); ?></h3>
				<p><?php esc_html_e( 'Dedicated WooCommerce sidebar and layout support out of the box.', 'helloturbo' ); ?></p>
			</div>
		</div>
		<?php
		$this->render_recommended_plugins();
	}

	/**
	 * Render the recommended plugins section.
	 */
	private function render_recommended_plugins() {
		?>
		<div class="helloturbo-card">
			<h2><?php esc_html_e( 'Recommended Plugins', 'helloturbo' ); ?></h2>
			<p><?php esc_html_e( 'HelloTurbo works best with the following plugins. Click Install to install a plugin from the WordPress.org directory — the button uses WordPress own installer and only runs when you click it.', 'helloturbo' ); ?></p>
		</div>

		<div class="helloturbo-plugin-list">
			<?php
			foreach ( $this->recommended_plugins as $plugin ) {
				$this->render_plugin_row( $plugin );
			}
			?>
		</div>
		<?php
	}

	/**
	 * Render a single recommended plugin row.
	 *
	 * @param array $plugin Plugin definition.
	 */
	private function render_plugin_row( $plugin ) {
		$slug    = $plugin['slug'];
		$status  = $this->get_plugin_status( $slug );
		$badge   = $plugin['required'] ? __( 'Required', 'helloturbo' ) : __( 'Recommended', 'helloturbo' );
		$badge_c = $plugin['required'] ? 'is-required' : 'is-recommended';
		?>
		<div class="helloturbo-plugin helloturbo-plugin--<?php echo esc_attr( $status ); ?>">
			<div class="helloturbo-plugin__icon dashicons dashicons-admin-plugins"></div>
			<div class="helloturbo-plugin__body">
				<div class="helloturbo-plugin__title-row">
					<h3 class="helloturbo-plugin__name"><?php echo esc_html( $plugin['name'] ); ?></h3>
					<span class="helloturbo-plugin__badge <?php echo esc_attr( $badge_c ); ?>"><?php echo esc_html( $badge ); ?></span>
				</div>
				<p class="helloturbo-plugin__description"><?php echo esc_html( $plugin['description'] ); ?></p>
			</div>
			<div class="helloturbo-plugin__action">
				<?php $this->render_plugin_action( $plugin, $status ); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render the action link for a plugin based on its status.
	 *
	 * @param array  $plugin Plugin definition.
	 * @param string $status Plugin status: active|inactive|not_installed.
	 */
	private function render_plugin_action( $plugin, $status ) {
		switch ( $status ) {
			case 'active':
				echo '<span class="helloturbo-plugin__active"><span class="dashicons dashicons-yes-alt"></span> ' . esc_html__( 'Active', 'helloturbo' ) . '</span>';
				break;

			case 'inactive':
				if ( current_user_can( 'activate_plugins' ) ) {
					$basename = $this->get_plugin_basename( $plugin['slug'] );
					$url      = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=' . rawurlencode( $basename ) ), 'activate-plugin_' . $basename );
					echo '<a class="button" href="' . esc_url( $url ) . '">' . esc_html__( 'Activate', 'helloturbo' ) . '</a>';
				} else {
					echo '<span class="helloturbo-plugin__active">' . esc_html__( 'Installed', 'helloturbo' ) . '</span>';
				}
				break;

			default:
				if ( current_user_can( 'install_plugins' ) ) {
					$url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . rawurlencode( $plugin['slug'] ) ), 'install-plugin_' . $plugin['slug'] );
					echo '<a class="button button-primary" href="' . esc_url( $url ) . '">' . esc_html__( 'Install', 'helloturbo' ) . '</a>';
				} else {
					echo '<span class="helloturbo-plugin__active">' . esc_html__( 'Install manually', 'helloturbo' ) . '</span>';
				}
				break;
		}
	}

	/**
	 * Resolve a plugin's main file basename (e.g. elementor/elementor.php).
	 *
	 * @param string $slug Plugin slug.
	 * @return string
	 */
	private function get_plugin_basename( $slug ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		foreach ( get_plugins() as $file => $data ) {
			if ( 0 === strpos( $file, $slug . '/' ) ) {
				return $file;
			}
		}

		return $slug . '/' . $slug . '.php';
	}

	/**
	 * Detect a plugin's current status.
	 *
	 * @param string $slug Plugin slug.
	 * @return string active|inactive|not_installed
	 */
	private function get_plugin_status( $slug ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$basename = '';
		foreach ( get_plugins() as $file => $data ) {
			if ( 0 === strpos( $file, $slug . '/' ) ) {
				$basename = $file;
				break;
			}
		}

		if ( '' === $basename ) {
			return 'not_installed';
		}

		return is_plugin_active( $basename ) ? 'active' : 'inactive';
	}

	/**
	 * Render the customizer shortcuts tab.
	 */
	private function render_customize_tab() {
		$sections = array(
			array(
				'title' => __( 'Global Colors', 'helloturbo' ),
				'desc'  => __( 'Set your site-wide color palette.', 'helloturbo' ),
				'focus' => 'turbo_global_colors',
			),
			array(
				'title' => __( 'Typography', 'helloturbo' ),
				'desc'  => __( 'Body and heading fonts, plus H1-H6 sizes.', 'helloturbo' ),
				'focus' => 'turbo_global_typography',
			),
			array(
				'title' => __( 'Buttons', 'helloturbo' ),
				'desc'  => __( 'Button colors, radius, padding, and weight.', 'helloturbo' ),
				'focus' => 'turbo_global_buttons',
			),
			array(
				'title' => __( 'Header Builder', 'helloturbo' ),
				'desc'  => __( 'Build your header with multiple rows.', 'helloturbo' ),
				'panel' => 'turbo_header_builder',
			),
			array(
				'title' => __( 'Footer Builder', 'helloturbo' ),
				'desc'  => __( 'Widget areas and the copyright bar.', 'helloturbo' ),
				'panel' => 'turbo_footer_builder',
			),
			array(
				'title' => __( 'Blog &amp; Archive', 'helloturbo' ),
				'desc'  => __( 'List, grid, and masonry layouts.', 'helloturbo' ),
				'panel' => 'turbo_blog',
			),
			array(
				'title' => __( 'Single Post', 'helloturbo' ),
				'desc'  => __( 'Title, featured image, meta, and related posts.', 'helloturbo' ),
				'panel' => 'turbo_single_post',
			),
			array(
				'title' => __( 'Sidebar', 'helloturbo' ),
				'desc'  => __( 'Sidebar position per content type.', 'helloturbo' ),
				'focus' => 'turbo_sidebar',
			),
			array(
				'title' => __( 'Breadcrumbs', 'helloturbo' ),
				'desc'  => __( 'Enable and style breadcrumbs.', 'helloturbo' ),
				'focus' => 'turbo_breadcrumbs',
			),
		);
		?>
		<div class="helloturbo-card">
			<h2><?php esc_html_e( 'Customizer Shortcuts', 'helloturbo' ); ?></h2>
			<p><?php esc_html_e( 'Jump straight to the section you want to customize.', 'helloturbo' ); ?></p>
		</div>

		<div class="helloturbo-dashboard__grid">
			<?php foreach ( $sections as $section ) : ?>
				<div class="helloturbo-card helloturbo-card--link">
					<h3><?php echo esc_html( $section['title'] ); ?></h3>
					<p><?php echo esc_html( $section['desc'] ); ?></p>
					<a href="<?php echo esc_url( $this->customizer_url( $section ) ); ?>" class="button"><?php esc_html_e( 'Open', 'helloturbo' ); ?></a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Build a Customizer URL for a section or panel.
	 *
	 * @param array $section Section definition with either a focus or panel key.
	 * @return string
	 */
	private function customizer_url( $section ) {
		$args = array( 'url' => rawurlencode( home_url( '/' ) ) );

		if ( isset( $section['panel'] ) ) {
			$args['autofocus[panel]'] = $section['panel'];
		} elseif ( isset( $section['focus'] ) ) {
			$args['autofocus[section]'] = $section['focus'];
		}

		return add_query_arg( $args, admin_url( 'customize.php' ) );
	}

	/**
	 * Render the help & support tab.
	 */
	private function render_support_tab() {
		?>
		<div class="helloturbo-card">
			<h2><?php esc_html_e( 'Help &amp; Support', 'helloturbo' ); ?></h2>
			<p><?php esc_html_e( 'Need help? Here are the best places to start.', 'helloturbo' ); ?></p>
		</div>

		<div class="helloturbo-dashboard__grid">
			<!-- <div class="helloturbo-card">
				<h3><span class="dashicons dashicons-book"></span> <?php esc_html_e( 'Documentation', 'helloturbo' ); ?></h3>
				<p><?php esc_html_e( 'Read the setup and customization guides.', 'helloturbo' ); ?></p>
				<a href="<?php echo esc_url( 'https://wp-turbo.com/hello-turbo/' ); ?>" class="button" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View Docs', 'helloturbo' ); ?></a>
			</div> -->
			<div class="helloturbo-card">
				<h3><span class="dashicons dashicons-sos"></span> <?php esc_html_e( 'Support Forums', 'helloturbo' ); ?></h3>
				<p><?php esc_html_e( 'Ask a question on the official WordPress.org support forum.', 'helloturbo' ); ?></p>
				<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/helloturbo/' ); ?>" class="button" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get Support', 'helloturbo' ); ?></a>
			</div>
			<div class="helloturbo-card">
				<h3><span class="dashicons dashicons-star-filled"></span> <?php esc_html_e( 'Rate HelloTurbo', 'helloturbo' ); ?></h3>
				<p><?php esc_html_e( 'If you like the theme, please leave a review.', 'helloturbo' ); ?></p>
				<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/helloturbo/reviews/#new-post' ); ?>" class="button" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Leave a Review', 'helloturbo' ); ?></a>
			</div>
		</div>
		<?php
	}
}

new Helloturbo_Admin();
