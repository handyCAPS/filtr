

(function($) {
	$(document).ready(function() {

		/**
		 * @param select {jQuery Object}
		 * Sets the text of a datalist input to the text of the selected option
		 */
		function setInputToSelected(select) {
			var selectedText = select.find('option:selected').text();
			// The connected datalist input is set through a data attribute on the select element
			var connectedList = select.data('list');
			var connectedInput = $("input[list='" + connectedList + "']");

			connectedInput.val(selectedText);
		}

		/**
		 * @param nonBelongers {jQuery Object}
		 * @param belongers {jQuery Object}
		 * @return {void}
		 * Hides and disables options that don't belong
		 * Unhides and re-enables options that do belong
		 * removes selection from both belongers and non-belongers
		 */	
		function showBelongingOptions(nonBelongers, belongers) {
			belongers.prop('hidden', null);
            nonBelongers.prop('hidden', true);

            belongers.prop('disabled', null);
            nonBelongers.prop('disabled', true);

            nonBelongers.prop('selected', null);
            belongers.prop('selected', null);
		}

		/**
		 * @param options {Array | jQuery Object}
		 * @param belongsTo {Int | Array}
		 * @return {Array}
		 * Takes an array of options and returns those that do not belong
		 */
		function findNonBelongers(options, belongsTo) {
			var b = parseInt(belongsTo);
			function filterForValue(option) {
				return parseInt(option.dataset.belongsto) !== b;
			}
			function filterForArray(option) {
				return belongsTo.indexOf(parseInt(option.dataset.belongsto)) === -1;
			}
			var filterFunc = Array.isArray(belongsTo) ? filterForArray : filterForValue;

			return [].filter.call(options, filterFunc);
		}

		function getAllReferences(options) {
			var result = [];
			for (var i = 0; i < options.length; i++) {
				result.push(parseInt(options[i].dataset.reference));
			}
			return result;
		}


		function filterSelect(filter, target) {
	        $(filter).on('change', function () {
	            var targetSelect = $(target);
	            var targetOptions = targetSelect.find('option');
	            var filterOptions = $(this).find('option:not(:hidden)');

	            var selectedOption = $(this).find('option:selected');
	            var reference = selectedOption.length ? selectedOption.data('reference') : getAllReferences(filterOptions);
	            var nonBelongers = $(findNonBelongers(targetOptions, reference));

	            showBelongingOptions(nonBelongers, targetSelect.find('option'));

	            targetSelect.trigger('change');

	        });
	    }

	    filterSelect('#select-city', '#select-family');
	    filterSelect('#select-family', '#select-name');

		$('.dlist-search').on('select', function() {
			var connectedList = $(this).attr('list');
			var selectedValue = $(this).val();
			var selectedOption= $('#' + connectedList).find("option[value='" + selectedValue + "']");
			var selectedReference = selectedOption.data('reference');

			var connectedSelect = $("select[data-list='" + connectedList + "']");

			var connectedOption = connectedSelect.find("option[data-reference='" + selectedReference + "']");

			connectedOption.prop('selected', true);
			connectedSelect.trigger('change');
		});

		$('.list').on('change', function() {
			setInputToSelected($(this));
		});

		$('#btnClearAll').on('click', function() {
			$('option:selected').prop('selected', null);
			$('option').prop('hidden', null);
			$('option').prop('disabled', null);
			$('.dlist-search').val('');
		});

		$('.btn-clear').on('click', function() {
			var parent = $(this).parents('.wrap');
			var datainput = parent.find('input[list]');
			var select = parent.find('select');
			var selected = select.find('option:selected');

			datainput.val('');
			selected.prop('selected', null);
			select.trigger('change');
		});

	});
}(jQuery));