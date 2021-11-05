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
			if($main_image) { ?>
			<div id="gallery<?php echo $gallery_id;?>" class="gallery-swiper">
				<div class="gallery-wrap"> 
					<div id="galleryItem<?php echo $gallery_id;?>" data-id="<?php echo $gallery_id;?>" class="gallerySwipe">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="imgwrap">
									<img src="<?php echo $main_image['url'] ?>" alt="<?php echo $main_image['title'] ?>" />
									<div class="gallerypaginate">
										<a href="#" class="prev gallery-prev<?php echo $gallery_id;?>"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="30" height="45" viewBox="0 0 20 30"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M14.258 1.53L13.198.47-.061 13.728l13.259 13.258 1.06-1.06L2.061 13.728z"></path></g></svg></a>
										<a href="#" class="next gallery-next<?php echo $gallery_id;?>""><svg fill="currentColor" stroke="none" width="30" height="45" viewBox="0 0 20 30"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M.198 25.926l1.06 1.06 13.259-13.258L1.258.47.198 1.53l12.197 12.198z"></path></g></svg></a>
									</div>
									<a href="<?php echo $main_image['url'] ?>" data-fancybox="images" rel="group<?php echo $gallery_id;?>" title="Fullscreen" class="enlarge fancybox-button fancybox-button--fsenter"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"></path></svg><span class="sr">Fullscreen</span></a>
								</div>
							</div>
							<?php if ($galleries) { ?>
								<?php foreach ($galleries as $g) { ?>
								<div class="swiper-slide">
									<div class="imgwrap">
										<img src="<?php echo $g['url']?>" alt="<?php echo $g['title'] ?>" />
										<div class="gallerypaginate">
											<a href="#" class="prev gallery-prev<?php echo $gallery_id;?>"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="30" height="45" viewBox="0 0 20 30"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M14.258 1.53L13.198.47-.061 13.728l13.259 13.258 1.06-1.06L2.061 13.728z"></path></g></svg></a>
											<a href="#" class="next gallery-next<?php echo $gallery_id;?>"><svg fill="currentColor" stroke="none" width="30" height="45" viewBox="0 0 20 30"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M.198 25.926l1.06 1.06 13.259-13.258L1.258.47.198 1.53l12.197 12.198z"></path></g></svg></a>
										</div>
										<a href="<?php echo $g['url']?>" data-fancybox="images" rel="group<?php echo $gallery_id;?>" title="Fullscreen" class="enlarge fancybox-button fancybox-button--fsenter"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"></path></svg><span class="sr">Fullscreen</span></a>
									</div>
								</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<img src="<?php echo $placeholder  ?>" alt="" aria-hidden="true" class="placeholder">
				</div>
				<div class="project-name"><span><?php echo $projectName; ?></span></div>
			</div>
			<?php $i++; } ?>
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
jQuery(document).ready(function ($) {
  if( $(".gallery-swiper").length ) {
    $(".gallery-swiper .gallerySwipe").each(function () {
      var num = $(this).attr("data-id");
      console.log(num);
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
