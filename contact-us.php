<?php
/**
 * Template Name: Contact Us
 */
get_header();
?>
<section class="front-page-contact">
	<!-- Insert the content from the WordPress page editor -->
	<div class="page-content">
		<?php
			// This will display the content from the page editor
			while (have_posts()) : the_post();
				the_content();
			endwhile;
		?>
	</div>
	<div class="contact-bg-container">
		<h1>Have Questions?</h1>
		<p>Send us a message by filling out this form and we will be in contact with you.</p>
		<div class="contact-container">
			<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
				<label for="cf-name">Name</label>
				<input type="text" id="cf-name" name="cf-name" required>

				<label for="cf-email">Email</label>
				<input type="email" id="cf-email" name="cf-email" required>

				<label for="cf-phone">Phone</label>
				<input type="tel" id="cf-phone" name="cf-phone">

				<label for="cf-message">Project Proposal</label>
				<textarea id="cf-message" name="cf-message" required></textarea>

				<input type="submit" name="cf-submitted" value="Send">
			</form>

			<?php
			if (isset($_POST['cf-submitted'])) {
				$name = sanitize_text_field($_POST['cf-name']);
				$email = sanitize_email($_POST['cf-email']);
				$message = sanitize_textarea_field($_POST['cf-message']);
				$phone = sanitize_text_field($_POST['cf-phone']);

				$to = get_option('admin_email');
				$subject = 'New Contact Form Submission';
				$body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
				$headers = array('Content-Type: text/html; charset=UTF-8');

				if (wp_mail($to, $subject, $body, $headers)) {
					echo '<p class="contact-message">Thank you for contacting us. We will be in touch soon.</p>';
				} else {
					echo '<p class="contact-error">There was an error sending your message. Please try again later.</p>';
				}
			}
			?>
		</div>
		<section class="booking-section">
    <h2>Book a Consultation</h2>
    <?php echo do_shortcode('[ameliabooking service=1]'); ?>
</section>
	</div>
</section>
<?php get_footer(); ?>