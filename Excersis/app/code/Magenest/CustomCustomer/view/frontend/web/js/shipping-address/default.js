define([
    'Magenest_CustomCustomer/js/shipping-address/default'
], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Magenest_CustomCustomer/shipping-address/default'
        },

        /**
         * Override để thêm trường 'vn_region'
         */
        getVnRegion: function () {
            return this.address().customAttributes.vn_region;
        }
    });
});
