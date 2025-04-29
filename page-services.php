<?php
/**
 * Template Name: Services Page
 *
 * @package Titrin
 */

get_header(); ?>

<div class="services-page">
    <!-- <section class="services-hero">
        <div class="hero-content">
            <h1 class="hero-title"><?php the_title(); ?></h1>
            <p class="hero-description">Discover our range of services to support sustainable agriculture and land management at Titrin AgriSoil Solutions.</p>
        </div>
    </section>.services-hero -->

    <div class="services-intro">
        <?php
        // Display the page content (if any) entered in the WordPress editor
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div><!-- .services-intro -->

    <div class="services-list">
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'service',
            'posts_per_page' => 6,
            'paged'          => $paged,
        );
        $services_query = new WP_Query( $args );

        if ( $services_query->have_posts() ) : ?>
            <div class="services-grid">
                <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'service-item' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="service-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <h2 class="service-title">
                            <?php the_title(); ?>
                        </h2>

                        <div class="service-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="service-link">Learn More</a>
                    </article><!-- #post-<?php the_ID(); ?> -->
                <?php endwhile; ?>
            </div><!-- .services-grid -->

            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'Previous', 'titrin' ),
                'next_text' => __( 'Next', 'titrin' ),
            ) );
            ?>

            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'No services found.', 'titrin' ); ?></p>
        <?php endif; ?>
    </div><!-- .services-list -->
</div><!-- .services-page -->

<?php get_footer(); ?>