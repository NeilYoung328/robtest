/**
 *  Initialize gridItemMatchHeight
 */

var gridItemMatchHeight = (function ($) {

    var pub = {}; // public facing functions

    pub._init = function () {
        var gridItem = $('.grid-item');

        if (gridItem.length > 0) {
            gridItem.matchHeight({
                byRow: false
            });
        }
    };

    return pub;

})(jQuery);