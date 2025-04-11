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
    while ( have_posts() ) :
        the_post();
        ?>

        <div class="front-page-content">
            <?php the_content(); ?>
        </div><!-- .front-page-content -->

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    endwhile; // End of the loop.
    ?>

    <!-- Our Services Section -->
    <section class="front-page-services">
        <div class="services-container">
            <h2 class="services-heading">Our Services</h2>
            <?php
            // Query the service CPT
            $args = array(
                'post_type'      => 'service',
                'posts_per_page' => -1, // Show all services
            );
            $services_query = new WP_Query( $args );

            if ( $services_query->have_posts() ) : ?>
                <div class="services-grid">
                    <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                        <div class="service-item">
                            <h3 class="service-title"><?php the_title(); ?></h3>
                            <a href="<?php the_permalink(); ?>" class="service-link">Learn More <span class="arrow">→</span></a>
                        </div><!-- .service-item -->
                    <?php endwhile; ?>
                </div><!-- .services-grid -->

                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php esc_html_e( 'No services found.', 'titrin' ); ?></p>
            <?php endif; ?>
        </div><!-- .services-container -->
    </section><!-- .front-page-services -->

</main><!-- #main -->

<?php
get_footer();