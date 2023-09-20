$( document ).ready(function() {
	//
	var body = localStorage.getItem("enlarged");
	// var nav = localStorage.getItem("navToggle");
	$("body").addClass(body);
	// $("#accordionSidebar").addClass(nav);

	
	$(".open-left").click(function(){
		var body = localStorage.getItem("enlarged");
		// var nav = localStorage.getItem("navToggle");
		//
		if(body == null){
			localStorage.setItem("enlarged","enlarged");
			// localStorage.setItem("navToggle","toggled");
		}else{
			localStorage.removeItem("enlarged");
			// localStorage.removeItem("navToggle");
		}
	});

});