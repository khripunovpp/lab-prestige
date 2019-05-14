<?php
/*
Template Name: Главная
*/

get_header();
?>
<section class="main">
    <div class="container">
        <div class="main__inner">
            <?php get_template_part( 'sidebar-block' ); ?>
            <article class="main__content">
                <div class="hero"><img src="<?php echo get_theme_file_uri() ?>/img/hero.jpg" alt="">
                    <p class="hero__text">ЦИРКОНОВЫЕ КАРКАСЫ <br>ТИТАНОВЫЕ ОСНОВАНИЯ <br>АБАТМЕНТЫ
                        <button class="hero__btn js-callback">Обратный звонок</button>
                    </p>
                </div>
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
<?php get_footer(); ?>