<?php
$args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'team',
	'post_status'      => 'publish'
);
$placeholder = get_bloginfo("template_url") . "/images/square.png";
$team = new WP_Query($args);
if ( $team->have_posts() ) { ?>
<section class="section team-list cf">
	<div class="wrapper">
		<div class="flexwrap cf">
			<?php while ( $team->have_posts() ) : $team->the_post();
			$photo = get_field('photo'); 
			$job_title = get_field('job_title'); 
			$staff_name = get_the_title();
			$pagelink = get_permalink();
			$hasphoto = ($photo) ? 'hasphoto':'nophoto';
			$style = ($photo) ? ' style="background-image:url('.$photo['url'].')"':''
			?>
			<div class="staffinfo <?php echo $hasphoto ?>">
				<div class="photo"<?php echo $style ?>>
					<?php if ($photo) { ?><img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>" style="display:none;" /><?php } ?>
					<a href="<?php echo $pagelink ?>"><img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" /></a>
				</div>
				<div class="titlediv">
					<h3 class="name"><?php echo $staff_name ?></h3>
					<?php if ($job_title) { ?>
					<div class="jobtitle"><?php echo $job_title ?></div>	
					<?php } ?>
					<a href="<?php echo $pagelink ?>" class="more">Read Bio <span>&rsaquo;</span></a>
				</div>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php } ?>