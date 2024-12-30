<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/admin/dashboard">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item" id="active_statistical">
            <a class="nav-link" href="/admin/statistical">
              <i class="fas fa-chart-bar menu-icon"></i>
              <span class="menu-title">Thống kê</span>
            </a>
          </li>
          <li class="nav-item" id="active_book">
            <a class="nav-link" href="{{ route('book.index')}}">
              <i class="icon-book menu-icon"></i>
              <span class="menu-title">Sách</span>
            </a>
          </li>
          <li class="nav-item" id="active_account">
            <a class="nav-link" href="{{ route('account.index')}}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Tài khoản</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('order.index')}}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Đơn hàng</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('comment.index')}}">
              <i class="fas fa-comments menu-icon"></i>
              <span class="menu-title">Bình luận</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('publishing.index')}}">
              <i class="fas fa-building menu-icon"></i>
              <span class="menu-title">Nhà xuất bản</span>
            </a>
          </li>
          <li class="nav-item" id="active_promotion"> 
            <a class="nav-link" href="{{ route('promotion.index') }}">
              <i class="fas fa-gifts menu-icon"></i>
              <span class="menu-title">Khuyến mãi</span>
            </a>
          </li>
          <li class="nav-item" id="active_news">
            <a class="nav-link" href="{{ route('news.index') }}">
              <i class="fas fa-newspaper menu-icon"></i>
              <span class="menu-title">Tin tức</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=" {{route('logoutAd') }}">
              <i class="fas fa-sign-out-alt menu-icon"></i>
              <span class="menu-title">Đăng xuất</span>
            </a>
          </li>
        </ul>
      </nav>
