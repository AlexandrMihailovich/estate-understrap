<?php
/**
 * Главная страница
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package estate_understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// для формы добавления недвижимости
acf_form_head();

get_header();

$container = get_theme_mod( 'understrap_container_type' );

//запрос 12 последних объектов недвижимости
$EstateQuery = new WP_Query([
    'post_type' => ESTATE,
    'posts_per_page' => 12
]);
//запрос последних 12 городов
$CityQuery = new WP_Query([
    'post_type' => CITIES,
    'posts_per_page' => 12
]);
?>

<?php if ( is_front_page() && is_home() ) : ?>
    <?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check and opens the primary div -->
            <?php //get_template_part( 'global-templates/left-sidebar-check' ); ?>

            <main class="site-main" id="main">
                <section>
                <h2 class="display-3 mt-5"><?php _e('Estate', 'estate_understrap');?></h2>
                <hr>
                <div class="card-columns">

                    <?php if ( $EstateQuery->have_posts() ) : ?>

                        <?php /* Start the Loop */ ?>

                        <?php while ( $EstateQuery->have_posts() ) : $EstateQuery->the_post(); ?>

                            <?php

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'loop-templates/content-estate-card', get_post_format() );
                            ?>

                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                    <?php endif; ?>
                </div>
                </section>

                <section>
                <h2 class="display-3 mt-4"><?php _e('Cities', 'estate_understrap')?></h2>
                <hr>

                <div class="card-columns">

                    <?php if ( $CityQuery->have_posts() ) : ?>

                        <?php /* Start the Loop */ ?>

                        <?php while ( $CityQuery->have_posts() ) : $CityQuery->the_post(); ?>

                            <?php

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'loop-templates/content-cities-card', get_post_format() );
                            ?>

                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                    <?php endif; ?>
                </div>
                </section>
            </main><!-- #main -->

            <!-- The pagination component -->
            <?php understrap_pagination();
            ?>

            <!-- Do the right sidebar check -->
            <?php //get_template_part( 'global-templates/right-sidebar-check' ); ?>

        </div><!-- .row -->

        <?php if(is_user_logged_in()) :?>
        <h2 class="display-3 mt-5"><?php _e('Add Estate', 'estate_understrap');?></h2>
        <hr>
        <div class="jumbotron">
            <div class="container">
                <div class="form-group"><?php the_acf_form();?></div>
            </div>
        </div>
        <?php endif;?>
    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer(); ?>
