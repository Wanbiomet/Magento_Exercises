// define([
//     'jquery',
//     'Magento_Catalog/js/price-utils',
//     'jquery/ui'
// ], function ($, priceUtils) {
//     'use strict';
//
//     $.widget('Magenest_Movie.productSwitcher', {
//         _create: function () {
//             var config = this.options.jsonConfig,
//                 $productName = $('.product-info-main .page-title .base'),
//                 $productImage = $('.product.media img');
//
//             this._on({
//                 'change .super-attribute-select': function () {
//                     var selectedProductId = this.options.spConfig.selectedProductId;
//
//                     if (config.names[selectedProductId]) {
//                         $productName.text(config.names[selectedProductId]);
//                     }
//
//                     if (config.images[selectedProductId]) {
//                         var imageUrl = config.images[selectedProductId][0].url; // get first image
//                         $productImage.attr('src', imageUrl);
//                     }
//                 }
//             });
//         }
//     });
//
//     return $.Magenest_Movie.productSwitcher;
// });
