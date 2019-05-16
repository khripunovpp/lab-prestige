<?php
/*
Template Name: Работы
*/

get_header();
?>
<section class="main">
    <div class="container">
        <div class="main__inner">
            <?php get_template_part( 'sidebar-block' ); ?>
            <article class="main__content">
                <h1 class="main__title"><?php the_title(); ?></h1>
                <div class="content">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                </div>
                <div class="portfolio">
                    <?php if( have_rows('portfolio') ): ?>
                        <?php while( have_rows('portfolio') ): the_row(); ?>
                            <div data-thumb="<?php the_sub_field('img'); ?>" data-src="<?php the_sub_field('img'); ?>">
                                <img src="<?php the_sub_field('img'); ?>" />
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <?php get_template_part( 'contacts-block' ); ?>
            </article>
        </div>
    </div>
</section>
<?php get_footer(); ?>