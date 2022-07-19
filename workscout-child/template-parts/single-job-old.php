

<div id="titlebar" class="photo-bg single " style="background: url('/wp-content/uploads/2022/06/job-banner.jpg')">
	<div class="container">
		<div class="sixteen columns">
			<!-- <img src=""> -->
		</div>
		</div>
	</div>

<!-- Titlebar
================================================== -->
<?php
$header_image_url = get_post_meta($post->ID, 'pp_job_header_bg', TRUE);

if (empty($header_image_url)) {
	$header_image_url = get_post_meta($post->ID, '_header_image', TRUE);
}

$header_image = apply_filters('workscout_single_job_header_image', $header_image_url);


if (!empty($header_image)) {
	$transparent_status = get_post_meta($post->ID, 'pp_transparent_header', TRUE);

	if ($transparent_status == 'on') { ?>
		<div id="titlebar" class="photo-bg with-transparent-header" style="background: url('<?php echo esc_url($header_image); ?>')">
		<?php } else { ?>
			<div id="titlebar" class="photo-bg" style="background: url('<?php echo esc_url($header_image); ?>')">
			<?php } ?>
		<?php } else { ?>
			<div id="titlebar" class="single titlebar-boxed-company-info">
			<?php } ?>

			<div class="container">
				<div class="eleven columns">

					<?php
					$terms = get_the_terms($post->ID, 'job_listing_category');

					if ($terms && !is_wp_error($terms)) :

						$jobcats = array();

						foreach ($terms as $term) {
							$term_link = get_term_link($term);
							$jobcats[] = '<a href="' . $term_link . '">' . $term->name . '</a>';
						}

						$print_cats = join(" / ", $jobcats); ?>
						<?php echo '<span>' . $print_cats . '</span>'; ?>
					<?php
					endif; ?>
					<h1><?php the_title(); ?>
						<?php if (get_option('job_manager_enable_types')) {
							$types = get_the_terms($post->ID, 'job_listing_type');
							if ($types && !is_wp_error($types)) :
								foreach ($types as $type) { ?>
									<span class="job-type <?php echo sanitize_title($type->slug); ?>"><?php echo $type->name; ?></span>
							<?php }
							endif; ?>
						<?php } ?>
						<?php if (workscout_newly_posted()) {
							echo '<span class="new_job">' . esc_html__('NEW', 'workscout') . '</span>';
						} ?>
					</h1>
				</div>

				<div class="five columns">
					<?php do_action('workscout_bookmark_hook') ?>
					<?php
					$private_messages = get_option('workscout_private_messages_job');
					if ($private_messages && is_user_logged_in()) :

					?>
						<!-- Reply to review popup -->
						<div id="small-dialog" class="zoom-anim-dialog mfp-hide small-dialog apply-popup ">


							<div class="small-dialog-header">
								<h3><?php esc_html_e('Send Message', 'workscout'); ?></h3>
							</div>

							<div class="message-reply margin-top-0">
								<?php get_job_manager_template('ws-private-message.php'); ?>

							</div>
						</div>




					<?php endif; ?>
				</div>

			</div>
			</div>

			<!-- Content
================================================== -->
			<?php

			$layout = Kirki::get_option('workscout', 'pp_job_layout'); ?>
			<div class="container <?php echo esc_attr($layout); ?>">
				<div class="sixteen columns">
					<?php do_action('job_content_start'); ?>
				</div>

				<?php if (class_exists('WP_Job_Manager_Applications')) : ?>
					<?php if (is_position_filled()) : ?>
						<div class="sixteen columns">
							<div class="notification closeable notice "><?php esc_html_e('This position has been filled', 'workscout'); ?></div>
							<div class="margin-bottom-35"></div>
						</div>
					<?php elseif (!candidates_can_apply() && 'preview' !== $post->post_status) : ?>
						<div class="sixteen columns">
							<div class="notification closeable notice "><?php esc_html_e('Applications have closed', 'workscout'); ?></div>
						</div>
					<?php endif; ?>
				<?php endif;  ?>

				<!-- Recent Jobs -->
				<?php $logo_position = Kirki::get_option('workscout', 'pp_job_list_logo_position', 'left'); ?>
				<?php $company_id = get_post_meta($post->ID, '_company_id', true);
				if (!empty($company_id) && get_post_status($company_id)) {
					$company_url = get_permalink($company_id);
				}  ?>
				<div class="company-info-boxed">
					<?php if (get_the_company_name()) { ?>
						<!-- Company Info -->
						<div class="company-info <?php echo ($logo_position == 'left') ? 'left-company-logo' : 'right-company-logo'; ?>">

							<div class="company-info-boxed-logo">
								<?php if (class_exists('Astoundify_Job_Manager_Companies')) {
									echo workscout_get_company_link(get_post_meta($post->ID, '_company_name', true));
								} ?>
								<?php if ($company_id) { ?> <a href="<?php echo esc_url($company_url) ?>"><?php } ?>
									<?php
									if ($company_id) {
										($logo_position == 'left') ? the_company_logo('thumbnail', null, $company_id) : the_company_logo('medium', null, $company_id);
									} else {
										($logo_position == 'left') ? the_company_logo() : the_company_logo('medium');
									} ?>
									<?php if ($company_id) { ?> </a><?php } ?>
								<?php if (class_exists('Astoundify_Job_Manager_Companies')) {
									echo "</a>";
								} ?>
							</div>

							<div class="content">
								<h4>
									<?php if (class_exists('Astoundify_Job_Manager_Companies')) {
										echo workscout_get_company_link(get_post_meta($post->ID, '_company_name', true));
									} ?>
									<?php if ($company_id) { ?> <a href="<?php echo esc_url($company_url) ?>"><?php } ?>
										<?php the_company_name('<strong>', '</strong>'); ?>
										<?php if ($company_id) { ?> </a><?php } ?>
									<?php if (class_exists('Astoundify_Job_Manager_Companies')) {
										echo "</a>";
									} ?>

									<?php if ($company_id && function_exists('mas_wpjmc_get_the_meta_data') && !empty($company_tagline = mas_wpjmc_get_the_meta_data('_company_tagline', $company_id))) : ?>
										<p class="company-data__content--list-item"><?php echo esc_html($company_tagline); ?></p>
									<?php else :
										the_company_tagline('<span class="company-tagline">', '</span>'); ?>
									<?php endif; ?>
								</h4>

								<div class="company-info-boxed-links">

									<?php if ($company_id && function_exists('mas_wpjmc_get_the_meta_data')) {

										if (!empty(mas_wpjmc_get_the_meta_data('_company_website', $company_id))  || !empty(mas_wpjmc_get_the_meta_data('_company_email', $company_id)) || !empty(mas_wpjmc_get_the_meta_data('_company_twitter', $company_id)) || !empty(mas_wpjmc_get_the_meta_data('_company_facebook', $company_id)) || !empty(mas_wpjmc_get_the_meta_data('_company_phone', $company_id))) {
									?>


											<?php if (!empty($company_website = mas_wpjmc_get_the_meta_data('_company_website', $company_id))) : ?>
												<span class="company-data__content--list-item _company_website"><a class="website" href="<?php echo esc_url($company_website); ?>" target="_blank" rel="nofollow"><i class="fa fa-link"></i> <?php esc_html_e('Website', 'workscout'); ?></a></span>
											<?php endif; ?>
											<?php if (!empty($company_email = mas_wpjmc_get_the_meta_data('_company_email', $company_id))) : ?>
												<span class="company-data__content--list-item _company_email">
													<a href="mailto:<?php echo ($company_email); ?>" target="_blank"><i class="fa fa-envelope"></i> <?php echo esc_html($company_email); ?></a>
												</span>
											<?php endif; ?>
											<?php if (!empty($company_twitter = mas_wpjmc_get_the_meta_data('_company_twitter', $company_id))) : ?>
												<span class="company-data__content--list-item _company_twitter">
													<a href="<?php echo get_the_mas_company_twitter($company_id); ?>">
														<i class="fa fa-twitter"></i>
														<?php esc_html_e('Twitter', 'workscout'); ?>
													</a></span>

											<?php endif; ?>
											<?php if (!empty($company_facebook = mas_wpjmc_get_the_meta_data('_company_facebook', $company_id))) : ?>
												<span class="company-data__content--list-item _company_phone"><a href="<?php echo esc_url($company_facebook); ?>">
														<i class="fa fa-facebook"></i>
														<?php esc_html_e('Facebook', 'workscout'); ?>
													</a></span>

											<?php endif; ?>
											<?php if (!empty($company_phone = mas_wpjmc_get_the_meta_data('_company_phone', $company_id))) : ?>
												<span class="company-data__content--list-item _company_phone">
													<a href="tel:<?php echo esc_attr($company_phone); ?>" target="_blank"><i class="fa fa-phone"></i>
														<?php echo esc_html($company_phone); ?>
													</a>
												</span>
											<?php endif; ?>

										<?php
										}
									} else { ?>


										<?php if ($website = get_the_company_website()) : ?>
											<span><a class="website" href="<?php echo esc_url($website); ?>" target="_blank" rel="nofollow"><i class="fa fa-link"></i> <?php esc_html_e('Website', 'workscout'); ?></a></span>
										<?php endif; ?>
										<?php if (get_the_company_twitter()) : ?>
											<span><a href="http://twitter.com/<?php echo get_the_company_twitter(); ?>">
													<i class="fa fa-twitter"></i>
													@<?php echo get_the_company_twitter(); ?>
												</a></span>
										<?php endif; ?>

										<?php
										$company_facebook = get_post_meta($post->ID, '_company_facebook', true);
										if ($company_facebook) : ?>
											<span><a href="<?php echo esc_url($company_facebook); ?>">
													<i class="fa fa-facebook"></i>
													<?php esc_html_e('Facebook', 'workscout'); ?>
												</a></span>
										<?php endif; ?>


									<?php } ?>
								</div>
								<?php

								if ($private_messages) : ?>
									<?php if (is_user_logged_in()) : ?>
										<a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> <?php esc_html_e('Send Message', 'workscout'); ?></a>
									<?php else : ?>
										<?php
										$popup_login = get_option('workscout_popup_login');
										if ($popup_login == 'ajax') { ?>
											<a href="#login-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> <?php esc_html_e('Login to Send Message', 'workscout'); ?></a>
										<?php } else {
											$login_page = get_option('workscout_profile_page'); ?>
											<a href="<?php echo esc_url(get_permalink($login_page)); ?>" class="send-message-to-owner button"><i class="sl sl-icon-envelope-open"></i> <?php esc_html_e('Login to Send Message', 'workscout'); ?></a>
										<?php } ?>

									<?php endif; ?>
								<?php endif; ?>
							</div>
							<div class="company-info-apply-btn">

								<?php
								if (candidates_can_apply()) {

									$apply = get_the_job_application_method();
									if (!empty($apply)) {
										if ($apply->type == 'url') {
											echo '<a class="button" target="_blank" href="' . esc_url($apply->url) . '">' . esc_html__('Apply for job', 'workscout') . '</a>';
										} else {
											get_job_manager_template('job-application.php');
										}
									} else {
										$apply = get_post_meta($post->ID, '_apply_link', true);
										if (!empty($apply)) {
											echo '<a class="button " target="_blank" href="' . esc_url($apply) . '">' . esc_html__('Apply for job', 'workscout') . '</a>';
										}
									}
								} ?>
							</div>
						</div>
					<?php } ?>
				</div>


				<div class="eleven columns ">
					<div class="padding-right">

						<div class="single_job_listing">

							<?php if (get_option('job_manager_hide_expired_content', 1) && 'expired' === $post->post_status) : ?>
								<div class="job-manager-info"><?php esc_html_e('This listing has expired.', 'workscout'); ?></div>
							<?php else : ?>
								<div class="job_description">
									<?php do_action('workscout_single_job_before_content'); ?>
									<?php the_company_video(); ?>
									<?php echo do_shortcode(apply_filters('the_job_description', get_the_content())); ?>
								</div>
								<?php
								/**
								 * single_job_listing_end hook
								 */
								do_action('single_job_listing_end');
								?>

								<?php
								$share_options = Kirki::get_option('workscout', 'pp_job_share');

								if (!empty($share_options)) {
									$id = $post->ID;
									$title = urlencode($post->post_title);
									$url =  urlencode(get_permalink($id));
									$summary = urlencode(workscout_string_limit_words($post->post_excerpt, 20));
									$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'medium');
									if($thumb){									
										$imageurl = urlencode($thumb[0]);
									} else {
										$imageurl = '';
									}
								?>
									<ul class="share-post">
										<?php if (in_array("facebook", $share_options)) { ?><li><?php echo '<a target="_blank" class="facebook-share" href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '">Facebook</a>'; ?></li><?php } ?>
										<?php if (in_array("twitter", $share_options)) { ?><li><?php echo '<a target="_blank" class="twitter-share" href="https://twitter.com/share?url=' . $url . '&amp;text=' . esc_attr($summary) . '" title="' . __('Twitter', 'workscout') . '">Twitter</a>'; ?></li><?php } ?>

										<?php if (in_array("pinterest", $share_options)) { ?><li><?php echo '<a target="_blank"  class="pinterest-share" href="http://pinterest.com/pin/create/button/?url=' . $url . '&amp;description=' . esc_attr($summary) . '&media=' . esc_attr($imageurl) . '" onclick="window.open(this.href); return false;">Pinterest</a>'; ?></li><?php } ?>
										<?php if (in_array("linkedin", $share_options)) { ?><li><?php echo '<a target="_blank"  class="linkedin-share" href="https://www.linkedin.com/cws/share?url=' . $url . '">LinkedIn</a>'; ?></li><?php } ?>

										<!-- <li><a href="#add-review" class="rate-recipe">Add Review</a></li> -->
									</ul>
								<?php } ?>
								<div class="clearfix"></div>



							<?php endif; ?>


						</div>

					</div>
				</div>


				<!-- Widgets -->
				<div class="five columns" id="job-details">
					

				</div>
				<!-- Widgets / End -->


			</div>



			<div class="clearfix"></div>
			<div class="margin-top-55"></div>