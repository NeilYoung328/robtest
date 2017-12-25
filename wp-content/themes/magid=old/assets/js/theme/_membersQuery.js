/**
 *  Initialize membersQuery
 */

var membersQuery = (function ($) {

    var pub = {}; // public facing functions
    var membersContainer = $('#membersList');

    pub._init = function () {
        pub._selectSkillsDropdown();

        if (membersContainer.length > 0) {
            var defaultSkill = membersContainer.attr('data-term');
            pub._ajaxMembersPosts(defaultSkill);
        }
    };

    /**
     * Call Select function to style expertise dropdown
     */
    pub._selectSkillsDropdown = function () {
        var orderingSelect = $('.member__skills');
        if (orderingSelect.length > 0) {
            orderingSelect.selectize({
                dataAttr: 'data-description',
                onInitialize: function () {
                    var s = this;
                    var children = this.revertSettings.$children;
                    children.each(function (i, value) {
                        if (typeof value.attributes.description !== 'undefined') {
                            var descriptionObject = {
                                description: value.attributes.description.value
                            };
                            $.extend(s.options[this.value], descriptionObject);
                        }
                    });
                },
                render: {
                    option: function (item, escape) {
                        return '<div class="option" data-description="' + item.description + '">' + item.text + '</div>';
                    }
                },
                onChange: pub._skillsEventHandler()
            });

            $('.selectize-input input[type=text]').prop("disabled", "disabled");
        }
    };

    /**
     * Update members data on skills select change
     *
     * @returns {Function}
     */
    pub._skillsEventHandler = function () {
        return function () {
            pub._ajaxMembersPosts(arguments[0]);
            pub._updateSelectedSkill();
        };
    };

    /**
     * Update module header and description with currently selected skill term data
     *
     * @param selected
     */
    pub._updateSelectedSkill = function (selected) {
        var selectedSkill = $('.member__skills').find(':selected');
        var skillName = selectedSkill.html();
        var skillDescriptionElement = $('.selectize-dropdown-content').find('div[data-value="' + selectedSkill[0].value + '"]');
        var skillDescription = skillDescriptionElement[0].dataset.description;

        if (skillDescription === 'undefined') {
            skillDescription = '';
        }

        $('#memberTermName').html(skillName);
        $('#memberTermDesc').html(skillDescription);
    };

    /**
     * Query members rest endpoint
     */
    pub._ajaxMembersPosts = function (id) {
        membersContainer.html('<img class="members--loading" src="' + wpApiSettings.theme_path + 'assets/images/loading-grid.svg"/>');
        var data = {
            per_page: 100
        };
        if (id > 0) {
            data.skill = id;
        }
        if ("9" !== id) {
            data.ignore_custom_sort = true;
        }
        $.ajax({
            url: wpApiSettings.root + 'wp/v2/members',
            method: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
            },
            data: data
        }).done(function (response) {
            pub._renderMemberItems(response);
        });
    };

    /**
     * Loop through data results and build each item with proper markup and values
     *
     * @param data
     */
    pub._renderMemberItems = function (data) {
        var html = '';
        $.each(data, function (index, element) {
            var itemHtml = pub._memberItemMarkup(element);
            itemHtml = itemHtml.replace('{image_src}', element._thumbnail_id);
            itemHtml = itemHtml.replace('{name}', element.title.rendered);
            itemHtml = itemHtml.replace('{position}', element.position);
            html += itemHtml;
        });
        membersContainer.html(html);
    };

    /**
     * member item markup template
     *
     * @param item
     *
     * @returns {string}
     */
    pub._memberItemMarkup = function (item) {
        var linkedinMarkup = '';
        if (item.linkedin_url !== '') {
            linkedinMarkup = '<a class="member__linkedin" href="' + item.linkedin_url + '" target="_blank">' +
                '<svg class="icon icon-linkedin"><use xlink:href="#icon-linkedin"></use></svg>' +
                '</a>';
        }
        return '<div class="member-item col-xs-12 col-sm-4 col-md-3">' +
            '<img class="member__image" src="{image_src}" />' +
            '<div class="member__info">' +
            '<h4 class="member__name">{name}</h4>' +
            '<h5 class="member__position">{position}</h5>' +
            linkedinMarkup +
            '</div>' +
            '</div>';
    };

    return pub;

})(jQuery);