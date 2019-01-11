<?php
/**
 * Страница просмотра оъекта недвижимости
 *
 * @package estate_understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$fields = get_field_objects();
//echo '<pre>';
//var_dump($fields);
//echo '</pre>';
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header">

        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <div class="entry-meta">
            <?php understrap_posted_on(); ?>

        </div><!-- .entry-meta -->

    </header><!-- .entry-header -->
    <ul class="list-group">
        <li class="list-group-item">
            <?php echo get_the_post_thumbnail( $post->ID, 'large', ['class' => 'img-fluid rounded mx-auto d-block'] ); ?>
        </li>
        <li class="list-group-item">
            <span class="text-muted"><?php _e('City', 'estate_understrap')?></span>
            <a href="<?php echo get_post_permalink($fields['city']['value']);?>"><?php echo get_the_title($fields['city']['value']);?></a>
        </li>
        <li class="list-group-item">
            <span class="text-muted"><?php echo _e('Type', 'estate_understrap')?></span>
            <?php echo get_the_term_list( get_the_ID(), ESTATE_TYPE, '', ',', '' );?>
        </li>
        <?php foreach ($fields as $value) : if (!empty($value['value']) && ($value['type'] == 'text' || $value['type'] == 'number')) :?>
            <li class="list-group-item">
                <span class="text-muted"><?php echo $value['label']?></span>
                <span class="lead"><?php echo $value['value'];?></span>
                <?php echo $value['append'];?>
            </li>
        <?php endif; endforeach; // end of the loop. ?>
    </ul>
    <div class="entry-content mt-3">



        <?php the_content(); ?>

        <?php
        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
                'after'  => '</div>',
            )
        );
        ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">

        <?php understrap_entry_footer(); ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
