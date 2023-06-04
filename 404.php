<?php get_header(); ?>
<div class="template-404">
	<div class="container">
        <?php
        get_template_part_args(
            'template-parts/content-modules-image',
            array(
                'v'     => 'icon',
                'v2x'   => false,
                'is'    => false,
                'is_2x' => false,
                'o'     => 'o',
                'w'     => 'div',
                'wc'    => 'template-404__logo a-up',
            )
        );
        ?>
        <?php
        get_template_part_args(
            'template-parts/content-modules-text',
            array(
                'v'  => '404_title',
                't'  => 'h1',
                'o'  => 'o',
                'tc' => 'template-404__title a-up a-delay-1'
            )
        );
        ?>
        <div class="template-404__content">
            <?
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => '404_description',
                    't'  => 'h4',
                    'o'  => 'o',
                    'tc' => 'template-404__description a-up a-delay-1'
                )
            );
            get_template_part_args(
                'template-parts/content-modules-cta',
                array(
                    'v'  => '404_cta',
                    'o'  => 'o',
                    'c' => 'template-404__cta btn a-up a-delay-1'
                )
            );
            ?>
        </div>
        <?php
        get_template_part_args(
            'template-parts/content-modules-image',
            array(
                'v'     => '404_image',
                'v2x'   => false,
                'is'    => false,
                'is_2x' => false,
                'o'     => 'o',
                'w'     => 'div',
                'wc'    => 'template-404__image a-up a-delay-1',
            )
        );
        ?>
	</div>
</div>

<?php get_footer() ?>