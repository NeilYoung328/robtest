/**
 *  Initialize select JS
 */
var selectDropdownStyles = (function ($) {

    var pub = {}; // public facing functions

    pub._init = function () {
        pub._gravityFormDropdown();
    };

    /**
     * Call Select function to style expertise dropdown
     */
    pub._gravityFormDropdown = function () {
        var gformSelect = $('.gfield_select');
        if (gformSelect.length > 0) {
            gformSelect.selectize();

            $('.selectize-input input[type=text]').prop("disabled","disabled");
        }
    };

    return pub;

})(jQuery);