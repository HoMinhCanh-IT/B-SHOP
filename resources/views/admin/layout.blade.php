<!DOCTYPE html>
<html lang="en">

@include('admin.header.head')
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
      @include('admin.header.header')
      <!-- partial:partials/_sidebar.html -->
      @include('admin.header.sidebar')
      @yield('content')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  @include('admin.footer.footer')
</body>

</html>



