<?php
get_header();
?>
<section class="main">
    <div class="container">
        <div class="main__inner">
            <?php get_template_part( 'sidebar-block' ); ?>
            <article class="main__content">
                <?php get_search_form(); ?>
                <h1 class="main__title"><?php the_title(); ?></h1>
                <div class="content">
                <?php while ( have_posts() ) : the_post(); ?>
                  <?php the_content(); ?>
                <?php endwhile; ?>
                </div>
                <?php get_template_part( 'photogallery-block' ); ?>
                <?php get_template_part( 'contacts-block' ); ?>
            </article>
        </div>
    </div>
</section>
<?php the_field('scripts'); ?>
<?php get_footer(); ?>