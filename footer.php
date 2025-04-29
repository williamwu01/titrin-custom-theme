

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package titrin
 */

?>

<footer class="stack-footer" style="background: #1c6c2b; color: #fff; padding: 1rem 1rem;">
  <div class="footer-container" style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
    
    <!-- Logo on the left -->
    <div class="footer-logo" style="flex: 1;">
			<img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.jpg" alt="Footer Logo" style="max-height: 70px;">
    </div>
    
    <!-- Navigation on the right -->
    <nav class="footer-nav" style="flex: 2; text-align: right;">
      <a href="/" style="color: #fff; margin-left: 1.5rem; text-decoration: none;">Home</a>
      <a href="/blogs" style="color: #fff; margin-left: 1.5rem; text-decoration: none;">Blogs</a>
			<a href="/about-us" style="color: #fff; margin-left: 1.5rem; text-decoration: none;">About</a>
      <a href="/services" style="color: #fff; margin-left: 1.5rem; text-decoration: none;">Services</a>
      <a href="/contact-us" style="color: #fff; margin-left: 1.5rem; text-decoration: none;">Contact</a>
    </nav>
    
  </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
