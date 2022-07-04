<?php
$latest_news = new WP_Query( $args['params'] );
?>

<div class="latest-news">
  <?php if ( $latest_news->have_posts() ): ?>
    <?php while ( $latest_news->have_posts() ):  $latest_news->the_post(); ?>
      <?php
        $background_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
        $excerpt = strlen(get_the_content()) > 50 ? substr(get_the_content(), 0, 100)."..." : get_the_content();
        $date_created = date_create(get_the_date());
        $categories = get_the_category(get_the_ID());
       ?>
      <div class="row">
        <div class="featured-image" style="background: url(<?php echo !empty($background_url) ? $background_url : 'https://via.placeholder.com/754x350.png'; ?>) no-repeat center;height:230px">
          <p><?php echo date_format($date_created, 'M d, Y'); ?></p>
          <p><?php echo !empty($categories) ? esc_html( $categories[0]->name ) : ''; ?></p>
        </div>
        <h5><?php the_title() ?></h5>
        <p><?php echo $excerpt; ?></p>
        <a href="<?php echo get_permalink( get_the_ID() ) ?>">View More</a>
    <?php
    endwhile;
    wp_reset_postdata();
   ?>
  <?php endif; ?>
</div>
