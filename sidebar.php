<div id="sidebar" class="col_sidebar">

	<div class="sidebar_widgets">
		<?php if ( ! dynamic_sidebar( 'sidebar-default' ) ) : ?>

			<?php the_widget( 'WP_Widget_Categories' ); ?>

			<?php the_widget( 'WP_Widget_Archives' ); ?>

			<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>	

		<?php endif; ?>
	</div><!-- /sidebar_widgets -->
</div><!-- /sidebar -->
