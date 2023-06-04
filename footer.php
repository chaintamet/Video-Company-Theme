</main>
<?php
global $post;
$image = get_field( 'footer_logo', 'options' );
$socials = get_field( 'social_link', 'options' );
?>
<?php if ( !is_404() ) : ?>
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-left">
                <div class="footer-logo">
                    <a href="/">
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
                    </a>
                </div>
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'description',
                        't'  => 'h5',
                        'o'  => 'o',
                        'tc' => 'footer-description p2'
                    )
                );
                ?>
                <?php if ( $socials ) : ?>
                <ul class="footer-social">
                    <?php foreach ( $socials as $social ) : ?>
                    <li class="footer-social__item"><a href="<?php echo esc_url( $social['cta']['url'] ); ?>" class="p2"><?php echo esc_attr( $social['cta']['title'] ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="footer-right">
                <?php
                wp_nav_menu(
                    array(
                        'container'  => false,
                        'menu'       => 'Footer Menu',
                        'menu_class' => 'footer-menu',
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom__copyright">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'copyright',
                        't'  => 'p',
                        'o'  => 'o',
                        'tc' => 'footer-copyright'
                    )
                );
                ?>
            </div>
            <div class="footer-bottom__policy-creator">
                <?php
                get_template_part_args(
                    'template-parts/content-modules-cta',
                    array(
                        'v'  => 'policy',
                        'o'  => 'o',
                        'c'  => 'footer-bottom__policy p1'
                    )
                );
                ?>
                <?php
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'creator',
                        't'  => 'p',
                        'o'  => 'o',
                        'tc' => 'footer-creator'
                    )
                );
                ?>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
