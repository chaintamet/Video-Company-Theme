<?php
/**
 * Template Name: FAQ Page
 */

get_header();

$items = get_field( 'items' );
?>

<div class="template-faq">
    <div class="container">
        <section class="template-heading">
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'title',
                    't'  => 'h1',
                    'o'  => 'f',
                    'tc' => 'template-headding__title'
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
                    'tc' => 'template-headding__description'
                )
            );
            ?>
        </section>

        <?php if ( $items ) : ?>
        <section class="template-faq__content">
            <div class="faq-left">
                <div class="faq-titles">
                    <?php $ind = 0; ?>
                    <?php foreach ( $items as $item ) : 
                        $ind ++; ?>
                    <h5 class="faq-title p2 <?php echo ( $ind == 1 ? 'active' : ''); ?>" tab-index="<?php echo __( $ind ); ?>"><?php echo __( $item['title'] ); ?></h5>
                    <?php endforeach; 
                    $ind = 0;
                    ?>
                </div>
            </div>
            <div class="faq-tab">
                <?php foreach ( $items as $item ) : 
                    $questions = $item['questions'];
                    $ind ++; ?>
                    <h2 class="faq-tab__title h1 <?php echo ( $ind == 1 ? 'active' : '' ); ?> <?php echo ( 'title_' . $ind ); ?>"><?php echo __( $item['title'] ); ?></h2>
                    <?php if ( $questions ) : ?>
                    <div class="faq-tab__accordion <?php echo ( $ind == 1 ? 'active' : '' ); ?> <?php echo ( 'content_' . $ind ); ?>">
                        <?php foreach ( $questions as $question ) : ?>
                        <h5 class="faq-tab__accordion__title p3"><?php echo __( $question['title'] ); ?></h5>
                        <div class="faq-tab__accordion__content">
                            <div class="faq-tab__accordion__wrapper">
                                <div class="faq-tab__accordion__description"><?php echo __( $question['description'] ); ?></div>
                                <div class="faq-tab__accordion__image">
                                    <img src="<?php echo esc_url( $question['image']['url'] ); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
    </div>

</div>

<?php
get_footer();
