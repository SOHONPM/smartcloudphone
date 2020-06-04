<?php

/**
 * Footer Template
 *
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since   1.0.0
 * @package themezero
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
} ?>

<footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">

  <div class="container">
    <div class="row">
      <div class="col-md-6">

        <div class="row">
          <div class="col-md-6">
            <!-- Site-logo -->
            <!-- <div class="site-logo">
                          <a href="<?php echo site_url() ?>"><?php themezero_get_logo() ?></a>
                        </div> -->
            <!-- ./Site-logo -->
            <!-- Footer About -->
            <?php if (is_active_sidebar('footer-about')) : ?>
              <div class="widget-area widget-about">
                <?php dynamic_sidebar('footer-about')  ?>
              </div>
            <?php endif; ?>
            <!-- ./Footer About -->
          </div>
          <div class="col-md-5 offset-md-1">
            <!-- Footer Main Menu -->
            <?php if (is_active_sidebar('footer-menu')) : ?>
              <div class="widget-area widget-menu">
                <div class="footer-navigation">
                  <?php dynamic_sidebar('footer-menu')  ?>
                </div>
              </div>
            <?php endif; ?>
            <!-- ./Footer Main Menu -->
          </div>
        </div>

      </div>
      <div class="col-md-6">

        <div class="row">
          <div class="col-md-5 offset-md-1">
            <!-- Widget Area -->
            <?php if (is_active_sidebar('footer-contact-1')) : ?>
              <div class="widget-area">
                <?php dynamic_sidebar('footer-contact-1')  ?>
              </div>
            <?php endif; ?>
            <!-- ./Widget Area -->
          </div>
          <div class="col-md-5 offset-md-1">
            <!-- Widget Area -->
            <?php if (is_active_sidebar('footer-contact-2')) : ?>
              <div class="widget-area">
                <?php dynamic_sidebar('footer-contact-2')  ?>
              </div>
            <?php endif; ?>
            <!-- ./Widget Area -->
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="site-footer__bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- Copyright -->
          <div class="copyright">
            <?php
            $copyright = get_theme_mod('copyright');

            if ($copyright) : ?>
              <?php echo $copyright; ?>
            <?php endif; ?>
          </div>
          <!-- Copyright -->
        </div>
        <!-- <div class="col-md-6">
          <?php

          // wp_nav_menu(array(
          //   'menu'            => 'Legal Menu', // Do not fall back to first non-empty menu.
          //   'depth'           => 1,
          //   'theme_location'  => 'Legal',
          //   'menu_class'      => 'footer-nav-extra',
          //   'container'       => false,
          //   'container_class' => false,
          //   'container_id'    => false,
          // ));

          ?>
        </div> -->
      </div>
    </div>
  </div>
</footer><!-- .site-footer -->

<?php

wp_footer(); ?>

</body>

</html>