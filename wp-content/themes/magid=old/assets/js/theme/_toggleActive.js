/**
 *  Initialize toggleActive
 */

var toggleActive = (function ($) {

    var pub = {}; // public facing functions
    var clickTarget = $('*[data-active-class]');
    var $html = undefined;

    pub._init = function () {
        pub.Features = pub.Features || {};
        this.$html = $('html');

        // feature detection
        pub._noTouch();
        pub._isTouch();
    };

    pub._noTouch = function() {
        if ( ! ('ontouchstart' in window) ) {
            pub.Features.noTouch = false;
            this.$html.addClass('noTouch');
            return;
        }
        pub.Features.noTouch = false;
    };

    pub._isTouch = function() {
        if ( 'ontouchstart' in window ) {
            pub.Features.isTouch = false;
            this.$html.addClass('isTouch');

            pub._toggleActiveClass();

            return;
        }
        pub.Features.isTouch = false;
    };

    /**
     * When nav toggle is clicked, show/hide the nav menu element
     */
    pub._toggleActiveClass = function () {
        clickTarget.on('click touchstart:not(touchmove)', function (e) {
            var activeClass = $(this).attr('data-active-class');
            e.preventDefault();
            $(this).toggleClass(activeClass);
        });
    };

    return pub;

})(jQuery);
