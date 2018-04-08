$(function() {

    'use strict';

    $('.confirm').click(function() {
        return confirm('Are You Sure');
    });

    $('.card-header i').click(function() {

        $(this).parent('.card-header').next('.card-body').slideToggle(200);

    });

    $('.gallary').mixItUp();

});