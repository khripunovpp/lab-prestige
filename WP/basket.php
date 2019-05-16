<?php
/*
Template Name: Корзина
*/

get_header();
?>
<section class="main">
    <div class="container">
        <div class="main__inner">
            <?php get_template_part( 'sidebar-block' ); ?>
            <article class="main__content">
                <form class="basket empty" action="/wp-content/themes/lab/mail.php" id="basket-form" method="post">
                    <p class="basket__empty">Корзина пуста</p>
                    <div class="basket__step basket__step--delivery">
                        <p class="basket__step-title">Регион доставки
                            <button class="basket__edit" type="button">Изменить</button>
                        </p>
                        <div class="basket__step-body">
                            <div class="basket__group">
                                <p class="basket__group-label">Тип плательщика</p>
                                <div class="basket__group-radio checked">
                                    <input type="radio" name="role" value="Физическое лицо" checked required>Физическое лицо
                                </div>
                                <div class="basket__group-radio">
                                    <input type="radio" name="role" value="Юридическое лицо" required>Юридическое лицо
                                </div>
                            </div>
                            <div class="basket__group">
                                <p class="basket__group-label"><strong>*</strong> Местопложение</p>
                                <p class="basket__group-helper">Местоположение определено автоматически. Введите верный город при необходимости.</p>
                                <input class="basket__group-field" type="text" name="location" required>
                            </div>
                            <button class="basket__next" type="button">Далее</button>
                        </div>
                    </div>
                    <div class="basket__step basket__step--contacts disabled">
                        <p class="basket__step-title">Данные покупателя
                            <button class="basket__edit" type="button">Изменить</button>
                        </p>
                        <div class="basket__step-body">
                            <div class="basket__group">
                                <p class="basket__group-label"><strong>*</strong> ФИО</p>
                                <input class="basket__group-field" type="text" name="name" required>
                            </div>
                            <div class="basket__group">
                                <p class="basket__group-label"><strong>*</strong> E-mail</p>
                                <input class="basket__group-field" type="email" name="mail" required>
                            </div>
                            <div class="basket__group">
                                <p class="basket__group-label"><strong>*</strong> Телефон</p>
                                <input class="basket__group-field" type="tel" name="phone" required>
                            </div>
                            <div class="basket__group">
                                <p class="basket__group-label">Комментарии к доставке</p>
                                <textarea class="basket__group-field" rows="3" name="comments"></textarea>
                            </div>
                            <button class="basket__next" type="button">Далее</button>
                        </div>
                    </div>
                    <div class="basket__step basket__step--basket disabled">
                        <p class="basket__step-title">Товары в заказе</p>
                        <div class="basket__step-body">
                            <div class="basket__list"></div>
                            <p class="basket__total">Всего на сумму: <strong><span class="js-basketTotal">0 </span> <i class="currency"></i></strong></p>
                            <button class="basket__ok js-submit-basket" type="button">Оформить заказ</button>
                        </div>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
<?php the_field('scripts'); ?>
<?php get_footer(); ?>