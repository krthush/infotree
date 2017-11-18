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