(function() {
    function carouselUpdate() {
        current = (current >= max) ? 1 : current + 1;
        changeCarousel($('#carousel-nav-' + current));
    }

    function changeCarousel(source) {
        if (carouselTarget) {
            $(carouselTarget.node).removeClass('active');
            $(carouselTarget.source).removeClass('active');
            carouselTarget = null;
        }

        var dataTarget = $(source).attr('data-target');
        var nodeTarget = $('#' + dataTarget);
        carouselTarget = {
            source: source,
            data: dataTarget,
            node: nodeTarget
        };

        $(nodeTarget).addClass('active');
        $(source).addClass('active');
        $('#carousel-link').attr('href', $(source).attr('data-href'));

        current = parseInt(dataTarget.replace("carousel-", ""));
        clearInterval(carouselInterval);
        carouselInterval = setInterval(carouselUpdate, 5000);
    }

    var carouselImages = $(".custom-carousel > .inner > .item");
    var carouselButtons = $(".carousel-navigation > li");
    var carouselHyperlink = $('#carousel-link');

    var activeSource = $('.carousel-navigation > li.active');
    var activeData = $(activeSource).attr('data-target');
    var activeTarget = $('#' + activeTarget);
    var carouselTarget = {
        source: activeSource,
        data: activeData,
        node: activeTarget
    };
    $('#carousel-link').attr('href', $(activeSource).attr('data-href'));

    var current = 1;
    var max = $(carouselButtons).size();
    var carouselInterval = setInterval(carouselUpdate, 5000);

    $(carouselButtons).click(function(evt) {
        changeCarousel(this);
    });

    var categoryLists = $("ul#category-list > li");
    var categoryCont = $("#category-container");
    var currentTarget = null;
    $(categoryLists).mouseover(function(evt) {
        if (currentTarget) {
            $(currentTarget.node).removeClass('show');
            currentTarget = null;
        }
        var dataTarget = $(this).attr('data-target');
        var nodeTarget = $("#" + dataTarget);
        currentTarget = {
            source: this,
            data: dataTarget,
            node: nodeTarget
        };

        $(nodeTarget).addClass('show');
    });
    $(categoryCont).mouseleave(function(evt) {
        $(currentTarget.node).removeClass('show');
        currentTarget = null;
    });
})();

$('.carousel-wrapper').each(function(idx, el) {
    function getTarget(src) {
        return {
            source: src,
            data: $(src).attr('data-target'),
            node: $('#' + $(src).attr('data-target')),
            href: $('#' + $(src).attr('data-target')).attr('data-href')
        };
    }

    function updateTargeting(source) {
        $(source).find('.carousel-buttons > .carousel-button').each(function(idx, el) {
            var target = getTarget(el);

            if (idx === 0) {
                firstTarget = target;   
            }

            if (idx == carouselCount - 1) {
                lastTarget = target;
            }

            if ($(el).hasClass('active')) {
                if (previousTarget) {
                    $(previousTarget.node).removeClass('previous');
                }
                $(currentTarget.node).addClass('previous');

                previousTarget = currentTarget;
                currentTarget = target;

                if (idx == carouselCount - 1) {
                    nextTarget = firstTarget;
                } else {
                    nextTarget = null;
                }

                return;
            }

            if (currentTarget && !nextTarget) {
                nextTarget = target;
                return;
            }
        });
    }
    
    function carouselUpdate() {
        changeTarget(currentTarget, nextTarget);
    }

    function changeTarget(from, to) {
        $(from.source).removeClass('active');
        $(from.node).removeClass('active');
        $(to.source).addClass('active');
        $(to.node).addClass('active');
        $(carouselLink).attr('href', to.href);
        updateTargeting(el);
        clearTimeout(carouselTimeout);
        carouselTimeout = setTimeout(carouselUpdate, 5000);
    }

    var src = $(el).find('.carousel-buttons > .carousel-button:active');
    var currentTarget = getTarget(src);
    var nextTarget = null;
    var previousTarget = null;
    var firstTarget = null;
    var lastTarget = null;

    var carouselCount = $(el).find('.carousel-buttons > .carousel-button').size();
    var carouselLink = $(el).find('.carousel-link');

    $(el).find('.carousel-buttons > .carousel-button').click(function(evt) {
        var target = getTarget(this);
        changeTarget(currentTarget, target);
    });

    updateTargeting(el);
    var carouselTimeout = setInterval(carouselUpdate, 5000);
});

(function() {
    $(window).scroll(function(evt) {
        if ($(this).scrollTop() > 500) {
            if (!$('#sticky-header').hasClass('show')) {
                $('#sticky-header').addClass('show');
            }
        } else {
            if ($('#sticky-header').hasClass('show')) {
                $('#sticky-header').removeClass('show');
            }
        }
    });
})();
