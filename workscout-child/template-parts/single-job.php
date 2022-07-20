<?php

global $post;

$header_image_url = !empty( get_post_meta($post->ID, 'pp_job_header_bg', TRUE) ) ? get_post_meta($post->ID, 'pp_job_header_bg', TRUE) : get_template_directory_uri().'-child/src/img/job-banner.jpg' ;
$header_image     = apply_filters('workscout_single_job_header_image', $header_image_url);

$company_id       = get_post_meta($post->ID, '_company_id', true);
$company_logo     = (get_the_company_logo( $company_id, 'thumbnail' )) ?  get_the_company_logo( $company_id, 'thumbnail' ) : apply_filters( 'job_manager_default_company_logo', JOB_MANAGER_PLUGIN_URL . '/assets/images/company.png' );
$salary_per_year  = get_post_meta( $post->ID, '_salary_max', true);
$location 		  = get_post_meta( $post->ID, '_job_location', true);
$country 	      = get_post_meta( $post->ID, '_country', true);
$application_email= get_post_meta( $post->ID, '_application', true);
$about_our_club   = get_post_meta( $post->ID, '_about_our_club', true);
$the_position     = get_post_meta( $post->ID, '_the_position', true);
$job_details      = get_post_meta( $post->ID, '_the_job_details', true);
$job_requirements = get_post_meta( $post->ID, '_job_requirements', true);
$job_start_date	  = get_post_meta( $post->ID, '_job_start_date', true);

if ( $deadline = get_post_meta( $post->ID, '_application_deadline', true ) ) {
	$expiring_days = apply_filters( 'job_manager_application_deadline_expiring_days', 2 );
	$expiring = ( floor( ( time() - strtotime( $deadline ) ) / ( 60 * 60 * 24 ) ) >= $expiring_days );
	$expired  = ( floor( ( time() - strtotime( $deadline ) ) / ( 60 * 60 * 24 ) ) >= 0 );
}


?>

<div id="titlebar" class="photo-bg single " style="background: url(<?php echo $header_image ?>)">
	<div class="container">
		<div class="sixteen columns"></div>
	</div>
</div>

<div class="container">
	<div class="company-logo">
		<img src="<?php echo $company_logo ?>" alt="Company Name">
	</div>
</div>

<div class="job-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="job-content__header">
					<div class="d-flex">
						<h2 class="job-content__company"><?php the_company_name();?></h2>
						<?php if ( !empty($deadline) ): ?>
							<span class="job-content__closing-date"><span class="job-content__closing-date-icon"><img src="<?php echo get_template_directory_uri() ?>-child/src/img/calendar.svg" alt="calendar icon" ></span> 
								<?php echo ( $expired ? __( 'Closed', 'workscout' ) : __( 'Closing Date', 'workscout' ) ) .': ' . date(' jS F Y', strtotime($deadline))  ?>
							</span>
						<?php endif; ?>
					</div>
					<div class="d-flex v-align-center">
						<h1 class="job-content__title"><?php wp_strip_all_tags( the_title() ); ?></h1>
						<span class="job-content__salary"><span class="job-content__salary-icon"><img src="<?php echo get_template_directory_uri() ?>-child/src/img/money.svg" alt="money icon" ></span>£<?php echo thousandsCurrencyFormat($salary_per_year) ?> <span class="job-content__note">Per Year</span></span>
					</div>
					<div class="d-flex">
						<p class="job-content__address"><span class="job-content__location-pin"><img src="<?php echo get_template_directory_uri() ?>-child/src/img/location.svg" alt="money icon" ></span><?php echo $location.', '.$country ?></p>
						<div class="job-content__social-share"></div>
					</div>
					<div class="d-flex">
						<?php applyJob($post); ?>
						<a href="#" class="site-btn bookmark-btn"><span class="site-btn__icon"><img src="<?php echo get_template_directory_uri() ?>-child/src/img/bookmark.svg" alt="bookmark icon" ></span>Add to bookmarks</a>
					</div>
					<div class="job-content__company-description">
						<?php the_content();?>
					</div>
				</div>
				<div class="job-content__summary">
					<h2 class="job-content__section-title">Job Role Summary</h2>
					<div class="job-content__table">
						<div class="job-content__table-row">
							<div class="job-content__table-label">
								Job Title
							</div>
							<div class="job-content__table-value">
								<?php the_title(); ?>
							</div>
						</div>
						<div class="job-content__table-row">
							<div class="job-content__table-label">
								Location
							</div>
							<div class="job-content__table-value">
								<?php echo $location.', '.$country ?>
							</div>
						</div>
						<div class="job-content__table-row">
							<div class="job-content__table-label">
								Function
							</div>
							<div class="job-content__table-value">
								Coaching & Performance — Academy
							</div>
						</div>
						<div class="job-content__table-row">
							<div class="job-content__table-label">
								Employment Terms
							</div>
							<div class="job-content__table-value">
								<?php echo strip_tags(ws_get_job_types($post)); ?>
							</div>
						</div>
						<?php if ( !empty($deadline) ): ?>
							<div class="job-content__table-row">
								<div class="job-content__table-label">
									Closing Date
								</div>
								<div class="job-content__table-value">
									Applications must be submitted by <?php echo date('l', strtotime($deadline)); ?>, <?php echo date(' jS F Y', strtotime($deadline)) ?> 
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="job-content__details">
					<h2 class="job-content__section-title">Job Role Details</h2>
					<?php if ( !empty($job_start_date) ): ?>
						<p class="job-content__start-date">Start Date: <?php echo date('F Y', strtotime($job_start_date) ) ?></p>
					<?php endif; ?>
					
					<?php if ( !empty($about_our_club) ): ?>
						<h3 class="job-content__sub-section-title"><span class="section-title-icon"><img src="<?php echo get_template_directory_uri() ?>-child/src/img/yellow-arrow.svg" alt="yellow arrow icon" ></span>About Our Club</i></h3>
						<?php $about = explode(PHP_EOL, $about_our_club); ?>
						<?php foreach ($about as $b): ?>
							<p><?php echo $b ?></p>
						<?php endforeach; ?>
					<?php endif; ?>
					
					<?php if ( !empty($the_position) ): ?>
						<h3 class="job-content__sub-section-title"><span class="section-title-icon"><img src="<?php echo get_template_directory_uri() ?>-child/src/img/yellow-arrow.svg" alt="yellow arrow icon" ></span>The Position</i></h3>
						<?php $position = explode(PHP_EOL, $the_position); ?>
						<?php foreach ($position as $p): ?>
							<p><?php echo $p ?></p>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if ( !empty($job_details) ): ?>
						<h3 class="job-content__sub-section-title"><span class="section-title-icon"><img src="<?php echo get_template_directory_uri() ?>-child/src/img/yellow-arrow.svg" alt="yellow arrow icon" ></span>The Job Details</i></h3>
						<p><strong>Role and Responsibilities</strong></p>
						<ul class="job-content__list">
						<?php $details = explode(PHP_EOL, $job_details); ?>
						<?php foreach ($details as $detail): ?>
							<li><?php echo $detail ?></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>


				</div>
				<div class="job-content__requirements">
					<?php if ( !empty($job_requirements) ): ?>
						<p><strong>Requirements</strong></p>
						<ul class="job-content__list">
							<?php $requirements = explode(PHP_EOL, $job_requirements); ?>
							<?php foreach ($requirements as $requirement): ?>
									<li><?php echo $requirement ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="special-note">
						<div class="special-note__icon">
							<img src="<?php echo get_template_directory_uri() ?>-child/src/img/question-mark.svg" alt="question mark icon" >
						</div>
						<div class="special-note__text">
							<p>Please provide a CV and tailored cover letter. If you have any questions about this role, please contact <?php echo $application_email ?>.</p>
						</div>
					</div>
				</div>
				<?php applyJob($post); ?>
			</div>
			<div class="col-sm-4">

				<?php get_template_part('template-parts/featured', 'job') ?>

				<div class="ad-box">
					<div class="ad-box__item">
						<a href="#">
							<img src="<?php echo get_template_directory_uri() ?>-child/src/img/ad-1.jpg" alt="ads" >
						</a>
					</div>
					<div class="ad-box__item">
						<a href="#">
							<img src="<?php echo get_template_directory_uri() ?>-child/src/img/ad-2.jpg" alt="ads" >
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>