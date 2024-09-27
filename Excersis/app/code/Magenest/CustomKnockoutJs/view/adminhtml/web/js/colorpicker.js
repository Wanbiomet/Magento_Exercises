// define([
//     "jquery",
//     "jquery/colorpicker"
// ], function($) {
//     "use strict";
//
//     $(document).ready(function() {
//         // Khởi tạo color picker cho tất cả các input với class 'color-picker'
//         $(".color-picker").each(function() {
//             $(this).colorpicker({
//                 // Bạn có thể tùy chỉnh các tùy chọn ở đây
//                 format: 'hex',
//                 align: 'left'
//             }).on('changeColor', function(event) {
//                 $(this).val(event.color.toString());
//             });
//         });
//     });
// });
