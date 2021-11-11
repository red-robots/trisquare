<?php
add_action( 'init', 'myscript_enqueuer' );
function myscript_enqueuer() {
  wp_register_script( "ajax_script", get_template_directory_uri() . '/assets/ajax.js', array('jquery') );
  wp_localize_script( 'ajax_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'ajax_script' );
}

add_action('wp_ajax_nopriv_get_gallery_entries', 'get_gallery_entries');
add_action("wp_ajax_get_gallery_entries", "get_gallery_entries");
function get_gallery_entries() {
   
   // nonce check for an extra layer of security, the function will exit if it fails
   // if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_like_nonce")) {
   //    exit("Woof Woof Woof");
   // }

  $placeholder = get_bloginfo("template_url") . "/images/rectangle-lg.png";
  $taxonomy = $_REQUEST["taxonomy"];
  $term_id = $_REQUEST["termid"];
  $post_type = $_REQUEST["posttype"];
  $perpage = $_REQUEST["perpage"];
  $index = $_REQUEST["index"];
  $paged = ($_REQUEST["paged"]) ? $_REQUEST["paged"] : 1;
  $next_page = $paged + 1;
  $totalpages = $_REQUEST["totalpages"];
  $show_more_button = ($next_page>=$totalpages) ? false : true;
  $html_output = '';

  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    $args = array(
      'posts_per_page'  => $perpage,
      'post_type'       => $post_type,
      'paged'           => $next_page,
      'post_status'     => 'publish',
      'tax_query'       => array(
          array(
            'taxonomy'  => $taxonomy,
            'terms'     => $term_id,
            'include_children' => false 
          )
      )
    );

    
    $posts = new WP_Query($args);    
    ob_start();
    if ( $posts->have_posts() ) { ?>
    <?php $i=$index; while ( $posts->have_posts() ) : $posts->the_post();
      $main_image = get_field('main_image');
      $projectName = get_the_title();
      $hasphoto = ($main_image) ? 'hasphoto':'nophoto';
      $pagelink = get_permalink();
      $galleries = get_field("gallery");
      $gallery_id = get_the_ID();
      $dummy = get_bloginfo("template_url") . "/images/placeholder.png";
      if($main_image) { ?>
      <div id="gallery<?php echo $gallery_id;?>" class="gallery-swiper new animated fadeIn">
        <div class="gallery-wrap"> 
          <div id="galleryItem<?php echo $gallery_id;?>" data-id="<?php echo $gallery_id;?>" class="gallerySwipe">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="imgwrap">
                  <img src="<?php echo $dummy ?>" alt="<?php echo $main_image['title'] ?>" class="lozad" data-src="<?php echo $main_image['url'] ?>" />
                  <div class="gallerypaginate">
                    <a href="#" class="prev gallery-prev<?php echo $gallery_id;?>"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="30" height="45" viewBox="0 0 20 30"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M14.258 1.53L13.198.47-.061 13.728l13.259 13.258 1.06-1.06L2.061 13.728z"></path></g></svg></a>
                    <a href="#" class="next gallery-next<?php echo $gallery_id;?>"><svg fill="currentColor" stroke="none" width="30" height="45" viewBox="0 0 20 30"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M.198 25.926l1.06 1.06 13.259-13.258L1.258.47.198 1.53l12.197 12.198z"></path></g></svg></a>
                  </div>
                  <a href="<?php echo $main_image['url'] ?>" data-fancybox="images" rel="group<?php echo $gallery_id;?>" title="Fullscreen" class="enlarge fancybox-button fancybox-button--fsenter"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"></path></svg><span class="sr">Fullscreen</span></a>
                </div>
              </div>
              <?php if ($galleries) { ?>
                <?php foreach ($galleries as $g) { ?>
                <div class="swiper-slide">
                  <div class="imgwrap">
                    <img src="<?php echo $dummy ?>" alt="<?php echo $g['title'] ?>" class="lozad" data-src="<?php echo $g['url'] ?>" />
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
    <?php }  
    $html_output = ob_get_contents();
    ob_end_clean();

    $data['result'] = $html_output;
    $data['show_more_button'] = $show_more_button;
    $result = json_encode($data);
    echo $result;
  }
  else {
    header("Location: ".$_SERVER["HTTP_REFERER"]);
  }

  die();
}

function get_gallery_entries($custom_class=null) {

}