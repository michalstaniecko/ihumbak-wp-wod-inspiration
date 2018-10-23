(function () {
  'use strict';

  var classCallCheck = function (instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  };

  var createClass = function () {
    function defineProperties(target, props) {
      for (var i = 0; i < props.length; i++) {
        var descriptor = props[i];
        descriptor.enumerable = descriptor.enumerable || false;
        descriptor.configurable = true;
        if ("value" in descriptor) descriptor.writable = true;
        Object.defineProperty(target, descriptor.key, descriptor);
      }
    }

    return function (Constructor, protoProps, staticProps) {
      if (protoProps) defineProperties(Constructor.prototype, protoProps);
      if (staticProps) defineProperties(Constructor, staticProps);
      return Constructor;
    };
  }();

  var Forms = function () {
  	function Forms() {
  		classCallCheck(this, Forms);


  		this.select();
  	}

  	createClass(Forms, [{
  		key: 'select',
  		value: function select() {

  			$('.js-select').each(function (key, elem) {
  				$(elem).select2({
  					width: '100%',
  					placeholder: '',
  					allowClear: true

  				});
  			});
  		}
  	}]);
  	return Forms;
  }();

  new Forms();

  var Exercise = function () {
  	function Exercise() {
  		classCallCheck(this, Exercise);


  		this.addRowBtn = '.js-exercise-form__add-row';
  		this.removeRowBtn = '.js-exercise-form__remove-row';

  		this.bindClick();
  	}

  	createClass(Exercise, [{
  		key: 'bindClick',
  		value: function bindClick() {
  			var _this = this;

  			$(document).on('click', this.addRowBtn, function (e) {
  				return _this.addRow($(e.target));
  			});
  			$(document).on('click', this.removeRowBtn, function (e) {
  				return _this.addRow($(e.target));
  			});
  		}
  	}, {
  		key: 'addRow',
  		value: function addRow($elem) {
  			var $rowToClone = $elem.closest('.exercise-form__row');
  			var $cloneRow = $rowToClone.clone();
  			$cloneRow.find('input').val('');
  			$cloneRow.insertAfter($rowToClone);
  		}
  	}, {
  		key: 'removeRow',
  		value: function removeRow($elem) {
  			var $rowToRemove = $elem.closest('.exercise-form__row');
  			$rowToRemove.remove();
  		}
  	}]);
  	return Exercise;
  }();

  new Exercise();

  var WOD = function () {
  	function WOD() {
  		classCallCheck(this, WOD);
  	}

  	createClass(WOD, [{
  		key: 'toolTips',
  		value: function toolTips() {
  			$('[data-toggle="tooltip"]').tooltip();
  		}
  	}]);
  	return WOD;
  }();

  var $wod = new WOD();

  $wod.toolTips();

  var Table = function () {
  	function Table() {
  		classCallCheck(this, Table);
  	}

  	createClass(Table, [{
  		key: 'background',
  		value: function background() {
  			$('.wod-table-item').hover(function (e) {
  				var $elem = $(e.target);
  				var currentIndex = $elem.index();
  				var $parent = $elem.closest('.js-wod-table-hightlight');
  				var parentIndex = $parent.index();
  				var $columnHeading = $('.wod-table-column-heading');
  				var $columnWod = $('.wod-table-column');
  				$columnHeading.find('.js-wod-table-hightlight').eq(parentIndex - 1).find('.wod-table-item').eq(currentIndex).addClass('wod-table-row-hightlight');
  				$columnWod.each(function (e, elem) {
  					$(elem).find('.js-wod-table-hightlight').eq(parentIndex - 1).find('.wod-table-item').eq(currentIndex).addClass('wod-table-row-hightlight');
  				});
  			}, function (e) {
  				$('.js-wod-table-hightlight .wod-table-row-hightlight').removeClass('wod-table-row-hightlight');
  			});
  		}
  	}]);
  	return Table;
  }();

  new Table().background();

}());
