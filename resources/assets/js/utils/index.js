export default (function () {
	const EVENT = document.createEvent('UIEvents');
	window.EVENT = EVENT;
	EVENT.initUIEvent('resize', true, false, window, 0);

	window.addEventListener('load', () => {
		window.dispatchEvent(EVENT);
	});

	$('a').filter('[href^="http"], [href^="//"]').not(`[href*="${window.location.host}"]`).attr('rel', 'noopener noreferrer').attr('target', '_blank');

	document.addEventListener('click', () => {
		window.dispatchEvent(window.EVENT);
	});

	// Close alerts
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 3500);
}());