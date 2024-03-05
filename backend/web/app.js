$(function () {
    'use strict';
    $('#productFile').change(ev => {
        $(ev.target).closest('form').trigger('submit');
    })
});