/**
 *  Initialize gformsReset
 */

var gformsReset = (function ($) {

    var pub = {}; // public facing functions

    pub._init = function () {
        var gformResetButton = $('.gform_wrapper .gform_reset_button');
        if (gformResetButton.length > 0) {
            gformResetButton.each(function () {
                var idFormat;
                $('br', this).remove();
                $('p', this).remove();
                idFormat = "#" + this.id;
                $(idFormat).each(function () {
                    var resetText = "Reset";
                    $('.gform_footer', this).append('<input type="reset" class="btn btn--outline gform_button" value="' + resetText + '" >');
                    $(':submit', this).addClass('submit-button');
                });
            });
        }
    };

    return pub;

})(jQuery);