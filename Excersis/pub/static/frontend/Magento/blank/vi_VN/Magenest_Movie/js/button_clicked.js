define([
    'jquery',
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/modal/modal'
], function ($,alert,modal) {
    'use strict';

    return function () {
        $(document).ready(function() {
            //Event btn2
            $('#btn2').on('click', function() {
                alert({
                    title: 'Alert Modal',
                    modalClass: 'alert',
                    content: 'hello world!',
                    clickableOverlay:true,
                    actions: {
                        always: function(){}
                    }
                });
            });
            //Event btn3
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                title: 'Login Modal',
                buttons: [{
                    text: $.mage.__('Close'),
                    class: 'modal-close',
                    click: function (){
                        this.closeModal();
                    }
                }]
            };

            modal(options, $('#custom-content'));
            $("#btn3").on('click',function(){
                $("#custom-content").modal("openModal");
            });
        });
    };
});

