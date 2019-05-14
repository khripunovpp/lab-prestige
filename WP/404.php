<?php
get_header();
?>
<section class="main">
    <div class="container">
        <div class="main__inner">
            <?php get_template_part( 'sidebar-block' ); ?>
            <article class="main__content">
                <h1 class="main__title">Страницы не существует</h1>
                <?php get_template_part( 'contacts-block' ); ?>
                <?php get_template_part( 'photogallery-block' ); ?>
            </article>
        </div>
    </div>
</section>
<?php get_footer(); ?>