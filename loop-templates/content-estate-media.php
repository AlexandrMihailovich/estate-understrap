<?php
/**
 * Карточка для вывода недвижимости на страницах городов и в архивах
 *
 * @package estate_understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$fields = get_field_objects();
?>


<li class="media my-4 border rounded">
    <div class="media-left media-middle">
        <?php echo get_the_post_thumbnail( $post->ID, 'estate_media_thumbnail', ['class' => 'mr-3 img-thumbnail mx-auto d-block'] ); ?>
    </div>
    <div class="media-body">

        <?php
        the_title(
            sprintf( '<h5 class="mt-2"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '</a></h5>'
        );
        ?>
        <ul class="list-unstyled">
            <li class="mt-1">
                <span class="text-muted"><?php echo $fields['price']['label']?></span>
                <span class="lead"><?php echo $fields['price']['value'];?></span>
                <?php echo $fields['price']['append'];?>
            </li>
            <li class="mt-1">
                <span class="text-muted"><?php echo $fields['address']['label']?></span>
                <span class="lead">
                    <a href="<?php echo get_post_permalink($fields['city']['value']);?>"><?php echo get_the_title($fields['city']['value']);?></a>
                    <?php echo $fields['address']['value'];?>
                </span>
            </li>
        </ul>
    </div>
</li>
