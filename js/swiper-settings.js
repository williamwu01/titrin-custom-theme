
const swiper = new Swiper('.swiper', {
	loop: true,
	autoHeight: true,
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},
	slidesPerView: 1,
	spaceBetween: 5,
	breakpoints: {
			800: {
					slidesPerView: 2,
					spaceBetween: 5
			},
	}
});


