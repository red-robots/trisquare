<?php
$banner = get_slider();
$placeholder = get_bloginfo("template_url") . "/images/blurred.png";
$rectangle = get_bloginfo("template_url") . "/images/rectangle-lg.png";
$taxonomy = 'project-categories';
$post_type = get_post_type();
$post_id = get_the_ID();
$terms = '';
get_header(); ?>

	<div id="primary" class="content-area cf projects-single-page">
		<main id="main" data-id="<?php echo get_the_ID(); ?>" class="site-main wrapper cf" role="main">

			<?php while ( have_posts() ) : the_post(); 
        $terms = get_the_terms( get_the_ID(), $taxonomy );
        $term_id = ($terms) ? $terms[0]->term_id : '';
        $term_name = ($terms) ? $terms[0]->name : '';
        $term_link = ($terms) ? get_term_link($terms[0]) : '';
        ?>
        <?php if ($terms) { ?>
        <div class="breadcrumb" style="display:none;">
          <a href="<?php echo $term_link ?>">&larr; Back to <b><?php echo $term_name ?></b> page</a>
        </div>
        <?php } ?>
        
        <h1 class="page-title"><?php the_title(); ?></h1>
				
				<?php if ( get_the_content() ) { ?>
				<div class="entry-content cf"><?php the_content(); ?></div>
				<?php } ?>

				<?php 
        $gallery_id = $post_id;
        $projectName = get_the_title();
        $first_image = get_field('main_image');
        $galleries = get_field("gallery");
        $main_image_url = '';
        $main_image_title = '';
        if($first_image) {
          $main_image_title = $first_image['title'];
          $main_image_url = $first_image['url'];
        } else {
          if($galleries) {
            $main_image_url = $galleries[0]['url'];
            $main_image_title = $galleries[0]['title'];
          }
        }
        if($main_image_url) { ?>
        <section class="section projects-by-category style2 cf">
          <div id="gallery<?php echo $gallery_id;?>" class="gallery-swiper animated fadeIn">
            <div class="gallery-wrap"> 
              <div id="galleryItem<?php echo $gallery_id;?>" data-id="<?php echo $gallery_id;?>" class="gallerySwipe">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="imgwrap">
                      <img src="<?php echo $placeholder ?>" class="lozad" data-src="<?php echo $main_image_url ?>" alt="<?php echo $main_image_title ?>" />
                      <div class="gallerypaginate">
                        <a href="#" class="prev gallery-prev<?php echo $gallery_id;?>"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="30" height="45" viewBox="0 0 20 30"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M14.258 1.53L13.198.47-.061 13.728l13.259 13.258 1.06-1.06L2.061 13.728z"></path></g></svg></a>
                        <a href="#" class="next gallery-next<?php echo $gallery_id;?>"><svg fill="currentColor" stroke="none" width="30" height="45" viewBox="0 0 20 30"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M.198 25.926l1.06 1.06 13.259-13.258L1.258.47.198 1.53l12.197 12.198z"></path></g></svg></a>
                      </div>
                      <a href="<?php echo $main_image_url ?>" data-fancybox="images" rel="group<?php echo $gallery_id;?>" title="Fullscreen" class="enlarge fancybox-button fancybox-button--fsenter"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"></path></svg><span class="sr">Fullscreen</span></a>
                    </div>
                  </div>
                  <?php if ($galleries) { ?>
                    <?php foreach ($galleries as $g) { ?>
                    <div class="swiper-slide">
                      <div class="imgwrap">
                        <img src="<?php echo $placeholder ?>" alt="<?php echo $g['title'] ?>" class="lozad" data-src="<?php echo $g['url'] ?>" />
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
              <img src="<?php echo $placeholder  ?>" alt="" aria-hidden="true" class="placeholder" style="visibility:hidden;">
            </div>
            <!-- <div class="project-name"><span><?php //echo $projectName; ?></span></div> -->
          </div>
        </section>
				<?php } ?>

			<?php endwhile; ?>


      <?php
      if( $terms ) { 
        $args = array(
          'posts_per_page'  => -1,
          'post_type'       => $post_type,
          'post_status'     => 'publish',
          'post__not_in'    => array($post_id),
          'tax_query'       => array(
            array(
              'taxonomy'  => $taxonomy,
              'terms'     => $term_id,
              'include_children' => false 
            )
          )
        );
        $other = new WP_Query($args);
        if( $other->have_posts() ) {  ?>
        <section class="section projects-list small-thumbs cf">
          <h2 class="stitle">See other <!-- <span class="term"><?php //echo $term_name ?></span> --> projects</h2>
          <div class="wrapper">
            <div class="flexwrap">
              <?php while ( $other->have_posts() ) : $other->the_post(); ?>
              <?php 
                $photo = get_field('main_image');
                $projLink = get_permalink();
                $projName = get_the_title();
                $hasphoto = ($photo) ? 'hasphoto':'nophoto';
                $style = ($photo) ? ' style="background-image:url('.$photo['url'].')"':''
              ?>
              <div class="project <?php echo $hasphoto ?>">
                <div class="inside">
                  <a href="<?php echo $projLink ?>" class="projlink">
                    <?php if ($photo) { ?><span class="projImg" style="background-image:url('<?php echo $photo['sizes']['medium_large'];?>')"></span><?php } ?>
                    <img src="<?php echo $rectangle ?>" alt="" aria-hidden="true" style="visibility:hidden;" />
                    <span class="projname"><span><?php echo $projName; ?></span></span>
                  </a>
                </div>
              </div>
              <?php endwhile; wp_reset_postdata(); ?>
            </div>
          </div>
        </section>
        <?php } ?>
      <?php } ?>


		</main><!-- #main -->
	</div><!-- #primary -->

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

<?php
get_footer();
