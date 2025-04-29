<?php
/**
 * The template for displaying single Service posts.
 *
 * @package Titrin
 */

get_header(); ?>

<div class="single-service">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">


                <?php the_content(); ?>

                <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'titrin' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php
                // Display custom fields if they exist
                if ( get_post_meta( get_the_ID(), 'service_price', true ) ) {
                    echo '<p><strong>Price:</strong> ' . esc_html( get_post_meta( get_the_ID(), 'service_price', true ) ) . '</p>';
                }
                ?>
            </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        // If comments are open or we have at least one comment, load the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>
    <?php endwhile; ?>
</div><!-- .single-service -->

<?php get_footer(); ?>