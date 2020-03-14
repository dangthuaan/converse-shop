$(window).scroll(function () {
    sessionStorage.scrollTop = $(this).scrollTop();
});

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

    $('.add-to-favorite').click(function () {
        var url = '/favorites';
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
                    alert('Added to favorites!');
                    location.reload();
                }
            },
            error: function () {
                alert('Something went wrong!');
                location.reload();
            }
        });
    });

    $('.remove-from-favorite').click(function () {
        var productId = $(this).data('product-id');
        var url = '/favorites/' + productId;

        var data = {
            'product_id': productId
        };

        $.ajax({
            url: url,
            type: 'DELETE',
            data: data,
            cache: false,
            success: function (result) {
                if (result.status) {
                    alert('Removed from favorites!');
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

    $('.increase').click(function () {
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

    $('.reduced').click(function () {
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

    $("#comment_form").submit(function (event) {
        event.preventDefault();
    }).validate({
        rules: {
            content: {
                required: true,
                minlength: 10,
            },
        },
        errorPlacement: function (label, element) {
            label.addClass('error');
            label.insertAfter(element);
        },
        wrapper: 'span',
        submitHandler: function (form) {
            var url = "/comments";
            var content = $(form).find('textarea[name="content"]').val();
            var productId = $('.submit_comment').data("product-id");

            var data = {
                'product_id': productId,
                'content': content,
            };

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                cache: false,
                success: function (result) {
                    if (result.status) {
                        $("#comment").load(location.href + " #comment>*", "");
                        $(form).find("textarea[name='content']").val('');
                    }
                },
                error: function () {
                    alert("Something went wrong!");
                    location.reload();
                }
            });
            return false;
        }
    });

    $('#comment').on('click', '.reply_btn', function (event) {
        event.preventDefault();

        $('.hide_reply_form').hide();

        var $this = $(this).parent().parent().parent().next('#comment_reply');
        $("#comment_reply").not($this).hide();
        $this.show();
        $this.children().attr('id', 'active_reply');
    });

    $('#comment').on('click', '.submit_reply', function () {
        $(this).parent().parent().on('submit', function (event) {
            event.preventDefault();
        }).validate({
            rules: {
                reply_content: {
                    required: true,
                    minlength: 10,
                },
            },
            errorPlacement: function (label, element) {
                label.addClass('error');
                label.insertAfter(element);
            },
            wrapper: 'span',
            submitHandler: function (form) {
                var url = "/comments/reply";
                var content = $(form).find('.reply_content').val();
                var productId = $('#active_reply').find('.submit_reply').data("product-id");
                var parentId = $('#active_reply').find('.submit_reply').data("parent-id");

                var data = {
                    'product_id': productId,
                    'parent_id': parentId,
                    'content': content,
                };

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    cache: false,
                    success: function (result) {
                        if (result.status) {
                            $("#comment").load(location.href + " #comment>*", "");
                            $("textarea[name='reply_content']").val('');
                        }
                    },
                    error: function () {
                        alert("Something went wrong!");
                        location.reload();
                    }
                });
            }
        });
    });

    $(".currency").inputmask({
        alias: 'numeric',
        rightAlign: false,
        digitsOptional: true,
        radixPoint: ',',
        groupSeparator: '.',
        autoGroup: true,
        placeholder: '',
        removeMaskOnSubmit: true
    });

    var checkUrl = function () {
        var pathname = window.location.href;
        var url = new URL(pathname);
        var size = url.searchParams.get("size");
        var sizeArray = size.split(",");

        $.each(sizeArray, function (index, value) {
            $("." + value).toggleClass("selected");
        });
    };

    //Product size filter
    var path = window.location.search;
    var urlParams = new URLSearchParams(path);

    var getParamArrayFromUrl = function (paramString) {
        if (paramString) {
            return paramString.split(",");
        }

        return [];
    };

    var createNewSizeParamInUrl = function (paramString, sizeName) {
        if (paramString.length) {
            paramString += ",";
        }

        return paramString + sizeName;
    };

    var removeSizeParamInUrl = function (urlSizeParamArray, sizeName) {
        var removalSizeParamArray = jQuery.grep(urlSizeParamArray, function (value) {
            return value != sizeName;
        });

        return removalSizeParamArray.toString();
    };

    $('.size').on('click', function () {
        var sizeName = $(this).text();
        var sizeParamPosition = -1;
        var paramString = "";
        var urlSizeParamArray = [];

        if (urlParams.has("size") && urlParams.get("size").length) {
            var paramString = urlParams.get("size");
            urlSizeParamArray = getParamArrayFromUrl(paramString);
            sizeParamPosition = jQuery.inArray(sizeName, urlSizeParamArray);
        }

        var newSizeParamInUrl = "";

        if (sizeParamPosition < 0) {
            newSizeParamInUrl = createNewSizeParamInUrl(paramString, sizeName);
        } else {
            newSizeParamInUrl = removeSizeParamInUrl(urlSizeParamArray, sizeName);
        }

        if (!newSizeParamInUrl) {
            window.location.href = "/products";
        } else {
            newUrl = "/products?size=" + newSizeParamInUrl;
            window.location.href = newUrl;
        }
    });

    checkUrl();
});
