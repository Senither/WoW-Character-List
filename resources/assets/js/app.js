
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

jQuery(function($) {
    $(".toggle").click(function() {
        $("#panel").slideToggle(300, function() {
            $(".toggle").toggleClass("active"); 
        });
    });

    $(".softbutton").stop().fadeTo("fast", 0.4);
    $(".softbutton").hover(
        function () {
            $(this).stop().fadeTo("fast", 1);
        },
        function () {
            $(this).stop().fadeTo("fast", 0.4);
        }
    );

    // Used to scroll to a specific position.
    // Edit the variables below to adjust speed and positioning
    var scrollDuration = 500; // 1000 = 1 second
    var scrollGap = 0; // in Pixels, the gap left above the scroll to point
    $('a[href*=#jump-]').click(function()
    {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname)
        {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
            if ($target.length)
            {
                var targetOffset = $target.offset().top - scrollGap;
                $('html,body').animate
                    (
                    {scrollTop: targetOffset},
                    scrollDuration
                    );
                return false;
            }
        }
    });
});
