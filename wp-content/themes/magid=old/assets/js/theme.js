/**
 * Custom JS Scripts
 *
 * @package Magid
 */

(function () {

    blogfilters._init();
    blogPosts._init();
    deferImageLoad._init();
    navigation._init();
    membersQuery._init();
    fluidVids._init();
    gformsReset._init();
    postsList._init();
    selectDropdownStyles._init();
    gridItemMatchHeight._init();
    toggleActive._init();

})();


jQuery(document).ready(function(){
    jQuery('.tbn').click(function(){
        jQuery('html, body').animate({
        scrollTop: jQuery('.module-members').offset().top
    }, 'slow');
    });
});
