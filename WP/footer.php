<?php 

$logo = get_field('logo', 'option');
$address = get_field('address', 'option');
$hours = get_field('hours', 'option');
$phone = get_field('phone', 'option');
$list = get_field('list', 'option');

$scripts = get_field('scriptsbody', 'option');


?>
        <footer class="footer">
            <div class="container">
                <div class="footer__inner"><a class="footer__logo" href=""><img src="<?php echo $logo ?>" alt=""></a>
                    <div class="footer__menu">
                        <?php wp_nav_menu( array('menu' => 'Футер', 'container' => false, 'menu_class' => '')); ?>
                    </div>
                    <div class="footer__additional">
                        <p class="footer__additional-caption">ПРАВОВАЯ ИНФОРМАЦИЯ</p>
                        <?php wp_nav_menu( array('menu' => 'Правовая информация', 'container' => false, 'menu_class' => '')); ?>
                    </div>
                    <div class="footer__contacts"><a class="footer__contacts-phone" href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
                        <p class="footer__contacts-hours"><?php echo $hours ?></p>
                        <div class="footer__contacts-address">
                            <p><?php echo $address ?></p>
                        </div>
                        <button class="footer__contacts-btn btn js-callback">Обратный звонок</button>
                    </div>
                </div>
                <p class="footer__disclamer">Информация, размещенная на сайте, не является публичной офертой. <br>Актуальную информацию о ценах, акциях и предложениях уточняйте по телефону.</p>
            </div>
        </footer>
    </div>
    <div class="callback overlay">
        <table class="callback__wrapper">
            <tbody>
                <tr>
                    <td class="callback__inner">
                        <?php echo do_shortcode('[contact-form-7 id="873" title="Обратный звонок" html_class="callback__box overlay-inner"]') ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="registration overlay">
        <table class="registration__wrapper">
            <tbody>
                <tr>
                    <td class="registration__inner">
                        <?php echo do_shortcode('[contact-form-7 id="872" title="Регистрация" html_class="registration__box overlay-inner"]') ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="response response--success overlay">
        <table class="response__wrapper">
            <tbody>
                <tr>
                    <td class="response__inner">
                        <div class="response__box">
                            <button class="response__close"></button>
                            <p class="response__title">Ваша заявка принята</p>
                            <p class="response__text">Спасибо за ваше доверие! В ближайшее время мы вам перезвоним.</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="response response--error overlay">
        <table class="response__wrapper">
            <tbody>
                <tr>
                    <td class="response__inner">
                        <div class="response__box">
                            <button class="response__close"></button>
                            <p class="response__title">Ошибка</p>
                            <p class="response__text">Что-то пошло не так. Пожалуйста, свяжитесь с нами удобным для вас способом.</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="implants overlay">
        <table class="implants__wrapper">
            <tbody>
                <tr>
                    <td class="implants__inner">
                        <div class="implants__box overlay-inner">
                            <button class="implants__close overlay-close"></button>
                            <p class="implants__title">Перечень фрезеруемых систем имплантов</p>
                            <div class="implants__list">
                                <?php echo $list ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <button class="pbm js-callback"></button>
    <script>
       var IP = '<?php echo do_shortcode('[show_user_ip]'); ?>';
       var POSTS = <?php echo wp_json_encode( get_posts( array( 'numberposts' => 5000000 ) ) ) ?>;
    </script>
    <?php echo $scripts ?>
    </body>

</html>

<?php wp_footer(); ?>