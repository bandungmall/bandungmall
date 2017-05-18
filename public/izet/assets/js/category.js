(function() {
    $('#category-wrapper').mouseover(function() {
        $('#category-container').removeClass('hidden');
    });
    $('#category-wrapper').mouseleave(function() {
        $('#category-container').addClass('hidden');
    });
})();
