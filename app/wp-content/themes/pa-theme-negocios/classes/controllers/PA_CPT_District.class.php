<?php

use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Textarea;
use Extended\ACF\Fields\Group;
use Extended\ACF\Fields\Url;
use Extended\ACF\Fields\Email;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Repeater;
use Extended\ACF\Location;
use Extended\ACF\Fields\Tab;


class PaCptDistricts
{

    public function __construct()
	{
		add_action('init', [$this, 'checkModule']);
	}

	function checkModule()
	{
		if(get_field('module_districts', 'pa_settings') === false)
			return;

		$this->CreatePostType();
		$this->CreateACFFields();
        $this->RegisterTaxonomyDistricts();
	}

    function CreatePostType()
    {
        $labels = array(
            'name'                  => __('Districts', 'iasd'),
            'singular_name'         => __('District', 'iasd'),
            'menu_name'             => __('Districts', 'iasd'),
            'name_admin_bar'        => __('Districts', 'iasd'),
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
            'label'                 => __('District', 'iasd'),
            'labels'                => $labels,
            'supports'              => array('title', 'thumbnail', 'revisions'),
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
            //'capability_type'       => 'districts',
            'capabilities'			=> pa_compile_post_type_capabilities('district', 'districts'),
            'show_in_rest'          => true,
        );
        register_post_type('districts', $args);
    }

    function CreateACFFields()
    {
        register_extended_field_group([
            'title' => __('Districts', 'iasd'),
            'style' => 'default',
            'fields' => [
                Tab::make(__('Tab churches', 'iasd')),
                Repeater::make(__('Churches', 'iasd'), 'churches')
                    ->fields([
                        Text::make(__('Name', 'iasd'), 'church_nome'),
                        Image::make(__('Picture', 'iasd'), 'church_foto')
                            ->library('all') // all or uploadedTo
                            ->height(300)
                            ->width(300)
                            ->returnFormat('array') // id, url or array (default)
                            ->previewSize('thumbnail'), // thumbnail, medium or large
                        Textarea::make(__('Address', 'iasd'), 'church_address'),
                        Group::make(__('Church Netork', 'iasd'), 'church_netork')
                            ->fields([
                                Url::make('Youtube', 'district_youtube'),
                                Url::make('Google Maps', 'district_maps'),
                                Url::make('Waze', 'district_waze'),
                                Email::make('E-mail', 'district_email')
                            ])
                            ->layout('block')
                    ])
                    ->buttonLabel(__('Add church', 'iasd'))
                    ->layout('row'), // block, row or table

                Tab::make(__('Tab shepherds', 'iasd')),
                Repeater::make(__('Shepherds', 'iasd'), 'shepherds')
                    ->fields([
                        Text::make(__('Name', 'iasd'), 'shepherd_nome'),
                        Image::make(__('Picture', 'iasd'), 'shepherd_foto')
                            ->library('all') // all or uploadedTo
                            ->height(300)
                            ->width(300)
                            ->returnFormat('array') // id, url or array (default)
                            ->previewSize('thumbnail'), // thumbnail, medium or large
                        Group::make(__('Shepherd Netork', 'iasd'), 'shepherd_netork')
                            ->fields([
                                Url::make('Facebook', 'shepherd_facebook'),
                                Url::make('Instagram', 'shepherd_instagram'),
                                Url::make('Twitter', 'shepherd_twitter'),
                                Email::make('E-mail', 'shepherd_email')
                            ])
                            ->layout('block')
                    ])
                    ->buttonLabel(__('Add shepherd', 'iasd'))
                    ->layout('row') // block, row or table


            ],
            'location' => [
                Location::where('post_type', '==', 'districts')
            ]
        ]);
    }

    function RegisterTaxonomyDistricts()
    {

        $labels = array(
            'name'              => __('Region', 'webdsa'),
            'singular_name'     => __('Region', 'webdsa'),
            'search_items'      => __('Search', 'webdsa'),
            'all_items'         => __('All itens', 'webdsa'),
            'parent_item'       => __('Region', 'webdsa') . ', father',
            'parent_item_colon' => __('Region', 'webdsa') . ', father',
            'edit_item'         => __('Edit', 'webdsa'),
            'update_item'       => __('Update', 'webdsa'),
            'add_new_item'      => __('Add new', 'webdsa'),
            'new_item_name'     => __('New', 'webdsa'),
            'menu_name'         => __('Region', 'webdsa'),
        );

        $args   = array(
            'hierarchical'        => true, // make it hierarchical (like categories)
            'labels'              => $labels,
            'show_ui'             => true,
            'show_admin_column'   => true,
            'query_var'           => true,
            'rewrite'             => array('slug' => sanitize_title(__('Region', 'webdsa'))),
            'public'              => true,
            'show_in_rest'        => true, // add support for Gutenberg editor
            // 'capabilities'        => array(
            //   'edit_terms'        => false,
            //   'delete_terms'      => false,
            // )
        );

        register_taxonomy('xtt-pa-region', ['districts'], $args);
    }
}


$PaCptdistricts = new PaCptdistricts();
