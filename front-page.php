<?php
/**
 * The template for displaying the front page
 *
 * This is the template that displays the front page of the site.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package titrin
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	// Display the page content (Gutenberg blocks)
	while (have_posts()):
		the_post();
		?>

		<div class="front-page-content">
			<?php the_content(); ?>
		</div><!-- .front-page-content -->

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()):
			comments_template();
		endif;
	endwhile; // End of the loop.
	?>
	<!-- Swiper version for mobile -->
	<div class="swiper-container services-swiper">
		<div class="swiper-wrapper">
			<?php
						$args = array(
							'post_type' => 'service',
							'posts_per_page' => -1, // Show all services
						);
			$services_query_mobile = new WP_Query($args); // Reuse your query args
			
			if ($services_query_mobile->have_posts()):
				while ($services_query_mobile->have_posts()):
					$services_query_mobile->the_post(); ?>
					<div class="swiper-slide">
						<div class="service-card">
							<h3 class="service-title"><?php the_title(); ?></h3>
							<a href="<?php the_permalink(); ?>" class="service-link">Learn More <span class="arrow">→</span></a>
						</div>
					</div>
				<?php endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
		<!-- Swiper Pagination (optional) -->
		<div class="swiper-pagination"></div>
	</div>
	<!-- Our Services Section -->
	<div class="background-image"
		style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/tree-img.png');"></div>
	<section class="front-page-services">
		<div class="services-container">
			<h2 class="services-heading">Our Services</h2>
			<?php
			// Query the service CPT
			$args = array(
				'post_type' => 'service',
				'posts_per_page' => -1, // Show all services
			);
			$services_query = new WP_Query($args);

			if ($services_query->have_posts()): ?>
				<div class="services-cards">
					<?php while ($services_query->have_posts()):
						$services_query->the_post(); ?>
						<div class="service-card">
							<h3 class="service-title"><?php the_title(); ?></h3>
							<a href="<?php the_permalink(); ?>" class="service-link">Learn More <span class="arrow">→</span></a>
						</div><!-- .service-item -->
					<?php endwhile; ?>
				</div><!-- .services-grid -->

				<?php wp_reset_postdata(); ?>
			<?php else: ?>
				<p><?php esc_html_e('No services found.', 'titrin'); ?></p>
			<?php endif; ?>
		</div><!-- .services-container -->
	</section><!-- .front-page-services -->
	<!-- Contact Section -->
	<section class="front-page-contact">
		<div class="contact-container">
			<h2>Contact Us</h2>
			<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
				<label for="cf-name">Name</label>
				<input type="text" id="cf-name" name="cf-name" required>

				<label for="cf-email">Email</label>
				<input type="email" id="cf-email" name="cf-email" required>

				<label for="cf-message">Message</label>
				<textarea id="cf-message" name="cf-message" required></textarea>

				<input type="submit" name="cf-submitted" value="Send">
			</form>

			<?php
			// Show success or error message
			if (isset($_POST['cf-submitted'])) {
				echo '<p class="contact-message">Thank you for contacting us. We will be in touch soon.</p>';
			}
			?>
		</div>
	</section>
</main><!-- #main -->

<?php
get_footer();