<?php

function shortcode_fc_search_job_and_location() {
	ob_start();
  get_template_part('template-parts/forms/search-job-and','locations');
	return ob_get_clean();
}
add_shortcode('fc_search_job_and_location', 'shortcode_fc_search_job_and_location');

function shortcode_fc_login_form() {
	ob_start();
  get_template_part('template-parts/forms/login','form');
	return ob_get_clean();
}
add_shortcode('fc_login_form', 'shortcode_fc_login_form');


function shortcode_fc_latest_news($attr) {
	ob_start();
	$params = [
		'numberposts' => $attr['limit'],
		'post_status' => 'publish'
	];

	$latest_post = wp_get_recent_posts($params);
  get_template_part('template-parts/latest','news', ['latest_news' => $latest_post]);
	return ob_get_clean();
}
add_shortcode('fc_latest_news', 'shortcode_fc_latest_news');
