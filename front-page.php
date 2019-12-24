<?php get_header(); ?>
<div id="primary" class="content-area cf">
	<main id="main" class="site-main cf" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( $row1_text = get_field("row1_text") ) { ?>
			<section class="section row1 text-center">
				<div class="wrapper">
					<div class="midtext">
						<span class="corner topleft"></span><span class="corner topright"></span>
						<span class="corner bottomleft"></span><span class="corner bottomright"></span>
						<div class="text"><?php echo $row1_text ?></div>
					</div>
				</div>
			</section>
			<?php } ?>


			<?php
			$row2_image = get_field("row2_image");
			$row2_text = get_field("row2_text");
			$row2Class = ($row2_image && $row2_text) ? 'half':'full';
			?>

			<?php if ($row2_image || $row2_text) { ?>
			<section class="section row2 <?php echo $row2Class ?>">
				<div class="flexwrap cf">
					<?php if ($row2_image) { ?>
						<div class="imagecol col">
							<img src="<?php echo $row2_image['url'] ?>" alt="<?php echo $row2_image['title'] ?>" />
						</div>
					<?php } ?>
					<?php if ($row2_text) { ?>
						<div class="textcol col">
							<div class="text"><?php echo $row2_text ?></div>
						</div>
					<?php } ?>
				</div>
			</section>	
			<?php } ?>

			<?php  
				//$row3_title = get_field("row3_title");
				//$featured_staff = get_field("featured_staff");
				//$contactForm = get_field("contact_form");
				$formData = get_field("contact_form","option");
				$formheading = ( isset($formData['heading']) && $formData['heading'] ) ? $formData['heading'] : '';
				$featured_staff = ( isset($formData['featured_staff']) && $formData['featured_staff'] ) ? $formData['featured_staff'] : '';
				$contactForm = ( isset($formData['contact_form_shortcode']) && $formData['contact_form_shortcode'] ) ? $formData['contact_form_shortcode'] : '';
				$row3Cols = ($contactForm && $featured_staff) ? 'half':'full';
				$row3Image = get_field("row3_bg");
				$row3Style = ($row3Image) ? ' style="background-image:url('.$row3Image['url'].')"':'';
			?>
				
			<?php if ($contactForm && do_shortcode($contactForm)) { ?>
			<section class="section row3">
				<?php if ($row3Image) { ?>
				<div class="imageBg"<?php echo $row3Style ?>></div>	
				<?php } ?>
				<div class="wrapper">
					<div class="contact-form-wrapper">
						<?php if ($formheading) { ?>
						<h2 class="hd2 text-center"><?php echo $formheading ?></h2>	
						<?php } ?>
						
						<div class="flexwrap cf <?php echo $row3Cols ?>">
							<?php if ($featured_staff) { ?>
								<?php 
									$teamId = $featured_staff->ID;
									$teamName = $featured_staff->post_title;
									//$teamPhoto = get_field("photo",$teamId);
									$teamPhoto = ( isset($formData['contact_photo']) && $formData['contact_photo'] ) ? $formData['contact_photo'] : '';
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
