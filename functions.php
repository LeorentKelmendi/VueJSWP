<?php

require __DIR__ . './vendor/autoload.php';
use VuePress\V1\Search\Posts;
use VuePress\V1\Search\Users;
function theme_styles()
{
    wp_enqueue_style('vendor_css', get_template_directory_uri() . '/public/css/vendor.css');
}
add_action('wp_enqueue_scripts', 'theme_styles');

function theme_js()
{
    wp_enqueue_script('vendor_js', get_template_directory_uri() . '/public/js/vendor.js', '', '', true);
    wp_enqueue_script('theme_js', get_template_directory_uri() . '/public/js/app.js?=' . time(), ['vendor_js'], '', true);
}
add_action('wp_enqueue_scripts', 'theme_js');

add_theme_support('menus');
add_theme_support('post-thumbnails');

add_action('rest_api_init', 'add_theme_endpoint');

function add_theme_endpoint()
{
    register_rest_route('/leo/v1', 'search/posts/(?P<query>.+)', [
        'methods'  => 'GET',
        'callback' => 'searchPosts',
        'args'     => [
            'query',
        ],
    ]);
    register_rest_route('/leo/v1', 'search/users/(?P<query>.+)', [
        'methods'  => 'GET',
        'callback' => 'searchUsers',
        'args'     => [
            'query',
        ],
    ]);
};
/**
 * @param WP_REST_Request $request
 */
function searchUsers(WP_REST_Request $request)
{
    $query = $request->get_param('query');
    $users = new Users;

    return $users->search($query);
}
/**
 * @return mixed
 */
function searchPosts(WP_REST_Request $request)
{
    $query = $request->get_param('query');
    $posts = new Posts;

    return $posts->search($query);
}
