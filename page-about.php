<?php
/*
 * Template Name: About
 */

$banner = get_slider();
get_header(); ?>

	<div id="primary" class="content-area cf default">
		<main id="main" data-id="<?php echo get_the_ID(); ?>" class="site-main cf" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php if ($banner) { ?>
					<h1 class="entry-title" style="display:none"><?php the_title(); ?></h1>
				<?php } else { ?>
					<header class="entry-header wrapper">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
				<?php } ?>

				<?php /* ROW 1 */ ?>
				<?php if ( $row1_text = get_field("row1_text") ) { ?>
				<section class="section text-middle row1_text">
					<div class="wrapper">
						<div class="midtext">
							<span class="corner topleft"></span><span class="corner topright"></span>
							<span class="corner bottomleft"></span><span class="corner bottomright"></span>
							<div class="text"><?php echo $row1_text; ?></div>
						</div>
					</div>
				</section>
				<?php } ?>


				<?php  
				/* ROW 2 */
				$row2_text = get_field("row2_text");
				$row2_btnName = get_field("row2_button_name");
				$row2_btnLink = get_field("row2_button_link");
				$row2_gallery = get_field("row2_gallery");
				$row2_bgImage = get_field("row2_bgImage");
				$row2Class = ($row2_text && $row2_gallery) ? 'half':'full';
				$placeholder = get_bloginfo("template_url") . "/images/square.png";
				?>
				<?php if ($row2_text || $row2_gallery) { ?>
				<section class="section row2_text section-gallery <?php echo $row2Class  ?>">
					<?php if ($row2_bgImage) { ?>
					<div class="sectionBg" style="background-image:url('<?php echo $row2_bgImage['url'];?>')"></div>
					<?php } ?>
					<div class="wrapper maintext">
						<div class="flexwrap">
							<?php if ($row2_text) { ?>
							<div class="fcol textcol">
								<div class="inside">
									<div class="text">
										<?php echo $row2_text ?>
										<?php if ($row2_btnName && $row2_btnLink) { ?>
										<div class="btndiv"><a href="<?php echo $row2_btnLink ?>" class="btn btn-default"><?php echo $row2_btnName ?></a></div>	
										<?php } ?>
									</div>
								</div>
							</div>
							<?php } ?>

							<?php if ($row2_gallery) { $count = count($row2_gallery); ?>
							<div class="fcol imagecol <?php echo ($count>1) ? 'grid':'full';?>">
								<div class="inside">
									<div class="flexwrap">
									<?php foreach ($row2_gallery as $g) {  ?>
										<div class="img"><div style="background-image:url('<?php echo $g['url'] ?>')"><img src="<?php echo $placeholder ?>" alt="" aria-hidden="true"></div></div>
									<?php } ?>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</section>	
				<?php } ?>


				<?php /* ROW 3 */ ?>
				<?php if ( $row3_text = get_field("row3_text") ) { ?>
				<section class="section text-middle row3_text">
					<div class="wrapper">
						<div class="midtext">
							<span class="corner topleft"></span><span class="corner topright"></span>
							<span class="corner bottomleft"></span><span class="corner bottomright"></span>
							<div class="text"><?php echo $row3_text; ?></div>
						</div>
					</div>
				</section>
				<?php } ?>
				
				<?php get_template_part('template-parts/content','team'); ?>


			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
