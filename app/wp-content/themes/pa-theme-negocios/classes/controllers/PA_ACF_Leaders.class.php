<?php

use Extended\ACF\Fields\PostObject;
use Extended\ACF\Location;

class PaAcfLeaders
{

    public function __construct()
    {
        add_action('init', [$this, 'createACFFields']);
        add_action('init', [$this, 'hideEditor']);
        add_action('init', [$this, 'createLeadersPage']);
    }

    function createACFFields()
    {
        register_extended_field_group([
            'title' => 'Leader-feature',
            'style' => 'default',
            'fields' => [
                PostObject::make('Líderes destaques', 'lideres_destaques')
                    ->postTypes(['lideres'])
                    ->returnFormat('id') // id or object (default)
                    ->allowMultiple(true),
            ],
            'location' => [
                Location::where('page_template', '==', 'page-lideres.php'),
            ]
        ]);
    }

    function hideEditor()
    {
        if (!is_admin()) {
            return;
        }

        if (isset($_GET['post']) || isset($_POST['post_ID'])) {
            $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
        }

        if (!isset($post_id)) return;

        $template_file = get_post_meta($post_id, '_wp_page_template', true);

        if ($template_file == 'page-lideres.php') { // edit the template name

            remove_post_type_support('page', 'editor');
        }
    }

    public static function createLeadersPage()
    {
        $page = __('/leaders/', 'iasd');
        $page = get_page_by_path($page);

        if (!$page) {

            $new_page = array(
                'post_content'   => '',
                'post_name'      => __('leaders', 'iasd'),
                'post_title'     => __('Leaders', 'iasd'),
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'post_author'    => get_current_user_id(),
                'page_template'  => 'page-lideres.php'
            );
            $page_id = wp_insert_post($new_page);
        }
    }
}

$PaAcfLeaders = new PaAcfLeaders();
