<?php

use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Url;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\ColorPicker;
use Extended\ACF\Location;

class PaCptSliderHome {

	public function __construct()
	{
		add_action('init', [$this, 'checkModule']);
	}

	function checkModule()
	{
		if(get_field('module_sliders', 'pa_settings') === false)
			return;

		$this->CreatePostType();
		$this->CreateACFFields();
	}

	function CreatePostType() {
		$labels = array(
			'name'                  => _x( 'Sliders', 'Post Type General Name', 'pa_iasd' ),
			'singular_name'         => _x( 'Slider', 'Post Type Singular Name', 'pa_iasd' ),
			'menu_name'             => __( 'Sliders', 'pa_iasd' ),
			'name_admin_bar'        => __( 'Sliders', 'pa_iasd' ),
			'archives'              => __( 'Sliders', 'pa_iasd' ),
			'add_new'               => __( 'Add New', 'iasd' ),
			'add_new_item'          => __( 'Add New Item', 'iasd' ),
			'new_item'              => __( 'New item', 'iasd' ),
			'edit_item'             => __( 'Edit item', 'iasd' ),
			'view_item'             => __( 'View item', 'iasd' ),
			'all_items'             => __( 'All items', 'iasd' ),
			'search_items'          => __( 'Search item', 'iasd' ),
			'not_found'             => __( 'Not found.', 'iasd' ),
			'not_found_in_trash'    => __( 'Not found in Trash.', 'iasd' ),
		);
		$args = array(
			'label'                 => __( 'Slider', 'pa_iasd' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions' ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			//'capability_type'       => 'pages',
			'capabilities'			=> pa_compile_post_type_capabilities('slider', 'sliders'),
			'show_in_rest'          => true,
		);
		register_post_type( 'sliders', $args );
	}

	function CreateACFFields(){
		register_extended_field_group([
			'title' => 'Slider-home',
			'style' => 'default',
			'fields' => [
				Image::make(__('Image - Desktop', 'iasd'), 'slider_img_desktop')
					->mimeTypes(['jpg', 'jpeg', 'png'])
					->library('all') // all or uploadedTo
					->returnFormat('url') // id, url or array (default)
					->previewSize('medium'), // thumbnail, medium or large
				Image::make(__('Image - Mobile', 'iasd'), 'slider_img_mobile')
					->mimeTypes(['jpg', 'jpeg', 'png'])
					->library('all') // all or uploadedTo
					->returnFormat('url') // id, url or array (default)
					->previewSize('medium'), // thumbnail, medium or large
				Text::make(__('Line 1 - Text', 'iasd'), 'slider_text_01'),
				Text::make(__('Line 2 - Text', 'iasd'), 'slider_text_02'),
				Text::make(__('Line 3 - Text', 'iasd'), 'slider_text_03'),
				ColorPicker::make(__('Button text color', 'iasd'), 'slider_button_text_color')
					->defaultValue('#ffffff'),
				ColorPicker::make(__('Button color', 'iasd'), 'slider_button_color')
					->defaultValue('#003366'),
				Text::make(__('Button text', 'iasd'), 'slider_button_text')
					->defaultValue(__('Access', 'iasd')),
				Url::make(__('Button URL', 'iasd'), 'slider_button_url'),
			],
			'location' => [
				Location::where('post_type', '==','sliders'),
			],
		]);
	}
}

$PaCptSliderHome = new PaCptSliderHome();
