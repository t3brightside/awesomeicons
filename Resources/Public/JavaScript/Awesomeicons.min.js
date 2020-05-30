define(['jquery'], function() {
    let Awesomeicons = {};

    Awesomeicons.init = function() {
        $('.ext-awesomeicons').each(function() {
            let extIconContent = $(this);
            let seenField = $('.typo3-TCEforms').find("input[data-formengine-input-name*='tx_awesomeicons_icon']");
            let hiddenField = $('.typo3-TCEforms').find("input[name*='tx_awesomeicons_icon']");
            let selectedIcon = $('#ext-awesomeicons-selected i');
            let items = extIconContent.find('.item');
            items.on('click', function() {
                items.removeClass('active');
                let item = $(this);

                seenField.val(item.data('value'));
                hiddenField.val(item.data('value'));
                selectedIcon.attr('class', item.data('value'));
                selectedIcon.addClass('fa-fw fa-4x');
                item.addClass('active');
            });
        });

        $('.ext-awesomeicons input[name=icon-filter]').on('keyup', function() {
            Awesomeicons.updateIconList($(this).val());
        });

        $('.ext-awesomeicons button.reset-icon-filter').on('click', function() {
            Awesomeicons.resetFilter();
        });
    };

    Awesomeicons.resetFilter = function() {
        $('.ext-awesomeicons input[name=icon-filter]').val('');
        Awesomeicons.updateIconList('');
    };

    Awesomeicons.updateIconList = function(searchWord) {
        $('.ext-awesomeicons .icon-list .item').each(function() {
            if (searchWord === '' || $(this).data('keywords').toLowerCase().indexOf(searchWord.toLowerCase()) >= 0) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });

        $('.ext-awesomeicons .icon-list .row').each(function() {
            let empty = $(this).find('.empty');
            if ($(this).find('.item').length === $(this).find('.item.hidden').length) {
                empty.removeClass('hidden');
            } else {
                empty.addClass('hidden');
            }
        });
    };
    Awesomeicons.init();
    return Awesomeicons;
});
