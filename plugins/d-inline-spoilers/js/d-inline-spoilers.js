jQuery(function($) {

    handle_hash_change();

    $(".spoiler-head").on("click", function() {
        toggle($(this));
    });

    $(window).on("hashchange", handle_hash_change);



    function handle_hash_change() {
        if (document.location.hash != "") {
            $spoiler = $(document.location.hash + " .spoiler-head");
            expand($spoiler);
        }
    }

    function toggle($spoiler) {
        $spoiler.toggleClass("expanded");
        $spoiler.next().stop();
        $spoiler.next().slideToggle("fast");
    }

    function expand($spoiler) {
        $spoiler.addClass("expanded");
        $spoiler.next().stop();
        $spoiler.next().slideDown("fast");
    }

    function collapse($spoiler) {
        $spoiler.removeClass("expanded");
        $spoiler.next().stop();
        $spoiler.next().slideUp("fast");
    }
});
