<?php

//PHP
function ajax_localize_script()
{
    //add localize_script
    wp_localize_script('core-defer-main', 'ajax_get_post', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}

add_action('wp_enqueue_scripts', 'ajax_localize_script');


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

//Javascript Fetch

const data = new FormData();
data.append('action', 'get_post');
data.append('id', button.getAttribute('data-id'));

fetch(ajax_get_post.ajax_url, {
        method: "POST",
        body: data
    })
    .then((response) => response.json())
    .then((data) => {
        if (data) {
            console.log(data);
        }
    })
    .catch((error) => {
        console.error(error);
    });
