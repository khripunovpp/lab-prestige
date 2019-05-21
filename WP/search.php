<?php
get_header();
?>
<section class="main">
    <div class="container">
        <div class="main__inner">
            <?php get_template_part( 'sidebar-block' ); ?>
            <article class="main__content">
                 <?php get_search_form(); ?>
                <h1 class="main__title">Поиск: <?php the_search_query(); ?></h1>
                    <button class="showImplantList js-openlist">Перечень фрезеруемых систем имплантов</button>
                    <div class="case" <?php if (get_field('productstype')) echo "data-cost-type='".mb_strtolower(get_field('productstype'), 'UTF-8')."'"?> >
                        <div class="case__list">
                            <?php
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                            ?>
                                <div class="case__item product" data-id="<?php the_ID(); ?>">
                                    <?php if(get_the_post_thumbnail_url()) : ?>
                                        <img class="product__pic" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                                    <?php else : ?>
                                        <img class="product__pic" src="<?php echo get_theme_file_uri() ?>/img/no-pic.jpg" alt="">
                                    <?php endif; ?>
                                    <p class="product__name">
                                    <?php if(get_field('name')) : ?>
                                        <?php the_field('name'); ?>
                                    <?php else: ?>
                                        <?php if(in_category('category')) : ?>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <?php else : ?>
                                            <?php the_title(); ?>
                                        <?php endif; ?> 
                                    <?php endif; ?> 
                                    </p>
                                    <?php if( have_rows('prices') ): ?>
                                        <?php while( have_rows('prices') ): the_row(); ?>
                                            <p class="product__cost" 
                                            <?php if(get_sub_field('type')) echo "data-cost-type='".mb_strtolower(get_sub_field('type'), 'UTF-8')."'"?>
                                            >
                                                <?php if(get_sub_field('type')) : ?>
                                                    <span class="product__cost-type"><?php the_sub_field('type'); ?></span>
                                                <?php endif; ?>
                                                <strong class="product__cost-price"><?php the_sub_field('cost'); ?></strong>
                                                <button class="product__cost-btn">Заказать</button><a class="product__check" href="./korzina/" title="Просмотреть корзину"></a>
                                                <button class="product__delete" title="Удалить из корзины"></button>
                                            </p>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                            <?php
                            else :
                            echo " <p class='case__empty'>Извините по Вашему результату ничего не найдено</p>";
                            endif;
                            ?>
                        </div>
                    </div>
                <?php get_template_part( 'photogallery-block' ); ?>
                <?php get_template_part( 'contacts-block' ); ?>
            </article>
        </div>
    </div>
</section>
<?php the_field('scripts'); ?>
<?php get_footer(); ?>