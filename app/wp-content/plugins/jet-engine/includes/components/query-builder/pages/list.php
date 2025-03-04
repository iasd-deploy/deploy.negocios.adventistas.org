<?php
namespace Jet_Engine\Query_Builder\Pages;

use Jet_Engine\Query_Builder\Manager;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Queries_List extends \Jet_Engine_CPT_Page_Base {

	public $is_default = true;

	/**
	 * Class constructor
	 */
	public function __construct( $manager ) {

		parent::__construct( $manager );

		add_action( 'jet-engine/query/page/after-title', array( $this, 'add_new_btn' ) );
	}

	/**
	 * Add new  post type button
	 */
	public function add_new_btn( $page ) {

		if ( $page->get_slug() !== $this->get_slug() ) {
			return;
		}

		?>
		<a class="page-title-action" href="<?php echo $this->manager->get_page_link( 'add' ); ?>"><?php
			_e( 'Add New', 'jet-engine' );
		?></a>
		<?php

		jet_engine()->get_video_help_popup( array(
			'popup_title' => __( 'JetEngine Query Builder overview', 'jet-engine' ),
			'embed' => 'https://www.youtube.com/embed/n8YmsTLHuRU',
		) )->wp_page_popup();

	}

	/**
	 * Page slug
	 *
	 * @return string
	 */
	public function get_slug() {
		return 'list';
	}

	/**
	 * Page name
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'Queries List', 'jet-engine' );
	}

	/**
	 * Register add controls
	 * @return [type] [description]
	 */
	public function page_specific_assets() {

		$module_data = jet_engine()->framework->get_included_module_data( 'cherry-x-vue-ui.php' );

		$ui = new \CX_Vue_UI( $module_data );

		$ui->enqueue_assets();

		wp_register_script(
			'jet-engine-query-delete-dialog',
			Manager::instance()->component_url( 'assets/js/admin/delete-dialog.js' ),
			array( 'cx-vue-ui', 'wp-api-fetch', ),
			jet_engine()->get_version(),
			true
		);

		wp_localize_script(
			'jet-engine-query-delete-dialog',
			'JetEngineQueryDeleteDialog',
			array(
				'api_path' => jet_engine()->api->get_route( 'delete-query' ),
				'redirect' => $this->manager->get_page_link( 'list' ),
			)
		);

		wp_enqueue_script(
			'jet-engine-list-navigation',
			Manager::instance()->component_url( 'assets/js/admin/list-navigation.js' ),
			array( 'cx-vue-ui', ),
			jet_engine()->get_version(),
			true
		);

		wp_enqueue_script(
			'jet-engine-query-list',
			Manager::instance()->component_url( 'assets/js/admin/list.js' ),
			array( 'cx-vue-ui', 'wp-api-fetch', 'jet-engine-query-delete-dialog' ),
			jet_engine()->get_version(),
			true
		);

		wp_enqueue_style(
			'jet-engine-query-dynamic-args',
			Manager::instance()->component_url( 'assets/css/query-builder.css' ),
			array(),
			jet_engine()->get_version()
		);

		wp_localize_script(
			'jet-engine-query-list',
			'JetEngineQueryListConfig',
			array(
				'api_path'     => jet_engine()->api->get_route( 'get-queries' ),
				'api_path_add' => jet_engine()->api->get_route( 'add-query' ),
				'edit_link'    => $this->manager->get_edit_item_link( '%id%' ),
				'query_types'  => $this->manager->editor->get_types_for_js(),
				'notices'      => array(
					'copied' => __( 'Copied!', 'jet-engine' ),
				),
			)
		);

		add_action( 'admin_footer', array( $this, 'add_page_template' ) );

	}

	/**
	 * Print add/edit page template
	 */
	public function add_page_template() {

		ob_start();
		include Manager::instance()->component_path( 'templates/admin/list.php' );
		$content = ob_get_clean();
		printf( '<script type="text/x-template" id="jet-query-list">%s</script>', $content );

		ob_start();
		include Manager::instance()->component_path( 'templates/admin/delete-dialog.php' );
		$content = ob_get_clean();
		printf( '<script type="text/x-template" id="jet-query-delete-dialog">%s</script>', $content );

		ob_start();
		include Manager::instance()->component_path( 'templates/admin/list-navigation.php' );
		$content = ob_get_clean();
		printf( '<script type="text/x-template" id="jet-list-navigation">%s</script>', $content );

	}

	/**
	 * Renderer callback
	 *
	 * @return void
	 */
	public function render_page() {

		?>
		<br>
		<style type="text/css">
			.list-table-heading__cell,
			.list-table-item__cell {
				flex: 0 0 33.3333%;
				max-width: 33.3333%;
			}
		</style>
		<div id="jet_query_list"></div>
		<?php

	}

}
