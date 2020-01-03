<?php
/*
 * Template Name: Sitemap
 */

$banner = get_slider();
get_header(); ?>

	<div id="primary" class="content-area cf default">
		<main id="main" data-id="<?php echo get_the_ID(); ?>" class="site-main cf" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<div class="wrapper">

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

					<?php get_template_part('template-parts/content','sitemap'); ?>

				</div>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
