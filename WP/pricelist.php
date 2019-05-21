<?php
/*
Template Name: Прайс
*/

get_header();
?>
<section class="main">
    <div class="container">
        <div class="main__inner">
            <?php get_template_part( 'sidebar-block' ); ?>
            <article class="main__content">
                <?php get_search_form(); ?>
                <h1 class="main__title"><?php the_title() ?></h1>
                <button class="showImplantList js-openlist">Перечень фрезеруемых систем имплантов</button>
                <?php 
                $args = array( 'category_name' => 'category', 'numberposts' => -1, 'order' => 'ASC');
                $lastposts = get_posts( $args );
                foreach( $lastposts as $post ){ setup_postdata($post); ?>
                    <div class="priceTable">
                        <div class="priceTable__category" data-link="<?php the_permalink() ?>" title="Перейти на страницу с товарами" <?php if (get_field('productstype')) echo "data-cost-type='".mb_strtolower(get_field('productstype'), 'UTF-8')."'" ?>><?php the_title(); ?></div>
                        <div class="priceTable__body">
                            <?php $posts = get_field('products1'); ?>
                        <?php foreach( $posts as $post):  ?>
                            <?php setup_postdata($post); ?>
                            <div class="priceTable__row" data-id="<?php the_ID(); ?>">
                                <div class="priceTable__name">
                                <?php if(get_field('name')) : ?>
                                    <?php the_field('name'); ?>
                                <?php else: ?>
                                    <?php the_title(); ?>
                                <?php endif; ?>
                                </div>
                                <div class="priceTable__order">
                                    <?php if( have_rows('prices') ): ?>
                                        <?php while( have_rows('prices') ): the_row(); ?>

                                        <div class="priceTable__cost" 
                                        <?php if(get_sub_field('type')) echo "data-cost-type='".mb_strtolower(get_sub_field('type'), 'UTF-8')."'"?>
                                        >
                                            <?php if(get_sub_field('type')) : ?>
                                                <div class="priceTable__pricetype"><?php the_sub_field('type'); ?></div>
                                            <?php endif; ?>
                                            <div class="priceTable__price"><?php the_sub_field('cost'); ?></div>
                                            <button class="priceTable__btn">Заказать</button><a class="priceTable__added" href="./korzina/">В корзине</a>
                                            <button class="priceTable__delete" title="Удалить из корзины"></button>
                                        </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata();?>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
                ?>
                <?php get_template_part( 'photogallery-block' ); ?>
                <?php get_template_part( 'contacts-block' ); ?>
            </article>
        </div>
    </div>
</section>
<?php get_footer(); ?>