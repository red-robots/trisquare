<?php
/*
 * Template Name: Gallery
 */

$banner = get_slider();
get_header(); ?>

	<div id="primary" class="content-area cf default gallerypage">
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

			<?php endwhile; ?>


			<?php
			/* GALLERIES */
			$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
			$args = array(
				'posts_per_page'   => -1,
				'post_type'        => 'projects',
				'post_status'      => 'publish'
			);
			
			$projects = new WP_Query($args);
			if ( $projects->have_posts() ) { ?>
			<section class="section projects-list cf">
				<div class="wrapper">
					<div class="flexwrap">
						<?php while ( $projects->have_posts() ) : $projects->the_post();
						$photo = get_field('featured_image'); 
						$project_name = get_the_title();
						$pagelink = get_permalink();
						$hasphoto = ($photo) ? 'hasphoto':'nophoto';
						$style = ($photo) ? ' style="background-image:url('.$photo['url'].')"':''
						?>
						<div class="project <?php echo $hasphoto ?>">
							<div class="inside">
								<a href="<?php echo $pagelink ?>" class="projlink">
									<?php if ($photo) { ?><span class="projImg" style="background-image:url('<?php echo $photo['url'];?>')"></span><?php } ?>
									<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
									<span class="projname"><span><?php echo $project_name; ?></span></span>
								</a>
							</div>
						</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
			</section>
			<?php } ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
