<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php the_field( 'head_code', 'options' ); ?>
	<?php wp_head(); ?>
</head>

<?php
global $post;
$image   = get_field( 'header_logo', 'options' );
$socials = get_field( 'social_link', 'options' );
?>

<body <?php body_class(); ?>>
<?php the_field( 'body_code', 'options' ); ?>

<?php if ( !is_404() ) : ?>

<header class="header">
	<div class="container">
		<div class="hamburger">
			<span></span>
		</div>
		<div class="header-logo">
			<a href="/">
				<img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
			</a>
		</div>
		<div class="header-nav">
			<?php
			wp_nav_menu(
				array(
					'container'  => false,
					'menu'       => 'Main Menu',
					'menu_class' => 'header-nav__menu',
				)
			);
			if ( $socials ) :
			?>
			<ul class="header-nav__social">
				<?php foreach ( $socials as $social ) : ?>
				<li class="header-nav__social__item"><a href="<?php echo esc_url( $social['cta']['url'] ); ?>" class="p2"><?php echo esc_attr( $social['cta']['title'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
		<div class="header-search">
			<div class="header-search__icon">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/search-icon.svg' ); ?>" alt="search icon">
			</div>
			<?php get_search_form(); ?>
		</div>
	</div>
</header>
<?php endif; ?>

<main class="main">
	