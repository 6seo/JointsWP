<?php
/**
 * Displays archive pages if a speicifc template is not set. 
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header(); ?>
<div class="container">		
	<div class="content margin-top-2">
	
		<div class="inner-content grid-x grid-margin-x grid-padding-x">
		
		    <main class="main small-12 medium-8 large-8 cell" role="main">
			    
		    	<header>
					
		    		<h1 class="page-title" cat="<?php  ?>"><?php the_archive_title();?></h1>
					<?php the_archive_description('<div class="taxonomy-description">', '</div>');?> 
		    	</header>
				<div class="grid-x grid-margin-x grid-padding-x archive-grid card-grid" data-equalizer data-ajax="target"> <!--Begin Grid-->
		    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			 	
					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'archive-grid-card' ); ?>
				    
				<?php endwhile; ?>	
				</div>  <!--End Grid --> 
					<?php get_template_part( 'parts/load-more') ?> 
					<?php //joints_page_navi(); ?>
					
				<?php else : ?>
											
					<?php get_template_part( 'parts/content', 'missing' ); ?>
						
				<?php endif; ?>
		
			</main> <!-- end #main -->
	
			<?php get_sidebar(); ?>
	    
	    </div> <!-- end #inner-content -->
	    
	</div> <!-- end #content -->
</div>	
<?php get_footer(); ?>