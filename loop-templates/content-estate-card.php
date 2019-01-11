<?php
/**
 * Карточка для недвижимости на главной страници
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
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <span class="text-muted"><?php _e('City', 'estate_understrap')?></span>
            <a href="<?php echo get_post_permalink($fields['city']['value']);?>"><?php echo get_the_title($fields['city']['value']);?></a>
        </li>
        <li class="list-group-item">
            <span class="text-muted"><?php _e('Type', 'estate_understrap')?></span>
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
</div>
