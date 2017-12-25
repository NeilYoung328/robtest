/**
 *  Initialize postsList
 */

var postsList = (function ($) {

    var pub = {}; // public facing functions
    var listPosts = $('.list__posts');
    var listPostsToggle = $('.list__posts-toggle');

    pub._init = function () {
        if (!listPosts.length > 0) {
            return;
        }

        pub._masonryInit();
        pub._loadMorePostsToggle();
    };

    pub._masonryInit = function () {
        listPosts.masonry({
            columnWidth: '.col-sm-6',
            itemSelector: '.list__post',
            percentPosition: true
        });
    };

    pub._loadMorePostsToggle = function () {
        listPostsToggle.on('click', function (e) {
            e.preventDefault();
            $(this).addClass('btn--loading');
            $(this).append('<img src="' + wpApiSettings.theme_path + 'assets/images/loading-three-dots.svg"/>');

            pub._loadMorePosts();
        });
    };

    pub._defaultToggleState = function (text) {
        listPostsToggle.removeClass('btn--loading');
        listPostsToggle.html(text);
    };

    pub._loadMorePosts = function () {
        var currentPage = listPosts.attr('data-page');
        var postsPerPage = listPosts.attr('data-posts');
        var postType = listPosts.attr('data-type');
        var nextPage = parseInt(currentPage) + 1;

        var data = {
            page: nextPage,
            per_page: postsPerPage
        };

        $.ajax({
            url: wpApiSettings.root + 'wp/v2/' + postType + 's',
            method: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
            },
            data: data
        }).done(function (response) {
            if (response.length > 0) {
                console.log(response);
                pub._renderPostItems(response);
                listPosts.attr('data-page', nextPage);
                return true;
            }
            pub._defaultToggleState('No Posts Found');
            listPostsToggle.addClass('disabled');
        });
    };

    pub._renderPostItems = function (data) {
        $.each(data, function (index, element) {
            var html = '<div class="col-sm-6 list__post">';

            switch (element.type) {
                case 'career':
                    html += pub._careerItemMarkup(element);
                    break;
                case 'consortium':
                    html += pub._consortiumItemMarkup(element);
                    break;
                case 'course':
                    html += pub._courseItemMarkup(element);
                    break;
                case 'institute':
                    html += pub._instituteItemMarkup(element);
                    break;
            }

            html += '</div>';

            var appendedItem = $(html);
            listPosts.append(appendedItem).masonry('appended', appendedItem);
        });

        pub._defaultToggleState('Load More');
    };

    /**
     * institute item markup template
     *
     * @param item
     *
     * @returns {string}
     */
    pub._instituteItemMarkup = function (item) {
        var signUpText = item.sign_up_text ? item.sign_up_text : 'Sign Up Now';
        return '<article id="post-' + item.id + '" class="entry post-' + item.id + ' institute type-institute"><div class="section">' +
            '<h2 class="hdg hdg--5 hdg--orange">' + item.title.rendered + '</h2>' +
            '<div class="institute__meta">' +
            '<p>' + item.institute_date + '</p>' +
            '<p>' + item.institute_location + '</p>' +
            '</div></div>' +
            '<div class="section entry__content section__institute-description">' + item.description + '</div>' +
            '<div class="btn__container">' +
            ( item.sign_up ? '<a class="btn btn--primary" href="' + item.sign_up + '">' + signUpText + '</a>' : '' ) +
            '</div>' +
            '</article>';
    };

    /**
     * consortium item markup template
     *
     * @param item
     *
     * @returns {string}
     */
    pub._consortiumItemMarkup = function (item) {
        return '<article id="post-' + item.id + '" class="entry post-' + item.id + ' consortium type-consortium"> ' +
            '<div class="section"><h2 class="hdg hdg--5 hdg--orange">' + item.title.rendered + '</h2></div> ' +
            '<div class="section section--large">' + item.excerpt + '</div>' +
            '<div class="btn__container">' +
            '<a class="btn btn--primary" href="' + item.link + '">View Now</a> ' +
            '</div>' +
            '</article>';
    };

    /**
     * courses item markup template
     *
     * @param item
     *
     * @returns {string}
     */
    pub._courseItemMarkup = function (item) {
        var trackHtml = '';
        if (item.tracks.length > 0) {
            $.each(item.tracks, function (i, value) {
                trackHtml += '<li>' + value.course + '</li>';
            });
        }
        return '<article id="post-' + item.id + '" class="entry list__post--course post-' + item.id + ' course type-course">' +
            '<div class="section"><h2 class="hdg hdg--5 hdg--orange">Course:</h2><p>' + item.title.rendered + '</p></div> ' +
            '<div class="section"><h2 class="hdg hdg--5 hdg--orange">Level:</h2><p>' + item.level + '</p></div> ' +
            '<div class="section"><h2 class="hdg hdg--5 hdg--orange">Track:</h2> ' +
            '<p>' + item.tracks.length + ' Courses:</p>' +
            '<ul>' + trackHtml + '</ul>' +
            '</div> ' +
            '</article>';
    };

    /**
     * career item markup template
     *
     * @param item
     *
     * @returns {string}
     */
    pub._careerItemMarkup = function (item) {
        return '<article id="post-' + item.id + '" class="entry post-' + item.id + ' career type-career">' +
            '<div class="section job-title">' +
            '<h2 class="hdg hdg--5 hdg--orange">Job Title</h2>' +
            item.title.rendered +
            '</div> ' +
            '<div class="section office-location"> ' +
            '<h2 class="hdg hdg--5 hdg--orange">Location</h2>' +
            item.location +
            '</div>' +
            '<div class="btn__container">' +
            '<a class="btn btn--primary" href="' + item.link + '">View Job Posting</a> ' +
            '</div> ' +
            '</article>';
    };

    return pub;

})(jQuery);