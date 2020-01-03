<?php
/*
 * Template Name: Contact
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
				<?php if ( get_the_content() ) { ?>
				<section class="section text-middle row1_text">
					<div class="wrapper">
						<div class="midtext midtextLg">
							<span class="corner topleft"></span><span class="corner topright"></span>
							<span class="corner bottomleft"></span><span class="corner bottomright"></span>
							<div class="text"><?php the_content(); ?></div>
						</div>
					</div>
				</section>
				<?php } ?>

				<?php  
					/* CONTACT FORM */
					//$row3_title = get_field("row3_title");
					//$featured_staff = get_field("featured_staff");
					//$contactForm = get_field("contact_form");
					$formData = get_field("contact_form","option");
					$formheading = ( isset($formData['heading']) && $formData['heading'] ) ? $formData['heading'] : '';
					$featured_staff = ( isset($formData['featured_staff']) && $formData['featured_staff'] ) ? $formData['featured_staff'] : '';
					$contactForm = ( isset($formData['contact_form_shortcode']) && $formData['contact_form_shortcode'] ) ? $formData['contact_form_shortcode'] : '';
					$row3Cols = ($contactForm && $featured_staff) ? 'half':'full';
				?>
				
				<?php if ($contactForm && do_shortcode($contactForm)) { ?>
				<section class="section-contact">
					<div class="wrapper">
						<div class="contact-form-wrapper contactpage">
							<?php // if ($formheading) { ?>
							<!-- <h2 class="hd2 text-center"><?php //echo $formheading ?></h2>	 -->
							<?php //} ?>
							
							<div class="flexwrap cf <?php echo $row3Cols ?>">
								<?php if ($featured_staff) { ?>
									<?php 
										$teamId = $featured_staff->ID;
										$teamName = $featured_staff->post_title;
										$teamPhoto = ( isset($formData['contact_photo']) && $formData['contact_photo'] ) ? $formData['contact_photo'] : '';
										//$teamPhoto = get_field("photo",$teamId);
										$jobTitle = get_field("job_title",$teamId);
										$officePhone = get_field("office_phone",$teamId);
										$cellphone = get_field("cellphone",$teamId);
										$email = get_field("email",$teamId);
										$photoSrc = ($teamPhoto) ? $teamPhoto['sizes']['medium'] : get_bloginfo('template_url')."/images/square.png";
										$hasImage = ($teamPhoto) ? 'hasphoto':'nophoto';
									?>
									<div class="col featStaff">
										<div class="fscol imagecol">
											<div class="image <?php echo $hasImage ?>" style="background-image:url('<?php echo $photoSrc ?>');"></div>
										</div>
										<div class="fscol info">
											<h3 class="name"><?php echo $teamName ?></h3>
											<?php if ($jobTitle) { ?>
											<div class="jobtitle data"><?php echo $jobTitle ?></div>	
											<?php } ?>
											<?php if ($officePhone) { ?>
											<div class="officePhone data">Office: <?php echo $officePhone ?></div>	
											<?php } ?>
											<?php if ($cellphone) { ?>
											<div class="cellphone data">Cell: <?php echo $cellphone ?></div>	
											<?php } ?>
											<?php if ($email) { ?>
											<div class="email data">Email: <a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email) ?></a></div>	
											<?php } ?>
										</div>
									</div>
								<?php } ?>

								<?php if ($contactForm) { ?>
									<div class="col contactform">
										<?php echo do_shortcode($contactForm) ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</section>
				<?php } ?>


			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
