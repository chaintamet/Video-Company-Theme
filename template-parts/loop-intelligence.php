<?php
global $post;
$terms = get_the_terms( $post, 'intelligence_category' );
?>
<article class="loop-intelligence">
    <div class="intelligence-normal">
        <h4 class="intelligence-normal__title"><?php echo __( the_title() ); ?></h4>
        <div class="intelligence-normal__type">
            <?php if ( $terms ) : 
                $ind = 0;
                foreach ( $terms as $term ) :
                    $ind ++;
                ?>
                <h5 class="intelligence-normal__type__item p2"><?php echo __( $ind == count( $terms ) ? ($term->name) : ( $term->name . ', ' ) ); ?></h5>
            <?php endforeach;
            endif; ?>
        </div>
        <h5 class="intelligence-normal__date p2"><?php echo __( get_the_date( 'o' ) ); ?></h5>
    </div>
    <div class="intelligence-hover">
        <div class="intelligence-hover__image"><?php echo the_post_thumbnail(); ?></div>
        <div class="intelligence-hover__content">
            <div class="close">-</div>
            <h2 class="intelligence-hover__title h1"><?php echo __( the_title() ); ?></h2>
            <div class="intelligence-hover__data">
                <div class="intelligence-hover__left">
                    <div class="intelligence-hover__type">
                        <?php if ( $terms ) : 
                            $ind = 0;
                            foreach ( $terms as $term ) :
                                $ind ++;
                            ?>
                            <h5 class="intelligence-hover__type__item p2"><?php echo __( $ind == count( $terms ) ? ($term->name) : ( $term->name . ', ' ) ); ?></h5>
                        <?php endforeach;
                        endif; ?>
                    </div>
                    <h5 class="intelligence-hover__date p2"><?php echo __( get_the_date( 'o' ) ); ?></h5>
                </div>
                <div class="intelligence-hover__description"><?php echo __( the_content() ); ?></div>
            </div>
            <div class="intelligence-hover-download"><a href="/" download class="btn btn-white">download</a></div>
        </div>
    </div>
</article>