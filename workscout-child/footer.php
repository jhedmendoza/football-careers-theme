<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WorkScout
 */

?>
<?php if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('footer')) { ?>
    <!-- Footer
================================================== -->
    <div class="margin-top-45"></div>

    <!-- Footer
================================================== -->
    <div id="footer-new">


        <!-- Footer Middle Section -->
        <div class="footer-new-middle-section">
            <div class="container">
                <div class="footer-row">
                    <?php
                    $footer_layout = Kirki::get_option('workscout', 'pp_new_footer_widgets');

                    $footer_layout_array = explode(',', $footer_layout);
                    $x = 0;
                    foreach ($footer_layout_array as $value) {
                        $x++;
                    ?>
                        <div class="footer-col-<?php echo esc_attr($value); ?> footer-col-s-3 footer-col-xs-6">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer' . $x)) : endif; ?>
                        </div>
                    <?php } ?>
                    <div class="footer-col-4 footer-col-s-3 footer-col-xs-6">
                        <?php /* get the slider array */
                            $footericons = Kirki::get_option('workscout', 'pp_footericons', array());
                            if (!empty($footericons)) {

                                echo '<ul class="new-footer-social-icons">';
                                foreach ($footericons as $icon) {
                                    echo '<li><a target="_blank" title="' . esc_attr($icon['icons_service']) . '" href="' . esc_url($icon['icons_url']) . '"><i class="icon-' . $icon['icons_service'] . '"></i></a></li>';
                                }
                                echo '</ul>';
                            }
                        ?>  
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Footer Middle Section / End -->


        <!-- Footer Copyrights -->
        <div class="footer-new-bottom-section">
            <div class="container">
                <div class="row">
                    <div class="sixteen columns">
                        <div class="footer-new-bottom-inner">
                            <p class="copyright-text">Copyright © 2022 Football Careers. All rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Copyrights / End -->

        </div>
        <!-- Footer / End -->


        <div id="ajax_response"></div>
    </div>
    <!-- Wrapper / End -->
<?php } ?>
<?php if ((is_page_template('template-home.php') || is_page_template('template-home-box.php')) &&  Kirki::get_option('workscout', 'pp_jobs_home_typed_status') == 'enable') {
    $typed =  Kirki::get_option('workscout', 'pp_jobs_home_typed_text');
    if (empty($typed)) {
        $typed = 'healthcare, automotive, sales & marketing, accounting & finance';
    }
    $typed_array = explode(',', $typed);
?>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
    <script>
        var typed = new Typed('.typed-words', {
            strings: <?php echo json_encode($typed_array); ?>,
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
        });
    </script>
<?php } ?>

<?php if (is_page_template('template-home-resumes.php') && Kirki::get_option('workscout', 'pp_resume_home_typed_status') == 'enable') {
    $typed =  Kirki::get_option('workscout', 'pp_resume_home_typed_text');
    if (empty($typed)) {
        $typed = 'healthcare, automotive, sales & marketing, accounting & finance';
    }
    $typed_array = explode(',', $typed);
?>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
    <script>
        var typed = new Typed('.typed-words', {
            strings: <?php echo json_encode($typed_array); ?>,
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
        });
    </script>
<?php } ?>

<?php wp_footer(); ?>

</body>

</html>