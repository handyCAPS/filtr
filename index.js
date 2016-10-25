

(function($) {
	$(document).ready(function() {

		function setInputToSelected(select) {
			var selectedText = select.find('option:selected').text();
			var connectedList = select.data('list');
			var connectedInput = $("input[list='" + connectedList + "']");

			connectedInput.val(selectedText);
		}

		function showBelongingOptions(nonBelongers, belongers) {
            nonBelongers.prop('hidden', true);
			belongers.prop('hidden', null);

            nonBelongers.prop('selected', null);
            belongers.prop('selected', null);
		}

		function findBelongers(targetList, reference) {
			return targetList.find('option[data-belongsto=' + reference + ']');
		}

		function findNonBelongers(options, belongsTo) {
			return options.filter(function(i, option) {
				return option.data('belongsto') == belongsTo;
			});
		}


		function filterSelect(filter, target) {
	        $(filter).on('change', function () {
	            var targetSelect = $(target);

	            var reference = $(this).find('option:selected').data('reference');
	            var belongers = findBelongers(targetSelect, reference);
	            // var nonBelongers = targetSelect.find('option:not([data-belongsto=' + reference + '])');
	            var firstBelonger = belongers.first();


	            showBelongingOptions(targetSelect.find('option'), belongers);

	            firstBelonger.prop('selected', true);

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
			$('.dlist-search').val('');
		});

	});
}(jQuery));