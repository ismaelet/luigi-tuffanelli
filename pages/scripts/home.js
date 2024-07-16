$(window).ready(function() {

	const step = 2;

	//read more
	$('.read-more').click(function() {

		const self = $(this)
		const target = $('#' + self.data('target'))
		const targetById = document.getElementById(self.data('target'))

		let pageCount = parseInt(target.css('--_page'))

		const baseHeight = targetById.clientHeight / pageCount

		target.addClass('open').css('--_page', pageCount + step)

		if (targetById.clientHeight + (baseHeight * step) + 3 >= targetById.scrollHeight) {

			self.fadeOut(200)
			target.addClass('ended')

		}

	})
	
})