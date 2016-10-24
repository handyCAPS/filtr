

(function($) {
	$(document).ready(function() {

		$('.list li').on('click', function() {
			$(this).parents('.list').find('.selected').removeClass('selected');
			$(this).addClass('selected');
			var selectedText = $(this).text();

			$(this).parents('ul').prev('.dlist').prev('.dlist-search').val(selectedText);
			// console.log($(this).text());
		});

		$('.dlist-search').on('select', function() {
			var selectedVal = $(this).val();
			var connectedDataList = $(this).next('.dlist');
			var selectedOption = connectedDataList.find('option[value="' + selectedVal + '"]');
			var ref = selectedOption.data('reference');
			var connectedList = $(this).nextAll('.list');
			var referencedNode = connectedList.find("li[data-reference='" + ref + "']");
			var rNodeOffsetTop = referencedNode[0].offsetTop - (referencedNode.innerHeight() * 2);
			
			connectedList.scrollTop(rNodeOffsetTop);
			referencedNode.trigger('click');
		});

	});
}(jQuery));