<?php
/**
 * Template Name: Index Page
 */

get_header();

global $post;

$cat_args = array(
    'taxonomy' => 'project_category'
);
$project_categories = get_terms( $cat_args );

$cat_args = array(
    'taxonomy' => 'intelligence_category'
);
$intelligence_categories = get_terms( $cat_args );

$cat_args = array(
    'taxonomy' => 'category'
);
$article_categories = get_categories( $cat_args );

$categories = array_merge( $project_categories , $intelligence_categories , $article_categories );

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
);
$args_2 = array(
    'post_type' => 'project',
    'posts_per_page' => 10,
);
$args_3 = array(
    'post_type' => 'intelligence',
    'posts_per_page' => 10,
);
$query = new WP_Query( $args );
$query_2 = new WP_Query( $args_2 );
$query_3 = new WP_Query( $args_3 );
?>

<div class="template-index">
    <div class="index-heading">
        <div class="container">
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'title',
                    'tc' => 'index-heading__title h2',
                    'o'  => 'f',
                    't'  => 'h1'
                )
            );
            ?>
            <div class="index-heading__filters">
                <div class="filter filter-type">
                    <div class="filter-btn button" data-value="post">Type +</div>
                    <div class="filter-dropdown">
                        <p value="post" class="option">Articles</p>
                        <p value="project" class="option">Projects</p>
                        <p value="intelligence" class="option">Intelligences</p>
                    </div>
                </div>
                <div class="filter filter-category">
                    <div class="filter-btn button" data-value="all">Category +</div>
                    <?php if ( $categories ) : ?>
                    <div class="filter-dropdown">
                        <?php foreach ( $categories as $category ) : ?>
                        <p class="option" value="<?php echo __( $category->slug ); ?>"><?php echo __( $category->name ); ?></p> 
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
    </div>
    <div class="container">
        <?php if ( $query->have_posts() ) : ?>
        <div class="cpt-block cpt-articles">
            <div class="cpt-heading">
                <h2 class="cpt-heading__title h1">articles</h2>
                <div class="cpt-heading__view_all button">view all</div>
            </div>
            <div class="cpt-list"
                data-cat="" 
                data-post-type="post" 
                data-paged="" 
                data-posts-per-page="10">
                <?php while ( $query->have_posts() ) :
                    $query->the_post();
                    global $post;
                    $type = get_post_type();
                    $terms = $type == 'post' ? get_the_category( $post->ID ) : get_the_terms( $post, $type . '_category' );
                ?>
                    <div class="cpt-list__item">
                        <?php if ( $terms ) : ?>
                        <div class="cpt-list__item__type">
                            <?php foreach ( $terms as $term ) : ?>
                            <h5 class="cpt-list__item__type__name p2"><?php echo $term->name; ?></h5>
                            <?php endforeach; ?>
                        </div>
                        <?php else : ?>
                            <h5 class="cpt-list__item__type p2"><?php echo 'any'; ?></h5>
                        <?php endif; ?>
                        <h4 class="cpt-list__item__title"><?php echo the_title(); ?></h4>
                        <a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
                    </div>
                <?php endwhile; 
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if ( $query_2->have_posts() ) : ?>
        <div class="cpt-block cpt-projects">
            <div class="cpt-heading">
                <h2 class="cpt-heading__title h1">projects</h2>
                <div class="cpt-heading__view_all button">view all</div>
            </div>
            <div class="cpt-list_2"
                data-cat="" 
                data-post-type="post" 
                data-paged="" 
                data-posts-per-page="10">
                <?php while ( $query_2->have_posts() ) :
                    $query_2->the_post();
                    global $post;
                    $type = get_post_type();
                    $terms = $type == 'post' ? get_the_category( $post->ID ) : get_the_terms( $post, $type . '_category' );
                ?>
                    <div class="cpt-list__item">
                        <?php if ( $terms ) : ?>
                        <div class="cpt-list__item__type">
                            <?php foreach ( $terms as $term ) : ?>
                            <h5 class="cpt-list__item__type__name p2"><?php echo $term->name; ?></h5>
                            <?php endforeach; ?>
                        </div>
                        <?php else : ?>
                            <h5 class="cpt-list__item__type p2"><?php echo 'any'; ?></h5>
                        <?php endif; ?>
                        <h4 class="cpt-list__item__title"><?php echo the_title(); ?></h4>
                        <a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
                    </div>
                <?php endwhile; 
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if ( $query_3->have_posts() ) : ?>
        <div class="cpt-block cpt-intelligences">
            <div class="cpt-heading">
                <h2 class="cpt-heading__title h1">intelligences</h2>
                <div class="cpt-heading__view_all button">view all</div>
            </div>
            <div class="cpt-list_3"
                data-cat="" 
                data-post-type="post" 
                data-paged="" 
                data-posts-per-page="10">
                <?php while ( $query_3->have_posts() ) :
                    $query_3->the_post();
                    global $post;
                    $type = get_post_type();
                    $terms = $type == 'post' ? get_the_category( $post->ID ) : get_the_terms( $post, $type . '_category' );
                ?>
                    <div class="cpt-list__item">
                        <?php if ( $terms ) : ?>
                        <div class="cpt-list__item__type">
                            <?php foreach ( $terms as $term ) : ?>
                            <h5 class="cpt-list__item__type__name p2"><?php echo $term->name; ?></h5>
                            <?php endforeach; ?>
                        </div>
                        <?php else : ?>
                            <h5 class="cpt-list__item__type p2"><?php echo 'any'; ?></h5>
                        <?php endif; ?>
                        <h4 class="cpt-list__item__title"><?php echo the_title(); ?></h4>
                        <a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
                    </div>
                <?php endwhile; 
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
