<script>

	$(window).on('load', function() {

		$('.loader').fadeOut(1000);
	});

	var ww = $(window).width();
	var limit = 992;

function refresh() {
   ww = $(window).width();
   var w =  ww<limit ? (location.reload(true)) :  ( ww>limit ? (location.reload(true)) : ww=limit );
}

var tOut;
$(window).resize(function() {
    var resW = $(window).width();
    clearTimeout(tOut);
    if ( (ww>limit && resW<limit) || (ww<limit && resW>limit) ) {  
        tOut = setTimeout(refresh, 100);
    }
});

function slide(i, s, n) {
    var e = document.getElementById(i);
    s = s || 2e3, n = n || 400;

    function t(i) {
        l && clearTimeout(l);
        var e = null;
        ! function(e) {
            e.style.display = "block", e.style.opacity = 1;
            var s = +(new Date).getTime();
            ! function i() {
                e.style.opacity = Math.max(1 - (+new Date - s) / n, 0), 0 < +e.style.opacity && setTimeout(i, 16)
            }()
        }(r[c]), e = "number" == typeof i ? i : "prev" == i ? 0 == c ? r.length - 1 : c - 1 : c == r.length - 1 ? 0 : c + 1, setTimeout(function() {
            ! function(e) {
                e.style.display = "block", e.style.opacity = 0;
                var s = +(new Date).getTime();
                ! function i() {
                    e.style.opacity = Math.min((+new Date - s) / n, 1), +e.style.opacity < 1 && setTimeout(i, 16)
                }()
            }(r[e])
        }, n), c = e, l = setTimeout(t, s)
    }
    var r = e.getElementsByClassName("slider-page"),
        c = 0,
        l = setTimeout(t, s);
    e.getElementsByClassName("slider-prev")[0].addEventListener("click", function(i) {
        t(i.target.dataset.slideTo)
    }), e.getElementsByClassName("slider-next")[0].addEventListener("click", function(i) {
        t(i.target.dataset.slideTo)
    })
}


var totalPage, curPage, firstIn = true;
var data = [];

function showByType(i) {
    99 == i ? $(".thumb").fadeTo(300, 1) : ($(".thumb[category*=" + i + "]").fadeTo(300, 1), $(".thumb:not([category*=" + i + "])").fadeTo(300, 0))
}

function before() {
    $(".scrollingpage-index").hasClass("active") && $(".slider-prev").click(), $(".scrollingpage-projects").hasClass("active") && $(".prev-button").click()
}

function after() {
    $(".scrollingpage-index").hasClass("active") && $(".slider-next").click(), $(".scrollingpage-projects").hasClass("active") && $(".next-button").click()
}
$(document).ready(function() {

	var sarchitect = {!! json_encode($sarchitect) !!};
	var slocation = {!! json_encode($slocation) !!};

	if(sarchitect != 0) {
		$('.thumb[sarchitect={!! $sarchitect !!}]').fadeTo(300, 1);
		$('.thumb:not([sarchitect={!! $sarchitect !!}])').fadeTo(300, 0);
	}

	if(slocation != 0) {
		$('.thumb[slocation={!! $slocation !!}]').fadeTo(300, 1);
		$('.thumb:not([slocation={!! $slocation !!}])').fadeTo(300, 0);
	}

    slide("slidebox", 5e3, 300), $(".slider-page").imagefill(), $("#main-div").onepage_scroll({
        pagination: !1,
		responsiveFallback: 992,
        afterMove: function(i) {
            switch (i) {
                case 1:
                    $("#projects-menu").children("img").css("visibility", "hidden"), $("#projects-menu").children("span").css("visibility", "hidden"), $("#projects-menu").children("img").attr("src", "{{ url('images/icons/projects.svg') }}"), $("#about-menu").children("img").css("visibility", "hidden"), $("#about-menu").children("span").css("visibility", "hidden"), $("#about-menu").children("img").attr("src", "{{ url('images/icons/about.svg') }}"), $("#portfolio-menu").children("img").css("visibility", "hidden"), $("#admin-menu").children("img").css("visibility", "hidden"), $("#forward-menu").children("img").css("visibility", "inherit"), $("#backward-menu").children("img").css("visibility", "inherit"), $("#project-tags").children("ul").css("visibility", "hidden"), $("#project-tags").children("ul").children("li").css("visibility", "hidden"), curPage = 0;
                    break;
                case 2:
                    $("#projects-menu").children("img").css("visibility", "visible"), $("#projects-menu").children("span").css("visibility", "visible"), $("#projects-menu").children("img").attr("src", "{{ url('images/icons/projects-hover.svg') }}"), $("#about-menu").children("img").css("visibility", "hidden"), $("#about-menu").children("span").css("visibility", "hidden"), $("#about-menu").children("img").attr("src", "{{ url('images/icons/about.svg') }}"), $("#portfolio-menu").children("img").css("visibility", "hidden"), $("#admin-menu").children("img").css("visibility", "hidden"), $("#forward-menu").children("img").css("visibility", "inherit"), $("#backward-menu").children("img").css("visibility", "inherit"), $("#project-tags").children("ul").css("visibility", "inherit"), $("#project-tags").children("ul").children("li").css("visibility", "inherit"), curPage = 1;
                    break;
                case 3:
                    $("#projects-menu").children("img").css("visibility", "hidden"), $("#projects-menu").children("span").css("visibility", "hidden"), $("#projects-menu").children("img").attr("src", "{{ url('images/icons/projects.svg') }}"), $("#about-menu").children("img").css("visibility", "visible"), $("#about-menu").children("span").css("visibility", "visible"), $("#about-menu").children("img").attr("src", "{{ url('images/icons/about-hover.svg') }}"), $("#portfolio-menu").children("img").css("visibility", "hidden"), $("#admin-menu").children("img").css("visibility", "hidden"), $("#forward-menu").children("img").css("visibility", "inherit"), $("#backward-menu").children("img").css("visibility", "inherit"), $("#project-tags").children("ul").css("visibility", "hidden"), $("#project-tags").children("ul").children("li").css("visibility", "hidden"), curPage = 2
            }
        }
    }), $("#side-menu").mouseover(function() {
        $("#main-nav").css("visibility", "visible"), $("#project-tags").css("visibility", "visible"), $("#page-controls").css("visibility", "visible"), $("#portfolio-menu").children("img").css("visibility", "visible"), $("#projects-menu").children("img").css("visibility", "visible"), $("#about-menu").children("img").css("visibility", "visible"), $("#admin-menu").children("img").css("visibility", "visible")
    }), $("#side-menu").mouseout(function() {
        $("#main-nav").css("visibility", "hidden"), $("#project-tags").css("visibility", "hidden"), $("#page-controls").css("visibility", "hidden"), $("#portfolio-menu").children("img").css("visibility", "hidden"), 1 != curPage && $("#projects-menu").children("img").css("visibility", "hidden"), 2 != curPage && $("#about-menu").children("img").css("visibility", "hidden"), $("#admin-menu").children("img").css("visibility", "hidden")
    }), $(".logo-main").mouseover(function(i) {
        $(i.currentTarget).children("img").attr("src", "{{ url('images/icons/logo-hover.svg') }}")
    }), $(".logo-main").mouseout(function(i) {
        $(i.currentTarget).children("img").attr("src", "{{ url('images/icons/logo.svg') }}")
    }), $(".logo-main").click(function(i) {
        $("#main-div").moveTo(1)
    }), $("#portfolio-menu").mouseover(function(i) {
        $(i.currentTarget).children("img").attr("src", "{{ url('images/icons/portfolio-hover.svg') }}"), $(i.currentTarget).children("span").css("visibility", "visible")
    }), $("#portfolio-menu").mouseout(function(i) {
        $(i.currentTarget).children("img").attr("src", "{{ url('images/icons/portfolio.svg') }}"), $(i.currentTarget).children("span").css("visibility", "hidden")
    }), $("#projects-menu").mouseover(function(i) {
        $(i.currentTarget).children("img").attr("src", "{{ url('images/icons/projects-hover.svg') }}"), $(i.currentTarget).children("span").css("visibility", "visible")
    }), $("#projects-menu").mouseout(function(i) {
        1 != curPage && ($(i.currentTarget).children("img").attr("src", "{{ url('images/icons/projects.svg') }}"), $(i.currentTarget).children("span").css("visibility", "hidden"))
    }), $("#projects-menu").click(function(i) {
        $("#main-div").moveTo(2)
    }), $("#about-menu").mouseover(function(i) {
        $(i.currentTarget).children("img").attr("src", "{{ url('images/icons/about-hover.svg') }}"), $(i.currentTarget).children("span").css("visibility", "visible")
    }), $("#about-menu").mouseout(function(i) {
        2 != curPage && ($(i.currentTarget).children("img").attr("src", "{{ url('images/icons/about.svg') }}"), $(i.currentTarget).children("span").css("visibility", "hidden"))
    }), $("#about-menu").click(function(i) {
        $("#main-div").moveTo(3)
    }), $("#admin-menu").mouseover(function(i) {
        $(i.currentTarget).children("img").attr("src", "{{ url('images/icons/client-hover.svg') }}"), $(i.currentTarget).children("span").css("visibility", "visible")
    }), $("#admin-menu").mouseout(function(i) {
        $(i.currentTarget).children("img").attr("src", "{{ url('images/icons/client.svg') }}"), $(i.currentTarget).children("span").css("visibility", "hidden")
    }), $("#forward-menu").mouseover(function(i) {
        $(i.currentTarget).children("div").children("img").attr("src", "{{ url('images/icons/next-hover.svg') }}")
    }), $("#forward-menu").mouseout(function(i) {
        $(i.currentTarget).children("div").children("img").attr("src", "{{ url('images/icons/next.svg') }}")
    }), $("#backward-menu").mouseover(function(i) {
        $(i.currentTarget).children("div").children("img").attr("src", "{{ url('images/icons/previous-hover.svg') }}")
    }), $("#backward-menu").mouseout(function(i) {
        $(i.currentTarget).children("div").children("img").attr("src", "{{ url('images/icons/previous.svg') }}")
    }), $("#fullscreen-menu").mouseover(function(i) {
        $(i.currentTarget).children("div").children("img").attr("src", "{{ url('images/icons/fullscreen-hover.svg') }}")
    }), $("#fullscreen-menu").mouseout(function(i) {
        $(i.currentTarget).children("div").children("img").attr("src", "{{ url('images/icons/fullscreen.svg') }}")
	})
	
	var section = {!! json_encode($section) !!};

	if(section == 'projects') {
		$('#main-div').moveTo(2);
	} else if(section == 'about') {
		$('#main-div').moveTo(3);
	}

});

function fullscreen() {
  	var element = document.body;

	var isFullscreen = document.webkitIsFullScreen || document.mozFullScreen || false;

	element.requestFullScreen = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || function () { return false; };
	document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || function () { return false; };

	isFullscreen ? document.cancelFullScreen() : element.requestFullScreen();
}

$("#mobile-slider > li:gt(0)").hide();

setInterval(function() { 
  $('#mobile-slider > li:first')
    .fadeOut(500)
    .next()
    .fadeIn(500)
    .end()
    .appendTo('#mobile-slider');
},  5000);
</script>
<script src="js/ResizeSensor.js"></script>
<script src="js/ElementQueries.js"></script>
<script>
</script>