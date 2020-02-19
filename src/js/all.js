var menuState;
var subMenuState;
$(function() {
	$("#nav_tab > li").hover(openSub, closeSub);
	$("#nav_tab_mobile > li > span").click(function() {
		if (subMenuState) {
			closeSubMobile(this);
			subMenuState = false;
		}
		else {
			openSubMobile(this);	
			subMenuState = true;
		}
	});
	$(".search_wrapper > input").keyup(search);
	$("#search_input_mobile").keyup(search_mobile);
	$("#search_input_mobile").focus(() => {
		let scroll = $("#nav_mobile").offset().top;
		$('html, body').animate({ scrollTop: scroll }, 500);
	});
	$("#overlay_menu_mobile").click(slideMenu);
});
function openSubMobile(element) {
	$(element).css("color", "#dd0322");
	$(element).find("i").css("transform", "rotate(180deg)");
	$(element).next().css("display", "block");
}
function closeSubMobile(element) {
	$(element).removeAttr("style");
	$(element).find('i').removeAttr("style");
	$(element).next().css("display", "none");
}

function openSub() {
	$(this).children().first().css("background-color", "rgb(163, 0, 0)");
	$(this).children().first().css("color", "rgb(200, 200, 200)");
	$(this).find("ul").delay(100).fadeIn("100ms");	//take the second child element (the tab) and disp it
}
function closeSub() {
	$(this).find("ul").clearQueue(); //To avoid graphic bugs with several ul opened at the same time
	$(this).find("ul").fadeOut(); //take the second child element and hide it
	$(this).children().first().removeAttr('style');	
}
function slideMenu() {
	$("#nav_mobile").slideToggle(500);
	$("#overlay_menu_mobile").fadeToggle(500);
	if (menuState) {
		$('html, body').animate({scrollTop: $("html, body").offset().top }, 500);
		$(".button_menu_mobile").removeAttr("style");
		menuState = false;
	}
	else {
		$('html, body').animate({scrollTop: $("#header").offset().top + 50}, 500);
		$(".button_menu_mobile").css("transform", "rotate(180deg)");
		menuState = true;
	}
}
function dispSearcher() {
	$(".search_wrapper > i").css("display", "none");
	$(".search_wrapper > input").css("display", "inline").focus();
	$(".search_wrapper").addClass("search_wrapper_input");
	$(".search_wrapper > i").unbind("click");
	setTimeout(() => {
		$("#wrapper").click((evt) => {
			if (evt.target.id == "search_input")
				return;
			hideSearcher();
		});		
	}, 100);
}
function hideSearcher() {
	$(".search_wrapper > i").css("display", "inline");
	$(".search_wrapper > input").css("display", "none");
	$(".search_wrapper").removeClass("search_wrapper_input");
	$(".search_wrapper").removeClass("search_wrapper_results");
	$(".results_wrapper").hide();
	$("#wrapper").unbind("click");
	$(".search_wrapper > i").click(dispSearcher);	
}
function search() {
	let query = $(this).val();
	if (query != "") {
		$.get("/src/html/ajax/search_ajax.php?query=" + query, (data) => {
			$(".results_wrapper").show();
			$(".results_wrapper").html(data);
			$(".search_wrapper").addClass("search_wrapper_results");
		});
	}
	else {
		$(".search_wrapper").removeClass("search_wrapper_results");
		$(".results_wrapper").hide();
	}
}

function search_mobile() {
	let query = $(this).val();
	if (query != "") {
		$.get("/src/html/ajax/search_ajax.php?query=" + query, (data) => {
			$(".results_wrapper_mobile").show();
			$(".results_wrapper_mobile").html(data);	
		});
	}
	else {	
		$(".results_wrapper_mobile").hide();
	}
}
