<?php
/**
 * The template part for displaying a grid of posts
 *
 * For more info: http://jointswp.com/docs/grid-archive/
 */

// Adjust the amount of rows in the grid
 ?>

<!--Item: -->
<div class="small-6 medium-3 large-3 cell panel">
	<div id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
		<?php the_post_thumbnail('medium'); ?>
		<div class="card-info">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3 class="card-title h4"><?php the_title(); ?></h3></a>
			<div class="card-category">
				<i>by</i>
				<?php item_author(); ?> 
				in 
				<?php item_category(); ?>

			</div>
		<?php if ( get_field('item_rating')) : ?>
		<div class="card-star"><?php $rating = get_field('item_rating', false, false); echo '<span>'. $rating .''; ?></span> </div>
		<?php endif; ?>
		<p class="card-stats">6 <img src="https://placehold.it/20" alt="hi" /> 6 <img src="https://placehold.it/20" alt="hi" /></p>
		</div>
	</div>	
</div>






