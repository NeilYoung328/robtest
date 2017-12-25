/**
 *  Initialize membersQuery
 */

var blogfilters = (function ($) {

    var pub = {}; // public facing functions

    pub._init = function () {
        pub._selectCategoriesDropdown();
    };

    /**
     * Call Select function to style category dropdown
     */
    pub._selectCategoriesDropdown = function () {
        var orderingSelect = $('.filter__terms-select');
        if (orderingSelect.length > 0) {
            orderingSelect.selectize();

            $('.selectize-input input[type=text]').prop("disabled","disabled");

            orderingSelect.on('change', function () {
                $('form.search__form').submit();
            });
        }
    };

    return pub;

})(jQuery);