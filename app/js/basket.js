var basket = {
    state: {},
    init: function() {
        var _that = this

        _that._update()

        $('.product:not(.added) .product__cost-btn').on('click', function(e) {
            _that._add.call(_that, e)
            $(this).closest('.product').addClass('added')
        })

        $('.product__delete').on('click', function(e) {
            _that._removeItem.call(_that, e)
        });

        $('.js-clear').on('click', function(e) {
            _that._clearBasket.call(_that, e)
        });
    },
    _add: function(event) {
        var _that = this

        var product = $(event.target).closest('.product'),
            cost = $(event.target).closest('.product__cost'),
            price = cost.find('.product__cost-price').text();

        _that._addBasket({
            id: product.attr('data-id'),
            quantity: "1",
            name: product.find('.product__name').text(),
            costType: cost.find('.product__cost-type').text(),
            price: price.substring(0, price.length - 5),
            thumb: product.find('.product__pic').attr('src'),
        })
    },
    _addBasket: function(prod) {
        var _that = this

        var basket = _that._getBasket()

        var id = prod.id

        basket.push(prod)

        $.cookie('basket', JSON.stringify(basket));
    },
    _getBasket: function() {
        return JSON.parse($.cookie('basket')) || []
    },
    _clearBasket: function() {
        var _that = this
        $.cookie('basket', null);

        _that._update()
    },
    _removeItem: function(event) {
        var _that = this

        var id = $(event.target).closest('.product').attr('data-id')

        var basket = _that._getBasket(),
            basketFinal = [];

        basket.map(function(elem, i) {
            if (elem.id !== id) basketFinal.push(elem)
        })

        $.cookie('basket', JSON.stringify(basketFinal));

        _that._update()
    },
    _update: function() {
        var _that = this

        var totalPrice = 0

        $('.product').removeClass('added')

        _that._getBasket().map(function(elem) {
            $('[data-id="' + elem.id + '"]').addClass('added')

            var prodItem = $('<div class="basket__item" data-id="' + elem.id + '"><div class="basket__item-info"> <button class="basket__item-delete" title="Удалить из корзины"></button></div></div>')
            if (elem.thumb) prodItem.prepend('<div class="basket__item-pic"><img src="' + elem.thumb + '" alt="" /></div>')
            prodItem.find('.basket__item-info').append('<p class="basket__item-name">' + elem.name + '</p>')
            prodItem.find('.basket__item-info').append('<p class="basket__item-costType">Тип цены: <strong>' + elem.costType + '</strong></p>')
            prodItem.find('.basket__item-info').append('<p class="basket__item-quantity">Колличество: <strong>' + elem.quantity + ' шт.</strong></p>')
            prodItem.find('.basket__item-info').append('<p class="basket__item-price">' + elem.price + ' руб.</p>')

            totalPrice += Number(elem.price)

            $('.basket__list').append(prodItem)
        })

        $('.js-basketTotal').text(totalPrice)
    }
}

$(function() {
    basket.init()
}())