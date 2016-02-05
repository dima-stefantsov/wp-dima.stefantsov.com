jQuery(function () {
    jQuery(".spoiler-head").on('click', function (event) {
        $this = jQuery(this);
        if ($this.hasClass("expanded")) {
            $this.removeClass("expanded");
            $this.addClass("collapsed");
            $this.next().slideUp("fast");
        } else {
            $this.removeClass("collapsed");
            $this.addClass("expanded");
            $this.next().slideDown("fast");
        }
    });
});
