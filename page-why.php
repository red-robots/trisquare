<?php
/**
 * Template Name: Why Tri-Square
 */
$banner = get_slider();
get_header(); ?>

	<div id="primary" class="content-area cf default whyus">
		<main id="main" data-id="<?php echo get_the_ID(); ?>" class="site-main cf" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php if ($banner) { ?>
					<h1 class="entry-title" style="display:none"><?php the_title(); ?></h1>
				<?php } else { ?>
					<header class="entry-header wrapper">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
				<?php } ?>
				
				<?php if ( get_the_content() ) { ?>
				<section class="section text-middle row1_text">
					<div class="wrapper">
						<div class="midtext">
							<span class="corner topleft"></span><span class="corner topright"></span>
							<span class="corner bottomleft"></span><span class="corner bottomright"></span>
							<div class="text"><?php the_content(); ?></div>
						</div>
					</div>
				</section>
				<?php } ?>


				<?php if( $reasons = get_field("why_ts") ) { ?>
				<section class="section why-us">
					<div class="wrapper">
						<div class="flexwrap">
						<?php foreach ($reasons as $r) { 
							$image = $r['image'];
							$title1 = $r['title1'];
							$title2 = $r['title2'];
							$text = $r['text'];
							$bgImg = ($image) ? $image['sizes']['medium_large']:'';
							$styleBg = ($image) ? ' style="background-image:url('.$bgImg.')"':'';
							$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
							?>
							<article class="info <?php echo ($image) ? 'hasphoto':'nophoto'; ?>">
								<div class="inside clear">
									<div class="feat-image"<?php echo $styleBg ?>>
										<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" /> 
									</div>
									<div class="textwrap cf">
										<div class="head">
											<?php if ($title1) { ?>
											<h2 class="title1"><?php echo $title1 ?></h2>	
											<?php } ?>
											<?php if ($title2) { ?>
											<h3 class="title2"><?php echo $title2 ?></h3>	
											<?php } ?>
										</div>
										<?php if ($text) { ?>
										<div class="text"><?php echo $text ?></div>	
										<?php } ?>
									</div>
								</div>
							</article>
						<?php } ?>
						</div>
					</div>
				</section>
				<?php } ?>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
