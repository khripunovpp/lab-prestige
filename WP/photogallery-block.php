<ul class="photoGallery">
		<?php if( have_rows('photogallery', 'option') ): ?>
        <?php while( have_rows('photogallery', 'option') ): the_row(); ?>
            <li data-thumb="<?php the_sub_field('img'); ?>" data-src="<?php the_sub_field('img'); ?>">
					    <img src="<?php the_sub_field('img'); ?>" />
					  </li>
        <?php endwhile; ?>
    <?php endif; ?>
</ul>