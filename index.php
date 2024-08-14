<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jobs-info
 */

get_header();

?>

	<main id="primary" class="site-main">
	<h2 class="text-center my-4">Welcome to the Job Listings Platform. <a href="<?php esc_url( home_url()) ?>/jobs/" class="btn-btn-primary">View All Jobs</a></h2>
		<?php
		if ( have_posts() ) :
		while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
