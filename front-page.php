<?php
/**
 * The template for displaying the front page
 *
 * @package titrin
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php while (have_posts()): the_post(); ?>
		<div class="front-page-content">
			<?php the_content(); ?>
		</div>
		<?php
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
	endwhile;
	?>

	<!-- Static Services Section (Desktop) -->
	<section class="front-page-services">
		<div class="services-container">
			<h2 class="services-heading">Our Services</h2>
			<?php
			// Static Services Section (for desktop display)
			$args = array(
				'post_type' => 'service',
				'posts_per_page' => -1,
			);

			$services_query = new WP_Query($args);

			if ($services_query->have_posts()): ?>
				<div class="services-cards">
					<?php while ($services_query->have_posts()): $services_query->the_post(); ?>
						<div class="service-card">
							<h3 class="service-title"><?php the_title(); ?></h3>
							<a href="<?php the_permalink(); ?>" class="service-link">Learn More <span class="arrow">→</span></a>
						</div>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else: ?>
				<p><?php esc_html_e('No services found.', 'titrin'); ?></p>
			<?php endif; ?>
		</div>
			<!-- Swiper Slider for Services (Mobile Only) -->
			<div class="mobile-services-swiper">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php
						$services_query_mobile = new WP_Query(array(
							'post_type' => 'service',
							'posts_per_page' => -1,
						));
		
						if ($services_query_mobile->have_posts()) :
							while ($services_query_mobile->have_posts()): $services_query_mobile->the_post(); ?>
								<div class="swiper-slide">
									<div class="service-card">
										<h3 class="service-title"><?php the_title(); ?></h3>
										<a href="<?php the_permalink(); ?>" class="service-link">Learn More <span class="arrow">→</span></a>
									</div>
								</div>
							<?php endwhile;
							wp_reset_postdata();
						else :
							echo '<p>No services found.</p>';
						endif;
						?>
					</div> <!-- .swiper-wrapper -->
				</div>
				<div class="swiper-pagination"></div>
			</div>
	</section>


	<!-- Contact Section -->
	<section class="front-page-contact">
		<div class="contact-bg-container">
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

				<?php if (isset($_POST['cf-submitted'])): ?>
					<p class="contact-message">Thank you for contacting us. We will be in touch soon.</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();