<?php
/**
 * Template Name: Intelligence Page
 */

get_header();
global $post;

$args = array(
    'post_type' => 'intelligence',
    'posts_per_page' => -1,
    'paged' => 1,
);
$cat_args = array(
    'taxonomy' => 'intelligence_category',
);
$categories = get_terms( $cat_args );

$query = new WP_Query( $args );
?>

<div class="template-intelligence">
    <section class="template-heading">
        <div class="container">
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
        </div>
    </section>
    <section class="template-intelligences">
        <div class="container">
            <div class="template-intelligences__filters">
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
            <?php if ( $query->have_posts() ) : ?>
            <div class="cpt-list"
                data-cat="" 
                data-post-type="intelligence" 
                data-paged="" 
                data-individual="intelligence"
                data-posts-per-page="10">
                <?php
                while ( $query->have_posts() ) :
                    $query->the_post();
                    get_template_part( 'template-parts/loop', 'intelligence' );
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php
get_footer();
