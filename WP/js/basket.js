var ajax = function(form, attach, sum) {

    var formtarget = form,
        msg = { userdata: $(formtarget).serialize(), basket: attach, sum: sum },
        jqxhr = $.post("/wp-content/themes/lab/ajax.php", msg, onAjaxSuccess);

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

        status === 'success' && basket._clearBasket()
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

        $('body').on('click', '.basket__item-quantity button', function(e) {
            _that._quantity.call(_that, e)
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
        costType = cost.find('.product__cost-type, .priceTable__pricetype').text() || product.closest('.priceTable').find('.priceTable__category').attr('data-cost-type') || product.closest('.case').attr('data-cost-type') || ''
        thumb = product.find('.product__pic').attr('src')
        quantity = 1

        cost.addClass('added')

        var item = {
            id: id,
            quantity: quantity,
            name: name,
            costType: costType.toLowerCase() || '',
            price: price,
            thumb: thumb || ''
        }

        _that._addBasket(item)

    },
    _addBasket: function(prod) {
        var _that = this

        var basket = _that._getBasket()

        var id = prod.id,
            costType = prod.costType;

        basket.map(function(el) {
            if (el.id === id && el.costType === costType) {
                el.quantity++
            }
        })

        basket.push(prod)

        localStorage.setItem('basket', JSON.stringify(basket));

        _that._update()
    },
    _getBasket: function() {
        return JSON.parse(localStorage.getItem('basket')) || []
    },
    _clearBasket: function() {
        var _that = this
        localStorage.setItem('basket', null);

        _that._update()
    },
    _removeItem: function(event) {
        var _that = this

        var id = $(event.target).closest('.product, .basket__item, .priceTable__row').attr('data-id'),
            costType = $(event.target).closest('.product__cost, .basket__item, .priceTable__cost').attr('data-cost-type') || $(event.target).closest('.priceTable').find('.priceTable__category').attr('data-cost-type') || '';

        var basket = _that._getBasket(),
            basketFinal = [];

        basket.map(function(elem, i) {
            if (String(elem.id) !== id || String(elem.costType) !== costType) basketFinal.push(elem)
        })

        $(event.target).closest('.basket__item').fadeOut()

        localStorage.setItem('basket', JSON.stringify(basketFinal));

        _that._update()
    },
    _quantity: function(event) {
        var _that = this

        var button = $(event.target),
            item = button.closest('.basket__item'),
            countEl = item.find('.js-quantity'),
            sumEl = item.find('.js-quantity-sum'),
            costEl = item.find('.js-cost'),
            totalSum = 0;

        var basket = _that._getBasket()

        var id = item.attr('data-id'),
            costType = item.attr('data-cost-type') || '';

        if (button.hasClass('js-quantity-less')) {
            var currentCount = Number(countEl.eq(0).text());
            currentCount > 1 && setQuantity(+currentCount - 1);
        } else {
            var currentCount = Number(countEl.eq(0).text());
            setQuantity(+currentCount + 1);
        }

        function setQuantity(q) {
            countEl.text(q)
            updateSum(q)

            basket.map(function(el) {
                if (String(el.id) === id && String(el.costType) === costType)  el.quantity = q
            })
        }

        function updateSum(q) {
            sumEl.text(Number(costEl.text()) * q)

            $('.js-quantity-sum').each(function(i, el) {
                totalSum += Number($(el).text())
            })

            $('.js-basketTotal').text(totalSum)
        }

        localStorage.setItem('basket', JSON.stringify(basket));
    },
    _update: function() {
        var _that = this

        var totalPrice = 0, 
        totalQuantity = 0

        $('.product__cost, .priceTable__cost').removeClass('added')
        $('.basket__list').html('')

        var basket = _that._getBasket()

        basket.map(function(elem) {
            if (elem.costType) {
                $('[data-id="' + elem.id + '"]').find('.product__cost[data-cost-type="' + elem.costType + '"], .priceTable__cost[data-cost-type="' + elem.costType + '"]').addClass('added')
                $('.priceTable').find('.priceTable__category[data-cost-type="' + elem.costType + '"]').closest('.priceTable').find('[data-id="' + elem.id + '"]').find('.priceTable__cost').addClass('added')
                $('.case[data-cost-type="' + elem.costType + '"]').find('[data-id="' + elem.id + '"]').find('.product__cost').addClass('added')
            } else {
                $('[data-id="' + elem.id + '"]').find('.product__cost, .priceTable__cost').addClass('added')
            }

            renderBasketItem(elem)
        })

        basket.length <= 0 ? _that.basket.addClass('empty') : _that.basket.removeClass('empty')

        $('.js-basketTotal').text(totalPrice)

        function renderBasketItem(elem) {
            var prodItem = $('<div class="basket__item" data-id="' + elem.id + '" data-cost-type="' + elem.costType + '"><div class="basket__item-info"> <button class="basket__item-delete" type="button">Удалить</button></div></div>')
            
            if (elem.thumb) prodItem.prepend('<div class="basket__item-pic"><img src="' + elem.thumb + '" alt="" /></div>')
           
            prodItem.find('.basket__item-info').append('<p class="basket__item-name">' + elem.name + '</p>')
           
            if (elem.costType) prodItem.find('.basket__item-info').append('<p class="basket__item-costType">Тип цены: <strong>' + elem.costType + '</strong></p>')
           
            prodItem.find('.basket__item-info').append('<p class="basket__item-quantity">Колличество: <button class="basket__item-less js-quantity-less" type="button"></button><strong><span class="js-quantity">' + elem.quantity + '</span> шт.</strong><button class="js-quantity-more basket__item-more" type="button"></button></p>')
            prodItem.find('.basket__item-info').append('<p class="basket__item-price"><span class="js-quantity">' + elem.quantity + '</span> шт. x <span class="js-cost">' + elem.price + '</span> <i class="currency"></i> = <span class="js-quantity-sum">' + elem.quantity * elem.price + '</span> <i class="currency"></i></p>')

            totalPrice += Number(elem.quantity * elem.price)

           totalQuantity += Number(elem.quantity)

            $('.basket__list').append(prodItem)
        }

        $('.js-basket').text(totalQuantity)
    },
    _steps: function() {
        var _that = this

        var inputs = $('input, textarea').filter('[required]')

        var activeStep, errors = 0

        setLocation()

        $(inputs).on('blur', function() {
            removeError($(event.target))
        });

        $('[type="radio"]').on('click', function() {
            $(this).closest('.basket__group-radio').addClass('checked').siblings().removeClass('checked')
        });

        $('.basket__edit').on('click', function(event) {
            event.preventDefault()

            prevStep($(event.target).closest('.basket__step'))
        })

        $('.basket__next').on('click', function(event) {
            event.preventDefault();

            inputs = $('input, textarea', $(event.target).closest('.basket__step-body')).filter('[required]')

            inputs.each(function(index, el) {
                $(el).val().length === 0 && setError($(el).closest('.basket__group'))
            });

            nextStep($(event.target).closest('.basket__step'))
        });

        $('.js-submit-basket').on('click', submit)

        function setError(el) {
            if (!el.hasClass('invalid')) {
                if (el.find('.basket__group-error').length === 0) el.append('<p class="basket__group-error">Это обязательное поле</p>')
                el.addClass('invalid')
                errors++
            }
        }

        function removeError(el) {
            if (el.val().length > 0) el.closest('.basket__group').removeClass('invalid').find('.basket__group-error').remove(), errors--
        }

        function nextStep(prev) {
            activeStep = $(prev)

            if (errors <= 0) activeStep.addClass('disabled done').next().removeClass('disabled done'), errors = 0, activeStep = activeStep.next()
        }

        function prevStep(target) {

            activeStep.addClass('disabled done')
            target.removeClass('disabled done')

            activeStep = target

            errors = 0
            inputs.closest('.basket__group').removeClass('invalid')
        }

        function submit() {
            var basket = _that._getBasket()

            basket.length > 0 && ajax(_that.basket, basket, $('.js-basketTotal').text())
        }

        function setLocation() {
            if ($('[name="location"]').length) {
                ymaps.ready(function() {
                    $('[name="location"]').val(ymaps.geolocation.city)
                })
            }
        }
    }
}

$(function() {
    basket.init()
}())