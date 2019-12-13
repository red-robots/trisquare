<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
$banner = get_slider();
get_header(); ?>

	<div id="primary" class="content-area cf default page404">
		<main id="main" class="site-main cf" role="main">

			<header class="entry-header wrapper">
				<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bellaworks' ); ?></h1>
			</header>
			
			<section class="section text-middle row1_text">
				<div class="wrapper">
					<div class="midtext">
						<span class="corner topleft"></span><span class="corner topright"></span>
						<span class="corner bottomleft"></span><span class="corner bottomright"></span>
						<div class="text">
							<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'bellaworks' ); ?></p>
						</div>
					</div>
				</div>
			</section>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
