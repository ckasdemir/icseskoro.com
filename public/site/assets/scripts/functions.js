(function ($) {
    "use strict";

    // Menu Items Limit

    var maxItems = 10; // Change Number of Items here
    var totalItems = jQuery('.navigation>ul').find('>li').length;
    if (totalItems > maxItems) {
        jQuery('.navigation>ul>li:nth-child(' + maxItems + ') ~ li').wrapAll('<li></li>').wrapAll('<ul class="sub-dropdown"></ul>');
        jQuery('.navigation>ul>li:last-child').prepend('<a href="#">More</a>');
    }

    // Responsive Menu

    jQuery(document).ready(function () {
        jQuery('.navigation>ul').slicknav();
        /*
                // JPlatyer

                if (jQuery('#jquery_jplayer_1').length != '') {
                    new jPlayerPlaylist({
                        jPlayer: "#jquery_jplayer_1",
                        cssSelectorAncestor: "#jp_container_1"
                    }, [{
                        title: "Cro Magnon Man - Demo",
                        mp3: "http://127.0.0.1:8000/uploads/albums/1544099396-album-2/songs/1544103258-demo.mp3"
                    }, {
                        title: "Your Face",
                        mp3: "http://www.jplayer.org/audio/mp3/TSP-05-Your_face.mp3"
                    }, {
                        title: "Cyber Sonnet",
                        mp3: "http://www.jplayer.org/audio/mp3/TSP-07-Cybersonnet.mp3"
                    }, {
                        title: "Tempered Song",
                        mp3: "http://www.jplayer.org/audio/mp3/Miaow-01-Tempered-song.mp3"
                    }, {
                        title: "Hidden",
                        mp3: "http://www.jplayer.org/audio/mp3/Miaow-02-Hidden.mp3"
                    },], {
                        swfPath: "../../dist/jplayer",
                        supplied: "mp3",
                        wmode: "window",
                        useStateClassSkin: true,
                        autoBlur: false,
                        smoothPlayBar: true,
                        keyEnabled: true,
                        solution: 'html, flash'
                    });
                }
                */
    });

    jQuery(window).load(function () {
        if (jQuery('.flexslider').length != '') {
            jQuery('.flexslider').flexslider({
                slideshowSpeed: 4000,
                animationDuration: 1100,
                animation: 'slide',
                directionNav: false,
                controlNav: false,
                pausePlay: false,

                start: function (slider) {
                    jQuery('.flexslider').removeClass('px-loading');
                    jQuery('.flexslider').find('.loader').remove();
                }
            });
        }
    });
})(jQuery);



