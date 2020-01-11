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


				<?php 
				$process_section_title = get_field("process_section_title"); 
				$process_bg_image = get_field("process_bg_image"); 
				$sectionStyle = ($process_bg_image) ? ' style="background-image:url('.$process_bg_image['url'].')"':'';
				$process = get_field("process");
				?>

				<section class="section process"<?php echo $sectionStyle ?>>
					<div class="section-content cf"> 
						<?php if ($process_section_title) { ?>
						<div class="text-middle row1_text">
							<div class="wrapper">
								<div class="midtext pad">
									<span class="corner topleft"></span><span class="corner topright"></span>
									<span class="corner bottomleft"></span><span class="corner bottomright"></span>
									<div class="text"><?php echo $process_section_title; ?></div>
								</div>
							</div>
						</div>
						<?php } ?>

						<?php if ($process) { 
							$totalSteps = count($process); 
							$colClass = '';
							if($totalSteps>2) {
								$colClass = ' columns'.$totalSteps;
							}

							if( $totalSteps>6 ) {
								$colClass = ' columnsMax';
							}
						?>
						<div class="wrapper">
							<div class="steps<?php echo $colClass; ?>">
								<?php $i=1; foreach ($process as $p) { 
									$title = $p['title'];
									$text = $p['text']; ?>
									<div class="step">
										<div class="inside cf">
											<div class="number"><span><?php echo $i ?></span></div>
											<?php if ($title || $text) { ?>
											<div class="steptext">
												<?php if ($title) { ?>
													<h2 class="stitle"><?php echo $title ?></h2>
												<?php } ?>
												<?php if ($text) { ?>
													<div class="stext"><?php echo $text ?></div>
												<?php } ?>
											</div>	
											<?php } ?>
										</div>
									</div>
								<?php $i++; } ?>
							</div>	
							<?php } ?>
						</div>
					</div>
				</section>


				<?php  
				$awards_section_title = get_field("awards_section_title");
				$awards_list = get_field("list");
				$stars = get_field("stars");
				?>
				<section class="section awards">
					<div class="wrapper">
						<?php if ($awards_section_title || $stars) { ?>
						<div class="text-middle">
							<div class="wrapper">
								<div class="midtext pad">
									<span class="corner topleft"></span><span class="corner topright"></span>
									<span class="corner bottomleft"></span><span class="corner bottomright"></span>
									<div class="text">
										<?php echo $awards_section_title; ?>
										<?php if ($stars) { 
											$starsArr = explode(".",$stars); 
											$hasDecimal = false;
											if( ( count($starsArr) > 1 ) ) {
												if( $starsArr[1] > 0 ) {
													$hasDecimal = true;
												}
											}
											$stars = floor($stars);
										?>
										<div class="stars cf" data-count="<?php echo $stars?>">

											<div class="shaded">
												<div class="wrap">
													<?php for($i=1; $i<=$stars; $i++) { ?>
														<span class="blue"><i class="fas fa-star star-icon-blue"></i></span>
													<?php } ?>

													<?php if ($hasDecimal) { ?>
														<span class="blue"><i class="fas fa-star-half-alt star-icon-blue"></i></span>
													<?php } ?>
												</div>
											</div>

										<?php } ?>	
										</div>	
									</div>
								</div>

								<?php if ($awards_list) { ?>
								<ul class="awards-list">
									<?php foreach ($awards_list as $a) { 
										$link = $a['link'];
										$openLink = '';
										$closeLink = '';
										if($link) {
											$openLink = '<a href="'.$link.'" target="_blank" class="awardsLink">';
											$closeLink = '</a>';
										}
										?>
										<li>
											<?php echo $openLink; ?>
											<i class="fas fa-star starIcon"></i> <?php echo $a['name'] ?>
											<?php if ($a['price']) { ?>
											<span class="price">(<?php echo $a['price'] ?>)</span>
											<?php } ?>
											<?php if ($a['year']) { ?>
											<span class="year"><?php echo $a['year'] ?></span>
											<?php } ?>
											<?php echo $closeLink; ?>
										</li>
									<?php } ?>
								</ul>	
								<?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</section>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
