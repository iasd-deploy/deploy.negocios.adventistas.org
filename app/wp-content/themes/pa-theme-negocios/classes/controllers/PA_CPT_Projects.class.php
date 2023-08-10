<?php

class PaCptProjects
{

	public function __construct()
	{
		add_filter('register_taxonomy_args', [$this, 'ChangeXttProjecTaxonomySlug'], 10, 2);
		add_action('init', [$this, 'checkModule'], 10, 2);
		
	}

	function checkModule()
	{
		
		if(get_field('module_projects', 'pa_settings') === false)
			return;

		$this->CreatePostType();
	}

	function CreatePostType()
	{
		$labels = array(
			'name'                  => __('Projects', 'iasd'),
			'singular_name'         => __('Project', 'iasd'),
			'menu_name'             => __('Projects', 'iasd'),
			'name_admin_bar'        => __('Projects', 'iasd'),
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
			'label'                 => __('Project', 'iasd'),
			'labels'                => $labels,
			'supports'              => array('title', 'editor', 'thumbnail', 'revisions'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => sanitize_title(__('Projects', 'iasd')),
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			//'capability_type'       => 'projects',
			'capabilities'			=> pa_compile_post_type_capabilities('project', 'projects'),
			'show_in_rest'          => true,
			'rewrite'				=> array('slug' => __('project-slug', 'iasd'))
		);
		register_post_type('projects', $args);
	}

	function ChangeXttProjecTaxonomySlug($args, $taxonomy)
	{
		if ('xtt-pa-projetos' === $taxonomy) {
			$args['rewrite']['slug'] = 'xtt-pa-projetos';
		}
		return $args;
	}
}

$PaCptProjects = new PaCptProjects();
