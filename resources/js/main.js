$(document).ready(function () {
    //Color Picker
    var colorPicker = function () {
        $('.color-desc .color').on('click', function (event) {
            event.preventDefault();
            $(this).toggleClass('selected');
        });
    };
    //Size Picker
    var sizePicker = function () {
        $('.size-desc .size').on('click', function (event) {
            event.preventDefault();
            $(this).toggleClass('selected');
        });
    };
    //Style Picker
    var stylePicker = function () {
        $('.list-desc .list').on('click', function (event) {
            event.preventDefault();
            $(this).toggleClass('selected');
        });
    };

    //functions
    colorPicker();
    sizePicker();
    stylePicker();

    //ajax setup for orders(add to cart)
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $('.add-to-cart').click(function () {
        var url = '/orders';
        var productId = $(this).data('product-id');

        var data = {
            'product_id': productId
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            cache: false,
            success: function (result) {
                if (result.status) {
                    $('.cart-number').text(result.quantity);
                    alert('Order success!');
                    location.reload();
                }
            },
            error: function () {
                alert('Something went wrong!');
                location.reload();
            }
        });
    });

    $('.product-remove').click(function () {
        if (confirm('Are you sure remove this product from cart?')) {
            var url = '/orders/remove';
            var productId = $(this).data('product-id');

            var data = {
                'product_id': productId
            };

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                cache: false,
                success: function (result) {
                    if (result.status) {
                        $('.product-' + productId).remove();
                        location.reload();
                    }
                },
                error: function () {
                    alert('Something went wrong!');
                    location.reload();
                }
            });
        }
    });

    $('.lnr-chevron-up').click(function () {
        var url = '/orders/increase-product-quantity';
        var productId = $(this).data('product-id');

        var data = {
            'product_id': productId
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            cache: false,
            success: function (result) {
                if (result.status) {
                    location.reload();
                }
            },
            error: function () {
                alert('Something went wrong!');
                location.reload();
            }
        });
    });

    $('.lnr-chevron-down').click(function () {
        var url = '/orders/decrease-product-quantity';
        var productId = $(this).data('product-id');

        var data = {
            'product_id': productId
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            cache: false,
            success: function (result) {
                if (result.status) {
                    location.reload();
                }
            },
            error: function () {
                alert('Something went wrong!');
                location.reload();
            }
        });
    });
});
