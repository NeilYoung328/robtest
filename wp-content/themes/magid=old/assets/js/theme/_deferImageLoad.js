/**
 *  Initialize lazyLoad
 *
 *  Utilize imagesLoaded to create a lazyload effect.
 */
var deferImageLoad = (function ($) {

    var pub = {}; // public facing functions

    pub._init = function () {
        this._deferImageSrcLoad();
        this._deferBackgroundImageLoad();
    };

    /**
     * Look for elements with a src data attribute and defer the images from loading until other resources are complete
     */
    pub._deferImageSrcLoad = function () {
        var imgDefer = document.querySelectorAll('[data-src]');
        for (var i = 0; i < imgDefer.length; i++) {
            if (imgDefer[i].getAttribute('data-src')) {
                imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                imagesLoaded(imgDefer[i], function (instance) {
                    instance.images[0].img.style.opacity = 1;
                });
            }
        }
    };

    /**
     * Look for elements with a bkg data attribute and defer the images from loading until other resources are complete
     */
    pub._deferBackgroundImageLoad = function () {
        var imgDefer = document.querySelectorAll('[data-bkg]');
        for (var i = 0; i < imgDefer.length; i++) {
            if (imgDefer[i].getAttribute('data-bkg')) {
                imgDefer[i].style.backgroundImage = "url('" + imgDefer[i].getAttribute('data-bkg') + "')";
                imgDefer[i].style.opacity = 1;
                // vanilla JS
                imagesLoaded(imgDefer[i], {background: true}, function (instance) {
                    instance.images[0].img.style.opacity = 1;
                });
            }
        }
    };

    return pub;

})
(jQuery);