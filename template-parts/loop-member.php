<?php
global $post;
$terms = get_the_terms( $post, 'member_category' );
?>
<article class="loop-member">
    <div class="loop-member__wrapper">
        <div class="loop-member__image"><?php echo the_post_thumbnail(); ?></div>
        <h3 class="loop-member__title"><?php echo the_title(); ?></h3>
        <div class="loop-member__bottom">
            <?php if ( $terms ) : 
                $ind = 0;
                ?>
            <h6 class="loop-member__role p2">
                <?php foreach ( $terms as $term ) {
                    $ind ++;
                    if ( $ind == count( $terms ) )
                        echo $term->name;
                    elseif ( $ind == count( $terms ) - 1 )
                        echo $term->name . ' and ';
                    else echo $term->name . ', ';
                }
                ?>
            </h6>
            <?php endif; ?>
            <div class="loop-member__plus"></div>
        </div>
        <div class="loop-member__content">
            <?php echo the_content(); ?>
        </div>
    </div>
</article>