<?php

function pa_compile_post_type_capabilities($singular, $plural, $roles = array('administrator', 'editor')){
    $caps = array(
    "edit_post" => "edit_$singular",
    "read_post" => "read_$singular",
    "delete_post" => "delete_$singular",
    "edit_posts" => "edit_$plural",
    "edit_others_posts" => "edit_others_$plural",
    "delete_posts" => "delete_$plural",
    "publish_posts" => "publish_$plural",
    "read_private_posts" => "read_private_$plural",
    "delete_private_posts" => "delete_private_$plural",
    "delete_published_posts" => "delete_published_$plural",
    "delete_others_posts" => "delete_others_$plural",
    "edit_private_posts" => "edit_private_$plural",
    "edit_published_posts" => "edit_published_$plural",
    "create_posts" => "create_$plural",
    "read" => "read"
);

foreach ($roles as $key => $role) {
    if( $role_object = get_role( $role ) ) {
        foreach ($caps as $key => $cap) {
            if( !$role_object->has_cap( $cap ) ) {
                $role_object->add_cap( "$cap" );
            }
        }
    }
}

    return $caps;
}