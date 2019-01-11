<?php
/**
 * Карточка для городов на главной страници
 *
 * @package estate_understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$fields = get_field_objects();
?>
<div class="card" id="post-<?php the_ID(); ?>">
    <?php echo get_the_post_thumbnail( $post->ID, 'estate_thumbnail', ['class' => 'card-img-top'] ); ?>
    <div class="card-body">
        <?php
        the_title(
            sprintf( '<h5 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '</a></h5>'
        );
        ?>
    </div>
    <div class="card-body">
        <p class="card-text"><?php the_excerpt(); ?></p>
    </div>
</div>
