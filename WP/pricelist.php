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
                <h1 class="main__title"><?php the_title() ?></h1>
                <button class="showImplantList js-openlist">Перечень фрезеруемых систем имплантов</button>
                        <div class="priceTable">
                            <div class="priceTable__category" data-link="single.html" title="Перейти на страницу с товарами">ZrO2 для каркасов CAD/CAM</div>
                            <div class="priceTable__body">
                                <div class="priceTable__row" data-id="radfbvf">
                                    <div class="priceTable__name">Zimmer, Mis, AlphaBio, Adin, BioGorizont, Conmet</div>
                                    <div class="priceTable__order">
                                        <div class="priceTable__cost" data-cost-type="по stl файлу">
                                            <div class="priceTable__pricetype">По STL файлу</div>
                                            <div class="priceTable__price">1500</div>
                                            <button class="priceTable__btn">Заказать</button><a class="priceTable__added" href="basket.html">В корзине</a>
                                            <button class="priceTable__delete" title="Удалить из корзины"></button>
                                        </div>
                                        <div class="priceTable__cost" data-cost-type="с уровня модели">
                                            <div class="priceTable__pricetype">С уровня модели</div>
                                            <div class="priceTable__price">43534</div>
                                            <button class="priceTable__btn">Заказать</button><a class="priceTable__added" href="basket.html">В корзине</a>
                                            <button class="priceTable__delete" title="Удалить из корзины"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="priceTable__row" data-id="nzf">
                                    <div class="priceTable__name">Zimmer, Mis, AlphaBio, Adin, BioGorizont, Conmet</div>
                                    <div class="priceTable__order">
                                        <div class="priceTable__cost" data-cost-type="с уровня модели">
                                            <div class="priceTable__pricetype">С уровня модели</div>
                                            <div class="priceTable__price">43534</div>
                                            <button class="priceTable__btn">Заказать</button><a class="priceTable__added" href="basket.html">В корзине</a>
                                            <button class="priceTable__delete" title="Удалить из корзины"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="priceTable__row" data-id="hzdfbz">
                                    <div class="priceTable__name">Индивидуальный абатмент ZrO2 Prettau на титановом основании</div>
                                    <div class="priceTable__order">
                                        <div class="priceTable__cost" data-cost-type="по stl файлу">
                                            <div class="priceTable__pricetype">По STL файлу</div>
                                            <div class="priceTable__price">1500</div>
                                            <button class="priceTable__btn">Заказать</button><a class="priceTable__added" href="basket.html">В корзине</a>
                                            <button class="priceTable__delete" title="Удалить из корзины"></button>
                                        </div>
                                        <div class="priceTable__cost" data-cost-type="с уровня модели">
                                            <div class="priceTable__pricetype">С уровня модели</div>
                                            <div class="priceTable__price">345</div>
                                            <button class="priceTable__btn">Заказать</button><a class="priceTable__added" href="basket.html">В корзине</a>
                                            <button class="priceTable__delete" title="Удалить из корзины"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php get_template_part( 'photogallery-block' ); ?>
                <?php get_template_part( 'contacts-block' ); ?>
            </article>
        </div>
    </div>
</section>
<?php get_footer(); ?>