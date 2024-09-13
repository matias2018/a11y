<?php
namespace SCML\A11Y;


function enqueue_accessibility_scripts()
{
    wp_enqueue_script('scml_a11y.js', plugins_url('scml_a11y/inc/js/scml_a11y.js'), array(), '1.0', true);
}
function enqueue_a11y_banner_script()
{
    wp_enqueue_style('a11y-style', plugin_dir_url(__FILE__) . '/inc/css/style.css', array(), '1.0');
    wp_enqueue_style('my-plugin-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('my-plugin-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), 'version', true);

    error_log('enqueue_a11y_banner_script');
    $useDevicePreferences = get_option('use_device_preferences');

    // Localize the script to make the data accessible in JavaScript
    wp_localize_script(
        'scml-a11y-script',
        'ajax_object',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('wp_enqueue_scripts', 'SCML\A11Y\enqueue_a11y_banner_script');
