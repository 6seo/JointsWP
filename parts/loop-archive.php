<?php
/**
 * Template part for displaying posts
 *
 * Used for single, index, archive, search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">					
	
	<header class="article-header">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'parts/content', 'byline' ); ?>
	</header> <!-- end article header -->
					
	<section class="entry-content" itemprop="text">
		<a class="" href="<?php the_permalink() ?>"><?php the_post_thumbnail('full'); ?></a>
		<p class=""><?php echo wp_trim_words( get_the_content(), 40, '<button class="hollow button tiny margin-left-1 margin-top-1">' . __( 'Read more...', 'jointswp' ) . '</button>' );?></p>
	</section> <!-- end article section -->
						
	<footer class="article-footer">
    	<p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'jointswp') . '</span> ', ', ', ''); ?></p>
	</footer> <!-- end article footer -->	
				    						
</article> <!-- end article -->

