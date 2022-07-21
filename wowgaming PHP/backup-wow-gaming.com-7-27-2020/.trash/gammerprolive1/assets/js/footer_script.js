$(document).ready(function() {
	$('.scrollbars').ClassyScroll();
});

$(window).scroll(function() {    
	var scroll = $(window).scrollTop();

	if (scroll >= 75) {
		$(".clearHeader").addClass("darkHeader");
	} else {
		$(".clearHeader").removeClass("darkHeader");
	}
});


function toggler(divId) {
	$("#" + divId).toggle();
}


$(document).ready(function() {
	$(".menu-icon").on("click", function() {
		$("nav ul").toggleClass("showing");
	});
});

  // Scrolling Effect

  $(window).on("scroll", function() {
  	if($(window).scrollTop()) {
  		$('nav').addClass('black');
  	}

  	else {
  		$('nav').removeClass('black');
  	}
  })





	// optional
	$('#blogCarousel').carousel({
		interval: 5000
	});



	$(document).ready(function() {
		$('.owl-carousel').owlCarousel({
			loop: true,
			margin: 10,
			responsiveClass: true,
			responsive: {
				0: {
					items: 1,
					nav: true
				},
				600: {
					items: 3,
					nav: false
				},
				1000: {
					items: 5,
					nav: true,
					loop: false,
					margin: 20
				}
			}
		})
	})


	window.onload = function() {
		document.getElementById('button').onclick = function() {
			document.getElementById('modalOverlay').style.display = 'none'
		};
	};


	function copyToClipboard(element) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}



	$( '#topheader .navbar-nav a' ).on( 'click', function () {
		$( '#topheader .navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
		$( this ).parent( 'li' ).addClass( 'active' );
	});




	$(document).ready(function () 
	{ 
		$("#new-colplaint").click(function()
		{
			$("#new-colplaint-show:hidden").show('slow');
			$("#exisiting-cmplaint-show").hide();
			$("#show-me-three").hide();
		});
		$("#new-colplaint").click(function()
		{
			if($('new-colplaint').prop('checked')===false)
			{
				$('#new-colplaint-show').hide();
			}
		});

		$("#existing-colplaint").click(function()
		{
			$("#exisiting-cmplaint-show:hidden").show('slow');
			$("#new-colplaint-show").hide();
			$("#show-me-three-ad").hide();
		});
		$("#existing-colplaint").click(function()
		{
			if($('see-me-two-ad').prop('checked')===false)
			{
				$('#exisiting-cmplaint-show').hide();
			}
		});

		$("#look-me-ad").click(function()
		{
			$("#show-me-three-ad:hidden").show('slow');
			$("#new-colplaint-show").hide();
			$("#exisiting-cmplaint-show").hide();
		});
		$("#look-me-ad").click(function()
		{
			if($('see-me-three-ad').prop('checked')===false)
			{
				$('#show-me-three-ad').hide();
			}
		});

	});

	
	
	
	$(document).ready(function () 
	{ 
		$("#watch-me").click(function()
		{
			$("#show-me:hidden").show('slow');
			$("#show-me-two").hide();
			$("#show-me-three").hide();
		});
		$("#watch-me").click(function()
		{
			if($('watch-me').prop('checked')===false)
			{
				$('#show-me').hide();
			}
		});

		$("#see-me").click(function()
		{
			$("#show-me-two:hidden").show('slow');
			$("#show-me").hide();
			$("#show-me-three").hide();
		});
		$("#see-me").click(function()
		{
			if($('see-me-two').prop('checked')===false)
			{
				$('#show-me-two').hide();
			}
		});

		$("#look-me").click(function()
		{
			$("#show-me-three:hidden").show('slow');
			$("#show-me").hide();
			$("#show-me-two").hide();
		});
		$("#look-me").click(function()
		{
			if($('see-me-three').prop('checked')===false)
			{
				$('#show-me-three').hide();
			}
		});

	});



	$(document).ready(function () 
	{ 
		$("#watch-me-ad").click(function()
		{
			$("#show-me-ad:hidden").show('slow');
			$("#show-me-two-ad").hide();
			$("#show-me-three").hide();
		});
		$("#watch-me-ad").click(function()
		{
			if($('watch-me-ad').prop('checked')===false)
			{
				$('#show-me-ad').hide();
			}
		});

		$("#see-me-ad").click(function()
		{
			$("#show-me-two-ad:hidden").show('slow');
			$("#show-me-ad").hide();
			$("#show-me-three-ad").hide();
		});
		$("#see-me-ad").click(function()
		{
			if($('see-me-two-ad').prop('checked')===false)
			{
				$('#show-me-two-ad').hide();
			}
		});

		$("#look-me-ad").click(function()
		{
			$("#show-me-three-ad:hidden").show('slow');
			$("#show-me-ad").hide();
			$("#show-me-two-ad").hide();
		});
		$("#look-me-ad").click(function()
		{
			if($('see-me-three-ad').prop('checked')===false)
			{
				$('#show-me-three-ad').hide();
			}
		});

	});



	var x, i, j, selElmnt, a, b, c;
	/*look for any elements with the class "custom-select":*/
	x = document.getElementsByClassName("custom-select");
	for (i = 0; i < x.length; i++) {
		selElmnt = x[i].getElementsByTagName("select")[0];
		/*for each element, create a new DIV that will act as the selected item:*/
		a = document.createElement("DIV");
		a.setAttribute("class", "select-selected");
		a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
		x[i].appendChild(a);
		/*for each element, create a new DIV that will contain the option list:*/
		b = document.createElement("DIV");
		b.setAttribute("class", "select-items select-hide");
		for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
        	if (s.options[i].innerHTML == this.innerHTML) {
        		s.selectedIndex = i;
        		h.innerHTML = this.innerHTML;
        		y = this.parentNode.getElementsByClassName("same-as-selected");
        		for (k = 0; k < y.length; k++) {
        			y[k].removeAttribute("class");
        		}
        		this.setAttribute("class", "same-as-selected");
        		break;
        	}
        }
        h.click();
    });
    b.appendChild(c);
}
x[i].appendChild(b);
a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
  });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
  	if (elmnt == y[i]) {
  		arrNo.push(i)
  	} else {
  		y[i].classList.remove("select-arrow-active");
  	}
  }
  for (i = 0; i < x.length; i++) {
  	if (arrNo.indexOf(i)) {
  		x[i].classList.add("select-hide");
  	}
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
