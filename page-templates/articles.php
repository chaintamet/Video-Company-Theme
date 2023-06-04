<?php
/**
 * Template Name: Articles Page
 */

get_header();

global $post;
$newsletter = get_field( 'newsletter' );
?>
<div class="template-articles">
    <section class="template-heading">
        <div class="container">
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'heading_title',
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
        </div>
    </section>
        
    <?php
        $style    = get_field( 'article_style' );
        $articles = get_field( 'articles' );
    ?>
    <!-- Spotlight Article Section -->
    <section class="spotlight-articles <?php echo 'style-' . $style; ?>">
        <div class="spotlight-articles__heading">
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'editor_title',
                    'o'  => 'f',
                    't'  => 'h2',
                    'tc' => 'spotlight-articles__title h1 a-up'
                )
            );
            ?>
        </div>
        <?php if ( $articles ) : 
            $ind = 0;
            ?>
        <div class="spotlight-articles__items">
            <?php foreach ( $articles as $post ) : 
                setup_postdata( $post );
                $ind    = $ind + 1;
                $terms = get_the_category( $post->ID );
                ?>
                <div class="spotlight-articles__item__title">
                    <h6 class="spotlight-articles__item__title__type p2"><?php echo esc_attr( $terms[0]->name ); ?></h6>
                    <h4 class="spotlight-articles__item__title__name">
                        <?php echo the_title(); ?>
                        <a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
                    </h4>
                </div>
                <div class="spotlight-articles__item__content <?php echo ($ind == 1 ? 'show' : ''); ?>">
                    <div class="spotlight-articles__item__content__img">
                        <h6 class="spotlight-articles__item__content__type p2"><?php echo esc_attr( $terms[0]->name ); ?></h6>
                        <?php echo the_post_thumbnail( 'article-image' )?>
                    </div>
                    <div class="spotlight-articles__item__content__description">
                        <h4 class="spotlight-articles__item__content__name"><?php echo the_title(); ?></h4>
                        <div class="spotlight-articles__item__content__content"><?php echo the_content(); ?></div>
                        <a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
                    </div>
                </div>
            <?php endforeach; 
                wp_reset_postdata();
            ?>
        </div>
        <?php endif; ?>
    </section>

    <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => '6'
        );
        $query = new WP_Query( $args );
    ?>
    <!-- Featured section -->
    <section class="featured-articles">
        <div class="container">
            <div class="featured-articles__heading">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'featured_title',
                        't'  => 'h2',
                        'o'  => 'f',
                        'tc' => 'featured-articles__title h1'
                    )
                );
                ?>
            </div>
            <?php if ( $query->have_posts() ) : ?>
            <div class="featured-articles__items">
                <?php while ( $query->have_posts() ) :
                    $query->the_post();
                    get_template_part( 'template-parts/loop', 'post' );
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
        $style = get_field( 'cta_style' );
    ?>
    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-main style-<?php echo $style; ?>">

            <div class="cta-icon"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cta-' . $style . '.svg'); ?>" alt=""></div>
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'cta_title',
                    't'  => 'h2',
                    'o'  => 'f',
                    'tc' => 'cta-title h1'
                )
            );
            ?>
            <div class="cta-arrow">></div>
            <?php
            get_template_part_args(
                'template-parts/content-modules-cta',
                array(
                    'v'  => 'cta',
                    'o'  => 'f',
                    'c'  => 'cta-cta h1',
                )
            );
            ?>
        </div>
        <?php
        get_template_part_args(
            'template-parts/content-modules-image',
            array(
                'v'     => 'cta_image',
                'v2x'   => false,
                'is'    => false,
                'is_2x' => false,
                'o'  => 'f',
                'w'     => 'div',
                'wc'    => 'cta-image',
            )
        );
        ?>
    </section>

    <?php
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 10
    );
    $cat_args = array(
        'taxonomy' => 'category'
    );
    $categories = get_categories( $cat_args );
    $query = new WP_Query( $args );
    ?>
    <section class="culture">
        <div class="container">
            <div class="culture-heading">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'culture_title',
                        't'  => 'h2',
                        'o'  => 'f',
                        'tc' => 'culture-heading__title h1'
                    )
                );
                ?>
                <div class="culture-heading__filters">
                    <div class="filter filter-category">
                        <div class="filter-btn button" data-value="all">Category +</div>
                        <?php if ( $categories ) : ?>
                        <div class="filter-dropdown">
                            <?php foreach ( $categories as $category ) : ?>
                            <p value="<?php echo __( $category->slug ); ?>" class="option"><?php echo __( $category->name ); ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="filter filter-sort">
                        <div class="filter-btn button button-dark" data-value="all">Sort by +</div>
                        <div class="filter-dropdown">
                            <p value="ASC" class="option">A-Z</p>
                            <p value="DESC" class="option">Z-A</p>
                            <p value="date" class="option">Date</p>
                            <p value="type" class="option">Type</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cpt-list"
                data-cat="" 
                data-post-type="post" 
                data-paged="" 
                data-posts-per-page="10">
                <?php while ( $query->have_posts() ) :
                    $query->the_post();
                    global $post;
                    $terms = get_the_category( $post->ID );
                ?>
                    <div class="cpt-list__item">
                        <h5 class="cpt-list__item__type p2"><?php echo $terms[0]->name; ?></h5>
                        <h4 class="cpt-list__item__title"><?php echo the_title(); ?></h4>
                        <a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
                    </div>
                <?php endwhile; 
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <?php
        $intelligences = get_field( 'intelligences' );
    ?>
    <section class="intelligence">
        <div class="container">
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'intelligence_title',
                    't'  => 'h5',
                    'o'  => 'f',
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

    <?php if ( $newsletter ) : 
  	    include get_template_directory() . '/template-parts/newsletter.php';
    endif; ?>
</div>
<?php
get_footer();
