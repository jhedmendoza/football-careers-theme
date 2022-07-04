<div class="wrapper">
  <div class="latest-news">
    <?php if (count($args['latest_news']) > 0): ?>
      <?php foreach ($args['latest_news'] as $post): ?>
        <?php
          $background_url = wp_get_attachment_url( get_post_thumbnail_id($post['ID']), 'thumbnail' );
          $excerpt = strlen($post['post_content']) > 50 ? substr($post['post_content'], 0, 100)."..." : $post['post_content'];
          $date_created = date_create($post['post_date']);
         ?>
        <div class="row">
          <div class="featured-image" style="background: url(<?php echo !empty($background_url) ? $background_url : 'https://via.placeholder.com/754x350.png'; ?>) no-repeat center;height:230px">
            <p><?php echo date_format($date_created, 'M d, Y'); ?></p>
          </div>
          <h5><?php echo $post['post_title'] ?></h5>
          <p><?php echo $excerpt ?></p>
          <a href="<?php echo get_permalink($post['ID']) ?>">View More</a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</div>
