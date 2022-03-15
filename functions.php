<?php
////add_filter('woocommerce_enqueue_styles', '__return_false');
////
////
/////*--------------------------------------------------
////    | Theme & WordPress core functions files
////--------------------------------------------------*/
require get_template_directory() . '/includes/core/wp-admin.php';
require get_template_directory() . '/includes/core/enqueue.php';
require get_template_directory() . '/includes/core/theme-setup.php';
require get_template_directory() . '/includes/core/theme-support.php';
require get_template_directory() . '/includes/core/excerpt.php';
require get_template_directory() . '/includes/core/nav-walker.php';
////require get_template_directory() . '/includes/core/google-analytics.php';
///
require get_template_directory() . '/includes/custom/custom.php';
require get_template_directory() . '/includes/custom/admin-styling.php';
require get_template_directory() . '/includes/custom/default-pages.php';
require get_template_directory() . '/includes/custom/parse-video.php';

require get_template_directory() . '/includes/woocommerce/woo-general.php';
require get_template_directory() . '/includes/woocommerce/woo-remove.php';
require get_template_directory() . '/includes/woocommerce/woo-shipping.php';
require get_template_directory() . '/includes/woocommerce/woo-styles.php';


function iconic_button_class($class)
{
    $class .= ' primary';
    return $class;
}

add_filter('jck_wssv_add_to_cart_button_class', 'iconic_button_class', 10);


//add_action('wp_ajax_nopriv_get_locations', 'get_locations');
//add_action('wp_ajax_get_locations', 'get_locations');
//function get_locations()
//{
//    $file = get_stylesheet_directory() . '/report.txt';
//    $current_page = (!empty($_POST['current_page'])) ? $_POST['current_page'] : 1;
//    $locations = [];
//    $locations = wp_remote_retrieve_body(wp_remote_get('https://coffeedrop.staging2.image-plus.co.uk/api/locations/?page=' . $current_page));
//    file_put_contents($file, 'Current page ' . $current_page . '\n\n', FILE_APPEND);
//    $locations = json_decode($locations);
//
//    if (!is_array($locations || empty($locations))) {
//        return false;
//    }
//    $current_page = $current_page + 1;
//    wp_remote_post(admin_url('admin-ajax.php?action=get_locations'), [
//        'blocking' => false,
//        'sslverify' => false,
//        'body' => [
//            'current_page' => $current_page
//        ]
//    ]);
//    return $locations;
//}

/**
 * Produces cleaner filenames for uploads
 *
 * @param  string $filename
 * @return string
 */
function wpartisan_sanitize_file_name( $filename ) {

    $sanitized_filename = remove_accents( $filename ); // Convert to ASCII

    // Standard replacements
    $invalid = array(
        ' '   => '-',
        '%20' => '-',
        '_'   => '-',
    );
    $sanitized_filename = str_replace( array_keys( $invalid ), array_values( $invalid ), $sanitized_filename );

    $sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); // Remove all non-alphanumeric except .
    $sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); // Remove all but last .
    $sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); // Replace any more than one - in a row
    $sanitized_filename = str_replace('-.', '.', $sanitized_filename); // Remove last - if at the end
    $sanitized_filename = strtolower( $sanitized_filename ); // Lowercase

    return $sanitized_filename;
}

add_filter( 'sanitize_file_name', 'wpartisan_sanitize_file_name');