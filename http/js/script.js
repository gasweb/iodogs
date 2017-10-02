$(function () {
	$(".form-breed-product-select").
	after('<span class="btn btn-danger delete-select" href="#"><i class="glyphicon glyphicon-remove"></i></span>')
	$("span.delete-select").on("click", function(){
		var totalProducts = $(".product-set fieldset").length;		
		
		if(totalProducts>1)	
			{
				var fieldset = $(this).
				parent(".form-group").
				parent("fieldset");
				fieldset.remove();
			}
		else
			{
				var select = $(this).
				siblings(".form-breed-product-select")
				.children("option:first")
				.attr("selected", "selected");					
			}		
		});
});