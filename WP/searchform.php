<form class="search" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>"  >
	<input type="text" class="search__field" name="s" id="s" placeholder="Введите название товара" value="<?php echo get_search_query() ?>">
	<button type="submit" class="search__btn" id="searchsubmit"></button>
	<input type="hidden" value="post" name="post_type" />
	<input type="hidden" value="post" name="post_type" />
</form>