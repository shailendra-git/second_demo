
/***ugn-to show hide content***/
$('.collapse').on('shown.bs.collapse', function(e) {
  var $card = $(this).closest('.card');
  $('html,body').animate({
    scrollTop: $card.offset().top - 80
  }, 400);
});


$(document).ready(function() { $('body').bootstrapMaterialDesign(); });



$(document).ready(function () {
	$("#sidebar").niceScroll({
		cursorcolor: '#53619d',
		cursorwidth: 4,
		cursorborder: 'none'
	});

	$('#dismiss, .overlay').on('click', function () {
		$('#sidebar').removeClass('active');
		$('.overlay').fadeOut();
	});

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').addClass('active');
		$('.overlay').fadeIn();
		$('.collapse.in').toggleClass('in');
		$('a[aria-expanded=true]').attr('aria-expanded', 'false');
	});
});









/***home page product slider***/
      $(".regular").slick({
        dots: false,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
      });


/***bootstrap carousel interval 0 ***/
$('.carousel').carousel({
  interval: 0
});

$(".carousel").on("touchstart", function (event) {
	var xClick = event.originalEvent.touches[0].pageX;
	$(this).one("touchmove", function (event) {
		var xMove = event.originalEvent.touches[0].pageX;
		if (Math.floor(xClick - xMove) > 5) {
			$(this).carousel('next');
		} else if (Math.floor(xClick - xMove) < -5) {
			$(this).carousel('prev');
		}
	});
	$(".carousel").on("touchend", function () {
		$(this).off("touchmove");
	});
});

/****tool-tip****/
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});


/****UGN go to inside tab****/
 $(".goto").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });






$("#sidebar").niceScroll({
		cursorcolor: '#53619d',
		cursorwidth: 4,
		cursorborder: 'none'
	});

	$('#dismiss, .overlay').on('click', function () {
		$('#sidebar').removeClass('active');
		$('.overlay').fadeOut();
	});

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').addClass('active');
		$('.overlay').fadeIn();
		$('.collapse.in').toggleClass('in');
		$('a[aria-expanded=true]').attr('aria-expanded', 'false');
	});



/***login popups***/

$(function () {
	$('#login-form-link').click(function (e) {
		$("#login-form").delay(100).fadeIn(100);
		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function (e) {
		$("#register-form").delay(100).fadeIn(100);
		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});





$.fn.center = function () {
  this.css("position","absolute");
  this.css("top", Math.max(0, (
    ($(window).height() - $(this).outerHeight()) / 2) + 
     $(window).scrollTop()) + "px"
  );
  this.css("left", Math.max(0, (
    ($(window).width() - $(this).outerWidth()) / 2) + 
     $(window).scrollLeft()) + "px"
  );
  return this;
}

$("#splash").show();
$("#splash-content").show().center();

setTimeout(function(){    
  $("#splash").fadeOut();
}, 1000);



 

$( document ).ready( function () {
					//If your <ul> has the id "glasscase"
					$( '#glasscase' ).glassCase( {
						'thumbsPosition': 'bottom',
						'widthDisplay': 560
					} );
				} );


$(document).ready(function(){
    $("#fly-show").click(function(){
        $(".hide").slideToggle();
    });
	
	$("#pro-show").click(function(){
        $(".pro-hide").slideToggle();
    });
	
	$("#ser-show").click(function(){
        $(".ser-hide").slideToggle();
    });
	
	$("#ugn-show").click(function(){
        $(".ugn-hide").slideToggle();
    });


	$('.most-popular a').on('click', function(){
    $('a.text-red').removeClass('text-red');
    $(this).addClass('text-red');
});
	//accordion-ugn -jit
    
    $('#qs-1 a').on('click', function(event){
        $('#my-tabs .et_pb_tab_1 a').click();
		$('#accordion #headingFive a').click();
        $("html, body").animate({ scrollTop: $('#my-tabs').offset().top }, 1000);
	});
	
	$('#qs-2 a').on('click', function(event){
        $('#my-tabs .et_pb_tab_2 a').click();
		$('#accordion2 #pw-headingSix a').click();
        $("html, body").animate({ scrollTop: $('#my-tabs').offset().top }, 1000);
	});
	
	$('#qs-3 a').on('click', function(event){
        $('#my-tabs .et_pb_tab_4 a').click();
		$('#accordion4 #wlfq-headingThirteen a').click();
        $("html, body").animate({ scrollTop: $('#my-tabs').offset().top }, 1000);
	});
	
	$('#qs-4 a').on('click', function(event){
        $('#my-tabs .et_pb_tab_2 a').click();
		$('#accordion2 #pw-headingFive a').click();
        $("html, body").animate({ scrollTop: $('#my-tabs').offset().top }, 1000);
	});
	
	$('#qs-5 a').on('click', function(event){
        $('#my-tabs .et_pb_tab_4 a').click();
		$('#accordion4 #wlfq-headingFour a').click();
        $("html, body").animate({ scrollTop: $('#my-tabs').offset().top }, 1000);
	});
	
	$('#qs-6 a').on('click', function(event){
        $('#my-tabs .et_pb_tab_4 a').click();
		$('#accordion4 #wlfq-headingFive a').click();
        $("html, body").animate({ scrollTop: $('#my-tabs').offset().top }, 1000);
	});
	
	$('#ldesk a').on('click', function(event){
        $('#my-tabs .et_pb_tab_2 a').click();
		$('#accordion2 #pw-headingFour a').click();
        $("html, body").animate({ scrollTop: $('#my-tabs').offset().top }, 1000);
	});
});


 
 


$(document).ready(function(){
    $("#hotel-show").click(function(){
        $(".hotel-hide").slideToggle();
    });
});


/*price slider*/
	// multiple handled with value 
	var pmdSliderValueRange = document.getElementById('pmd-slider-value-range');
	
	noUiSlider.create(pmdSliderValueRange, {
		start: [ 500, 50000 ], // Handle start position
		connect: true, // Display a colored bar between the handles
		tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
		format: wNumb({
			decimals: 0,
			thousand: '',
			postfix: '',
		}),
		range: { // Slider can select '0' to '100'
			'min': 500,
			'max': 50000
		}
	});
	
	var valueMax = document.getElementById('value-max'),
		valueMin = document.getElementById('value-min');
	
	// When the slider value changes, update the input and span
	pmdSliderValueRange.noUiSlider.on('update', function( values, handle ) {
		if ( handle ) {
			valueMax.innerHTML = values[handle];
		} else {
			valueMin.innerHTML = values[handle];
		}
	});	



/*spec slider*/
	// multiple handled with value 
	var pmdSliderValueRange = document.getElementById('specs-slider');
	
	noUiSlider.create(pmdSliderValueRange, {
		start: [ 1, 10 ], // Handle start position
		connect: true, // Display a colored bar between the handles
		tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
		format: wNumb({
			decimals: 0,
			thousand: '',
			postfix: '',
		}),
		range: { // Slider can select '0' to '100'
			'min': 1,
			'max': 10
		}
	});
	
	var valueMax2 = document.getElementById('specs-value-max'),
		valueMin2 = document.getElementById('specs-value-min');
	
	// When the slider value changes, update the input and span
	pmdSliderValueRange.noUiSlider.on('update', function( values, handle ) {
		if ( handle ) {
			valueMax2.innerHTML = values[handle];
		} else {
			valueMin2.innerHTML = values[handle];
		}
	});	


/****date time****/
/*document.getElementById("para1").innerHTML = formatAMPM();

function formatAMPM() {
var d = new Date(),
    minutes = d.getMinutes().toString().length == 1 ? '0'+d.getMinutes() : d.getMinutes(),
    hours = d.getHours().toString().length == 1 ? '0'+d.getHours() : d.getHours(),
    ampm = d.getHours() >= 12 ? ' PM' : ' AM',
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
return days[d.getDay()]+', '+months[d.getMonth()]+' '+d.getDate()+' - '+d.getFullYear()+' <br>'+hours+':'+minutes+ampm;
}
*/



	/***header fixed***/

	window.onscroll = function () {
		myFunction()
	};

	var header = document.getElementById( "myHeader" );
	var sticky = header.offsetTop;

	function myFunction() {
		if ( window.pageYOffset >= sticky ) {
			header.classList.add( "sticky" );
		} else {
			header.classList.remove( "sticky" );
		}
	}







/***wishlist stricky***/

	$( function () {
		$( '.toggle-menu' ).click( function () {
			$( '.exo-menu' ).toggleClass( 'display' );

		});
	});





