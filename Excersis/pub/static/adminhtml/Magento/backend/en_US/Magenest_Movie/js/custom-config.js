define(['jquery', 'mage/adminhtml/variables'], function ($) {
    'use strict';

    return function (config, element) {
        function toggleFieldVisibility() {
            $(document).ready(function () {
                var customSelectValue = $('#movie_magenest_movie_custome_select').val();
                console.log(customSelectValue)

                if (customSelectValue === 1) {
                    $('#movie_magenest_movie_actor_count').attr("disabled","disabled");
                } else {
                    $('#movie_magenest_movie_actor_count').remove("disabled");
                }
            })
        }
        // Initial check on page load
        toggleFieldVisibility();

        // Add change event listener to the select field
        $('#movie_magenest_movie_custome_select').on('change', function () {
            toggleFieldVisibility();
        });
    };
});
