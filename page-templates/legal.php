<?php
/**
 * Template Name: Legal Page
 */

get_header();

?>

<div class="template-legal">
    <section class="template-heading">
        <div class="container">
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'title',
                    't'  => 'h1',
                    'o'  => 'f',
                    'tc' => 'template-headding__title a-up'
                )
            );
            ?>
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'description',
                    't'  => 'p',
                    'o'  => 'f',
                    'tc' => 'template-headding__description a-up a-delay-1'
                )
            );
            ?>
        </div>
    </section>
    <?php if ( $items = get_field( 'items' ) ) : 
        $ind1 = 0;
        $ind2 = 0;
        ?>
    <section class="legal-content">
        <div class="container">
            <div class="legal-content__accordion">
                <div class="legal-content__accordion__left">
                    <?php foreach ( $items as $item ) : 
                        $ind1 ++;
                        ?>
                    <h4 class="legal-content__accordion__left__title p3 <?php echo ($ind1 == 1) ? 'active' : ''; ?>" title-ind="<?php echo $ind1; ?>"><?php echo __( $item['title'] ); ?></h4>
                    <?php endforeach; ?>
                </div>
                        
                <div class="legal-content__accordion__right">
                    <?php foreach ( $items as $item ) : 
                        $ind2 ++;
                        ?>
                    <h4 class="legal-content__accordion__title p3 <?php echo (($ind2 == 1) ? 'active ' : '') . 'title_' . $ind2; ?>"><?php echo __( $item['title'] ); ?></h4>
                    <div class="legal-content__accordion__content <?php echo (($ind2 == 1) ? 'active ' : '') . 'content_' . $ind2; ?> a-down a-delay-1"><?php echo __( $item['content'] ); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>

<?php
get_footer();
