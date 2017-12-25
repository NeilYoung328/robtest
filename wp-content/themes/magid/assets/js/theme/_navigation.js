/**
 *  Initialize navigation
 */

var navigation = (function ($) {

    var pub = {}; // public facing functions
    var siteHeader = $('.header');
    var navToggle = $('.nav__toggle');

    pub._init = function () {
        pub._toggleNavigationTray();
    };

    /**
     * When nav toggle is clicked, show/hide the nav menu element
     */
    pub._toggleNavigationTray = function () {
        navToggle.on('click', function (e) {
            if ($(this).hasClass('nav__toggle--alt')) {
                return;
            }
            e.preventDefault();
            $(this).find('.hamburger').toggleClass('is-active');

            siteHeader.toggleClass('tray--active');
            $('.nav__overlay').toggleClass('nav__overlay--is-active');
            $('body').toggleClass('nav__tray--active');

            var menuLabel = $('.hamburger-label');
            if ('Menu' === menuLabel.text()) {
                menuLabel.text('Close');
            } else {
                menuLabel.text('Menu');
            }
        });
    };

    return pub;

})(jQuery);