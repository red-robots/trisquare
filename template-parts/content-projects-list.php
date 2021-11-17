<?php
$term = get_queried_object();
$term_id = $term->term_id;
$taxonomy = $term->taxonomy;
$currentCategory = $term->name;
$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
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
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$post_type = 'projects';
$args = array(
  'posts_per_page'  => -1,
  'post_type'       => $post_type,
  'post_status'     => 'publish',
  'tax_query'       => array(
      array(
        'taxonomy'  => $taxonomy,
        'terms'     => $term_id,
        'include_children' => false 
      )
  )
);
$items = get_posts( $args );
$placeholder = get_bloginfo("template_url") . "/images/rectangle-lg.png";
$blurred = get_bloginfo("template_url") . "/images/blurred.png";
$dummy = get_bloginfo("template_url") . "/images/placeholder.png";
$posts = new WP_Query($args);
$found = $posts->found_posts;
if ( $posts->have_posts() ) { ?>
<section class="section projects-by-category style2 cf">
	<div id="gallery-entries-grid" class="wrapper">
    <div class="grid">
		<?php $i=1; while ( $posts->have_posts() ) : $posts->the_post();
			$main_image = get_field('main_image');
			$title = get_the_title();
			$hasphoto = ($main_image) ? 'hasphoto':'nophoto';
			$pagelink = get_permalink();
			$galleries = get_field("gallery");
      $count = ($galleries) ? count($galleries): '';
      $count = false;
      $gallery_id = get_the_ID();
			if($main_image) { ?>
			<div class="image-block">
        <div class="inner">
          <a href="<?php echo $pagelink ?>" class="image-info" data-id="<?php echo $gallery_id ?>">
            <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
            <span class="img lozad" data-background-image="<?php echo $main_image['url'] ?>"></span>
            <span class="title"><span><?php echo $title; ?></span></span>
            <?php if ($count>1) { ?>
            <span class="count">
              <b>+<?php echo $count ?></b>
            </span> 
            <?php } ?>
          </a>
        </div>
      </div>
			<?php $i++; } ?>
		<?php endwhile; wp_reset_postdata(); ?>	
    </div>
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
							<?php if ($photo) { ?><span class="projImg lozad" data-background-image="<?php echo $photo['sizes']['medium_large'] ?>"></span><?php } ?>
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

<script type="text/javascript">
const observer = lozad();
observer.observe();
jQuery(document).ready(function ($) {
  
});
</script>
