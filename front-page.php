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
			<div class="front-page-badges">
				<div class="front-page-badge">
					<img src="<?php echo get_template_directory_uri(); ?>/images/badge-icon.png" alt="badge">
					<p class="badge-text">Expertise in ALR & Soil Regulations</p>
				</div>
				<div class="front-page-badge">
					<img src="<?php echo get_template_directory_uri(); ?>/images/badge-icon.png" alt="badge">
					<p class="badge-text">Hands-on Experience with Municipal & Provincial Processes</p>
				</div>
				<div class="front-page-badge">
					<img src="<?php echo get_template_directory_uri(); ?>/images/badge-icon.png" alt="badge">
					<p class="badge-text">Efficient, Field-Tested Problem Solving</p>
				</div>
			</div>
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

					<label for="cf-phone">Phone</label>
					<input type="tel" id="cf-phone" name="cf-phone">
					<!-- Optional field for phone number -->

					<label for="cf-message">Project Proposal</label>
					<textarea id="cf-message" name="cf-message" required></textarea>

					<input type="submit" name="cf-submitted" value="Send">
				</form>

				<?php if (isset($_POST['cf-submitted'])){

					$name = sanitize_text_field($_POST['cf-name']);
					$email = sanitize_email($_POST['cf-email']);
					$message = sanitize_textarea_field($_POST['cf-message']);
					$phone = sanitize_text_field($_POST['cf-phone']);

					$to = get_option('admin_email');
					$subject = 'New Contact Form Submission';
					$body    = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
					$headers = array('Content-Type: text/html; charset=UTF-8');

					if (wp_mail($to, $subject, $body, $headers)) {
						echo '<p class="contact-message">Thank you for contacting us. We will be in touch soon.</p>';
					} else {
						echo '<p class="contact-error">There was an error sending your message. Please try again later.</p>';
					}
				} 			
				?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();