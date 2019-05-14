<?php 

$pic = get_field('contactspic', 'option');
$address = get_field('address', 'option');
$hours = get_field('hours', 'option');
$phone = get_field('phone', 'option');
$email = get_field('email', 'option');
$map = get_field('map', 'option');

?>
<div class="contacts">
    <div class="contacts__head">
        <div class="contacts__photo" style="background-image: url(<?php echo $pic ?>)"></div>
        <div class="contacts__map">
            <?php echo $map ?>
        </div>
    </div>
    <div class="contacts__body"><span class="contacts__caption">Контактные данные</span>
        <div class="contacts__left">
            <ul class="contacts__list">
                <li class="contacts__item contacts__item--address"><span class="contacts__term">Адрес:</span><span class="contacts__desc"><?php echo $address ?></span></li>
                <li class="contacts__item"><span class="contacts__term">Телефон:</span><a class="contacts__desc" id="comagic_phone2" href="tel:<?php echo $phone ?>"><?php echo $phone ?></a></li>
                <li class="contacts__item"><span class="contacts__term">E-mail:</span><a class="contacts__desc" href="mailto:<?php echo $email ?>"><?php echo $email ?></a></li>
                <li class="contacts__item"><span class="contacts__term">Время работы:</span><span class="contacts__desc"><?php echo $hours ?></span></li>
            </ul>
        </div>
        <div class="contacts__right">
            <button class="contacts__btn btn js-callback">Обратный звонок</button>
        </div>
    </div>
</div>