<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cobyjames
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
    
    
		<?php
    
    $args = array(
      'post_type' => 'section',
      'orderby' => 'menu_order',
      'order' => 'ASC'
    );

    $child_query = new WP_Query( $args );
    
    while ( $child_query->have_posts() ) : $child_query->the_post(); 

    // the_title();
    
    $t_slug = get_page_template_slug();

    include(locate_template($t_slug, false, false));
    endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
