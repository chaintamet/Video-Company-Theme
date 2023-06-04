<?php 
global $post;
$terms = get_the_category( $post->ID );
?>
<article class="loop-article">
    <a href="<?php echo esc_url( the_permalink() ); ?>">
        <h6 class="loop-article__type p2"><?php echo esc_attr( $terms ? $terms[0]->name : ''); ?></h6>
        <div class="loop-article__img">
            <?php echo the_post_thumbnail( ); ?>
        </div>
        <h3 class="loop-article__title"><?php echo the_title(); ?></h3>
        <span class="btn">read article</span>
    </a>
</article>