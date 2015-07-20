var App = {
	config: {
		url: '',
		layout: '',
	},
	is_xs : function() { return window.innerWidth < 739 },
	is_sm : function() { return window.innerWidth >= 740 && window.innerWidth <= 939 },
	is_md : function() { return window.innerWidth >= 940 && window.innerWidth <= 1000 },
	is_lg : function() { return window.innerWidth > 1000 },
	_screen : function() { 
		if(App.is_xs()) return 'xs';
		if(App.is_sm()) return 'sm';
		if(App.is_md()) return 'md';
		if(App.is_lg()) return 'lg';
	},
	Init: function(config){
		App.config = $.extend(App.config, config || {});
		$(document).ready(function(){
		  App.Event.DomReady();
		});
	},

  refreshCart: function(){
    $.ajax({
      dataType: "html",
      type: "POST",
      url: App.config.url  + 'cart/session',
      success: function(html){
        $('#cart-session').replaceWith(html);
      }
    });      
  },

	Event: {
		DomReady: function(){ 

			$( window ).resize(function() {
				//si cambia de pantalla recarga
		  		if( last_screen != App._screen() ) { location.reload(); } 
			} );

			var section = $('#page-info').attr('data-section');
			if(section == 'home') App.Event.home();  
			if(section == 'look1') App.Event.look1();  

			$('.colorpiker-btngroup .btn').each(function(i, item) {
				var color = $(item).attr('data-color');
				$(item).css('background-color',color);
			});

			$('.map').each(function(i, item) {
				var location = $(item).attr('data-location');
				var icon = $(item).attr('data-icon');
				var w = $(item).width();
				var h = $(item).height();

				var src = "http://maps.googleapis.com/maps/api/staticmap?scale=false&size="+w+"x"+h+"&maptype=roadmap&format=png&visual_refresh=true&markers=icon:"+icon+"%7Cshadow:true%7C"+location;
				var map = $('<img src="'+src+'" />');

				$(item).append(map);
			});
/*
			$('.go-top a').click(function () {
		        $('html, body').animate({
			        scrollTop: $("#top").offset().top
			    }, 500);
		    	return false;
		    });*/

		    $('.selectpicker').selectpicker();



		    $('.btn-arrowsInstaApi').on('click', function() {
		    	$('#collapseInstaApi').collapse('show');
		    })

		    if (App.is_lg()) { var InstaSliderCols = 10, InstaSliderItemHeight = 138 } 
		    if (App.is_md()) { var InstaSliderCols = 8, InstaSliderItemHeight = 138 } 
		    if (App.is_sm()) { var InstaSliderCols = 6, InstaSliderItemHeight = 138 } 
		    if (App.is_xs()) { var InstaSliderCols = 4, InstaSliderItemHeight = 66 } 


		    VerticalSlider.init({
		    	element:$('#collapseInstaApi'),
		    	btn_up:$('.btnInstaApiUp'),
		    	btn_down:$('.btnInstaApiDown'),
		    	item_height:InstaSliderItemHeight,
		    	cols: InstaSliderCols,
		    	rows: 2
		    });

		    //Cambios en mobile
		    if( App.is_xs() || App.is_sm() ) {

		    	var menu_mobile = $('#menu-mobile');
		    	var second_menu_mobile = $('#second-menu');
		    	var login_menu = $('#login-menu');
		    	var search_menu = $('#search-menu');
		    	var car_menu = $('#cart-menu');

		    	var btn_search = $('<button class="btn btn-primary fa fa-search hidden-xs"></button>');
		    	var btn_bars = $('<button class="btn btn-primary fa fa-bars"></button>');
		    	var btn_user = $('<button class="btn btn-primary fa fa-user"></button>');
		    	var btn_cart = $('#btn-cart-menu');
            

		    	second_menu_mobile.css({'overflow':'hidden', 'opacity': 0, 'display':'none' });
		    	
		    	function toggle_menu (btn, _menu) {
		    			
		    		if(btn.hasClass('active')) {
		    			btn.removeClass('active');
			    		_menu.animate({'max-height':0}, function() {
			    			
		    				_menu.css({'overflow':'hidden', 'opacity': 0, 'display':'none' });
			    		});

		    			$('body').css('overflow', 'inherit');
		    		} else {

		    			var h = document.body.clientHeight - 50;

			    		btn.addClass('active');
			    		_menu.css({'opacity':'1', 'display':'block', 'overflow-y':'auto', 'overflow-x':'hidden'});
			    		_menu.animate({'max-height':h});
			    		
		    			$('body').css('overflow', 'hidden');
		    		}

		    	}

		    	second_menu_mobile.addClass('active').append('<div class="clearfix"></div>');
		    	menu_mobile.append(btn_search, btn_bars, btn_user);

		    	second_menu_mobile.find('[data-toggle="collapse"]').each(function(i, item) { 

		    		var collapse_div_id = $(item).attr('aria-controls');
		    		var collapse_div = $('#'+collapse_div_id);
		    		
		    		collapse_div.addClass('submenu');
		    		
		    		$(item).after(collapse_div);
		    	});

		    	btn_bars.on('click', function() { 
		    		if($(btn_user).hasClass('active') ) toggle_menu( $(btn_user), $(login_menu) ); 
		    		if($(btn_search).hasClass('active') ) toggle_menu( $(btn_search), $(search_menu) );
		    		//if($(btn_cart).hasClass('active') ) toggle_menu( $(btn_cart), $(car_menu) );
		    		toggle_menu( $(btn_bars), $(second_menu_mobile) );


							$('#second-menu .submenu .row.pbot > div').each(function(index, el) {
									console.log(el);
								$('h3 a', el).click(function(event) {
									event.preventDefault();
									$('#second-menu .submenu .row.pbot .list-unstyled').addClass('collapse');
									$('.list-unstyled', el).removeClass('collapse');
								});
							});

		    	});
		    	btn_user.on('click', function() { 
		    		if($(btn_bars).hasClass('active') ) toggle_menu( $(btn_bars), $(second_menu_mobile) );
		    		if($(btn_search).hasClass('active') ) toggle_menu( $(btn_search), $(search_menu) );
		    		//if($(btn_cart).hasClass('active') ) toggle_menu( $(btn_cart), $(car_menu) );
		    		toggle_menu( $(btn_user), $(login_menu) ); 
		    	});
		    	btn_search.on('click', function() { 
		    		if($(btn_user).hasClass('active') ) toggle_menu( $(btn_user), $(login_menu) ); 
		    		if($(btn_bars).hasClass('active') ) toggle_menu( $(btn_bars), $(second_menu_mobile) );
		    		//if($(btn_cart).hasClass('active') ) toggle_menu( $(btn_cart), $(car_menu) );

		    		toggle_menu( $(btn_search), $(search_menu) ); 
		    	});
		    	/*btn_cart.on('click', function() { 
		    		if($(btn_user).hasClass('active') ) toggle_menu( $(btn_user), $(login_menu) ); 
		    		if($(btn_bars).hasClass('active') ) toggle_menu( $(btn_bars), $(second_menu_mobile) );
		    		if($(btn_search).hasClass('active') ) toggle_menu( $(btn_search), $(second_menu_mobile) );
		    		toggle_menu( $(btn_cart), $(car_menu) ); 
		    	});*/

		    	if( App.is_sm()) {
			    	var close_second_menu_mobile = $('<button class="btn-close" type="button"><span aria-hidden="true">×</span></button>');
			    	second_menu_mobile.prepend(close_second_menu_mobile);

			    	close_second_menu_mobile.on('click', function() { toggle_menu( $(btn_bars), $(second_menu_mobile) ); });
			    	
			    	var close_search_menu = $('<button class="btn-close" type="button"><span aria-hidden="true">×</span></button>');
			    	search_menu.prepend(close_search_menu);

			    	close_search_menu.on('click', function() { toggle_menu( $(btn_search), $(search_menu) ); });
		    		
		    	} else {
					
			    	$('[data-toggle-xs="collapse"]').attr('data-toggle','collapse');
			    	$('.collapse-xs').addClass('collapse');
			    	$('#collapse').removeClass('collapse');
			    	$('.footer-body-footer .pull-right').removeClass('pull-right').addClass('text-center');
		    	}
    	
		    	
		    	var close_login_menu = $('<button class="btn-close" type="button"><span aria-hidden="true">×</span></button>');
		    	login_menu.prepend(close_login_menu);

		    	close_login_menu.on('click', function() { toggle_menu( $(btn_user), $(login_menu) ); });

		    } else {
		    	//solo en md y lg(desktop)
			    $(window).bind('scroll mousewheel DOMMouseScroll resize', function(event){
					if($(window).scrollTop()>90) {
						$('.first-menu .logo-min').fadeIn();
						$('#second-menu, .third-menu').addClass('fixed');
					} else {
						$('.first-menu .logo-min').fadeOut();
						$('#second-menu, .third-menu').removeClass('fixed');
					}
				});
			    $('#second-menu').on('show.bs.collapse', function () {
			    	$('body').one('click', function(){
		    			$('#second-menu .collapse').collapse('hide');
			    	});
			    	$('#second-menu, .third-menu').click(function(e){
							e.stopPropagation();
						});
	    			$('.nav.nav-navbar li.active').removeClass('active');
					  $('#second-menu a[aria-expanded="true"]').trigger('click')
					});
			    $('#second-menu').on('hide.bs.collapse', function () {
			    	$('#second-menu, .third-menu').off('click');
					});

		    }


		},
		home: function(){ 


			App.requiredScript( App.config.layout + 'js/jquery.flexslider-min.js', function() {
				if( $(window).width() > 750)
				{
					$('.slider, .flexslider').flexslider({
					  animation: "slide"
					});
					return;
				}
				$('.slider').flexslider({
				  animation: "slide"
				});
					
			} );

		},
		look1: function(){ 

			//jquery.elevateZoom-3.0.8.min
			App.requiredScript( App.config.layout + 'js/jquery.flexslider-min.js', function() {

			  var w_carousel = ($('#carousel').width() + 30) / 3;

			  $('#carousel').flexslider({
			    animation: "slide",
			    slideshow: false,
			    controlNav: false,
			    animationLoop: false,
			    itemWidth: w_carousel,
			    touch: true,
			    move : 0,
			    asNavFor: '#slider'
			  });
			  if(App.is_lg())
			  {

				  App.requiredScript( App.config.layout + 'js/jquery.elevateZoom-3.0.8.min.js', function() {
					  $('#slider img').elevateZoom({
						zoomType: "inner"
				      }).mouseover(function() { $(this).css({opacity:'0'}) }).mouseout(function() { $(this).css({opacity:'1'}) });

			      });
			  }

				 
				  $('#slider').flexslider({
				    sync: "#carousel"
				  });
				  
			  var w_last_views = ($('.last-views:eq(0)').width() + 30) / 4;
			  if($(window).width() > 500)
			  {
			  	
			  $('.last-views').flexslider({
			    animation: "slide",
			    itemWidth: w_last_views,
			  });
			  }

			  setTimeout(function() {
				$(window).resize();
			  },200);
			});
		}
	},
	requiredScript: function(script, done){
		var scripts = [];
		done = done || function(){};
		$.each($('script'), function(index, script){
		  if($(script).attr('src'))
		    scripts.push($(script).attr('src'))
		});
		if($.inArray(script, scripts) > -1) return done();
		App.getScript(script, done);
	},
	getScript: function(url, done){
		options = {
		  dataType: "script",
		  cache: true,
		  url: url
		};
		$.ajax(options).done(done);
	},
};
var last_screen = App._screen();
