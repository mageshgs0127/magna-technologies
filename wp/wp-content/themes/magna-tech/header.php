<?php if (!defined('ABSPATH')) exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <div class="container nav">
    <?php magna_theme_logo(); ?>
    <nav class="nav-links" aria-label="Main navigation">
      <a href="<?php echo esc_url(home_url('/#services')); ?>">Services</a>
      <a href="<?php echo esc_url(home_url('/#why')); ?>">Why MAGNA</a>
      <a href="<?php echo esc_url(home_url('/#process')); ?>">Process</a>
      <a href="<?php echo esc_url(home_url('/#work')); ?>">Our Work</a>
      <a href="<?php echo esc_url(home_url('/#marketing')); ?>">Marketing</a>
      <a href="<?php echo esc_url(home_url('/#testimonials')); ?>">Testimonials</a>
    </nav>
    <a class="btn btn-glass" href="<?php echo esc_url(home_url('/#contact')); ?>">Start a Project</a>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-label="Open menu">☰</button>
  </div>
  <nav class="mobile-nav" aria-label="Mobile navigation">
    <a href="<?php echo esc_url(home_url('/#services')); ?>">Services</a>
    <a href="<?php echo esc_url(home_url('/#why')); ?>">Why MAGNA</a>
    <a href="<?php echo esc_url(home_url('/#process')); ?>">Process</a>
    <a href="<?php echo esc_url(home_url('/#work')); ?>">Our Work</a>
    <a href="<?php echo esc_url(home_url('/#marketing')); ?>">Marketing</a>
    <a href="<?php echo esc_url(home_url('/#testimonials')); ?>">Testimonials</a>
    <a href="<?php echo esc_url(home_url('/#contact')); ?>">Start a Project</a>
  </nav>
</header>
