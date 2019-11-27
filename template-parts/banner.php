<?php
$homeBanner = ( is_front_page() ) ? 'homepage':'subpage';
$banner = get_field('banner');
if($banner) { ?>
<div class="banner-wrap <?php echo $homeBanner ?>">
	<div class="slideItem">
		<img src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>" />
	</div>
</div>
<?php } ?>