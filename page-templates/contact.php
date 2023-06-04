<?php
/**
 * Template Name: Contact Us
 */

get_header();
$contact_form = get_field( 'contact_form' );
?>

<div class="template-contact">
    <div class="template-contact__content">
        <div class="container">
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'title',
                    't'  => 'h1',
                    'o'  => 'f',
                    'tc' => 'template-contact__title'
                )
            );
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'description',
                    't'  => 'p',
                    'o'  => 'f',
                    'tc' => 'template-contact__description'
                )
            );
            ?>
            <div class="template-contact__form">
                <?php echo do_shortcode( __( $contact_form ) ); ?>
            </div>
        </div>
    </div>
    <?php
    get_template_part_args(
        'template-parts/content-modules-image',
        array(
            'v'     => 'image',
            'v2x'   => false,
            'is'    => false,
            'is_2x' => false,
            'o'     => 'f',
            'w'     => 'div',
            'wc'    => 'template-contact__image',
        )
    );
    ?>
</div>

<?php
get_footer();
