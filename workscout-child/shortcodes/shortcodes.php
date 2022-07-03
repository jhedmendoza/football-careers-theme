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
