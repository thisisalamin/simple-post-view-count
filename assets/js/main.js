/**
 * Initializes the counter animation.
 * @param {jQuery} $ - The jQuery object.
 */
jQuery(document).ready(function($) {
    /**
     * Animates the counter element.
     * @param {number} now - The current value of the counter.
     */
    $('#counter').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
});