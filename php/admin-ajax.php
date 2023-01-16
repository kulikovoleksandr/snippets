<?php

function wp_pageviews_scripts()
{
    wp_localize_script('core-defer-main', 'wp_pageviews_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}

add_action('wp_enqueue_scripts', 'wp_pageviews_scripts');


add_action('wp_ajax_get_post', 'ajax_get_post');
add_action('wp_ajax_nopriv_get_post', 'ajax_get_post');
function ajax_get_post()
{
    $id = $_POST['id'];

    $return = [
        'title' => get_the_title($id),
        'content' => apply_filters('the_content', get_the_content(null, false, $id)),
    ];

    wp_send_json($return);
}
