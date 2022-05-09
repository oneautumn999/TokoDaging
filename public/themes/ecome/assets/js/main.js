var sliderrange = $('#slider-range');
    var amountprice = $('#amount');
    var minPrice = parseFloat($('#productMinPrice').val());
    var maxPrice  = parseFloat($('#productMaxPrice').val())

$(function () {
    /*=======================
                UI Slider Range JS
    =========================*/
    sliderrange.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            amountprice.val(ui.values[0] + "-" + ui.values[1]);
        }
    });
    amountprice.val(sliderrange.slider("values", 0) +
            "-" + sliderrange.slider("values", 1));
});

/*--- showlogin toggle function ----*/
$('#ship-box').on('click', function() {
    $('#ship-box-info').slideToggle(1000);
});