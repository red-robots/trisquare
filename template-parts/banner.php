<?php
$homeBanner = ( is_front_page() ) ? 'homepage':'subpage';
$slides = get_slider();
$count = 0;
if( isset($slides['url']) && $slides['url'] ) {
	$count = 0;
} else {
	$count = ($slides) ? count($slides) : 0; 
}

$slidesId = ($count>1) ? 'slideshow':'static-banner';
$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";

if( is_front_page() ) {
	if( $slides ) {  ?>
		<div id="<?php echo $slidesId ?>" class="swiper-container banner-wrap cf homepage">
			<div class="swiper-wrapper">

				<?php if ( isset($slides['url']) && $slides['url'] ) { ?>

					<div class="swiper-slide slideItem" style="background-image:url('<?php echo $slides['url'] ?>');">
						<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
					</div>

				<?php } else { ?>

					<?php foreach ($slides as $img) { 
							$title = $img['title'];
							$caption = $img['caption'];
						?>
	    				<div class="swiper-slide slideItem" style="background-image:url('<?php echo $img['url'] ?>');">
	    					<?php if ($caption) { ?>
	    					<div class="slideCaption">
		    					<div class="slideInside animated">
		    						<div class="slideMid">
			    						<?php if ($title) { ?>
			    						<h2 class="slideTitle"><?php echo $title; ?></h2><br>
			    						<?php } ?>
			    						<?php if ($caption) { ?>
			    						<div class="slideText"><?php echo $caption; ?></div>	
			    						<?php } ?>
		    						</div>
	    						</div>
	    					</div>
	    					<?php } ?>
	    					<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
	    				</div>
	    			<?php } ?>

				<?php } ?>

			</div>

			<?php if ($count>1) { ?>
			    <div class="swiper-pagination"></div>
			    <div class="swiper-button-next"></div>
			    <div class="swiper-button-prev"></div>
			<?php } ?>
		</div>
	<?php } ?>

<?php } else { ?>
	
	<?php if( $slides ) {  ?>
	<div id="static-banner" class="banner-wrap cf subpage">
		<div class="banner-image cf">
			<img src="<?php echo $slides['url'] ?>" alt="<?php echo $slides['title'] ?>" />
		</div>
	</div>
	<?php } ?>

<?php } ?>