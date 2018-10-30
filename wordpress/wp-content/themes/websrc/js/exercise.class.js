class Exercise  {
	constructor() {

		this.addRowBtn = '.js-exercise-form__add-row';
		this.removeRowBtn = '.js-exercise-form__remove-row';

		this.bindClick();
	}

	bindClick() {
		$(document).on('click', this.addRowBtn, (e) => this.addRow($(e.target)))
		$(document).on('click', this.removeRowBtn, (e) => this.addRow($(e.target)))
	}

	addRow($elem) {
			var $rowToClone = $elem.closest('.exercise-form__row');
			var $cloneRow = $rowToClone.clone();
			$cloneRow.find('input').val('');
			$cloneRow.insertAfter($rowToClone);

	}

	removeRow($elem) {
		var $rowToRemove = $elem.closest('.exercise-form__row');
		$rowToRemove.remove();
	}
}

new Exercise();
