<?php
get_header(); ?>

<div id="primary" class="content-area single-team cf">
		<main id="main" class="site-main cf" role="main">
			
			<div class="staff-details wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php  
					$photo = get_field("photo");
					$title = get_field("job_title");
					$office_phone = get_field("office_phone");
					$cellphone = get_field("cellphone");
					$email = get_field("email");
					$contact_info = array($office_phone,$cellphone,$email);
				?>
				<article id="post<?php the_ID(); ?>" class="entry-content cf <?php echo ($photo) ? 'hasProfPic':'nophoto';?>">
					<?php if ($photo) { ?>
					<div class="photo animated fadeIn">
						<img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>" />
					</div>	
					<?php } ?>

					<div class="text animated fadeIn">
						<div class="head">
							<h1 class="entry-title"><?php the_title() ?></h1>
							<?php if ($title) { ?>
							<div class="jobtitle"><?php echo $title ?></div>	
							<?php } ?>
						</div>
						<?php the_content(); ?>
						
						<?php if ($contact_info && array_filter($contact_info)) { ?>
						<div class="staff-contact-info cf">
							<?php if ($office_phone) { ?>
							<div class="info officephone">
								<i class="fas fa-phone icon"></i><a href="tel:<?php echo format_phone_number($office_phone); ?>"><?php echo $office_phone ?></a>
							</div>	
							<?php } ?>
							<?php if ($cellphone) { ?>
							<div class="info cellphone">
								<i class="fas fa-mobile-alt icon"></i><a href="tel:<?php echo format_phone_number($cellphone); ?>"><?php echo $cellphone ?></a>
							</div>	
							<?php } ?>

							<?php if ($email) { ?>
							<div class="info email">
								<i class="fas fa-envelope icon"></i><a href="mailto:<?php echo antispambot($email,1); ?>"><?php echo antispambot($email); ?></a>
							</div>	
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</article>

			<?php endwhile; ?>
			</div>
			
			<div class="other-staff">
				<div class="wrapper"><?php get_template_part("template-parts/content","team"); ?></div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
