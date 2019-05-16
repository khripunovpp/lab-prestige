<aside class="main__sidebar">
		<button class="main__sidebar-toggle">Каталог</button>
    <?php wp_nav_menu( array('menu' => 'Каталог', 'container' => false, 'walker' => new sideMenuWalker)); ?>
</aside>