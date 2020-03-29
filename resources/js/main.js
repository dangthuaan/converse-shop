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
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Success! Product has been added to your shopping cart!'
                    })

                    $('.cart-number').text(result.quantity);
                }
            },
            error: function () {
                alert('Something went wrong!');
                location.reload();
            }
        });
    });

    $('.add-to-cart-single').click(function () {
        var url = '/orders/single';
        var productId = $(this).data('product-id');
        var productNumber = $(this).parent().prev().find(".qty").val();

        var data = {
            'product_id': productId,
            'product_number': productNumber
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            cache: false,
            success: function (result) {
                if (result.status) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Success! Product has been added to your shopping cart!'
                    })

                    $('.cart-number').text(result.quantity);
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
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Success! Product has been added to your favorites list!'
                    })

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
        Swal.fire({
            title: 'Are you sure remove this product from cart?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
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
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Success! Product has been removed from cart!'
                            })

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
        })
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

    $('.spinner input').keydown(function (e) {
        e.preventDefault();
        return false;
    });
    var minNumber = 1;
    var maxNumber = 10;
    $('.spinner .items-count:first-of-type').on('click', function () {
        if ($('.spinner input').val() == maxNumber) {
            return false;
        } else {
            $('.spinner input').val(parseInt($('.spinner input').val(), 10) + 1);
        }
    });

    $('.spinner .items-count:last-of-type').on('click', function () {
        if ($('.spinner input').val() == minNumber) {
            return false;
        } else {
            $('.spinner input').val(parseInt($('.spinner input').val(), 10) - 1);
        }
    });

    $(".currency").inputmask("decimal", {
        alias: 'numeric',
        rightAlign: false,
        digitsOptional: true,
        radixPoint: ',',
        groupSeparator: '.',
        autoGroup: true,
        placeholder: '',
        removeMaskOnSubmit: true
    });

    $(".product-currency").inputmask("decimal", {
        alias: 'numeric',
        rightAlign: false,
        digitsOptional: true,
        radixPoint: ',',
        groupSeparator: '.',
        autoGroup: true,
        placeholder: '',
        suffix: " ₫",
        removeMaskOnSubmit: true
    });

    var checkUrl = function () {
        var pathname = window.location.href;
        var url = new URL(pathname);
        var categories = url.searchParams.get("categories");
        var categoriesArray = categories.split(",");

        $.each(categoriesArray, function (index, value) {
            $(".categories").find('span').filter(function () {
                return $(this).text() === value;
            }).parent().toggleClass("selected");
        });
    };

    //Product filter
    var path = window.location.search;
    var urlParams = new URLSearchParams(path);

    var getParamArrayFromUrl = function (paramString) {
        if (paramString) {
            return paramString.split(",");
        }

        return [];
    };

    var createNewCategoriesParamInUrl = function (paramString, sizeName) {
        if (paramString.length) {
            paramString += ",";
        }

        return paramString + sizeName;
    };

    var removeCategoriesParamInUrl = function (urlCategoriesParamArray, sizeName) {
        var removalCategoriesParamArray = jQuery.grep(urlCategoriesParamArray, function (value) {
            return value != sizeName;
        });

        return removalCategoriesParamArray.toString();
    };

    $('.categories').on('click', function () {
        var parentCategoryName = $(this).parent().parent().prev().text().toLowerCase();
        var categoriesName = $(this).find('span').text();
        var categoriesParamPosition = -1;
        var paramString = "";
        var urlCategoriesParamArray = [];

        if (urlParams.has("categories") && urlParams.get("categories").length) {
            var paramString = urlParams.get("categories");
            urlCategoriesParamArray = getParamArrayFromUrl(paramString);
            categoriesParamPosition = jQuery.inArray(categoriesName, urlCategoriesParamArray);
        }

        var newCategoriesParamInUrl = "";

        if (categoriesParamPosition < 0) {
            newCategoriesParamInUrl = createNewCategoriesParamInUrl(paramString, categoriesName);
        } else {
            newCategoriesParamInUrl = removeCategoriesParamInUrl(urlCategoriesParamArray, categoriesName);
        }

        if (!newCategoriesParamInUrl) {
            window.location.href = "/products";
        } else {
            newUrl = "/products?categories=" + newCategoriesParamInUrl;
            window.location.href = newUrl;
        }
    });

    checkUrl();
});
