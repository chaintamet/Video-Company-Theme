<?php
global $post;

if ( have_rows( 'modules' ) ) : ?>
	<?php while ( have_rows( 'modules' ) ) :
		the_row(); 
		$anchor_id = get_sub_field( 'anchor_id' );
		?>
		<?php if ( 'banner' == get_row_layout() ) : 
			$count = count(get_sub_field( 'products' ));
			?>
			<!-- Banner -->
			<section class="banner" data-count="<?php echo $count; ?>">
				<?php if ( have_rows( 'products' ) ) : ?>
				<div class="banner-carousel">
					<?php while ( have_rows( 'products' ) ) :
						the_row(); 
						$image = get_sub_field( 'image' );
						$video = get_sub_field( 'video' );
						$url   = get_sub_field( 'url' );
					?>
					<div class="banner-carousel__item">
						<?php
						get_template_part(
							'template-parts/content-modules',
							'media',
							array(
								'image'  => $image,
								'video'  => $video,
								'url'    => $url,
								'class'  => 'banner-carousel__item__media'
							)
						);
						?>
						<div class="banner-carousel__item__content">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'title',
									't'  => 'h1',
									'tc' => 'banner-carousel__item__title'
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'description',
									't'  => 'h3',
									'tc' => 'banner-carousel__item__description'
								)
							);
							?>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			</section>
		<?php elseif ( 'spotlight_articles' == get_row_layout() ) : 
			$style    = get_sub_field( 'style' );
			$articles = get_sub_field( 'articles' );
			?>
			<!-- Spotlight Article Section -->
			<section class="spotlight-articles <?php echo 'style-' . $style; ?>">
				<div class="spotlight-articles__heading">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'title',
							't'  => 'h2',
							'tc' => 'spotlight-articles__title h1 a-up'
						)
					);
					?>
				</div>
				<?php if ( $articles ) : 
					$ind = 0;
					?>
				<div class="spotlight-articles__items">
					<?php foreach ( $articles as $post ) : 
						setup_postdata( $post );
						$ind    = $ind + 1;
						$terms = get_the_category( $post->ID );
						?>
						<div class="spotlight-articles__item__title">
							<h6 class="spotlight-articles__item__title__type p2"><?php echo esc_attr( $terms[0]->name ); ?></h6>
							<h4 class="spotlight-articles__item__title__name">
								<?php echo the_title(); ?>
								<a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
							</h4>
						</div>
						<div class="spotlight-articles__item__content <?php echo ($ind == 1 ? 'show' : ''); ?>">
							<div class="spotlight-articles__item__content__img">
								<h6 class="spotlight-articles__item__content__type p2"><?php echo esc_attr( $terms[0]->name ); ?></h6>
								<?php echo the_post_thumbnail( 'article-image' )?>
							</div>
							<div class="spotlight-articles__item__content__description">
								<h4 class="spotlight-articles__item__content__name"><?php echo the_title(); ?></h4>
								<div class="spotlight-articles__item__content__content"><?php echo the_content(); ?></div>
								<a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
							</div>
						</div>
					<?php endforeach; 
						wp_reset_postdata();
					?>
				</div>
				<?php endif; ?>
			</section>
		<?php elseif ( 'featured_articles' == get_row_layout() ) : 
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => '6'
			);
			$query = new WP_Query( $args );
			?>
			<!-- Featured section -->
			<section class="featured-articles">
				<div class="container">
					<div class="featured-articles__heading">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'title',
								't'  => 'h2',
								'tc' => 'featured-articles__title h1'
							)
						);
						?>
						<a href="/articles" class="btn">view more</a>
					</div>
					<?php if ( $query->have_posts() ) : ?>
					<div class="featured-articles__items">
						<?php while ( $query->have_posts() ) :
							$query->the_post();
							get_template_part( 'template-parts/loop', 'post' );
						endwhile;
						wp_reset_postdata();
						?>
					</div>
					<?php endif; ?>
				</div>
			</section>
		<?php elseif ( 'most_popular' == get_row_layout() ) : 
			$articles = get_sub_field( 'popular_articles' );
			$style    = get_sub_field( 'style' );
			?>
			<!-- Section Most Popular -->
			<section class="most-popular style-<?php echo $style; ?>">
				<?php if ( $articles ) : ?>
				<div class="most-popular__carousel">
					<?php foreach ( $articles as $post ) : 
					setup_postdata( $post );
					$terms = get_the_category( $post->ID );
					?>
					<div class="most-popular__carousel__item">
						<div class="most-popular__carousel__item__img">
							<?php echo the_post_thumbnail( ) ?>
						</div>
						<div class="most-popular__carousel__item__content">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'title',
									't'  => 'h2',
									'tc' => 'most-popular__carousel__item__heading'
								)
							);
							?>
							<div class="most-popular__carousel__item__bottom">
								<h6 class="most-popular__carousel__item__type p2"><?php echo esc_attr( $terms[0]->name )?></h6>
								<div class="most-popular__carousel__item__right">
									<h3 class="most-popular__carousel__item__title"><?php echo the_title(); ?></h3>
									<div class="most-popular__carousel__item__description"><?php echo the_content(); ?></div>
									<a href="<?php echo esc_url( the_permalink() ); ?>" class="btn">read article</a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; 
					wp_reset_postdata();
					?>
				</div>
				<?php endif; ?>
			</section>
		<?php elseif ( 'mission' == get_row_layout() ) : 
			$image  = get_sub_field( 'image' );
			$video  = get_sub_field( 'video' );
			$url    = get_sub_field( 'url' );
			?>
			<!-- Section Mission -->
			<section class="mission">
				<div class="container">
					<div class="mission-media">
						<?php
						get_template_part(
							'template-parts/content-modules',
							'media',
							array(
								'image'   => $image,
								'video'   => $video,
								'url'     => $url,
								'control' => false,
								'class'   => 'mission-media__data'
							)
						);
						?>
					</div>
					<div class="mission-content">
						<div class="mission-heading">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'title',
									't'  => 'h2',
									'tc' => 'mission-title h1'
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-cta',
								array(
									'v'  => 'cta',
									'c'  => 'mission-cta btn'
								)
							);
							?>
						</div>
						<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'description',
									'w'  => 'div',
									'wc' => 'mission-description'
								)
							);
						?>
					</div>
				</div>
			</section>
		<?php elseif ( 'title_content' == get_row_layout() ) : ?>
			<!-- Title Content Section -->
			<section class="title-content">
				<div class="container">
					<?php if ( have_rows( 'content' ) ) : 
						while ( have_rows( 'content' ) ) :
							the_row(); ?>
						<div class="title-content__each">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'title',
									't'  => 'p',
									'tc' => 'title-content__title p3'
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'description',
									'w'  => 'div',
									'wc' => 'title-content__description'
								)
							);
							?>
						</div>
						<?php endwhile;
					endif; ?>
				</div>
			</section>
		<?php elseif ( 'image_content' == get_row_layout() ) : 
				$image = get_sub_field( 'image' );
				$video = get_sub_field( 'video' );
				$url   = get_sub_field( 'url' );
			?>
			<!-- Image Content Section -->
			<section class="image-content">
				<div class="image-content__image">
					<?php
					get_template_part(
						'template-parts/content-modules',
						'media',
						array(
							'image'  => $image,
							'video'  => $video,
							'url'    => $url,
							'class'  => 'image-content__media'
						)
					);
					?>
				</div>
				<div class="image-content__content">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'title',
							't'  => 'h2',
							'tc' => 'image-content__title'
						)
					);
					?>
					<div class="image-content__main">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'role',
								't'  => 'h6',
								'tc' => 'image-content__role p3'
							)
						);
						?>
						<div class="image-content__right">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'name',
									't'  => 'h3',
									'tc' => 'image-content__name'
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'description',
									'w'  => 'div',
									'wc' => 'image-content__description'
								)
							);
							?>
						</div>
					</div>
				</div>
			</section>
		<?php elseif ( 'testimonial' == get_row_layout() ) : ?>
			<!-- Testimonial Section -->
			<section class="testimonial">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'author',
							't'  => 'h4',
							'tc' => 'testimonial-author'
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'testimonial',
							't'  => 'h2',
							'tc' => 'testimonial-testimonial'
						)
					);
					?>
				</div>
			</section>
		<?php elseif ( 'what_we_do' == get_row_layout() ) : ?>
			<!-- Section What We Do -->
			<section class="what-we-do">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'title',
							't'  => 'h2',
							'tc' => 'what-we-do__title h1'
						)
					);
					?>
					<?php if ( have_rows( 'card' ) ) : ?>
					<div class="what-we-do__cards">
						<?php while ( have_rows( 'card' ) ) : 
							the_row(); 
							$style = get_sub_field( 'style' );
							$url = get_sub_field( 'cta' );
							?>
						<a href="<?php echo $url['url'] ?>" class="what-we-do__card style-<?php echo esc_attr( $style ); ?>">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'title',
									't'  => 'h2',
									'tc' => 'what-we-do__card__title h1'
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'sub_title',
									't'  => 'h3',
									'tc' => 'what-we-do__card__sub_title'
								)
							);
							?>
							<h5 class="what-we-do__card__cta btn p2"><?php echo $url['title']; ?></h5>
						</a>
						<?php endwhile; ?>
					</div>
					<?php endif; ?>
				</div>
			</section>
		<?php elseif ( 'our_team' == get_row_layout() ) : 
			$members = get_sub_field( 'members' );
			?>
			<!-- Our Team Carousel Section -->
			<section class="our-team">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'title',
							't'  => 'h2',
							'tc' => 'our-team__title h1'
						)
					);
					?>
				</div>
				<?php if ( $members ) : ?>
				<div class="our-team__carousel">
					<?php foreach ( $members as $post ) : 
						setup_postdata( $post );
						get_template_part( 'template-parts/loop', 'member' );
						endforeach; 
						wp_reset_postdata();
					?>
				</div>
				<?php endif; ?>
			</section>
		<?php elseif ( 'talent' == get_row_layout() ) : 
			$talents = get_sub_field( 'talents' );
			?>
			<!-- Section Talent -->
			<section class="talent">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'title',
							't'  => 'h2',
							'tc' => 'talent-title'
						)
					);
					?>
					<div class="talent-category"></div>
					<?php if ( $talents ) : ?>
					<div class="talent-items">
						<?php foreach ( $talents as $post ) : 
							setup_postdata( $post );
							get_template_part( 'template-parts/loop', 'talent' );
							endforeach; 
							wp_reset_postdata();
						?>
					</div>	
					<?php endif; ?>
				</div>
			</section>
		<?php elseif ( 'projects' == get_row_layout() ) : 
			$projects = get_sub_field( 'projects' );
			?>
			<!-- Section Project -->
			<section class="projects">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'title',
							't'  => 'h2',
							'tc' => 'projects-title'
						)
					);
					?>
				</div>
				<?php if ( $projects ) : ?>
				<div class="projects-carousel">
					<?php foreach ( $projects as $post ) : 
						setup_postdata( $post );
						get_template_part( 'template-parts/loop', 'project' );
					endforeach;
					wp_reset_postdata();
					?>
				</div>
				<?php endif; ?>
			</section>
		<?php elseif ( 'cta' == get_row_layout() ) : 
			$style = get_sub_field( 'style' );
			?>
			<!-- CTA Section -->
			<section class="cta">
				<div class="cta-main style-<?php echo $style; ?>">

					<div class="cta-icon"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cta-' . $style . '.svg'); ?>" alt=""></div>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'title',
							't'  => 'h2',
							'tc' => 'cta-title h1'
						)
					);
					?>
					<div class="cta-arrow">></div>
					<?php
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v'  => 'cta',
							'c'  => 'cta-cta h1',
						)
					);
					?>
				</div>
				<?php
                get_template_part_args(
                    'template-parts/content-modules-image',
                    array(
                        'v'     => 'image',
                        'v2x'   => false,
                        'is'    => false,
                        'is_2x' => false,
                        'w'     => 'div',
                        'wc'    => 'cta-image',
                    )
                );
                ?>
			</section>
		<?php elseif ( 'newsletter' == get_row_layout() ) : 
  			include get_template_directory() . '/template-parts/newsletter.php';
			?>
		<?php endif; ?>
	<?php endwhile ?>
<?php endif;
