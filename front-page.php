<?php get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>


		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
