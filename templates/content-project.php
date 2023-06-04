<?php
global $post;
$terms   = get_the_terms( $post, 'project_category' );
$talents = get_field( 'talent' );
$author  = get_field( 'author' );
$date    = get_the_date( 'o' );
$style   = get_field( 'style' ) ? get_field( 'style' ) : 'red';
?>
<article <?php post_class( 'project' ); ?> id="project-<?php the_ID(); ?>">
	<div class="<?php echo ( 'style-' . $style ); ?> single-project">
		<section class="single-project__dashboard">
			<div class="container">
				<div class="back"><a href="/brand-creator" class="btn">Back</a></div>
				<div class="single-project__dashboard__main">
					<div class="single-project__dashboard__left">
						<div class="single-project__dashboard__image"><?php echo the_post_thumbnail(); ?></div>
						<div class="single-project__dashboard__info">
							<div class="info-item">
								<h6 class="info-item__title p2">role</h6>
								<?php if ( $terms ) : ?>
									<?php foreach ( $terms as $term ) : ?>
										<h4 class="info-item__role"><?php echo __( $term->name ); ?></h4>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<div class="info-item">
								<h6 class="info-item__title p2">talent</h6>
								<?php if ( $talents ) : ?>
									<?php foreach ( $talents as $talent ) : ?>
										<h4 class="info-item__talent"><?php echo __( $talent->post_title ); ?></h4>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<div class="info-item">
								<h6 class="info-item__title p2">directed by</h6>
								<h4 class="info-item__author"><?php echo __( $author ); ?></h4>
							</div>
							<div class="info-item">
								<h6 class="info-item__title p2">date</h6>
								<h4 class="info-item__date"><?php echo __( $date ); ?></h4>
							</div>
						</div>
					</div>
					<div class="single-project__dashboard__right">
						<h1 class="single-project__dashboard__title"><?php echo __( the_title() ); ?></h1>
						<div class="single-project__dashboard__description"><?php echo __( the_content() ); ?></div>
					</div>
				</div>
			</div>
		</section>
		<?php
		get_template_part( 'template-parts/content', 'post_type' );
		?>
		<?php
		get_template_part( 'templates/content', 'page' );
		?>
	</div>
</article><!-- /post -->
