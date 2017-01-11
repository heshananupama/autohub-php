(function (e) {
    var t, o = {
        className: "autosizejs",
        append: "",
        callback: !1,
        resizeDelay: 10
    }, i = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>', n = ["fontFamily", "fontSize", "fontWeight", "fontStyle", "letterSpacing", "textTransform", "wordSpacing", "textIndent"], s = e(i).data("autosize", !0)[0];
    s.style.lineHeight = "99px", "99px" === e(s).css("lineHeight") && n.push("lineHeight"), s.style.lineHeight = "", e.fn.autosize = function (i) {
        return this.length ? (i = e.extend({}, o, i || {}), s.parentNode !== document.body && e(document.body).append(s), this.each(function () {
            function o() {
                var t, o;
                "getComputedStyle" in window ? (t = window.getComputedStyle(u, null), o = u.getBoundingClientRect().width, e.each(["paddingLeft", "paddingRight", "borderLeftWidth", "borderRightWidth"], function (e, i) {
                    o -= parseInt(t[i], 10)
                }), s.style.width = o + "px") : s.style.width = Math.max(p.width(), 0) + "px"
            }

            function a() {
                var a = {};
                if (t = u, s.className = i.className, d = parseInt(p.css("maxHeight"), 10), e.each(n, function (e, t) {
                        a[t] = p.css(t)
                    }), e(s).css(a), o(), window.chrome) {
                    var r = u.style.width;
                    u.style.width = "0px", u.offsetWidth, u.style.width = r
                }
            }

            function r() {
                var e, n;
                t !== u ? a() : o(), s.value = u.value + i.append, s.style.overflowY = u.style.overflowY, n = parseInt(u.style.height, 10), s.scrollTop = 0, s.scrollTop = 9e4, e = s.scrollTop, d && e > d ? (u.style.overflowY = "scroll", e = d) : (u.style.overflowY = "hidden", c > e && (e = c)), e += w, n !== e && (u.style.height = e + "px", f && i.callback.call(u, u))
            }

            function l() {
                clearTimeout(h), h = setTimeout(function () {
                    var e = p.width();
                    e !== g && (g = e, r())
                }, parseInt(i.resizeDelay, 10))
            }

            var d, c, h, u = this, p = e(u), w = 0, f = e.isFunction(i.callback), z = {
                height: u.style.height,
                overflow: u.style.overflow,
                overflowY: u.style.overflowY,
                wordWrap: u.style.wordWrap,
                resize: u.style.resize
            }, g = p.width();
            p.data("autosize") || (p.data("autosize", !0), ("border-box" === p.css("box-sizing") || "border-box" === p.css("-moz-box-sizing") || "border-box" === p.css("-webkit-box-sizing")) && (w = p.outerHeight() - p.height()), c = Math.max(parseInt(p.css("minHeight"), 10) - w || 0, p.height()), p.css({
                overflow: "hidden",
                overflowY: "hidden",
                wordWrap: "break-word",
                resize: "none" === p.css("resize") || "vertical" === p.css("resize") ? "none" : "horizontal"
            }), "onpropertychange" in u ? "oninput" in u ? p.on("input.autosize keyup.autosize", r) : p.on("propertychange.autosize", function () {
                "value" === event.propertyName && r()
            }) : p.on("input.autosize", r), i.resizeDelay !== !1 && e(window).on("resize.autosize", l), p.on("autosize.resize", r), p.on("autosize.resizeIncludeStyle", function () {
                t = null, r()
            }), p.on("autosize.destroy", function () {
                t = null, clearTimeout(h), e(window).off("resize", l), p.off("autosize").off(".autosize").css(z).removeData("autosize")
            }), r())
        })) : this
    }
})(window.jQuery || window.$);

var __slice = [].slice;
(function (e, t) {
    var n;
    n = function () {
        function t(t, n) {
            var r, i, s, o = this;
            this.options = e.extend({}, this.defaults, n);
            this.$el = t;
            s = this.defaults;
            for (r in s) {
                i = s[r];
                if (this.$el.data(r) != null) {
                    this.options[r] = this.$el.data(r)
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on("mouseover.starrr", "span", function (e) {
                return o.syncRating(o.$el.find("span").index(e.currentTarget) + 1)
            });
            this.$el.on("mouseout.starrr", function () {
                return o.syncRating()
            });
            this.$el.on("click.starrr", "span", function (e) {
                return o.setRating(o.$el.find("span").index(e.currentTarget) + 1)
            });
            this.$el.on("starrr:change", this.options.change)
        }

        t.prototype.defaults = {
            rating: void 0, numStars: 5, change: function (e, t) {
            }
        };
        t.prototype.createStars = function () {
            var e, t, n;
            n = [];
            for (e = 1, t = this.options.numStars; 1 <= t ? e <= t : e >= t; 1 <= t ? e++ : e--) {
                n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))
            }
            return n
        };
        t.prototype.setRating = function (e) {
            if (this.options.rating === e) {
                e = void 0
            }
            this.options.rating = e;
            this.syncRating();
            return this.$el.trigger("starrr:change", e)
        };
        t.prototype.syncRating = function (e) {
            var t, n, r, i;
            e || (e = this.options.rating);
            if (e) {
                for (t = n = 0, i = e - 1; 0 <= i ? n <= i : n >= i; t = 0 <= i ? ++n : --n) {
                    this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")
                }
            }
            if (e && e < 5) {
                for (t = r = e; e <= 4 ? r <= 4 : r >= 4; t = e <= 4 ? ++r : --r) {
                    this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")
                }
            }
            if (!e) {
                return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")
            }
        };
        return t
    }();
    return e.fn.extend({
        starrr: function () {
            var t, r;
            r = arguments[0], t = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function () {
                var i;
                i = e(this).data("star-rating");
                if (!i) {
                    e(this).data("star-rating", i = new n(e(this), r))
                }
                if (typeof r === "string") {
                    return i[r].apply(i, t)
                }
            })
        }
    })
})(window.jQuery, window);
$(function () {
    return $(".starrr").starrr()
})


var val;



$(document).ready(function () {


    $('#new-review').autosize({append: "\n"});

    var reviewBox = $('#post-review-box');
    var newReview = $('#new-review');
    var openReviewBtn = $('#open-review-box');
    var closeReviewBtn = $('#close-review-box');
    var ratingsField = $('#ratings-hidden');

    openReviewBtn.click(function (e) {
        reviewBox.slideDown(400, function () {
            $('#new-review').trigger('autosize.resize');
            newReview.focus();
        });
        openReviewBtn.fadeOut(100);
        closeReviewBtn.show();
    });

    closeReviewBtn.click(function (e) {
        e.preventDefault();
        reviewBox.slideUp(300, function () {
            newReview.focus();
            openReviewBtn.fadeIn(200);
        });
        closeReviewBtn.hide();

    });

    $('.starrr').on('starrr:change', function (e, value) {
        val = value;
        ratingsField.val(value);
    });


    $('.alert-autocloseable-success').hide();
    $('.alert-autocloseable-warning').hide();


    /*
     Fullscreen background
     */
    $.backstretch([
        "Images/backgrounds/2.jpg"
        , "Images/backgrounds/1.jpg"
        , "Images/backgrounds/3.jpg"
    ], {duration: 3000, fade: 750});

    /*
     Form validation
     */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
        $(this).removeClass('input-error');
    });


});
/*
 End of  Welcome screen Script
 */

// check whether search button clicked
var browse = document.getElementById("browseId");
browse.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        var search = document.getElementById("search").innerHTML;

        $.ajax({
            type: 'get',
            url: ('/browse'),
            data: {'name': name},
            success: function (data) {
                $('#modelEdit').html("");
                $('#modelEdit').html(data);
            }

        });
    }
});


// modal autofocus
$('.modal').on('shown.bs.modal', function () {
    $(this).find('[autofocus]').focus();
});
// Edit the existing brand
function EditBrand(brand, id) {
    document.getElementById("brand").value = brand;
    document.getElementById("id").value = id;


}

function DeleteModel(model) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/admin/model/delete/" + model;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}

function EditModel(id, model, brand, transmission, fuel, capacity, year, country) {

    $('#modelEdit').modal('show');

    document.getElementById("modelM").value = model;
    document.getElementById("brandM").value = brand;
    document.getElementById("transmissionM").value = transmission;
    document.getElementById("fuelM").value = fuel;
    document.getElementById("engineCapacityM").value = capacity;
    document.getElementById("yearM").value = year;

    document.getElementById("countryM").value = country;
    document.getElementById("modelid").value = id;


}


// delete the existing brand
function DeleteBrand(brand) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/admin/brand/delete/" + brand;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}

// delete the existing brand
function DeleteRetailer(retailer) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/admin/retailer/delete/" + retailer;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}


function EditCategory(id, category) {

    document.getElementById("categoryNameM").value = category;
    document.getElementById("categoryIdM").value = id;

}

function DeleteCategory(category) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/admin/category/delete/" + category;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}

function checkQuantity(id, value) {
    $.ajax({
        type: 'get',
        url: ('/productInfo/id/checkQuantity'),
        data: {
            'quantity': value,
            'productId': id
        },
        success: function (data) {
            if (data != "false") {
                alert("There are only remaining " + data + " units");

                $("#addToCart").prop("disabled", true);

            }
            else if (data == "false") {
                document.getElementById("addToCart").disabled = false;
            }
        }

    });
}

function shoppingCart(id) {
    var quantity = document.getElementById("quantity").value;
    if (quantity == "") {
        $.ajax({
            type: 'get',
            url: ('/productInfo/id/checkQuantity'),
            data: {
                'quantity': 1,
                'productId': id
            },
            success: function (data) {
                if (data != "false") {
                    alert("There are only remaining " + data + " units");


                }
                else if (data == "false") {
                    $.ajax({
                        type: 'get',
                        url: ('/productInfo/id/addToCart'),
                        data: {
                            'id': id,
                            'quantity': 1
                        },
                        success: function (data) {

                            document.getElementById('successMessage').innerHTML = data;
                            $('#autoclosable-btn-success').prop("disabled", true);
                            $('.alert-autocloseable-success').show();

                            $('.alert-autocloseable-success').delay(5000).fadeOut("slow", function () {
                                // Animation complete.
                                $('#autoclosable-btn-success').prop("disabled", false);
                            });
                        }

                    });
                }
            }

        });
    }
    else {
        $.ajax({
            type: 'get',
            url: ('/productInfo/id/addToCart'),
            data: {
                'id': id,
                'quantity': quantity
            },
            success: function (data) {

                document.getElementById('successMessage').innerHTML = data;
                $('#autoclosable-btn-success').prop("disabled", true);
                $('.alert-autocloseable-success').show();

                $('.alert-autocloseable-success').delay(5000).fadeOut("slow", function () {
                    // Animation complete.
                    $('#autoclosable-btn-success').prop("disabled", false);
                });
            }

        });

    }

}


function test() {
    $.get('https://openexchangerates.org/api/latest.json', {app_id: '2ac6b4542ae04de08defa36f68801476 '}, function (data) {
        console.log("1 US Dollar equals " + data.rates.LKR + " British Pounds");
    });
}

function deleteCartItem(id) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/cart/deleteCartItem/" + id;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}


function checkout(totalPrice) {
    window.location.href = "/checkout/" + totalPrice;

}


function submitform(cartTotal) {
    var address = $("#address").val();
    if(address==""){
        alert("Address Can't be Empty");

    }
    else{
         $.ajax({
         type: 'get',
         url: ('/cart/changeStatus'),
         data: {
         'address': address,
         'cartTotal': cartTotal,
         },
         success: function (data) {

         document.theForm.submit();


         }

         });
    }


}

function loadOrderItems(orderId) {


    $.ajax({
        type: 'get',
        url: ('/feedback/getDate'),
        data: {'orderId': orderId},
        success: function (data) {
            // $('#tableFeedback').html("");
            $('#dateLabel').html(data);
            window.location.href = "/feedback/" + orderId;

        }


    });
}
function showReviewModal(orderItemId) {
    document.getElementById('orderItemId').value = orderItemId;
    $('#modalReview').modal('show');

}


function saveReview() {
    var orderItemId = document.getElementById('orderItemId').value;
    var review = document.getElementById('new-review').value;
    if(review=="" || val==undefined ){
        alert("Please select requred fields")
    }
    else{
         $.ajax({
         type: 'get',
         url: ('/feedback/' + orderItemId + '/saveReview'),
         data: {
         'orderItemId': orderItemId,
         'starValue': val,
         'review': review,
         },
         success: function (data) {
         $('#modalReview').modal('hide');
         document.getElementById('successMessage').innerHTML = data;
         $('#autoclosable-btn-success').prop("disabled", true);
         $('.alert-autocloseable-success').show();

         $('.alert-autocloseable-success').delay(5000).fadeOut("slow", function () {
         // Animation complete.
         $('#autoclosable-btn-success').prop("disabled", false);
         });

         }

         });

    }


}

function showComplainModal(orderItemId) {
    document.getElementById('complainItemId').value = orderItemId;
    $('#modalComplain').modal('show');

}

function saveComplain() {
    var orderItemId = document.getElementById('complainItemId').value;
    var complain = document.getElementById('new-complain').value;
    var phone = document.getElementById('phoneNumber').value;


    $.ajax({
        type: 'get',
        url: ('/feedback/' + orderItemId + '/saveComplain'),
        data: {
            'orderItemId': orderItemId,
            'complain': complain,
            'phoneNumber': phone,
        },
        success: function (data) {
            $('#modalComplain').modal('hide');
            document.getElementById('successMessage').innerHTML = data;
            $('#autoclosable-btn-success').prop("disabled", true);
            $('.alert-autocloseable-success').show();

            $('.alert-autocloseable-success').delay(5000).fadeOut("slow", function () {
                // Animation complete.
                $('#autoclosable-btn-success').prop("disabled", false);
            });
        }

    });
}

function getNewModels() {

    var name = $("#brandDropdown option:selected").text();

    $.ajax({
        type: 'get',
        url: (' /browse/getModels'),
        data: {'brandName': name},
        success: function (data) {
            $('#model').html("");
            $('#model').html(data);

        }

    });

}

function dispayImage() {
    var img = document.getElementById('carImage');
    if (img.style.visibility === 'hidden') {
        // Currently hidden, make it visible
        img.style.visibility = "visible";
    }

}

function advancedSearch(value) {

   /* var brand = $('#brandDropdown').val();
    var model = $('#modelDropdown').val();*/
    document.getElementById('searchID').value = value;

    document.advanceSearchForm.submit();

   /* $.ajax({
        type: 'get',
        url: ('/browse/filter'),
        data: {
            'brand': brand,
            'model': model,
            'sortby': "",
            'category':"",
            'searchName':"brake"
        },
        success: function (data) {
            console.log("Ff");
        }

    });*/
}