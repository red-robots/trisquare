<?php
$term = get_queried_object();
$term_id = $term->term_id;
$taxonomy = $term->taxonomy;
$currentCategory = $term->name;
?>
<section class="section text-middle">
	<div class="wrapper">
		<div class="midtext">
			<span class="corner topleft"></span><span class="corner topright"></span>
			<span class="corner bottomleft"></span><span class="corner bottomright"></span>
			<div class="text"><h1 class="entry-title"><?php echo $currentCategory ?></h1></div>
		</div>
	</div>
</section>

<?php  
/* Individual Projects */
$post_type = 'projects';
$args = array(
	'posts_per_page' => -1,
    'post_type' => $post_type,
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'terms' => $term_id,
            'include_children' => false 
        )
    )
);
$items = get_posts( $args );
$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
$posts = new WP_Query($args);
if ( $posts->have_posts() ) { ?>
<section class="section projects-by-category cf">
	<div class="wrapper">
		<?php while ( $posts->have_posts() ) : $posts->the_post();
			$main_image = get_field('main_image');
			$projectName = get_the_title();
			$hasphoto = ($main_image) ? 'hasphoto':'nophoto';
			$pagelink = get_permalink();
			?>
			<div class="imagebox <?php echo $hasphoto ?>">
				<a href="#" data-url="<?php echo $pagelink ?>" data-id="<?php the_ID() ?>" class="link openGalleryBtn">
					<?php if ($main_image) { ?>
					<img src="<?php echo $main_image['url'] ?>" alt="<?php echo $main_image['title'] ?>" />
					<?php } else { ?>
					<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
					<?php } ?>
					<span class="projname"><span><?php echo $projectName; ?></span></span>
				</a>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>	
	</div>
</section>


<?php  
	$terms = get_terms( array(
	    'taxonomy' => 'project-categories',
	    'exclude' => array($term_id),
	    'hide_empty' => true,
	));
	if($terms) {  ?>
	<section class="section projects-list small-thumbs cf">
		<h2 class="stitle">See Other Galleries</h2>
		<div class="wrapper">
			<div class="flexwrap">
				<?php foreach($terms as $t) { 
					$photo = get_field('category_image',$t); 
					$pagelink = get_term_link($t);
					$termName = $t->name;
					$hasphoto = ($photo) ? 'hasphoto':'nophoto';
					$style = ($photo) ? ' style="background-image:url('.$photo['url'].')"':''
				?>
				<div class="project <?php echo $hasphoto ?>">
					<div class="inside">
						<a href="<?php echo $pagelink ?>" class="projlink">
							<?php if ($photo) { ?><span class="projImg" style="background-image:url('<?php echo $photo['url'];?>')"></span><?php } ?>
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

<div id="loadGalleries" style="display:none;"></div>
<?php } ?>