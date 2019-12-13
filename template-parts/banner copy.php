<?php
$homeBanner = ( is_front_page() ) ? 'homepage':'subpage';
$slides = get_field('banner');
$count = 0;
if( isset($slides['url']) && $slides['url'] ) {
	$count = 0;
} else {
	$count = count($slides); 
}

$slidesId = ($count>1) ? 'slideshow':'static-banner';
$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
if($slides) { ?>
<div id="<?php echo $slidesId ?>" class="banner-wrap cf <?php echo $homeBanner ?>">

	<div class="swiper-container slideItem">
		<?php if ($count>1) { ?>
			<?php foreach ($slides as $img) { ?>
				<div class="swiper-slide" style="background-image:url('<?php echo $img['url'] ?>');">
					<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" style="visibility:hidden"/>
				</div>
			<?php } ?>
		<?php } else { ?>
			<div class="swiper-slide">
				<img src="<?php echo $slides['url'] ?>" alt="<?php echo $slides['title'] ?>" />
			</div>
		<?php } ?>
	</div>
	
	<?php if ($count>1) { ?>
	    <div class="swiper-pagination"></div>
	    <div class="swiper-button-next"></div>
	    <div class="swiper-button-prev"></div>
	<?php } ?>
</div>
<?php } ?>