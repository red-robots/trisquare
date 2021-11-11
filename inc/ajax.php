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
      if($main_image) { 
        $custom_class = 'new';
        include( locate_template('template-parts/gallery-list.php') );
        ?>
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