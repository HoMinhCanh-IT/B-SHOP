<style>
	.time-dialog{
		width:60px;
		height:30px
	}
</style>
<!--jQuery-->
<script src="{{ asset('user/js/jquery-2.2.3.min.js') }}"></script>
	<script>
		$(document).ready(function () {
			$("#myModal").modal();
		});
	</script>
	<!-- // modal -->
	<!--search jQuery-->
	<script src="{{ asset('user/js/modernizr-2.6.2.min.js') }}"></script>
	<script src="{{ asset('user/js/classie-search.js') }}"></script>
	<script src="{{ asset('user/js/demo1-search.js') }}"></script>
	<!--//search jQuery-->
	<!-- cart-js -->
	<script src="{{ asset('user/js/minicart.js') }}"></script>
	<script>
		googles.render();

		googles.cart.on('googles_checkout', function (evt) {
			var items, len, i;

			if (this.subtotal() > 0) {
				items = this.items();

				for (i = 0, len = items.length; i < len; i++) {}
			}
		});
	</script>
	<!-- //cart-js -->
	<script>
		function returnLogin(){
			window.location.href = "/dang-nhap";
		}
		function Favorite(e){
                $.ajax({
                    url: "{{ route('user.accountheart') }}",
                    type:'POST',
                    data: {Id_Sach: e, _token: '{{ csrf_token() }}' },
                    success: function(data) {
						ShowMessage(data);
                    }
                });
		}
		function AddCart(e){
			var soluong = document.getElementById('So_Luong_SP');
			if(soluong != null){
				var num = soluong.value;
			}
			else{
				var num = 1;
			}
                $.ajax({
                    url: "{{ route('account.addcart') }}",
                    type:'POST',
                    data: {Id_Sach: e, So_Luong: num, _token: '{{ csrf_token() }}' },
                    success: function(data) {
						ShowMessageCart(data);
						$(".count").html(data);
                    }
                });
		}
		function DeleteFavorite(e){
			var tablefavorite = document.getElementById("favorite-book");
                $.ajax({
                    url: "{{ route('user.deleteheart') }}",
                    type:'POST',
                    data: {Id: e, _token: '{{ csrf_token() }}' },
                    success: function(data) {
						location.reload();
                    }
                });
		}
		$(document).ready(function () {
			$(".button-log a").click(function () {
				$(".overlay-login").fadeToggle(200);
				$(this).toggleClass('btn-open').toggleClass('btn-close');
			});
		});
		$('.overlay-close1').on('click', function () {
			$(".overlay-login").fadeToggle(200);
			$(".button-log a").toggleClass('btn-open').toggleClass('btn-close');
			open = false;
		});
		$(".miniview-btn").on('click', function () {
			$.ajax({
                    url: "{{ route('user.getsuggestion') }}",
                    type:'GET',
                    data: { },
                    success: function(result) {
						var codeHtml = "";
						$.each (result, function (key, item){
							codeHtml = codeHtml + "<div class='row'>";
							codeHtml = codeHtml + "<div class='col-md-4'> <img src='" + item['Anh_Bia'] + "' style='width:60px; height:60px; padding-top:10px'> </div>";
							codeHtml = codeHtml + "<div class='col-md-8' style='font-size:14px; color:#959596; padding-top:10px'><a href='/chi-tiet-san-pham/"+ item['Id'] +"'>"+ item['Ten_Sach'] + "</a></div>";
							codeHtml = codeHtml + "</div>";
                        });
						$('#goi-y').html(codeHtml);									
                    }
                });

        	$(".miniview-inner-content").addClass('show')
		});
		$(".miniview-btn-close").on('click', function () {
        	$(".miniview-inner-content").removeClass('show')
		});
	</script>
	<script>
	function ShowMessage(e) {
	var x = document.getElementById("snackbar");
	x.className = "show";
	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}
	function ShowMessageCart(e) {
	var x = document.getElementById("addcart");
	x.className = "show";
	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}
	</script>
	<!--quantity-->
	<script>
		$('.value-plus').on('click', function () {
			var divUpd = $(this).parent().find('.value'),
				newVal = parseInt(divUpd.text(), 10) + 1;
			divUpd.text(newVal);
		});

		$('.value-minus').on('click', function () {
			var divUpd = $(this).parent().find('.value'),
				newVal = parseInt(divUpd.text(), 10) - 1;
			if (newVal >= 1) divUpd.text(newVal);
		});
	</script>
	<!--quantity-->
	<!--close-->
	<script>
		$(document).ready(function (c) {
			$('.close1').on('click', function (c) {
				$('.rem1').fadeOut('slow', function (c) {
					$('.rem1').remove();
				});
			});
		});
	</script>
	<script>
		$(document).ready(function (c) {
			$('.close2').on('click', function (c) {
				$('.rem2').fadeOut('slow', function (c) {
					$('.rem2').remove();
				});
			});
		});
	</script>
	<script>
		$(document).ready(function (c) {
			$('.close3').on('click', function (c) {
				$('.rem3').fadeOut('slow', function (c) {
					$('.rem3').remove();
				});
			});
			$('.page-link').on('click', function(e){
				localStorage.myurl = location.href;
			});
		});
	</script>
	<!--//close-->
	<!-- carousel -->
	<!-- price range (top products) -->
	<script src="{!! asset('user/js/jquery-ui.js') !!}"></script>
		<script>
			$("#slider-range").slider({
				range: true,
				min: 0,
				step: 10000,
				max: 700000,
				values: [0, 700000],
				slide: function (event, ui) {
					$("#amount").val( ui.values[0] +"đ" + " - " + ui.values[1]+ "đ");
					var x = ui.values[0];
					var y = ui.values[1];
					$.ajax({
						url: "{{ route('user.shopquery', 0) }}",
						type:'POST',
						data: {Min: x, Max: y, _token: '{{ csrf_token() }}' },
						success: function(data) {
						}
					});
				}
			});
			$("#amount").val( $("#slider-range").slider("values", 0)+"đ" + " - " + $("#slider-range").slider("values", 1)+"đ" );
		</script>
	<!--// Count-down -->
	<script src="{{ asset('user/js/owl.carousel.js') }}"></script>
	<script>
		$(document).ready(function () {
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
						items: 2,
						nav: false
					},
					900: {
						items: 3,
						nav: false
					},
					1000: {
						items: 4,
						nav: true,
						loop: false,
						margin: 20
					}
				}
			})
		})
	</script>

	<!-- //end-smooth-scrolling -->
		<!-- single -->
		<script src="{!! asset('user/js/imagezoom.js') !!}"></script>
		<!-- single -->
		<!-- script for responsive tabs -->
		<script src="{!! asset('user/js/easy-responsive-tabs.js') !!}"></script>
		<script>
			$(document).ready(function () {
				$('#horizontalTab').easyResponsiveTabs({
					type: 'default', //Types: default, vertical, accordion           
					width: 'auto', //auto or any width like 600px
					fit: true, // 100% fit in a container
					closed: 'accordion', // Start closed if in accordion view
					activate: function (event) { // Callback function if tab is switched
						var $tab = $(this);
						var $info = $('#tabInfo');
						var $name = $('span', $info);
						$name.text($tab.text());
						$info.show();
					}
				});
				$('#verticalTab').easyResponsiveTabs({
					type: 'vertical',
					width: 'auto',
					fit: true
				});
			});
		</script>
		<!-- FlexSlider -->
		<script src="{!! asset('user/js/jquery.flexslider.js') !!}"></script>
		<script>
			// Can also be used with $(document).ready()
			$(window).load(function () {
				$('.flexslider1').flexslider({
					animation: "slide",
					controlNav: "thumbnails"
				});

				$.ajax({
						url: "{{ route('user.cartcount') }}",
						type:'GET',
						data: {},
						success: function(data) {
							//alert(data);
							$(".count").html(data);
					}
				});
			});			
		</script>
		<!-- //FlexSlider-->

	<!-- dropdown nav -->
	<script>
		$(document).ready(function () {
			$(".dropdown").hover(
				function () {
					$('.dropdown-menu', this).stop(true, true).slideDown("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('.dropdown-menu', this).stop(true, true).slideUp("fast");
					$(this).toggleClass('open');
				}
			);
		});
	</script>
	<!-- //dropdown nav -->
  <script src="{{ asset('user/js/move-top.js') }}"></script>
    <script src="{{ asset('user/js/easing.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 900);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            /*
            						var defaults = {
            							  containerID: 'toTop', // fading element id
            							containerHoverID: 'toTopHover', // fading element hover id
            							scrollSpeed: 1200,
            							easingType: 'linear' 
            						 };
            						*/

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <!--// end-smoth-scrolling -->

	<script src="{{ asset('user/js/bootstrap.js') }}"></script>
	<!-- js file -->