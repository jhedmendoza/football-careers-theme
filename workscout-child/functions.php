<?php

function initialize() {
  $shortcodes_path = get_template_directory().'-child'. '/shortcodes';
  require_once $shortcodes_path . '/shortcodes.php';
}
add_action( 'init', 'initialize' );

function fc_enqueue_script() {
	$version_script = '1';

	wp_enqueue_script('login-script', get_template_directory_uri().'-child'. '/src/js/fc-login.js', ['jquery'], $version_script, true);
	wp_enqueue_script('custom-script', get_template_directory_uri().'-child'. '/src/js/custom.js', ['jquery'], $version_script, true);
  wp_localize_script('custom-script', 'fc',
    array(
        'site_url' => site_url(),
    )
  );
}

add_action('wp_enqueue_scripts', 'fc_enqueue_script');

add_action( 'wp_enqueue_scripts', 'workscout_enqueue_styles' );
function workscout_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css',array('workscout-base','workscout-responsive','workscout-font-awesome') );
}


function remove_parent_theme_features() {

}
add_action( 'after_setup_theme', 'remove_parent_theme_features', 10 );

function get_job_tags($post){
  ob_start();

  $job_tags = get_the_terms( $post->ID, 'job_listing_tag');

  if ( empty($job_tags) )
    return;

  foreach ($job_tags as $tag): ?>
    <span class="job-tag"><?php echo $tag->name ?></span>
  <?php endforeach;

  $result = ob_get_clean();
  return $result;
}

function thousandsCurrencyFormat($num) {

  if($num>1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
  }
  return $num;
}

?>
