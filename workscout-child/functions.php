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


function workscout_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css',array('workscout-base','workscout-responsive','workscout-font-awesome') );
}
add_action( 'wp_enqueue_scripts', 'workscout_enqueue_styles' );

function remove_parent_theme_features() {}
add_action( 'after_setup_theme', 'remove_parent_theme_features', 10 );


function custom_submit_job_form_fields( $fields ) {
  //Remove unnecessary fields
  unset($fields['job']['rate_min']);
  unset($fields['job']['rate_max']);
  unset($fields['job']['salary_min']);
  unset($fields['job']['job_region']);

  //rename fields based on the design
  $fields['job']['salary_max']['label'] = "Salary (£) / yr";

  $job_fields = include get_template_directory().'-child/job_manager/configs/job_form_fields.php';
  return $job_fields;
}
add_filter( 'submit_job_form_fields', 'custom_submit_job_form_fields' );


/* Utility Functions */

function applyJob($post) {
  
  if ( candidates_can_apply() ) {

    $apply = get_the_job_application_method();

    if ( !empty($apply) ) 
    {
      if ($apply->type == 'url') 
        echo '<a class="button site-btn" target="_blank" href="' . esc_url($apply->url) . '">' . esc_html__('Apply for job', 'workscout') . '</a>';
      else 
        get_template_part('template-parts/job','application');
    } 
    else {
      $apply = get_post_meta($post->ID, '_apply_link', true);
      if ( !empty($apply) ) 
        echo '<a class="button site-btn" target="_blank" href="' . esc_url($apply) . '">' . esc_html__('Apply for job', 'workscout') . '</a>';
      
    }
  }
}


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
        $x_parts = array('K', 'M', 'B', 'T');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
  }
  return $num;
}



?>
