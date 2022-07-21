	/* User Login js start */
	
	$("document").ready(function(){
	 	$("#view-form").click(function(){
	 		$(".form-button").hide();
	 		$(".user-form").slideDown().slowDown("10000");
	 	});
	})
	
	$("document").ready(function(){
	 	$(".account-crt").click(function(){
	 		$(".client-detail-form").hide();
	 		$(".user-sign").slideDown().slowDown("10000");
	 	});
	})
	$("document").ready(function(){
	 	$(".otp-snd").click(function(){
	 		$(".user-sign").hide();
	 		$(".otp-pass").slideDown().slowDown("10000");
	 	});
	})
	
	$("document").ready(function(){
	 	$(".login-from").click(function(){
	 		$(".user-sign").hide();
	 		$(".client-detail-form").slideDown().slowDown("10000");
	 	});
	})
	
	$("document").ready(function(){
	 	$(".send-otp-sub").click(function(){
			// $(".forget-pass").hide();	 					
	 	// 	$(".new-pass").slideDown().slowDown("10000");
	 	});
	})
	
	$("document").ready(function(){
	 	$(".forgot-opn").click(function(){
	 		$(".client-detail-form").hide();
			$(".user-sign").hide();
	 		$(".forget-pass").slideDown().slowDown("10000");
	 	});
	})
	
	/* User Login js end */	
	
	
	
	/* Brand Login js start */
	
	$("document").ready(function(){
	 	$("#brand-view").click(function(){
	 		$(".brand-detail").hide();
	 		$(".brand-form").slideDown().slowDown("10000");
	 	});
	})
	
		
	$("document").ready(function(){
	 	$(".crt-brand").click(function(){
	 		$(".brand-detail-form").hide();
	 		$(".brand-sign").slideDown().slowDown("10000");
	 	});
	})
	$("document").ready(function(){
	 	$(".brnd-user-btn").click(function(){
	 		$(".brand-sign").hide();
	 		$(".brnd-otp-pass ").slideDown().slowDown("10000");
	 	});
	})
	
	$("document").ready(function(){
	 	$(".brnd-forgot-pass").click(function(){
	 		$(".brand-detail-form").hide();
	 		$(".brnd-forget-pass").slideDown().slowDown("10000");
	 	});
	})
	
	$("document").ready(function(){
	 	$(".brnd-repass").click(function(){
	 		$(".brnd-forget-pass").hide();			
	 		$(".brnd-new-pass").slideDown().slowDown("10000");
	 	});
	})
	
	/* Brand Login js start */
	
	/* review scroll js */
	
	  var myCustomScrollbar = document.querySelector('.my-custom-scrollbar');
		var ps = new PerfectScrollbar(myCustomScrollbar);

		var scrollbarY = myCustomScrollbar.querySelector('.ps.ps--active-y>.ps__scrollbar-y-rail');

		myCustomScrollbar.onscroll = function() {
		  scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; height: 400px; right: ${-this.scrollLeft}px`;
	  }
       
	 		
	   
	   
	   $("#anonymously").click(function(){
		$(".show-right").show();
	  });
       
	/* review scroll js */
		
		
		
	var editBtn = document.getElementById('editBtn');
var editables = document.querySelectorAll('#title, #author, #content');

if (typeof(Storage) !== "undefined") {
  if (localStorage.getItem('title') !== null) {
    editables[0].innerHTML = localStorage.getItem('title');
  }
  if (localStorage.getItem('author') !== null) {
    editables[1].innerHTML = localStorage.getItem('author');
  }
  if (localStorage.getItem('content') !== null) {
    editables[2].innerHTML = localStorage.getItem('content');
  }
}

editBtn.addEventListener('click', function(e) {
  if (!editables[0].isContentEditable) {
    editables[0].contentEditable = 'true';
    editables[1].contentEditable = 'true';
    editables[2].contentEditable = 'true';
    editBtn.innerHTML = 'Save Changes';
    editBtn.style.backgroundColor = '#6F9';
  } else {
    // Disable Editing
    editables[0].contentEditable = 'false';
    editables[1].contentEditable = 'false';
    editables[2].contentEditable = 'false';
    // Change Button Text and Color
    editBtn.innerHTML = 'Enable Editing';
    editBtn.style.backgroundColor = '#F96';
    // Save the data in localStorage 
    for (var i = 0; i < editables.length; i++) {
      localStorage.setItem(editables[i].getAttribute('id'), editables[i].innerHTML);
    }
  }
});

setInterval(function() {
  for (var i = 0; i < editables.length; i++) {
    localStorage.setItem(editables[i].getAttribute('id'), editables[i].innerHTML);
  }
}, 5000);

/* Post job Js */


/* edit text */



	
	
	