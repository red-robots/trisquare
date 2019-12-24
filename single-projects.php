<?php
$banner = get_slider();
get_header(); ?>

	<div id="primary" class="content-area cf projects-single-page">
		<main id="main" data-id="<?php echo get_the_ID(); ?>" class="site-main wrapper cf" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<header class="entry-header wrapper">
					<div class="midtext small">
						<span class="corner topleft"></span><span class="corner topright"></span>
						<span class="corner bottomleft"></span><span class="corner bottomright"></span>
						<div class="text"><h1 class="entry-title"><?php the_title(); ?></h1></div>
					</div>
				</header>
				
				<?php if ( get_the_content() ) { ?>
				<div class="entry-content cf"><?php the_content(); ?></div>
				<?php } ?>

				<?php if( $gallery = get_field("gallery") ) { 
					$count = count($gallery); 
					$colClass = ($count>1) ? 'half':'full';
					$images = array();
					$mainImage = $gallery[0];
					$placeholder = get_bloginfo("template_url") . "/images/square.png";
					?>
				<section id="gallerySection" class="section gallery-section cf <?php echo $colClass ?>">
					<div class="inside">
						<div id="photoBig" class="main-image" data-main="<?php echo $mainImage['url'] ?>">
							<?php if ($count>1) { ?>
							<a href="#" id="mainPhoto" data-thumb=".img1"><img src="<?php echo $mainImage['url'] ?>" alt="<?php echo $mainImage['title'] ?>"><span class="zoom"><i class="fas fa-search-plus zoomIcon" aria-hidden="true"></i></span></a>
							<?php } else { ?>
								<img src="<?php echo $mainImage['url'] ?>" alt="<?php echo $mainImage['title'] ?>">
							<?php } ?>
						</div>

						<?php if ($mainImage) { ?>
						<a href="<?php echo $mainImage['url'] ?>" id="firstGalleryPic" data-fancybox="images" data-caption="<?php echo get_the_title(); ?>" rel="next" class="fancy" style="display:none!important;">
							<img src="<?php echo $mainImage['url'] ?>" alt="<?php echo $mainImage['title'] ?>">
						</a>
						<?php } ?>
							
						<?php //unset($gallery[0]); ?>
						
						<?php if ($count>1) { ?>
						<div class="galleries">
							<div id="inner-galleries" class="wrap cf">
								<?php $j=1; foreach ($gallery as $g) { ?>
								<div class="thumb <?php echo ($j==1) ? 'hide':'show';?>">
									<div class="gimage" style="background-image:url('<?php echo $g['sizes']['medium'] ?>')">
										<a href="<?php echo $g['url'] ?>" data-thumb=".img<?php echo $j?>" class="thumbLink">
											<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
										</a>

										<a href="<?php echo $g['url'] ?>" data-fancybox="images" data-caption="<?php echo get_the_title(); ?>" rel="next" class="fancy img<?php echo $j?>" style="display:none!important;">
											<img src="<?php echo $g['sizes']['medium'] ?>" alt="<?php echo $g['title'] ?>" style="visibility:hidden;" />
										</a>
									</div>
								</div>
								<?php $j++; } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</section>
				<?php } ?>

			<?php endwhile; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
