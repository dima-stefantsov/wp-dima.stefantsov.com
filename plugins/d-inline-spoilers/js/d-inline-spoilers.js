jQuery(function($) {

    handle_hash_change();

    $(".spoiler-head").on("click", function() {
        if ($(this).hasClass("expanded")) {
            collapse($(this));
        }
        else {
            expand($(this));
        }
    });

    $(window).on("hashchange", handle_hash_change);



    function handle_hash_change() {
        if (document.location.hash != "") {
            $spoiler = $(document.location.hash + " .spoiler-head");
            expand($spoiler);
        }
    }

    function expand($spoiler) {
        $spoiler.removeClass("collapsed");
        $spoiler.addClass("expanded");
        $spoiler.next().slideDown("fast");
    }

    function collapse($spoiler) {
        $spoiler.removeClass("expanded");
        $spoiler.addClass("collapsed");
        $spoiler.next().slideUp("fast");
    }
});
