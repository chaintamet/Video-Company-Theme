<?php $search_query = get_search_query(); ?>
<div id="search_block" class="search-box">
	<form method="get" action="<?php echo esc_url( home_url() . '/' ); ?>">
		<fieldset>
			<input type="text" placeholder="<?php echo esc_attr( __( 'Search entry', 'am' ) ); ?>" value="<?php echo esc_attr( $search_query ); ?>" name="s" class="search-text p2" />
			<input type="submit" value="<?php echo esc_attr( __( 'Search', 'am' ) ); ?>" class="search-submit button button-dark" />
		</fieldset>
	</form>
</div><!-- /search_block -->
