<label class="top-log mx-auto"></label>
			<nav class="navbar navbar-expand-lg navbar-light bg-light top-header mb-2">
				<!-- Nút show menu mobile -->
				<button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						
					</span>
				</button>
				<!-- Menu trang web -->
				<div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-bottom: -10px">
					<ul class="navbar-nav nav-mega mx-auto">
						<!-- Trang chủ -->
						<li class="nav-item">
							<a class="nav-link ml-lg-0" id="nav-home" href="{{ route('user.index')}}">Trang Chủ
							</a>
						</li>
						<!-- Ưu đãi lớn -->
						<li class="nav-item">
							<a class="nav-link" id="nav-ctkm" href="{{ route('user.promotion')}}">Khuyến Mãi</a>
						</li>
						<!-- Cửa hàng -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="nav-cuahang" href="{{ route('user.shop')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
							    aria-expanded="false">
								Cửa Hàng
							</a>
							<ul class="dropdown-menu mega-menu">
								<li>
									<div class="row">
										<div class="col-md-4 media-list span4 text-center">
											<h5 class="tittle-w3layouts-sub"> Học Tập </h5>
											<ul style="font-size:120%">
												<li class="media-mini mt-3">
													<a href="{{ route('user.shop', 8)}}">Sách giáo khoa</a>
												</li>
												<li class="">
													<a href="{{ route('user.shop', 12)}}"> Sách tham khảo</a>
												</li>
												<li>
													<a href="{{ route('user.shop', 11)}}"> Sách học ngoại ngữ/Từ điển </a>
												</li>
												<li>
													<a href="{{ route('user.shop', 5)}}"> Văn học </a>
												</li>
											</ul>
										</div>
										<div class="col-md-4 media-list span4 text-center">
											<h5 class="tittle-w3layouts-sub"> Giải Trí </h5>
											<ul style="font-size:120%">
												<li class="media-mini mt-3">
													<a href="{{ route('user.shop', 1)}}"> Truyện tranh </a>
												</li>
												<li class="">
													<a href="{{ route('user.shop', 2)}}"> Sách thiếu nhi </a>
												</li>
												<li class="">
													<a href="{{ route('user.shop', 7)}}"> Văn hóa/Du lịch</a>
												</li>
												<li class="">
													<a href="{{ route('user.shop', 9)}}"> Thưởng thức/Đời sống</a>
												</li>
												<li class="">
													<a href="{{ route('user.shop', 10)}}"> Tạp chí</a>
												</li>													
											</ul>
										</div>
										<div class="col-md-4 media-list span4 text-center">
											<h5 class="tittle-w3layouts-sub"> Kỹ Năng </h5>
											<ul style="font-size:120%">
												<li class="media-mini mt-3">
													<a href="{{ route('user.shop', 3)}}">Kỹ năng sống</a>
												</li>
												<li class="">
													<a href="{{ route('user.shop', 4)}}"> Kinh tế </a>
												</li>
												<li>
													<a href="{{ route('user.shop', 13)}}">Sách ẩm thực</a>
												</li>
												<li>
													<a href="{{ route('user.shop', 6)}}">Tâm lý/Giáo dục</a>
												</li>
											</ul>
										</div>
									</div>
									<hr>
									<a href="{{ route('user.shop', 0)}}" style="text-align:center;"><h5 class="tittle-w3layouts-sub"> Xem Tất Cả </h5></a>
								</li>
							</ul>
						</li>
						<!-- Tin tức -->
						<li class="nav-item">
							<a class="nav-link" id="nav-news" href="{{ route('user.news')}}">Tin Tức</a>
						</li>
						<!-- Thông tin & liên hệ -->
						<li class="nav-item">
							<a class="nav-link" id="nav-contact" href="{{ route('user.about')}}">Liên Hệ</a>
						</li>
						<!-- Thanh tìm kiếm -->
						<li style="padding: 5px 0 0 15px;">
						<form id="form-search" action="{{route('tim-kiem')}}" method="GET"> 
							<input type="search" name="search">
							<button style="border-radius: 0.25rem; padding: 0.25rem 0.5rem; background-color: rgb(104, 101, 92); color: cornsilk;" onclick="saveSearch()">
								<i class="fas fa-search"></i>
							</button>
						</form>	
						</li>
					</ul>

				</div>
			</nav>
		</header>