/* global jQuery */

// no state
(function ($, undefined) {
    "use strict";
    $.jstree.plugins.nostate = function () {
        this.set_state = function (state, callback) {
            if(callback) { callback.call(this); }
            this.trigger('set_state');
        };
    };
})(jQuery);

// no selected in state
(function ($, undefined) {
    "use strict";
    $.jstree.plugins.noselectedstate = function (options, parent) {
        this.get_state = function () {
            var state = parent.get_state.call(this);
            delete state.core.selected;
            return state;
        };
    };
})(jQuery);

// allow search results expanding
(function ($, undefined) {
    "use strict";
    $.jstree.plugins.show_matches_children = function (options, parent) {
        this.bind = function () {
            parent.bind.call(this);
            this.element
                .on('search.jstree before_open.jstree', function (e, data) {
                    if(data.instance.settings.search && data.instance.settings.search.show_only_matches) {
                        data.instance._data.search.dom.find('.jstree-node')
                            .show().filter('.jstree-last').filter(function() { return this.nextSibling; }).removeClass('jstree-last')
                            .end().end().end().find(".jstree-children").each(function () { $(this).children(".jstree-node:visible").eq(-1).addClass("jstree-last"); });
                    }
                });
        };
    };
})(jQuery);