<?php
/**
 * Custom comments for single or page templates
 *
 * @param mixed $comment comments to display
 * @param mixed $args args
 * @param int   $depth depth
 * @return void
 */
function am_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php esc_attr( comment_ID() ); ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
		<?php
		if ( 0 != $args['avatar_size'] ) {
			echo get_avatar( $comment, $args['avatar_size'] );}
		?>
		<?php
		// phpcs:disabled WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'am' ), get_comment_author_link() );
		?>
		</div>
	<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'am' ); ?></em>
		<br />
<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_attr( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( esc_html__( '%1$s at %2$s', 'am' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) )
			?>
				</a>
				<?php
				edit_comment_link( __( '(Edit)', 'am' ), '  ', '' );
				?>
		</div>

		<div class="entry-comment"><?php comment_text(); ?></div>

		<div class="reply">
		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
	<?php
}

/**
 * Browser detection body_class() output
 *
 * @param string $classes default body classes
 * @return string updated classes
 */
function am_browser_body_class( $classes ) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_IE ) {
		$classes[] = 'ie';
	} else {
		$classes[] = 'unknown';
	}

	if ( wp_is_mobile() ) {
		$classes[] = 'mobile';
	}
	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}
	return $classes;
}

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function am_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'am' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'am_wp_title', 10, 2 );
endif;

/**
 * Filter for get_the_excerpt
 *
 * @param string $more excerpt more text
 * @return '...'
 */
function am_excerpt_more( $more ) {
	$more = '...';
	return '...';
}

/**
 * Add date if post doesn't have title
 *
 * @param string $title default title
 * @return string updated title
 */
function am_has_title( $title ) {
	global $post;
	if ( '' === $title ) {
		return get_the_time( get_option( 'date_format' ) );
	} else {
		return $title;
	}
}

/**
 * Enable shortcode tags in post content
 *
 * @param mixed $content post content
 * @return mixed filtered content
 */
function am_texturize_shortcode_before( $content ) {
	$content = preg_replace( '/\]\[/im', "]\n[", $content );
	return $content;
}

/**
 * Unregister all default WP Widgets
 */
function am_unregister_default_wp_widgets() {
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Calendar' );
	// unregister_widget('WP_Widget_Archives');
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Text' );
	// unregister_widget('WP_Widget_Categories');
	// unregister_widget('WP_Widget_Recent_Posts');
	// unregister_widget('WP_Widget_Recent_Comments');
	// unregister_widget('WP_Widget_RSS');
	// unregister_widget('WP_Widget_Tag_Cloud');
	// unregister_widget('WP_Nav_Menu_Widget');
}

/**
 * Add JS scripts
 */
function am_add_javascript() {

	global $am_option;

	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery' );
	if ( ! is_admin() ) {
		// external Javascript
		$am_links = array( 
			'https://cdnjs.cloudflare.com/ajax/libs/jQuery-viewport-checker/1.8.8/jquery.viewportchecker.min.js',
		);
		foreach ( $am_links as $am_link ) {
			// phpcs:disabled WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
			wp_enqueue_script( 'am_' . sanitize_title( $am_link ), $am_link, array( 'jquery' ), '', false );
		}
		$am_files = array(
			'/assets/js/libs.min.js',
			'/assets/js/main.min.js',
		); // example: array('script1', 'script2');
		foreach ( $am_files as $am_file ) {
			wp_enqueue_script( 'am_' . sanitize_title( $am_file ), get_theme_file_uri( $am_file ), array( 'jquery' ), filemtime( get_theme_file_path( $am_file ) ), true );
		}
	}
}

/**
 * Add CSS scripts
 */
function am_add_css() {
	// Add external CSS urls here
	$am_links = array(
	 );
	foreach ( $am_links as $am_link ) {
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_style( 'am_' . sanitize_title( $am_link ), $am_link, array() );
	}

	// Add all internal CSS here
	$am_files = array(
		'/assets/css/slick.min.css',
		'/assets/css/slick-theme.min.css',
		'/assets/css/style.min.css',
		'style.css',
	); // example: array('style1', 'style2');
	foreach ( $am_files as $am_file ) {
		wp_enqueue_style( 'am_' . sanitize_title( $am_file ), get_theme_file_uri( $am_file ), array(), filemtime( get_theme_file_path( $am_file ) ) );
	}

}

add_action( 'enqueue_block_editor_assets', 'add_block_editor_assets', 10, 0 );
/**
 * Add custom block editor css
 */
function add_block_editor_assets() {
	// wp_enqueue_style( 'block_editor_css', get_template_directory_uri() . '/assets/css/editor-block.css', array(), filemtime( get_template_directory_uri() . '/assets/css/editor-block.css' ) );
}

/**
 * Register widgetized areas
 */
function am_the_widgets_init() {

	if ( ! function_exists( 'register_sidebars' ) ) {
		return;
	}

	$before_widget = '<div id="%1$s" class="widget %2$s"><div class="widget_inner">';
	$after_widget  = '</div></div>';
	$before_title  = '<h3 class="widgettitle">';
	$after_title   = '</h3>';

	register_sidebar(
		array(
			'name'          => __( 'Default', 'am' ),
			'id'            => 'sidebar-default',
			'before_widget' => $before_widget,
			'after_widget'  => $after_widget,
			'before_title'  => $before_title,
			'after_title'   => $after_title,
		)
	);
}


/**
 * Move Comment textarea to the end of the form
 *
 * @param array $fields comment fields
 * @return array updated fields array
 */
function am_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

/**
 * Get page id by slug
 *
 * @param string $param template name
 * @return int page id
 */
function am_template_page_id( $param ) {
	$args  = array(
		'meta_key'    => '_wp_page_template',
		'meta_value'  => 'page-templates/' . $param . '.php',
		'post_type'   => 'page',
		'post_status' => 'publish',
	);
	$pages = get_pages( $args );
	return $pages[0]->ID;
}

/**
 * Return template HTML
 *
 * @param string $template_name template slug
 * @param string $part_name template part name
 */
function load_template_part( $template_name, $part_name = null ) {
	ob_start();
	get_template_part( $template_name, $part_name );
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

/**
 * Add SVG support
 *
 * @param array $mimes MIME file types
 * @return array updated MIMEs
 */
function am_mime_types( $mimes ) {
	$mimes['webp'] = 'image/webp';
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}

/**
 * Add SVG support - CSS part
 */
function am_svg_thumb_display() {
	echo '<style>
	td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
	 width: 100% !important; 
	 height: auto !important; 
	}
	</style>';
}

/**
 * Add Demo Role for security
 */
function am_demo_role() {
	global $wp_roles;
	if ( ! isset( $wp_roles ) ) {
		$wp_roles = new WP_Roles();
	}

	$role_admin = $wp_roles->get_role( 'administrator' );
	// Adding a 'new_role' with all admin caps
	$wp_roles->add_role( 'demo', __( 'Demo', 'am' ), $role_admin->capabilities );

	$role = get_role( 'demo' );
	$role->remove_cap( 'edit_themes' );
	$role->remove_cap( 'export' );
	$role->remove_cap( 'list_users' );
	$role->remove_cap( 'promote_users' );
	$role->remove_cap( 'switch_themes' );
	$role->remove_cap( 'remove_users' );
	$role->remove_cap( 'delete_themes' );
	$role->remove_cap( 'delete_plugins' );
	$role->remove_cap( 'edit_plugins' );
	$role->remove_cap( 'edit_users' );
	$role->remove_cap( 'create_users' );
	$role->remove_cap( 'delete_users' );
	$role->remove_cap( 'install_themes' );
	$role->remove_cap( 'install_plugins' );
	$role->remove_cap( 'activate_plugins' );
	$role->remove_cap( 'update_plugin' );
	$role->remove_cap( 'update_themes' );
	$role->remove_cap( 'update_core' );
}
