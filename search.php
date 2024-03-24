<?php get_header(); 
$flag = '';
global $wp_query;
$count = 0;
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$type = get_post_type();
		if ( $type == 'page' || $type == 'project' ) continue;
		$count ++;
	}
}
?>

<?php $search_query = get_search_query(); ?>

<div id="content" class="search-page">
	<div class="container">
		<div class="template-heading">
			<h1 class="template-heading__title h2">Search</h1>
			<div class="template-heading__meta">
				<div class="search-form">
					<div class="search-form__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/search-icon.svg' ); ?>" alt="search icon">
					</div>
					<div id="search_block" class="search-form__box">
						<form method="get" action="<?php echo esc_url( home_url() . '/' ); ?>">
							<fieldset>
								<input type="text" placeholder="search about a specific word found in miscellaneous formats" value="<?php echo esc_attr( $search_query ); ?>" name="s" class="search-text p2" />
							</fieldset>
						</form>
					</div>
				</div>
				<div class="search-count p1"><?php echo $count . ($count > 1 ? ' results' : ' result'); ?></div>
			</div>
		</div>
		<div class="search-page__content">
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					$type = get_post_type();
					if ( $type == 'page' || $type == 'project' ) continue;
					if ( $flag != $type ) {
						if ( !$flag == '' ) {
							echo '</div>';
						}
						echo '<h5 class="content-type__title h1">' . ($type == 'post' ? 'article' : $type) . '</h5>';
						echo '<div class="cpt-list cpt-' . $type . '">';
						$flag = $type;
					}
					?>
					<?php get_template_part( 'template-parts/loop', $flag ); ?>
				<?php endwhile; ?>
		
			<?php else : ?>
				<?php get_template_part( 'templates/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</div>

</div><!-- /content -->

<?php get_footer(); ?>
