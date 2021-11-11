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
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$post_type = 'projects';
$perpage = 3;
$args = array(
  'posts_per_page'  => $perpage,
  'post_type'       => $post_type,
  'paged'           => $paged,
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
$dummy = get_bloginfo("template_url") . "/images/placeholder.png";
$posts = new WP_Query($args);
$found = $posts->found_posts;
if ( $posts->have_posts() ) { ?>
<section class="section projects-by-category style2 cf">
	<div id="gallery-entries" class="wrapper">
		<?php $i=1; while ( $posts->have_posts() ) : $posts->the_post();
			$main_image = get_field('main_image');
			$projectName = get_the_title();
			$hasphoto = ($main_image) ? 'hasphoto':'nophoto';
			$pagelink = get_permalink();
			$galleries = get_field("gallery");
      $gallery_id = get_the_ID();
			if($main_image) { 
			$custom_class = 'init';
      include( locate_template('template-parts/gallery-list.php') );
			$i++; } ?>
		<?php endwhile; wp_reset_postdata(); ?>	
	</div>

  <?php  
  $total_pages = $posts->max_num_pages;
  if ($total_pages > 1){ ?>
  <div class="galleries-more-button"><a href="#" data-posttype="<?php echo $post_type ?>" data-total="<?php echo $found ?>" data-currentpage="<?php echo $paged ?>" data-taxonomy="<?php echo $taxonomy ?>" data-termid="<?php echo $term_id ?>" data-totalpages="<?php echo $total_pages ?>" id="galleriesMoreBtn" data-perpage="<?php echo $perpage ?>" data-index="<?php echo $i ?>" class="btn btn-default">Load More</a></div>
  <?php } ?>

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
							<?php if ($photo) { ?><span class="projImg" style="background-image:url('<?php echo $photo['sizes']['medium_large'];?>')"></span><?php } ?>
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
  if( $(".gallery-swiper").length ) {
    $(".gallery-swiper .gallerySwipe").each(function () {
      var num = $(this).attr("data-id");
      var target = $(this);
      var galleryId = $(this).attr("id");
      var galleryIDSelector = '#' + galleryId;
      var gallerySwiper = new Swiper(galleryIDSelector, {
        slidesPerView: 1,
        spaceBetween: 0,
        effect: 'slide',
        loop: false,
        autoplay: false,
        navigation: {
          nextEl: '.gallery-next' + num,
          prevEl: '.gallery-prev' + num
        }
      });
    });

    $('.gallery-swiper').each(function () {
      var mySwiper = $(this).find(".gallerySwipe");
      $(this).find("a.enlarge").fancybox({
        protect: true,
        loop: false,
        buttons: ['close'],
        hash: false,
        backFocus: false,
        image: {
          preload: true
        },
        fullScreen: {
          autoStart: false
        },
        helpers: {
          overlay: {
            closeClick: false
          }
        },
        keys: {
          close: null
        },
        afterLoad: function afterLoad(instance, current) {},
        afterClose: function afterClose() {}
      });
    });

  }
});
</script>
