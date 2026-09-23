<?php if (!defined('ABSPATH')) exit; ?>
<footer class="site-footer">
  <div class="container footer-inner">
    <div>
      <?php magna_theme_logo(); ?>
      <p class="footer-copy">Website design, development, maintenance and digital growth from a focused remote team.</p>
    </div>
    <div>
      <div class="footer-links"><a href="<?php echo esc_url(home_url('/#services')); ?>">Services</a><a href="<?php echo esc_url(home_url('/#process')); ?>">Process</a><a href="<?php echo esc_url(home_url('/#work')); ?>">Work</a></div>
      <p class="footer-copy">© <?php echo esc_html(date('Y')); ?> MAGNA Tech. All rights reserved.</p>
    </div>
  </div>
</footer>
<?php wp_footer(); ?></body></html>
