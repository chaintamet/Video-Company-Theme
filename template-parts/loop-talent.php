<?php
global $post;
$terms = get_the_terms( $post, 'talent_category' );
?>
<article class="loop-talent">
    <div class="loop-talent__wrapper">
        <div class="loop-talent__image"><?php echo the_post_thumbnail(); ?></div>
        <h3 class="loop-talent__title"><?php echo the_title(); ?></h3>
        <div class="loop-talent__bottom">
            <?php if ( $terms ) : 
                $ind = 0;
                ?>
            <h6 class="loop-talent__role p2">
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
            <div class="loop-talent__plus"></div>
        </div>
    </div>
    <div class="loop-talent__modal">
        <div class="loop-talent__modal__content">
            <div class="loop-talent__modal__image"><?php echo the_post_thumbnail(); ?></div>
            <div class="loop-talent__modal__data">
                <h3 class="loop-talent__modal__title"><?php echo the_title(); ?></h3>
                <div class="loop-talent__modal__bottom">
                    <?php if ( $terms ) : 
                        $ind = 0;
                        ?>
                    <h6 class="loop-talent__modal__role p2">
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
                    <div class="loop-talent__modal__plus"></div>
                </div>
                <div class="loop-talent__modal__description"><?php echo the_content(); ?></div>
            </div>
        </div>
    </div>
</article>