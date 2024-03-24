<?php get_header(); ?>

<?php breadcrumb_trail( 'echo=1&separator=/' ); ?>

<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<?php get_template_part( 'templates/content', 'post' ); ?>
	<?php endwhile; ?>

	<?php get_template_part( 'templates/pagination', 'post' ); ?>

<?php else : ?>
	<?php get_template_part( 'templates/content', 'none' ); ?>
<?php endif; ?>

<?php
get_footer();
