<?php
global $post;

if ( have_rows( 'post_modules' ) ) : 
    while ( have_rows( 'post_modules' ) ) : 
        the_row();
?>
    <?php if ( 'text_module' == get_row_layout() ) : ?>
    <!-- Text Module Section -->
        <section class="text-module">
            <div class="container">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'title',
                        't'  => 'h5',
                        'tc' => 'text-module__title p3'
                    )
                );
                ?>
                <?php if ( have_rows( 'part' ) ) : ?>
                <div class="text-module__parts">
                    <?php while ( have_rows( 'part' ) ) : 
                        the_row();
                    ?>
                    <?php
                    get_template_part_args(
                        'template-parts/content-modules-text',
                        array(
                            'v'  => 'content',
                            'w'  => 'div',
                            'wc' => 'text-module__part a-up a-delay-1'
                        )
                    );
                    ?>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
    <?php elseif ( 'image_module' == get_row_layout() ) : ?>
        <!-- Section Image Module -->
        <section class="image-module">
            <div class="container">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-image',
                    array(
                        'v'     => 'image',
                        'v2x'   => false,
                        'is'    => false,
                        'is_2x' => false,
                        'w'     => 'div',
                        'wc'    => 'image-module__image a-up a-delay-1',
                    )
                );
                ?>
            </div>
        </section>
    <?php elseif ( 'two_image_module' == get_row_layout() ) : ?>
        <!-- Section Two Image Module -->
        <section class="two-image-module">
            <div class="container">
                <div class="two-image-module__image a-up a-delay-1">
                    <?php
                    get_template_part_args(
                        'template-parts/content-modules-image',
                        array(
                            'v'     => 'image_1',
                            'v2x'   => false,
                            'is'    => false,
                            'is_2x' => false,
                            'w'     => 'div',
                            'wc'    => 'two-image-module__image__img a-up a-delay-1',
                        )
                    );
                    ?>
                    <?php
                        get_template_part_args(
                            'template-parts/content-modules-text',
                            array(
                                'v'  => 'description_1',
                                't'  => 'h4',
                                'tc' => 'two-image-module__image__description a-up a-delay-1'
                            )
                        );
                    ?>
                </div>
                <div class="two-image-module__image a-up a-delay-1">
                    <?php
                    get_template_part_args(
                        'template-parts/content-modules-image',
                        array(
                            'v'     => 'image_2',
                            'v2x'   => false,
                            'is'    => false,
                            'is_2x' => false,
                            'w'     => 'div',
                            'wc'    => 'two-image-module__image__img a-up a-delay-1',
                        )
                    );
                    ?>
                    <?php
                        get_template_part_args(
                            'template-parts/content-modules-text',
                            array(
                                'v'  => 'description_2',
                                't'  => 'h4',
                                'tc' => 'two-image-module__image__description a-up a-delay-1'
                            )
                        );
                    ?>
                </div>
            </div>
        </section>
    <?php elseif ( 'title_only_module' == get_row_layout() ) : ?>
        <!-- Title Only Module Section -->
        <section class="title-only-module">
            <div class="container">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'title',
                        't'  => 'h2',
                        'tc' => 'title-only-module__title a-up a-delay-1'
                    )
                );
                ?>
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'author',
                        't'  => 'h4',
                        'tc' => 'title-only-module__author a-up a-delay-1'
                    )
                );
                ?>
            </div>
        </section>
    <?php elseif ( 'video_or_image_module' == get_row_layout() ) : 
        $is_image = get_sub_field( 'video_or_image' );
        $image    = get_sub_field( 'image' );
        $video    = get_sub_field( 'video' );
        ?>
        <!-- Video Or Image Module Section -->
        <section class="video-or-image-module">
            <div class="container">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'title',
                        't'  => 'h5',
                        'tc' => 'video-or-image-module__title p3 a-up a-delay-1'
                    )
                );
                ?>
                <div class="video-or-image-module__media__wrapper">
                    <?php
                    get_template_part(
                        'template-parts/content-modules',
                        'media',
                        array(
                            'image'  => $image,
                            'video'  => $video,
                            'class'  => 'video-or-image-module-media a-up a-delay-1'
                        )
                    );
                    ?>
                </div>
            </div>
        </section>
    <?php elseif ( 'long_quote_module' == get_row_layout() ) : ?>
        <!-- Long Quote Module -->
        <section class="long-quote-module">
            <div class="container">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'description',
                        'w'  => 'div',
                        'wc' => 'long-quote-module__description a-up a-delay-1'
                    )
                );
                ?>
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'author',
                        't'  => 'h4',
                        'tc' => 'long-quote-module__author a-up a-delay-1'
                    )
                );
                ?>
            </div>
        </section>
    <?php elseif ( 'text_image_module' == get_row_layout() ) : ?>
        <!-- Text and Image Module -->
        <section class="text-image-module">
            <div class="container">
                <div class="text-image-module__image">
                    <?php
                    get_template_part_args(
                        'template-parts/content-modules-image',
                        array(
                            'v'     => 'image',
                            'v2x'   => false,
                            'is'    => false,
                            'is_2x' => false,
                            'w'     => 'div',
                            'wc'    => 'text-image-module__image__img a-up a-delay-1',
                        )
                    );
                    ?>
                    <?php
                    get_template_part_args(
                        'template-parts/content-modules-text',
                        array(
                            'v'  => 'title',
                            't'  => 'h4',
                            'tc' => 'text-image-module__image__title a-up a-delay-1'
                        )
                    );
                    ?>
                </div>
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'text',
                        'w'  => 'div',
                        'wc' => 'text-image-module__text a-up a-delay-1'
                    )
                );
                ?>
            </div>
        </section>
    <?php elseif ( 'related_articles' == get_row_layout() ) : 
        $articles = get_sub_field( 'articles' );
        ?>
        <!-- Related Articles -->
        <section class="related-articles a-up a-delay-1">
            <div class="container">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'title',
                        't'  => 'h2',
                        'tc' => 'related-articles__title h1'
                    )
                );
                ?>
                <?php if ( $articles ) : ?>
                    <div class="related-articles__items">
                    <?php foreach ( $articles as $post ) : 
                        setup_postdata( $post );
                        get_template_part( 'template-parts/loop', 'post' );
                    endforeach; 
                    wp_reset_postdata();
                    ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php elseif ( 'intelligence' == get_row_layout() ) : 
        $intelligences = get_sub_field( 'intelligences' );
        ?>
        <section class="intelligence">
            <div class="container">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'title',
                        't'  => 'h5',
                        'tc' => 'intelligence-title p3'
                    )
                );
                ?>
                <?php if ( $intelligences ) : ?>
                <div class="intelligence-items">
                    <?php foreach ( $intelligences as $post ) : 
                        setup_postdata( $post );
                        get_template_part( 'template-parts/loop', 'intelligence' );
                        endforeach;
                        wp_reset_postdata();
                    ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endwhile; 
endif;
