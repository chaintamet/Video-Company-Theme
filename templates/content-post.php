<?php
global $post;
$terms  = get_the_category( $post->ID );
$author = get_field( 'author' );
?>
<article <?php post_class( 'post' ); ?> id="post-<?php the_ID(); ?>">
	<section class="dashboard">
		<div class="container">
			<div class="back-to-articles a-up a-delay-1">
				<a href="/articles" class="btn btn-white">Back to articles</a>
			</div>
			<div class="dashboard-main">
				<div class="dashboard-image a-up a-delay-1">
					<?php echo the_post_thumbnail( 'brand-image' ); ?>
				</div>
				<div class="dashboard-content a-up a-delay-1">
					<h6 class="dashboard-type p2"><?php echo __( $terms ? $terms[0]->name : ''); ?></h6>
					<h1 class="dashboard-title"><?php echo __( the_title() ); ?></h1>
					<div class="dashboard-small_img"><?php echo the_post_thumbnail( 'brand-image' ); ?></div>
					<div class="dashboard-description"><?php echo __( the_content() ); ?></div>
					<div class="dashboard-info">
						<h4 class="dashboard-info__author">By <?php echo __( $author ); ?></h4>
						<h4 class="dashboard-info__date"><?php echo __( get_the_date( 'F o' ) ); ?></h4>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="single-article">
		<?php
		get_template_part( 'template-parts/content', 'post_type' );
		?>
	</div>
</article><!-- /post -->
