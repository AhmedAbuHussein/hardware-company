/** global $, alert ,window*/

$(function() {

    'use strict';
    $('.gallary').mixItUp();

    $('.card-toggle').click(function() {
        $(this).next().slideToggle();
    })

});