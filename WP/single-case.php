<?php
/*
Template Name: Категория товаров (в виде витрины)
Template Post Type: post
*/

get_header();
?>
<section class="main">
    <div class="container">
        <div class="main__inner">
            <?php get_template_part( 'sidebar-block' ); ?>
            <article class="main__content">
                <?php while ( have_posts() ) : the_post(); ?>
                    <h1 class="main__title"><?php the_title(); ?></h1>
                    <?php if(get_the_content()) : ?>
                        <div class="content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                    <button class="showImplantList js-openlist">Перечень фрезеруемых систем имплантов</button>
                    <div class="case" <?php if (get_field('productstype')) echo "data-cost-type='".mb_strtolower(get_field('productstype'), 'UTF-8')."'"?> >
                        <div class="case__list">
                        <?php if( have_rows('products') ): ?>
                            <?php while( have_rows('products') ): the_row(); ?>
                                <?php $item = get_sub_field('item'); ?>
                                <?php $id = $item->ID ?>
                                <div class="case__item product" data-id="<?php the_field('id', $id); ?>">
                                    <img class="product__pic" src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="">
                                    <p class="product__name"><?php echo get_the_title($item); ?></p>
                                    <?php if( have_rows('prices', $id) ): ?>
                                        <?php while( have_rows('prices', $id) ): the_row(); ?>
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
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php get_template_part( 'photogallery-block' ); ?>
                <?php get_template_part( 'contacts-block' ); ?>
            </article>
        </div>
    </div>
</section>
<?php the_field('scripts'); ?>
<?php get_footer(); ?>