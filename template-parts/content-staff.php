<?php  
	global $post;
	$currentPostId = ( isset($post->ID) && $post->ID ) ? $post->ID : '';

	$post_type = 'staff';
	$posts_per_page = -1;
	$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
	$args = array(
		'posts_per_page'=> $posts_per_page,
		'post_type'		=> $post_type,
		'post_status'	=> 'publish',
		'orderby' => 'menu_order', 
		'order' => 'ASC'
	);

	if($currentPostId) {
		$args['post__not_in'] = array($currentPostId);
	}
	$list_title = get_field("list_title",69);
	$team = new WP_Query($args);
	$placeholder = get_bloginfo("template_url") . "/images/square.png";
	if ( $team->have_posts() ) {  ?>
		<div class="project-galleries cf">
			<?php if ($list_title) { ?>
			<div class="title-wrapper"><h3 class="listtitle text-left"><em><?php echo $list_title ?></em></h3></div>
			<?php } ?>
			<div id="projectslist" class="staff-wrapper cf">
				<?php while ( $team->have_posts() ) : $team->the_post(); 
					$postid = get_the_ID();
					$projImage = get_field('picture');
					$hasImage = ($projImage) ? 'hasimage' : 'noimage';
					$style = ($projImage) ? ' style="background-image:url('.$projImage['sizes']['medium_large'].')"':'';
					$title = get_the_title();
					$link = get_permalink();
				?>
				<div class="box <?php echo $hasImage ?>">
					<a href="<?php echo $link ?>#content" class="inner <?php echo $hasImage ?>" data-name="<?php echo $title; ?>">
						<?php if ($projImage) { ?>
						<span class="image"<?php echo $style ?>></span>
						<?php } ?>
						<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
						<span class="caption">
							<span class="wrap">
								<span class="title"><?php echo $title; ?></span>
							</span>
						</span>
					</a>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>

		</div>
	<?php } ?>