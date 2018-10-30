class Forms {
	constructor() {

		this.select();

	}

	select() {

		$('.js-select').each((key, elem) => {
			$(elem).select2({
				width: '100%',
				placeholder: '',
				allowClear: true

			});
		})
	}
}

new Forms();
