var $ = jQuery.noConflict();
$(document).ready(function ($) {
    $('.selectDate').persianDatepicker({
        initialValue: false,
        autoClose: true,
        format: "YYYY-MM-DD"
    });
});