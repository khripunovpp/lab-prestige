var ajax = function(form, attach) {

    var formtarget = form,
        msg = { userData: $(formtarget).serializeArray(), basket: attach },
        jqxhr = $.post("/ajax.php", msg, onAjaxSuccess);

    function onAjaxSuccess(data) {

        var json = JSON.parse(data),
            status = json.status,
            message = json.message,
            formid = json.form;

        if (status === 'success') {
            $('input, textarea, button[type=submit]').each(function() {
                $(this).prop("disabled", "true");
            });
        }

        addNotify(status, message, formid)
    }

    var addNotify = function(status, msg, form) {
        var responsePopup = status === 'error' ? $('.response--error') : $('.response--success')

        responsePopup.fadeIn();
        $('.modal').fadeOut();
        $('.popup').fadeOut();

        setTimeout(function() {
            responsePopup.fadeOut();
        }, 2000)
    }
}

var basket = {
    state: {},
    init: function() {
        var _that = this

        _that.basket = $('.basket')

        _that.confrimPopup = $('.addConfirm')

        _that._update()

        $('body').on('click', '.product:not(.added) .product__cost-btn, .priceTable__row:not(.added) .priceTable__btn', function(e) {
            _that._add.call(_that, e)
            _that.confrimPopup.hide()
        })

        $('body').on('click', '.product__delete, .basket__item-delete, .priceTable__delete', function(e) {
            _that._removeItem.call(_that, e)
        });

        $('.js-clear').on('click', function(e) {
            _that._clearBasket.call(_that, e)
        });

        _that._steps()
    },
    _add: function(event) {
        var _that = this

        var target = $(event.target),
            product, cost, price, name, costType, quantity, thumb;


        product = $(event.target).closest('.product, .priceTable__row')

        id = product.attr('data-id')
        cost = $(event.target).closest('.product__cost, .priceTable__cost')
        price = cost.find('.product__cost-price, .priceTable__price').text()
        name = product.find('.product__name, .priceTable__name').text()
        costType = cost.find('.product__cost-type, .priceTable__priceType').text() || product.closest('.priceTable').find('.priceTable__category-priceType').text()
        price = price.substring(0, price.length - 5)
        thumb = product.find('.product__pic').attr('src')
        quantity = 1

        product.addClass('added')

        var item = {
            id: id,
            quantity: quantity,
            name: name,
            costType: costType || null,
            price: price,
            thumb: thumb || null
        }

        _that._addBasket(item)

    },
    _addBasket: function(prod) {
        var _that = this

        var basket = _that._getBasket()

        var id = prod.id

        basket.push(prod)

        $.cookie('basket', JSON.stringify(basket));

        _that._update()
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

        var id = $(event.target).closest('.product, .basket__item, .priceTable__row').attr('data-id')

        var basket = _that._getBasket(),
            basketFinal = [];

        basket.map(function(elem, i) {
            if (elem.id !== id) basketFinal.push(elem)
        })

        $(event.target).closest('.basket__item').fadeOut()

        $.cookie('basket', JSON.stringify(basketFinal));

        _that._update()
    },
    _update: function() {
        var _that = this

        var totalPrice = 0

        $('.product, .priceTable__row').removeClass('added')
        $('.basket__list').html('')

        var basket = _that._getBasket()

        basket.map(function(elem) {
            $('[data-id="' + elem.id + '"]').addClass('added')

            var prodItem = $('<div class="basket__item" data-id="' + elem.id + '"><div class="basket__item-info"> <button class="basket__item-delete" type="button">Удалить</button></div></div>')
            if (elem.thumb) prodItem.prepend('<div class="basket__item-pic"><img src="' + elem.thumb + '" alt="" /></div>')
            prodItem.find('.basket__item-info').append('<p class="basket__item-name">' + elem.name + '</p>')
            if(elem.costType) prodItem.find('.basket__item-info').append('<p class="basket__item-costType">Тип цены: <strong>' + elem.costType + '</strong></p>')
            prodItem.find('.basket__item-info').append('<p class="basket__item-quantity">Колличество: <strong>' + elem.quantity + ' шт.</strong></p>')
            prodItem.find('.basket__item-info').append('<p class="basket__item-price">' + elem.price + ' руб.</p>')

            totalPrice += Number(elem.price)

            $('.basket__list').append(prodItem)
        })

        basket.length <= 0 ? _that.basket.addClass('empty') : _that.basket.removeClass('empty')

        $('.js-basketTotal').text(totalPrice)
    },
    _steps: function() {
        var _that = this

        var inputs = $('input, textarea').filter('[required]')

        var activeStep, errors = 0

        $('[name="location"]').length > 0 && setLocation()

        $(inputs).on('blur', function() {
            removeError($(event.target))
        });

        $('[type="radio"]').on('click', function() {
            $(this).closest('.basket__group-radio').addClass('checked').siblings().removeClass('checked')
        });

        $('.basket__next').on('click', function(event) {
            event.preventDefault();

            inputs = $('input, textarea', $(event.target).closest('.basket__step-body')).filter('[required]')

            inputs.each(function(index, el) {
                $(el).val().length === 0 && setError($(el).closest('.basket__group'))
            });

            nextStep($(event.target).closest('.basket__step'))
        });

        $('.basket__ok').on('click', submit)

        function setError(el) {
            if (!el.hasClass('invalid')) el.addClass('invalid').append('<p class="basket__group-error">Это обязательное поле</p>'), errors++
        }

        function removeError(el) {
            if (el.val().length > 0) el.closest('.basket__group').removeClass('invalid').find('.basket__group-error').remove(), errors--
        }

        function nextStep(prev) {
            activeStep = $(prev)

            if (errors <= 0) activeStep.addClass('disabled done').next().removeClass('disabled'), errors = 0
        }

        function submit() {
            var basket = _that._getBasket()

            if (basket.length > 0) {
                ajax(_that.basket, basket)

                ////

                $('.response--success').fadeIn(100);
            } else {
                _that.basket.addClass('error')
            }
        }

        function setLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    $.ajax({
                        url: 'https://geocode-maps.yandex.ru/1.x/?geocode=' + position.coords.longitude + ',' + position.coords.latitude,
                        success: function(data) {
                            $('[name="location"]').val($(data).find('featureMember').eq(0).find('description').text())
                        }
                    });
                });
            }
        }
    }
}

$(function() {
    basket.init()
}())