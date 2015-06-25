$(document).ready(function () {

	$(".order-info").click(function(){
         $(this).next('.order-detail').slideToggle("slow");
	   	$(this).find('i').toggleClass('fa-chevron-up');
	 	$(this).find('i').toggleClass('fa-chevron-down');
    });
});
