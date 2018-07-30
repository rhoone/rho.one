/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license https://vistart.name/license/
 */

rho = (function ($) {
    var pub = {
        alert: function (content) {
            window.alert(content);
        },
        /**
         * 
         * @param string url
         * @param array parameters
         * @param callback successCallback
         * @param callback failCallback
         * @param callback postFailCallback
         * @param callback postAlwaysCallback
         * @returns mixed, determined by callback.
         */
        post: function (url, parameters, successCallback, failCallback, postFailCallback, postAlwaysCallback) {
            var posting = $.post(url, parameters, function (data, status) {
                if (status !== "success" || !data.success) {
                    if (!$.isFunction(failCallback) && $.isFunction(successCallback)) {
                        return successCallback(data, status);
                    }
                    if ($.isFunction(failCallback)) {
                        return failCallback(data.data, status);
                    }
                }
                if ($.isFunction(successCallback)) {
                    return successCallback(data.data, status);
                }
            });
            if ($.isFunction(postFailCallback)) {
                posting.fail(postFailCallback);
            }
            if ($.isFunction(postAlwaysCallback)) {
                posting.always(postAlwaysCallback);
            }
            return posting;
        },
        /**
         * Load parameter from variable defined in anyother place. You should
         * ensure the external variable defined, otherwise it will not work.
         * @param {variable} external External variable to be loaded. If this
         * variable is undefined, the internal will not be affected.
         * @param {variable} internal Property or internal variable should be set.
         * @param {string|undefined} type
         * @returns {undefined} this method will not return anything.
         */
        loadExternalParameter: function (external, internal, type) {
            if (external !== undefined) {
                if (type === undefined || typeof type !== "string") {
                    type = "string";
                }
                if (typeof external === type) {
                    internal = external;
                }
            }
        },
        initModule: function (module) {
            if (module.isActive === undefined || module.isActive) {
                if ($.isFunction(module.init)) {
                    module.init();
                }
                $.each(module, function () {
                    if ($.isPlainObject(this)) {
                        pub.initModule(this);
                    }
                });
            }
        }
    };
    return pub;
})(jQuery);

jQuery(document).ready(function () {
    rho.initModule(rho);
});