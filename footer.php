	</div><!-- #content -->
	
	<?php  
		$foot_logo = get_field("foot_logo","option");
		$address = get_field("address","option");
		$phone = get_field("phone","option");
		$social = get_social_links();
		$accolades = get_field("accolades","option");
	?>
	<footer id="colophon" class="site-footer cf" role="contentinfo">
		<div class="full-wrapper">
			<div class="flexwrap cf">
				<div class="footcol left">
				<?php if ($foot_logo) { ?>
					<div class="logo-img"><img src="<?php echo $foot_logo['url'] ?>" alt="<?php echo $foot_logo['title'] ?>" /></div>
				<?php } ?>
				</div>
				<div class="footcol right">
					<div class="inside">
						
						<?php if ($address || $phone) { ?>
						<div class="flexcol contact-info">
							<?php if ($address) { ?>
							<div class="cinfo"><?php echo $address ?></div>	
							<?php } ?>
							<?php if ($phone) { ?>
							<div class="cinfo"><a href="tel:<?php echo format_phone_number($phone); ?>"><?php echo $phone ?></a></div>	
							<?php } ?>
						</div>
						<?php } ?>

						<?php wp_nav_menu( array( 'menu' => 'Footer', 'menu_id' => 'footer-menu','container_class'=>'flexcol footer-menu-wrap' ) ); ?>

						<?php if ($social) { ?>
						<div class="flexcol social col6">
							<div class="ftitle">Follow Us</div>
							<?php foreach ($social as $k=>$s) { ?>
							<a href="<?php echo $s['link'] ?>"><span class="sr"><?php echo $k ?></span><i class="<?php echo $s['icon'] ?>"></i></a>	
							<?php } ?>
						</div>	
						<?php } ?>

						<?php if ($accolades) { ?>
						<div class="flexcol accolades col6">
							<div class="ftitle">Accolades</div>
							<?php foreach ($accolades as $a) { ?>
							<img src="<?php echo $a['url'] ?>" alt="<?php echo $a['title'] ?>" />	
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<div id="loaderOverlay"><div class="loaderSpin">Loading...</div></div>
<?php wp_footer(); ?>

</body>
</html>
