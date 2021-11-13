<?php
/*
 * Template Name: Gallery
 */

$banner = get_slider();
get_header(); ?>

	<div id="primary" class="content-area cf gallerypage">
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
			$terms = get_terms( array(
			    'taxonomy' => 'project-categories',
			    'hide_empty' => true,
			));
			
			if($terms) {  ?>
			<section class="section projects-list cf">
				<div class="wrapper">
					<div class="flexwrap">
						<?php foreach($terms as $t) { 
							$photo = get_field('category_image',$t); 
							$pagelink = get_term_link($t);
							$termName = $t->name;
							$hasphoto = ($photo) ? 'hasphoto':'nophoto';
							//$style = ($photo) ? ' style="background-image:url('.$photo['sizes']['medium'].')"':''
						?>
						<div class="project <?php echo $hasphoto ?>">
							<div class="inside">
								<a href="<?php echo $pagelink ?>" class="projlink show-title">
									<?php if ($photo) { ?><span class="projImg" style="background-image:url('<?php echo $photo['sizes']['large'];?>')"></span><?php } ?>
									<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
									<span class="projname"><span><?php echo $termName; ?></span></span>
								</a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</section>
			<?php } ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
