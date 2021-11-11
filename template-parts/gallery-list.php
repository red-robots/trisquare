<?php $placeholder = get_bloginfo("template_url") . "/images/placeholder.png"; ?>
<div id="gallery<?php echo $gallery_id;?>" class="gallery-swiper animated fadeIn <?php echo (isset($custom_class)) ? $custom_class:''; ?>">
  <div class="gallery-wrap"> 
    <div id="galleryItem<?php echo $gallery_id;?>" data-id="<?php echo $gallery_id;?>" class="gallerySwipe">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="imgwrap">
            <img src="<?php echo $placeholder ?>" class="lozad" data-src="<?php echo $main_image['url'] ?>" alt="<?php echo $main_image['title'] ?>" />
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
    <img src="<?php echo $placeholder  ?>" alt="" aria-hidden="true" class="placeholder">
  </div>
  <div class="project-name"><span><?php echo $projectName; ?></span></div>
</div>