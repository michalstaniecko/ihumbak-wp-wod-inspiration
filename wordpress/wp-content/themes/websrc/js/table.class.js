class Table {
	constructor() {

	}

	background() {
		$('.wod-table-item').hover(
			(e) => {
				var $elem = $(e.target);
				var currentIndex = $elem.index();
				var $parent = $elem.closest('.js-wod-table-hightlight');
				var parentIndex = $parent.index();
				var $columnHeading = $('.wod-table-column-heading');
				var $columnWod = $('.wod-table-column');
				$columnHeading.find('.js-wod-table-hightlight').eq(parentIndex - 1).find('.wod-table-item').eq(currentIndex).addClass('wod-table-row-hightlight');
				$columnWod.each((e, elem)=> {
					$(elem).find('.js-wod-table-hightlight').eq(parentIndex - 1).find('.wod-table-item').eq(currentIndex).addClass('wod-table-row-hightlight');
				});
			},
			(e) => {
				$('.js-wod-table-hightlight .wod-table-row-hightlight').removeClass('wod-table-row-hightlight');
			}
		)
	}
}

new Table().background();
