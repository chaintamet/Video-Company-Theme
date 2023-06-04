<?php 
global $post;
$newsletter = get_field( 'newsletter' );
$news_style = get_field( 'style', 'options' );
$news_form  = get_field( 'newsletter_form', 'options' );
?>

<section class="newsletter style-<?php echo $news_style; ?>">
	<h2 class="newsletter-title">newsletter</h2>
	<div class="newsletter-arrow">></div>
	<div class="newsletter-form">
		<?php echo do_shortcode( __( $news_form ) ); ?>
	</div>
</section>