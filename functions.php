<?php 
/* Some requirements for timber/twig */

// require composer autoload file
require_once(__DIR__ . '/vendor/autoload.php');

//initiate the timber class site wide
$timber = new \Timber\Timber();  

/*********************************************** 
 * Functions that help display the page title 
 ***********************************************/
// Add support for the title feature
function theme_slug_setup() {
    add_theme_support( 'title-tag' );
}
// Enqueue both the title tag features
 add_action( 'after_setup_theme', 'theme_slug_setup' );
 add_action( 'wp_head', 'theme_slug_render_title' );

// Render the title
function theme_slug_render_title() {
    ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
}
    
/*********************************************** 
 * Enqueue scripts and styles
 ***********************************************/

// Putting all of our scripts and styles in the one function and enqueing
 function adminpress_enqueue_sands() {

     // Use variables for long urls for readability
    $bootstrap_cdn = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js";
    $boot_cdn = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js";
    $fa_cdn = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js";
    $data_tables_cdn = "https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css";
    $jquery_cdn = "https://code.jquery.com/jquery-3.5.1.min.js";
    $js_charts_cdn = 'https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js';

     // Scripts
    wp_enqueue_script( 'my-jquery', $jquery_cdn, NULL, '3.5.1', false );
    wp_enqueue_script( 'bootstrap-4', $boot_cdn, array('jquery'), '4.5.0', false );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/src/js/scripts.js', array('jquery'), '1.0', false );
    wp_enqueue_script( 'bootstrap', $bootstrap_cdn, array('jquery'), '3.3.5', true );
    wp_enqueue_script( 'font-awesome', $fa_cdn, NULL, '1.0', false );
    wp_enqueue_script( 'data-tables', $data_tables_cdn, NULL, '1.0', false );
    wp_enqueue_script( 'js-charts', $js_charts_cdn, NULL, '2.9.3', false );
    wp_enqueue_script( 'axios', get_template_directory_uri() . '/node_modules/axios/dist/axios.min.js', array('jquery'), 1.0, false);

    // Styles
    wp_enqueue_style( 'style', get_stylesheet_uri() );
 }
 add_action( 'wp_enqueue_scripts' , 'adminpress_enqueue_sands' );

 // This function helps us format a time/date to show in mins/hours/days ago

 function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
