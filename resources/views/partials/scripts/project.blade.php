<script>
$(window).on('load', function() {

	
$(".loader").fadeOut(3000, function() {
$("#side-menu").fadeIn(1000); 
$("#main-div").fadeIn(1000);          
});
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

	var totalPage, curPage, firstIn = true;
	var select = [];
	var data=[];
	var curIndex = 0;


	$(document).ready(function() {
		slide('slidebox', 5000, 300);

	

		$('#side-menu').mouseover(function() {
			$('#main-nav').css('visibility', 'visible');
			$('#project-info').css('visibility', 'visible');
			$('#page-controls').css('visibility', 'visible');
		});

		$('#side-menu').mouseout(function() {
			$('#main-nav').css('visibility', 'hidden');
			$('#project-info').css('visibility', 'hidden');
			$('#page-controls').css('visibility', 'hidden');
		});

		$('.logo-main').mouseover(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/logo-hover.svg') }}");
		});

		$('.logo-main').mouseout(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/logo.svg') }}");
		});

		$('#portfolio-menu').mouseover(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/portfolio-hover.svg') }}");
			$(e.currentTarget).children('span').css('visibility', 'visible');
		});

		$('#portfolio-menu').mouseout(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/portfolio.svg') }}");
			$(e.currentTarget).children('span').css('visibility', 'hidden');
		});

		$('#projects-menu').mouseover(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/projects-hover.svg') }}");
			$(e.currentTarget).children('span').css('visibility', 'visible');
		});

		$('#projects-menu').mouseout(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/projects.svg') }}");
			$(e.currentTarget).children('span').css('visibility', 'hidden');
		});

		$('#about-menu').mouseover(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/about-hover.svg') }}");
			$(e.currentTarget).children('span').css('visibility', 'visible');
		});

		$('#about-menu').mouseout(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/about.svg') }}");
			$(e.currentTarget).children('span').css('visibility', 'hidden');
		});

		$('#admin-menu').mouseover(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/client-hover.svg') }}");
			$(e.currentTarget).children('span').css('visibility', 'visible');
		});

		$('#admin-menu').mouseout(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/client.svg') }}");
			$(e.currentTarget).children('span').css('visibility', 'hidden');
		});

		data = {!! json_encode($photos) !!};

		var curSel = getCookie('photo-selection');

		if(curSel != null) {
			select = curSel.split('_');
			for(var i = 0; i < select.length; i++) {
				select[i] = parseInt(select[i]);
			}
			if(select.indexOf(data[curIndex].id) != -1) {
				$('#select-photo').children('img').attr('src', "{{ url('images/icons/select-hover.svg') }}");
			}
			$('#badge').text(select.length);
		}

		$('.count').text("1-{!! $nphotos !!}");

		$('#make-pdf').mouseover(function(e) {
			$('.info-pdf').fadeIn('fast');
		});

		$('#make-pdf').mouseout(function(e) {
			$('.info-pdf').fadeOut('fast');
		});

		$('.turnback').mouseover(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/back-hover.svg') }}");
		});

		$('.turnback').mouseout(function(e) {
			$(e.currentTarget).children('img').attr('src', "{{ url('images/icons/back.svg') }}");
		});

		$('#forward-menu').mouseover(function(e) {
			$(e.currentTarget).children('div').children('img').attr('src', "{{ url('images/icons/next-hover.svg') }}");
		});

		$('#forward-menu').mouseout(function(e) {
			$(e.currentTarget).children('div').children('img').attr('src', "{{ url('images/icons/next.svg') }}");
		});

		$('#backward-menu').mouseover(function(e) {
			$(e.currentTarget).children('div').children('img').attr('src', "{{ url('images/icons/previous-hover.svg') }}");
		});

		$('#backward-menu').mouseout(function(e) {
			$(e.currentTarget).children('div').children('img').attr('src', "{{ url('images/icons/previous.svg') }}");
		});

		$('#fullscreen-menu').mouseover(function(e) {
			$(e.currentTarget).children('div').children('img').attr('src', "{{ url('images/icons/fullscreen-hover.svg') }}");
		});

		$('#fullscreen-menu').mouseout(function(e) {
			$(e.currentTarget).children('div').children('img').attr('src', "{{ url('images/icons/fullscreen.svg') }}");
		});
	});

	function before() {
		if(curIndex <= 0) return;
		$('.slider-prev').click();
	}

	function after() {
		if(curIndex >= data.length-1) return;
		$('.slider-next').click();
	}

	function selectPhoto() {
		var index = select.indexOf(data[curIndex].id);
		if(index != -1) {
			select.splice(index, 1);
			setCookie('photo-selection', select.join('_'));
			$('#select-photo').children('img').attr('src', "{{ url('images/icons/select.svg') }}");
			$('#badge').text(select.length);
		} else {
			select.push(data[curIndex].id);
			setCookie('photo-selection', select.join('_'));
			$('#badge').text(select.length);
			$('#select-photo').children('img').attr('src', "{{ url('images/icons/select-hover.svg') }}");
		}
	}

	function makePDF() {
		if(select.length == 0) return;
		delCookie('photo-selection');
		window.open('/pdf/create?photos=' + select.join('-'));
		window.location.reload();
	}

	function setCookie(name,value) {
		var Days = 30;
		var exp = new Date();
		exp.setTime(exp.getTime() + Days*24*60*60*1000);
		document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
	}

	function getCookie(name) {
		var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
		if(arr=document.cookie.match(reg))
			return unescape(arr[2]);
		else
			return null;
	}

	function delCookie(name) {
		var exp = new Date();
		exp.setTime(exp.getTime() - 1);
		var cval=getCookie(name);
		if(cval!=null)
			document.cookie= name + "="+cval+";expires="+exp.toGMTString();
	}

	function slide(id, showTime, fadeTime) {
		var doc = document.getElementById(id), showTime = showTime || 2000, fadeTime = fadeTime || 400;


		function fadeIn(el) {
			el.style.display = 'block';
			el.style.opacity = 0;
			var time = +new Date().getTime();
			function foo() {
				el.style.opacity = Math.min((+new Date() - time) / fadeTime, 1);
				if (+el.style.opacity < 1) {
					setTimeout(foo, 16);
				}
			}
			foo();
		}

		function fadeOut(el) {
			el.style.display = 'block';
			el.style.opacity = 1;
			var time = +new Date().getTime();
			function foo() {
				el.style.opacity = Math.max((1 - (+new Date() - time) / fadeTime), 0);
				if (+el.style.opacity > 0) {
					setTimeout(foo, 16);
				}
			}
			foo();
		}


		function slideMain(index) {
			if (timer) {
				clearTimeout(timer);
			}
			var next = null;
			fadeOut(sliderPages[cur]);
			if (typeof index == 'number') {
				next = index;
			} else if (index == 'prev') {
				next = (cur == 0) ? (sliderPages.length - 1) : (cur - 1);
			} else if (index == 'next') {
				next = (cur == sliderPages.length - 1) ? 0 : (cur + 1);
			} else if (cur == sliderPages.length - 1) {
				next = 0;
			} else {
				next = cur + 1;
			}
			function fii() {
				$(".count").text((next+1)+"-{!! $nphotos !!}");
					curIndex=next;
					if(select.indexOf(data[curIndex].id)!=-1){
						$('#select-photo').children('img').attr('src', "{{ url('images/icons/select-hover.svg') }}");
					}else{
						$('#select-photo').children('img').attr('src', "{{ url('images/icons/select.svg') }}");
					}

				fadeIn(sliderPages[next]);
			}
			setTimeout(fii,fadeTime);
			cur = next;
			timer = setTimeout(slideMain, showTime);
		}


		var sliderPages = doc.getElementsByClassName('slider-page');
		var cur = 0;
		var timer = setTimeout(slideMain, showTime);

		doc.getElementsByClassName('slider-prev')[0].addEventListener('click', function (e) {
			slideMain(e.target.dataset.slideTo);
		});

		doc.getElementsByClassName('slider-next')[0].addEventListener('click', function (e) {
			slideMain(e.target.dataset.slideTo);
		})

	};

function fullscreen() {
  	var element = document.body;

	var isFullscreen = document.webkitIsFullScreen || document.mozFullScreen || false;

	element.requestFullScreen = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || function () { return false; };
	document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || function () { return false; };

	isFullscreen ? document.cancelFullScreen() : element.requestFullScreen();
}
</script>