<?php

use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Textarea;
use Extended\ACF\Fields\Group;
use Extended\ACF\Fields\Url;
use Extended\ACF\Fields\Email;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Repeater;
use Extended\ACF\Location;


class PaCptLideres
{

	public function __construct()
	{
		add_action('init', [$this, 'checkModule']);
	}

	function checkModule()
	{
		
		
		if(get_field('module_leaders', 'pa_settings') === false)
			return;

		$this->CreatePostType();
		$this->CreateACFFields();
	}

	function CreatePostType()
	{
		$labels = array(
			'name'                  => __('Leaders', 'iasd'),
			'singular_name'         => __('Leader', 'iasd'),
			'menu_name'             => __('Leaders', 'iasd'),
			'name_admin_bar'        => __('Leaders', 'iasd'),
			'add_new'               => __('Add New', 'iasd'),
			'add_new_item'          => __('Add New Item', 'iasd'),
			'new_item'              => __('New item', 'iasd'),
			'edit_item'             => __('Edit item', 'iasd'),
			'view_item'             => __('View item', 'iasd'),
			'all_items'             => __('All items', 'iasd'),
			'search_items'          => __('Search item', 'iasd'),
			'not_found'             => __('Not found.', 'iasd'),
			'not_found_in_trash'    => __('Not found in Trash.', 'iasd'),
		);
		$args = array(
			'label'                 => __('Leader', 'iasd'),
			'labels'                => $labels,
			'supports'              => array('title', 'thumbnail', 'revisions', 'editor'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			//'capability_type'       => 'lidere',
			'capabilities'			=> pa_compile_post_type_capabilities('lidere', 'lideres'),
			'show_in_rest'          => true,
		);
		register_post_type('lideres', $args);
	}


	function CreateACFFields()
	{
		register_extended_field_group([
			'title' => __('Leaders', 'iasd'),
			'style' => 'default',
			'fields' => [
				Text::make(__('Role/Field', 'iasd'), 'lider_cargo'),
				Textarea::make(__('Biography', 'iasd'), 'lider_bibliografia')
					->newLines('br') // br or wpautop
					->rows(8),
				Group::make(__('Social Netork', 'iasd'), 'lider_redes_sociais')
					->fields([
						Url::make('Facebook', 'lider_facebook'),
						Url::make('Twitter', 'lider_twitter'),
						Url::make('Instagram', 'lider_instagram'),
						Email::make('E-mail', 'lider_email')
					])
					->layout('block'),
				Repeater::make(__('Staff', 'iasd'), 'lider_equipe')
					->fields([
						Text::make(__('Name', 'iasd'), 'lider_equipe_nome'),
						Text::make(__('Role', 'iasd'), 'lider_equipe_cargo'),
						Image::make(__('Picture', 'iasd'), 'lider_equipe_foto')
							->library('all') // all or uploadedTo
							->height(300)
							->width(300)
							->returnFormat('array') // id, url or array (default)
							->previewSize('medium'), // thumbnail, medium or large
						Email::make(__('E-mail', 'iasd'), 'lider_equipe_email'),
						Text::make(__('Telephone', 'iasd'), 'lider_equipe_telefone'),
					])
					->buttonLabel(__('Add member', 'iasd'))
					->layout('table') // block, row or table
			],
			'location' => [
				Location::where('post_type', '==', 'lideres'),
			],
		]);
	}
}

$PaCptLideres = new PaCptLideres();
 

//gadd_action( 'init', 'teste_cap', 9999 );


function teste_cap(){

	global $wp_post_types, $wp_roles;

	
	$wp_post_types['lideres']->cap->create_posts = 'create_lideres';

	print_r($wp_post_types['lideres']);	
	die;
	

}