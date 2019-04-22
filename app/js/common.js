$(function() {
    $('.main__sidebar .menu__item').on('click', 'span', function() {
        $(this).closest('.menu__item').find('ul').slideToggle()
    });

    $('.search input').on('focus', function() {
        $(this).closest('.search').addClass('focus')
    });

     $('.search input').on('blur', function() {
        if($(this).val().length === 0) $(this).closest('.search').removeClass('focus')
    });
});