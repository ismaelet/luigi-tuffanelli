$(window).ready(function() {

	overflow()

	$(window).resize(function() { overflow() })

	function overflow() {

		$('.curriculum-wrapper').each(function() {

			const self = $(this)
			const wrapperHeight = self.outerHeight();
			const contentHeight = self.find('.curriculum-experiences').innerHeight();

			if (wrapperHeight + 1 >= contentHeight) { self.addClass('ended') }

		})

	}
	
})