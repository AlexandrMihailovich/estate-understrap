<?php
/**
 * The template for displaying all single posts.
 *
 * @package estate_understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Запрос для вывода недвижимости в показаном городе
 */
$EstateQuery = new WP_Query([
	'post_type' => ESTATE,
	'meta_key' => 'city',
	'meta_value' => get_the_ID(),
	'posts_per_page' => 10
]);

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<ul class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content-cities', 'single' ); ?>

					<?php understrap_post_nav(); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>


					<?php /* вывод недвижимости для города */?>

					<?php if ( $EstateQuery->have_posts() ) : ?>
                        <h2 class="display-3 mt-5"><?php _e('In City', 'estate_understrap');?></h2>
                        <hr>
                <ul class="list-unstyled">
						<?php /* Start the Loop */ ?>

						<?php while ( $EstateQuery->have_posts() ) : $EstateQuery->the_post(); ?>

							<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'loop-templates/content-estate-media', get_post_format() );
							?>

						<?php endwhile; ?>
				</ul>
					<?php else : ?>

						<?php //get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
