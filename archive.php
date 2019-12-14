<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

$obj = get_queried_object();
$taxonomy = ( isset($obj->taxonomy) && $obj->taxonomy ) ? $obj->taxonomy : '';
$currentCategory = ( isset($obj->name) && $obj->name ) ? $obj->name : '';
get_header(); ?>

	<div id="primary" class="content-area cf default archivepage">
		<main id="main" class="site-main wrapper cf" role="main">

		<?php if( $taxonomy == 'project-categories' ) { ?>

			<?php get_template_part('template-parts/content','projects-list'); ?>

		<?php } else { ?>

			<?php if ( have_posts() ) : ?>

				<!-- <header class="page-header">
					<?php
						//the_archive_title( '<h1 class="page-title">', '</h1>' );
						//the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header> -->

				<section class="section text-middle">
					<div class="wrapper">
						<div class="midtext">
							<span class="corner topleft"></span><span class="corner topright"></span>
							<span class="corner bottomleft"></span><span class="corner bottomright"></span>
							<div class="text"><?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); ?></div>
						</div>
					</div>
				</section>

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
