(function() {
    $('#category-wrapper').mouseover(function() {
        $('#category-container').removeClass('hidden');
    });
    $('#category-wrapper').mouseleave(function() {
        $('#category-container').addClass('hidden');
    });
})();

(function() {
    var current = $('.product .image-list > li.active');
    var thumbs = $('.product .image-list > li');
    var preview = $('#product-image');

    $(thumbs).click(function(evt) {
        $(current).removeClass('active');
        $(this).addClass('active');
        current = this;

        var src = $(this).attr('data-src');
        $(preview).css('backgroundImage', 'url(' + src + ')');
    });
})();
