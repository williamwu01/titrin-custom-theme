

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

<footer class="stack-footer">
  <div class="footer-container">
    
    <!-- Logo on the left -->
    <div class="footer-logo">
			<img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.jpg" alt="Footer Logo">
    </div>
    
    <!-- Navigation on the right -->
    <nav class="footer-nav">
      <a href="/" class="footer-link">Home</a>
      <a href="/blogs" class="footer-link">Blogs</a>
			<a href="/about-us" class="footer-link">About</a>
      <a href="/services" class="footer-link">Services</a>
      <a href="/contact-us" class="footer-link">Contact</a>
    </nav>
    
  </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
