<?php
global $post;
?>
<article class="loop-project">
    <div class="loop-project__content">
        <h6 class="loop-project__title p3"><?php echo the_title(); ?></h6>
        <div class="loop-project__description"><?php echo the_excerpt(); ?></div>
        <a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">view more</a>
    </div>
    <div class="loop-project__image"><?php echo the_post_thumbnail(); ?></div>
</article>