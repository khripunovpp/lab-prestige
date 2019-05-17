<?php 

$logo = get_field('logo', 'option');
$address = get_field('address', 'option');
$hours = get_field('hours', 'option');
$phone = get_field('phone', 'option');

?>
<!DOCTYPE html>
<html>

<head>
	<base href=<?php echo get_site_url(); ?>>
	<meta charset="utf-8">
	<title></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" href="<?php echo get_theme_file_uri() ?>/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700,900">
	<meta name="theme-color" content="#3a5ca4">
	<meta name="yandex-verification" content="db61e0885a6c9178" />
	<?php wp_head(); ?>
</head>

<body>
	<div class="mobileMenu">
		<div class="mobileMenu__section">
			<div class="lk"><a class="lk__item lk__item--lk" href="">Личный кабинет</a>
				<button class="lk__item lk__item--reg">Регистрация</button><a class="lk__item lk__item--basket" href="basket.html">Корзина  <strong class="js-basket">0</strong></a>
			</div>
		</div>
		<div class="mobileMenu__section">
			<div class="mobileMenu__main">
				<?php wp_nav_menu( array('menu' => 'Главное меню', 'container' => false, 'menu_class' => '')); ?>
			</div>
		</div>
		<div class="mobileMenu__section">
			<div class="mobileMenu__phone"><a href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
				<p><?php echo $hours ?></p>
			</div>
			<div class="mobileMenu__address">
				<p><?php echo $address ?></p>
			</div>
			<div class="mobileMenu__cb btn btn--ghost js-callback">Обратный звонок</div>
		</div>
	</div>
	<div class="w-page">
		<header class="header">
			<div class="container">
				<div class="header__inner"><a class="header__logo" href="/"><img src="<?php echo $logo ?>" alt="LabPrestige"></a>
					<div class="header__contacts">
						<div class="header__address">
							<p><?php echo $address ?></p>
						</div>
						<div class="header__phone"><a href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
							<p><?php echo $hours ?></p>
						</div>
					</div>
					<div class="header__cb">
						<button class="btn btn--ghost js-callback">Обратный звонок</button>
					</div>
					<div class="header__lk lk"><a class="lk__item lk__item--lk" href="">Личный кабинет</a>
						<button class="lk__item lk__item--reg">Регистрация</button><a class="lk__item lk__item--basket" href="./korzina/">Корзина <strong class="js-basket">0</strong></a>
					</div>
					<button class="header__burger">Меню</button>
				</div>
			</div>
		</header>
		<nav class="nav">
			<div class="container">
				<div class="nav__inner">
					<?php 
						$args = array(
							'order'                  => 'ASC',
							'orderby'                => 'menu_order',
							'output'                 => ARRAY_A,
							'output_key'             => 'menu_order',
							'update_post_term_cache' => false,
						);

						$menu_items = wp_get_nav_menu_items( 3, $args );

						foreach ( (array) $menu_items as $key => $menu_item ){
							$item_url = esc_attr( $menu_item->url );
							if ( $item_url == 'http://labprestige.com/prajs/' ) {
								$class = 'nav__item--hasSubMenu';
							} else {
								$class = '';
							}
							echo '<a href="' . $item_url . '" class="nav__item '.$class.'">' . $menu_item->title . '</a>';
						}
					 ?>
				</div>
				<div class="nav__menu"></div>
			</div>
		</nav>