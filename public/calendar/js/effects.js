function add_effects(){
		var day = $(".day").parent(),
			box_color;
		$(day).hover(
		function(){//Mouse Over
			if($(this).children(".event").css("visibility") == "visible"){
				box_color = "rgba(255, 255, 255, 0.2)"
				$(this).css("box-shadow","0px 0px 2px 2px " + box_color);
			}
			else{
				$(this).css("box-shadow","none");
			}
		},
		function(){//Mouse Out
			if($(this).children(".event").css("visibility") == "visible"){
				box_color = "rgba(255, 255, 255, 0.2)"
				$(this).css("box-shadow","0px 0px 2px 1px " + box_color);
			}
			else{
				$(this).css("box-shadow","none");
			}
		}
		);
}