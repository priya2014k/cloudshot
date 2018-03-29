
		<!--/sidebar-menu-->
				<div class="sidebar-menu sidebar-main sidebar-default sideoverflow">
                    
					<header class="logo1">
							<a href="javascript:void(0)" id="imagelogo" ><img style="width: 40%;" src="{{ asset('images/dukan_logo.png') }}"></img></a> 
						<a href="#" class="sidebar-icon sidebar-xs" > <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu " >
									<ul id="menu" class="navigation navigation-main navigation-accordion">
                                        <li><a href="javascript:void(0)"><i ></i> <span>{$loggedinuser.first_name$} {$loggedinuser.last_name$}</span><div class="clearfix"></div></a></li>
                                        <li id="menu-academico" ><a href="#"><i class="fa fa-gear" aria-hidden="true"></i><span>Accounts</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                                           <ul id="menu-academico-sub" class="collapse_content" >
                                           <li id="menu-academico-avaliacoes" ><a href="#" ng-click="logout()">Logout</a></li>
                                          </ul>
                                        </li>
										<li><a href="dashboard"><i class="fa fa-home"></i> <span>Home</span><div class="clearfix"></div></a></li>
										<li id="menu-academico" ><a href="manageusers"><i class="fa fa-users nav_icon"></i><span>User Management</span><div class="clearfix"></div></a></li>
										
										<li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span> Role Management</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" class="collapse_content">
										   <li id="menu-academico-avaliacoes" ><a href="manageroles">Roles & Permissions</a></li>
											<li id="menu-academico-avaliacoes" ><a href="managerolespermission">Role Based Permissions</a></li>
										  </ul>
										</li>

										<li id="menu-academico" ><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i><span> Categories</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" class="collapse_content" >
										   <li id="menu-academico-avaliacoes" ><a href="managecategory">Category & SubCategory</a></li>
											<li id="menu-academico-avaliacoes" ><a href="managecategorysubcategory">Category Based Permissions</a></li>
										  </ul>
										</li>
                                        <li><a href="manageproduct"><i class="fa fa-shopping-basket"></i>  <span>Product Management</span><div class="clearfix"></div></a></li>
										
										<li><a href="managehome"><i class="fa fa-tachometer"></i>  <span>Home Page</span><div class="clearfix"></div></a></li>
										<li><a href="manageoffers"><i class="fa fa-table"></i>  <span>Offers & Promotions</span><div class="clearfix"></div></a></li>
										<li><a href="manageorders"><i class="fa fa-cart-plus" aria-hidden="true"></i>  <span>Order Management</span><div class="clearfix"></div></a></li>
										<li id="menu-academico" ><a href="#"><i class="fa fa-sliders" aria-hidden="true"></i><span> Reports</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                                           <ul id="menu-academico-sub" class="collapse_content">
                                           <li id="menu-academico-avaliacoes" ><a href="home">Financial Report</a></li>
                                            <li id="menu-academico-avaliacoes" ><a href="customerandsaleorder">Customers & Sales Orders</a></li>
                                          </ul>
                                        </li>
                                        <li><a href="deliveryfee"><i class="fa fa-life-ring"></i>  <span>Delivery fees</span><div class="clearfix"></div></a></li>
                                        <li><a href="timeslot"><i class="fa fa-hourglass-half"></i>  <span>Time Slot</span><div class="clearfix"></div></a></li>
                                        
                                        <li><a href="managesurvey"><i class="fa fa-bar-chart" aria-hidden="true"></i>  <span>Survey</span><div class="clearfix"></div></a></li>
										<li><a href="managebranches"><i class="fa fa-institution" aria-hidden="true"></i>  <span>Cities & Branches</span><div class="clearfix"></div></a></li>
										
										<li><a href="storeinventory"><i class="fa fa-truck" aria-hidden="true"></i>  <span>Store Wide Inventory</span><div class="clearfix"></div></a></li>
										<li><a href="importexportdata"><i class="fa fa-exchange" aria-hidden="true"></i>  <span>Import/Export Data</span><div class="clearfix"></div></a></li>
										
										<li><a href="managecomments"><i class="fa fa-comments" aria-hidden="true"></i>  <span>Comments & Feedback</span><div class="clearfix"></div></a></li>
										<li><a href="adminnotification"><i class="fa fa-commenting-o" aria-hidden="true"></i>  <span>Notification</span><div class="clearfix"></div></a></li>

										<!-- <li><a href="home"><i class="fa fa-picture-o" aria-hidden="true"></i><span>Filters Management</span><div class="clearfix"></div></a></li>
										<li><a href="home"><i class="fa fa-map-marker" aria-hidden="true"></i>  <span>Push Messages</span><div class="clearfix"></div></a></li>
										 -->
								  </ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							

	
	


	<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
							  	
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
								$("#imagelogo").hide();
							  }
							  else
							  {
							  		$("#imagelogo").show();
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>

   <script>
   		// Main navigation
    // -------------------------

    // Add 'active' class to parent list item in all levels
    $('.navigation').find('li.active').parents('li').addClass('active');

    // Hide all nested lists
    $('.navigation').find('li').not('.active, .category-title').has('ul').children('ul').addClass('hidden-ul');

    // Highlight children links
    $('.navigation').find('li').has('ul').children('a').addClass('has-ul');

    // Add active state to all dropdown parent levels
    $('.dropdown-menu:not(.dropdown-content), .dropdown-menu:not(.dropdown-content) .dropdown-submenu').has('li.active').addClass('active').parents('.navbar-nav .dropdown:not(.language-switch), .navbar-nav .dropup:not(.language-switch)').addClass('active');

    

    // Main navigation tooltips positioning
    // -------------------------

    // Left sidebar
/*    $('.navigation-main > .navigation-header > i').tooltip({
        placement: 'right',
        container: 'body'
    });*/



    // Collapsible functionality
    // -------------------------

    // Main navigation
    $('.navigation-main').find('li').has('ul').children('a').on('click', function (e) {
        e.preventDefault();

        // Collapsible
        $(this).parent('li').not('.disabled').not($('.sidebar-xs').not('.sidebar-xs-indicator').find('.navigation-main').children('li')).toggleClass('active').children('ul').slideToggle(250);

        // Accordion
        if ($('.navigation-main').hasClass('navigation-accordion')) {
            $(this).parent('li').not('.disabled').not($('.sidebar-xs').not('.sidebar-xs-indicator').find('.navigation-main').children('li')).siblings(':has(.has-ul)').removeClass('active').children('ul').slideUp(250);
        }
    });

        
    // Alternate navigation
    $('.navigation-alt').find('li').has('ul').children('a').on('click', function (e) {
        e.preventDefault();

        // Collapsible
        $(this).parent('li').not('.disabled').toggleClass('active').children('ul').slideToggle(200);

        // Accordion
        if ($('.navigation-alt').hasClass('navigation-accordion')) {
            $(this).parent('li').not('.disabled').siblings(':has(.has-ul)').removeClass('active').children('ul').slideUp(200);
        }
    }); 

   </script>

<script> 
	$.fn.collapseAll = function(){
	    $('.collapse_content').slideUp();
	    $('.navigation-wrapper').slideUp();
	    $('.halfopened').removeClass('opened');
	}

function themeInit1()
{
    $('body').addClass("has-detached-right");

        $('.collapse_content').slideUp();
        $('.navigation-wrapper').slideUp();
        $('.navbar-toggle').unbind( "click" );
        $('.navbar-toggle').click(
            function()
            {
                var gotId = "";
                gotId = $(this).attr('sideref');

                if(!$('body').hasClass('sidebar-xs'))
                {
                    if($(this).hasClass('opened'))
                    {
                        $(this).removeClass('opened');
                        $(gotId).slideToggle();
                    }
                    else
                    {
                        $().collapseAll();
                        $(this).addClass('opened');
                        $(gotId).slideToggle();
                    }    
                }
                else
                {
                    if($(this).hasClass('opened'))
                    {
                        $(this).removeClass('opened');
                        $(gotId).slideToggle();
                    }
                    else
                    {
                        $().collapseAll();
                    }
                }
            })
        $('.page-sidebar').niceScroll();
    $('.ripple').click( 
        function () {
          var $div = $('<div>'),
            btnOffset = $(this).offset(),
            xPos = event.pageX - btnOffset.left,
            yPos = event.pageY - btnOffset.top;
      

      
      $div.addClass('ripple-effect');
      var $ripple = $(".ripple-effect");
      
      $ripple.css("height", $(this).height());
      $ripple.css("width", $(this).height());
      $div
        .css({
          top: yPos - ($ripple.height()/2),
          left: xPos - ($ripple.width()/2),
          background: $(this).data("ripple-color")
        }) 
        .appendTo($(this));

      window.setTimeout(function(){
        $div.remove();
      }, 2000);
    });


    /*$('.sidebar_toggle').click(

    function()
    {
        if($('.page-sidebar').hasClass('expandit'))
        {
            $('body').addClass(' sidebar-xs');
        }
        else
        {
            $('body').removeClass(' sidebar-xs');
        }

    });*/
}
</script>	
<script>
	$(function() {


    // Mini sidebar
    // -------------------------

    // Setup
    function miniSidebar() {
        if ($('body').hasClass('sidebar-xs')) {
            $('.sidebar-main.sidebar-fixed .sidebar-content').on('mouseenter', function () {
                if ($('body').hasClass('sidebar-xs')) {

                    // Expand fixed navbar
                    $('body').removeClass('sidebar-xs').addClass('sidebar-fixed-expanded');
                }
            }).on('mouseleave', function () {
                if ($('body').hasClass('sidebar-fixed-expanded')) {

                    // Collapse fixed navbar
                    $('body').removeClass('sidebar-fixed-expanded').addClass('sidebar-xs');
                }
            });
        }
    }

    // Toggle mini sidebar
    $('.sidebar-main-toggle').on('click', function (e) {

        // Initialize mini sidebar 
        miniSidebar();
    });

});
</script>

