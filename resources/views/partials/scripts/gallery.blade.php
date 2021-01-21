<script>
		(function (scope) {
	if (window.matchMedia && window.matchMedia('(max-width:600px)').matches) {
		return;
	}

	var imageLoader = {
		isLoading: false, // The state of the image that is loading
		callback: null, // Contains the callback for the image that is loading

		loadingPath: '',

		init: function () {
			this.imgLoader = $('<img src="" class="imgLoader" alt="{title}">').appendTo(document.body).css({
				position: 'absolute',
				left: -4000
			});

			var that = this;

			this.imgLoader.on('load', function () {
				that.loaded();
			});
		},

		loaded: function () {
			this.callback($(this.imgLoader).clone());
			this.isLoading = false;
		},

		load: function (src, cb) {
			this.isLoading = true;
			this.callback = cb;

			if (this.imgLoader.attr('src') === src) {
				this.loaded();
				return;
			}

			this.imgLoader.attr('src', src);

			if (this.imgLoader.complete) {
				this.loaded();
			}
		},

		cancel: function() {
			this.callback = null;
		}
	};

	var imageResize = function (img, cont, noCrop) {
		var imgSize = {x: $(img).outerWidth(), y: $(img).outerHeight()},
		contSize = {x: $(cont).innerWidth()-80, y: $(cont).innerHeight()-25};


		var widthRatio = Math.abs(imgSize.x/imgSize.y),
			heightRatio = Math.abs(imgSize.y/imgSize.x),

		width = imgSize.x,
		height = imgSize.y;

		if (!noCrop) {
			if (widthRatio > heightRatio) {
				if (imgSize.x > contSize.x) {
					width = contSize.x;
					height = width/widthRatio;
				}
			} else {
				if (imgSize.y > contSize.y) {
					height = contSize.y;
					width = height/heightRatio;
				}
			}
		} else {
			var ratio = null;
			if (imgSize.x > contSize.x) {
				ratio = contSize.x/imgSize.x
			} else if (imgSize.y > contSize.y) {
				ratio = contSize.y/imgSize.y;
			}

			width = imgSize.x * ratio;
			height = imgSize.y * ratio;

			if (width > contSize.x) {
				ratio = contSize.x/width;
				width = width * ratio;
				height = height * ratio;
			} else if (height > contSize.y) {
				ratio = contSize.y/height;
				width = width * ratio;
				height = height * ratio;
			}

			if (width == 0 && height == 0) {
				width = imgSize.x;
				height = imgSize.y;
			}
		}

		return {x: width, y: height};
	};



	scope.gallery = function (opts) {
		var that = {},
			tid = null,
			cont = opts.cont,
			isRunning = false,
			isLoading = false,
			paths = opts.paths,
			resize = opts.resize || false,
			noCrop = opts.noCrop || false,
			loops = opts.loops || true,
			loadFirst = opts.loadFirst || false,
			nextBtn = $('<a href="#" class="nextBtn">Next</a>').appendTo(cont),
			prevBtn = $('<a href="#" class="prevBtn">Prev</a>').appendTo(cont),

			imageLoaded = opts.imageLoaded || false,

			cur = 0;


		var next = function () {
			if (!isRunning) {
				if (cur+1 < paths.length) {
					cur++;
				} else if (loops) {
					cur = 0;
				} else {
					return false;
				}

				isRunning = true;
				loadImage(paths[cur]);
			}

			return false;
		},

		previous = function () {
			if (!isRunning) {
				if (cur-1 >= 0) {
					cur--;
				} else if (loops) {
					cur = paths.length-1;
				} else {
					return false;
				}

				isRunning = true;
				loadImage(paths[cur]);
			}

			return false;
		},


		// Declare our methods
		// loadImage loads an image obviously!
		loadImage = function (path) {
			isLoading = true;
			var old = $('img', cont); // Get old image

			imageLoader.cancel();

			// Start loading image using image loader
			imageLoader.load(path, function (img) {
				// Get the image size
				var size = imageResize(imageLoader.imgLoader, cont, noCrop),

				// Define a callback for when the out fx has run
				cb = function () {
					isLoading = false;
					$(window).trigger('galleryLoad', [path]);

					$('a[href="'+$(old).attr('src')+'"] img').css('opacity', 0.5);
					// First remove the old image
					$(old).remove('img');

					// Inject a new image with the new path and set its width and height
					that.curImg = $('<img src="'+path+'" />');
					if (resize) {
						$(that.curImg).attr({width: size.x, height: size.y});

						$(that.curImg).css({marginTop: (($(cont).innerHeight()-25)-Math.floor(size.y))/2});
					}

					// Inject new image
					$(cont).append(that.curImg);

					if (imageLoaded)
						imageLoaded(that.curImg);

					$('a[href="'+path+'"] img').css('opacity', 1);
					// Run in fx on the
					inFx(that.curImg, function () {
						isRunning = false;
						$(window).trigger('galleryLoadEnd');
					});
				};


				if (old && old.length) {
					outFx(old, cb);
				} else {
					cb();
				}
			});
		},

		// inFx animates a target image in
		inFx = opts.inFx || function (img, cb) {
			$(img).css('opacity', 0).animate({opacity: 1}, 700, cb);
		},

		// outFx animates a target image out
		outFx = opts.outFx || function (img, cb) {
			$(img).css('opacity', 1).animate({opacity: 0}, 400, cb);
		};

		// Setup our click handlers
		$('.next-button', cont).click(next);
		$('.prev-button', cont).click(previous);


		if ($('body#showcase').length) {
			tid = setInterval(next, 5000);
			$(cont).mousemove(function () {
				if (tid)
					clearInterval(tid);
			});
			$(cont).mouseleave(function () {
				tid = setInterval(next, 5000);
			});
		}




		// Expose public methods and properties
		that.getCur = function (i) {return cur;};
		that.setCur = function (i) {cur = i};
		that.paths = paths;
		that.next = next;
		that.previous = previous;
		that.loadImage = function (path) {
			if (isLoading) {
				$(window).bind('galleryLoadEnd', function load () {
					loadImage(path);
					$(window).unbind('galleryLoadEnd', load);
				});
			} else {
				loadImage(path);
			}
		};

		// Load first image in paths
		if (loadFirst) {
			setTimeout(function () {
				loadImage(paths[cur]);
			}, 1000);
		}


		return that;
	};




	$(function () {
		// Initialize our image loader
		imageLoader.init();

		// Porfolio and projects have shared functionality
		if (document.body.id === 'portfolio' || document.body.id === 'projects') {
			// Porfolio
			// Get all our gallery paths and hide any existing elements
			var paths = [];
			$('body #nav .thumbslide a').each(function (i, a) {
				paths.push($(a).attr('href'));
			});

			// Setup a gallery container
			var galCont = $('<div class="wall"></div>').appendTo($('#wall'));
			// Set the height of the gallery container to its max height possible
			$(galCont).css('height', $('#content').outerHeight()-$('#push').outerHeight()-60);

			// Setup our gallery instance
			var portGal = gallery({
				cont: galCont,
				paths: paths,
				loadFirst: true,
				resize: true,
				noCrop: true,
				imageLoaded: function () {
					$('#views .numbering .current').text(portGal.getCur()+1);
					$('#views .numbering .total').text('- '+portGal.paths.length);
				}
			});


			var preLoading = [];
			$(window).bind('galleryLoad', function (e, path) {
				$(preLoading).remove();

				var cur = $('.thumbslide a[href="' + path + '"]');
				var prev = $(cur).parent('li').prevAll().find('a').splice(0, 5);
				var next = $(cur).parent('li').nextAll().find('a').splice(0, 5);

				var l = prev.length > next.length ? prev.length : next.length;
				var i = 0;

				for (; i < l; i++) {
				if (prev[i] !== undefined) {
					preLoading.push($('<img src="' + $(prev[i]).attr('href') + '">'));
				}

				if (next[i] !== undefined) {
					preLoading.push($('<img src="' + $(next[i]).attr('href') + '">'));
				}
				}
			});

			// Setup the thumbnail slider
			$('.thumbslide').wrap('<div class="thumbCut" />');
			$('.thumbslide').before('<a href="#" class="nextBtn">Next</a> <a href="#" class="prevBtn">Prev</a>');

			if ($('.numbering .thmb').hasClass('active')) {
				$('.ml-logo').last().css({opacity: 0});
			}

			$('.ml-logo').last().animate({opacity: 1});
			$('.sticky').animate({top: 100});
			$('.thumbCut').animate({height: 0}, 250, null, function () {
				$(this).css({display: 'none'});
				$(galCont).css('height', ($('#content').outerHeight()-$('#push').outerHeight()-60)+100);
			});

			// Setup the thumbslider toggling
			$('.numbering .lrge').click(function (e) {
				e.preventDefault();

				if (!$(this).hasClass('active')) {
					$('.ml-logo').last().animate({opacity: 1});
					$('.sticky').animate({top: 100});
					$('.thumbCut').animate({height: 0}, 250, null, function () {
						$(this).css({display: 'none'});
						$(galCont).css('height', ($('#content').outerHeight()-$('#push').outerHeight()-60)+100);
						portGal.loadImage(portGal.paths[portGal.getCur()]);
					});
					$(this).parent().find('.thmb.active').removeClass('active');
					$(this).addClass('active');
				}
			});

			$('.numbering .thmb').click(function (e) {
				e.preventDefault();
				var that = this;
				if (!$(this).hasClass('active')) {
					$('.ml-logo').last().animate({opacity: 0});
					$('.sticky').animate({top: 0});
					$('.wall .next-button, .wall .prev-button').fadeOut(250);
					$('.thumbCut').css('display', 'block').animate({height: 90}, 250, null, function () {
						$(galCont).css('height', ($('#content').outerHeight()-$('#push').outerHeight()-60));
						portGal.loadImage(portGal.paths[portGal.getCur()]);
						$(that).html('Thumbs'); // removed &darr;
						$(that).addClass('thumbsup'); // added class
						$('.thumbslide').trigger('toggle');
					});
					$(this).parent().find('.lrge.active').removeClass('active');
					$(this).addClass('active');
				} else {
					$('.ml-logo').last().animate({opacity: 1});
					$('.sticky').animate({top: 100});
					$('.wall .next-button, .wall .prev-button').fadeIn(250);
					$('.thumbCut').css('display', 'block').animate({height: 0}, 250, null, function () {
						$(this).css({display: 'none'});
						$(galCont).css('height', ($('#content').outerHeight()-$('#push').outerHeight()-60)+100);
						portGal.loadImage(portGal.paths[portGal.getCur()]);
						$(that).html('Thumbs');
					});
					$(this).removeClass('active');
				}
			});


			$('.thumbslide li img').css({opacity: 0.5});


			// Portfolio needs to load images one by one
			if (document.body.id === 'portfolio') {
	//			$('.thumbslide li img').css({display: 'none'}); // Hide all images

				var portJson;
				$.ajax({
					url: '/portfolio/json',
					dataType: 'json',
					success: function (json) {
						portJson = json.items;
					}
				});

				$(window).bind('galleryLoad', function (e, href) {
					$(portJson).each(function (i, item) {
						if (item.largeSrc === href) {
							$('#client h4').text(item.client);
							$('#architect h4').text(item.architect);

							if (item.commission && item.commission.length > 0) {
								$('#pdf').css('display', 'block');
								$('#pdf h4 a').attr('href', item.commission).text(item.alt);
							} else {
								$('#pdf').css('display', 'none');
							}

							if (item.project && item.project.length) {
								$('#proj h4').show();
								$('#proj h4 a').attr('href', item.project);
							} else {
								$('#proj h4').hide();
							}
						}
					});
				});
			}


			if ($('.thumbslide').length) {
				(function checkThumbs () {
					var animLeft = null,
					thumbLis = $('.thumbslide li'),
					cutWidth = $('.thumbslide').parent('.thumbCut').width(),
					thumbOffset = parseInt($('.thumbslide').css('left'));

					for (var i = 0; i < thumbLis.length; i++) {
						var li = thumbLis[i],
						liPos = $(li).position(),
						liWidth = $(li).width();

						if (liPos.left+liWidth > cutWidth) {
							animLeft = $(thumbLis[i-1]).position().left+$(thumbLis[i-1]).width();
							i = thumbLis.length;
						}
					}
				})();

				// Checks and hides relevant nav items
				var checkThumbNav = function (thumbOffset) {
					var lastLiOffset = $('.thumbslide li').last().offset().left;
					$('.thumbCut .prev-button').css('display', (thumbOffset === 0) ? 'none' : 'block');
					$('.thumbCut .next-button').css('display', (lastLiOffset+thumbOffset < $('.thumbCut').width()) ? 'none' : 'block');
				};
				$('.thumbslide').bind('toggle', function () {
					var thumbOffset = parseInt($('.thumbslide').css('left'));
					console.log('here',thumbOffset);
					checkThumbNav(thumbOffset);
				});

				checkThumbNav(0);

				$('.thumbCut .next-button, .thumbCut .prev-button').live('click', function (e) {
					e.preventDefault();

					var thumbslide = $(this).parent().find('.thumbslide'),
					cutWidth = $(thumbslide).parent('.thumbCut').width(),
					thumbOffset = parseInt($(thumbslide).css('left')),
					animLeft = null;

					if ($(e.target).text().toLowerCase() === 'next') {
						var oldImgs = $('li', thumbslide);

						var thumbLis = oldImgs;

						for (var i = 0; i < thumbLis.length; i++) {
							var li = thumbLis[i],
							liPos = $(li).position(),
							liWidth = $(li).width();

							if (liPos.left+liWidth > cutWidth) {
								animLeft = $(thumbLis[i-1]).position().left+$(thumbLis[i-1]).width();
								i = thumbLis.length;
							}
						}

						if (animLeft !== null) {
							$(thumbslide).animate({left: -(cutWidth-68)+thumbOffset}, 500);
							checkThumbNav(-(animLeft)+thumbOffset);
						}
					} else if ($(e.target).text().toLowerCase() === 'prev') {
						$(thumbslide).animate({left: (cutWidth-68)+thumbOffset}, 500);
						checkThumbNav((cutWidth-68)+thumbOffset);
					}

				});

				// This links the gallery with the navigation at the bottom
				$('#nav .thumbslide a').live('click', function (e) {
					e.preventDefault();
					// Get the links href to match to the paths in the	 gallery
					var href = $(this).attr('href');

					// Loop through the paths that are in the gallery
					$(portGal.paths).each(function (i, path) {
						// If there is a match set the gallery to load this image
						if (path === href) {
							// Set current gallery array position
							portGal.setCur(i);

							// Then load the new current item
							portGal.loadImage(portGal.paths[portGal.getCur()]);

							// Escape the loop
							return;
						}

					});

					return false;
				});
			}
		}

		// Navigation toggler
		var wrap = $('#nav .frame'),
		logo = $('h2', wrap).css('opacity', 0),
		logo2 = $('#nav .logopin a').css('opacity', 1),
		shown = false,
		height = $(wrap).innerHeight(),
		toggle = $('#nav .toggle');

		$(wrap).css({height: 0});

		$(toggle).click(function (e) {
			e.preventDefault();

			if (!shown) {
				$(logo2).animate({opacity: 0}, 120, function () {
					$(wrap).animate({height: height}, 500, function () {
						$(logo).animate({opacity: 1}, 120);
						shown = true;
						$(toggle).text('Close Menu');
					});
				});
			} else {
				$(logo).animate({opacity: 0}, 120, function () {
					$(wrap).animate({height: 0}, 500, function () {
						$(logo2).animate({opacity: 1}, 120);
						shown = false;
						$(toggle).text('Open Menu');
					});
				});
			}

			//$(wrap).stop();
			//$(wrap).animate({
				//height: shown ? 0 : height
			//}, 500, function () {
				//$(toggle).text((!shown ? 'Close' : 'Open') + ' Menu');
				//shown = !shown;
			//});
			return false;
		});

	});


	// projects grid view
	$(function () {
		if (($(document.body).attr('id') === 'projects' || $(document.body).attr('id') === 'downloads') && $('#content #thumbs').length) {
			$('#thumbs .thumb').css('visiblity', 'hidden');

				var cont, width, height, curPage, pageLoading, images, rowCount, pageTotal, pages, pageEls;
				var setup = function () {
					$('#thumbs .thumb').css({display: 'none', opacity: 0});

					cont = $('#thumbs');
					if(window.innerHeight>800){
						width = window.innerWidth-240;
						height = window.innerHeight-120;

					}else{
						width = window.innerWidth-180;
						height = window.innerHeight-107;

					}

					curPage = null;
					pageLoading = false; // Is a page being loaded
					images = $('.thumb', cont);
					rowCount = Math.floor(width/170);
					colCount = Math.floor(height/124);
					pageTotal = rowCount*colCount;
					pages = Math.ceil(images.length/pageTotal);

					$(cont).height(window.innerHeight-65);

					pageEls = [];

					// We need to seperate images into divs to animate off the screen
					// this one is the first page
					for (var i = 0; i < pages; i++) {
						var pageDiv = $('<div class="page" style="position: relative;"></div>').appendTo(cont);
						pageEls.push(pageDiv); // This is used for easy navigation

						for (var j = 0; j < pageTotal; j++) {
							var img = images[j+(i*pageTotal)];

							if (img) {
								$(img).appendTo(pageDiv)
							}
						}
					}
				};

				setup();

				var resizeTid = null;



				$('.prev-button', cont).bind('click', function () {
					if (curPage-1 >= 0) {
						loadPage(curPage-1);
					}
					return false;
				});

				$('.next-button', cont).bind('click', function () {
					if (curPage+1 < pages) {
						loadPage(curPage+1);
					}
					return false;
				});

				var loadPage = function (page, dir) {
					var fadeIn = function () {
						var curPageEl = pageEls[curPage];
						var pageEl = pageEls[page];

						var showNewPage = function () {
							$(pageEl).css({display: 'block'});
							var thumbs = $('.thumb', pageEl);

							$(thumbs).each(function (i, el) {
								$(el).css('display', 'block').delay(i*100).animate({opacity: 1}, 550);
							});

							curPage = page;

							checkNav();
						};

						if (curPageEl) {
							$(curPageEl).animate({left: (page > curPage) ? -width : width}, 250, function () {
								$(curPageEl).css({display: 'none'});
								$(pageEl).find('.thumb').css({opacity: 0});
								$(pageEl).css({left: 0});
								showNewPage();
							});
						} else {
							showNewPage();
						}

					};
					fadeIn();

				};

				var checkNav = function () {
					$('.prev-button', cont).css({display: ((curPage > 0) ? 'block' : 'none')});
					$('.next-button', cont).css({display: ((curPage+1 < pages) ? 'block' : 'none')});
				};


				loadPage(0);
				checkNav();
		}
	});



	$(function () {
		// screen fade up:
		$('body').hide().fadeIn(1000);

		// thumb info shutters:
		$('.thumb a').hover(function() {
			$(this).children('.thumb a span').stop(false, true).slideToggle(175);
		});

		// Btn Fades

		$(".wall .next-button, .wall .prev-button").fadeTo("slow", 0.3);
			$(".wall .next-button, .wall .prev-button, #thumbs .next-button, #thumbs .prev-button").hover(function(){
				$(this).fadeTo("fast", 1.0);
				},function(){
				$(this).fadeTo("fast", 0.3);
		});

		// credit shutter

		$('.creditsdue').click(function() {
			$('.creditbox').slideToggle(200);
		});


		// This setups our loading overlay
		$('#overlay').appendTo('#container');

		$('#overlay').show();
		$('#overlay').css({
			position: 'absolute',
			left: 0,
			top: 0,
			bottom: 0,
			width: '100%',
			zIndex: 99,
			// background: 'url(/images/system/preload.gif) no-repeat 50% 50%', // preloaded in css
			backgroundColor: 'rgba(255,255,255,1)'
		});

		// Hide the loading overlay once everything has been loaded duhhhh!
		$(window).on('load', function () {
			setTimeout(function () {
				$('#overlay').fadeOut();
			}, 750);
		});


			$('#overlay-home').show(); // added additional overlay height for home
			$('#overlay-home').css({
				position: 'absolute',
				left: 0,
				top: 0,
				bottom: 50,
				width: '100%',
				zIndex: 2,

				// These should be in the css
				// background: 'url(/images/system/preload.gif) no-repeat 50% 50%',
				backgroundColor: 'rgba(255,255,255,1)'
			});

			// Hide the loading overlay once everything has been loaded duhhhh!
			$(window).on('load', function () {
				setTimeout(function () {
					$('#overlay-home').fadeOut();
				}, 750);
			});


		// This handles setting up the scroll able view for the list page
		var listPage = $('.listop');
		if (listPage.length) {
			$(listPage).css({
				overflow: 'scroll',
				width: '100%',
				overflowX: 'hidden',
				height: window.innerHeight - 240 //$(window).innerHeight()
			});
		}
	});
})(window);

</script>