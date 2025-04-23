<?php
/**
 * Main template file for Blog Page as Posts Page
 *
 * @package titrin
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	// Display cover image and title from the Blog page itself
	if ( is_home() && ! is_front_page() ) :
		$blog_page_id = get_option('page_for_posts');
		$cover_image = get_the_post_thumbnail_url($blog_page_id, 'full');
		$blog_title = get_the_title($blog_page_id);
		$blog_content = get_post_field('post_content', $blog_page_id);
		?>
		<section class="blog-cover">
			<?php if ( $cover_image ) : ?>
				<div class="cover-image" style="background-image: url('<?php echo esc_url($cover_image); ?>');">
					<div class="overlay">
						<h1 class="cover-title"><?php echo esc_html($blog_title); ?></h1>
					</div>
				</div>
			<?php endif; ?>
			<div class="cover-content">
				<?php echo apply_filters('the_content', $blog_content); ?>
			</div>
		</section>
	<?php endif; ?>

	<section class="blog-posts-grid">
		<?php if ( have_posts() ) : ?>
			<div class="posts-wrapper">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="post-card">
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-thumbnail">
									<?php the_post_thumbnail('medium'); ?>
								</div>
							<?php endif; ?>
							<div class="post-content">
								<h2 class="post-title"><?php the_title(); ?></h2>
								<p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
							</div>
						</a>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_navigation(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</section>

</main>

<?php
// get_sidebar();
get_footer();
?>