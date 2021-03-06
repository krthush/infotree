<!DOCTYPE html>
<html lang="en">

  @include ('layouts.head')

<body>
<!--Main responsive container for body/whole website-->  
<div class="container-fluid nomargins">

  @include ('layouts.nav')

  <!--Middle content - sidebar and central page -->
  <div class="tall headerSpace hidden-md hidden-lg"></div>
  <div class="row midSection">
    
  <!-- Left Sidebar -->  
  @include('layouts.leftSidebar')    

    <!-- Content for page-->
    <div class="col-md-8">    

      @yield('content')

    </div>

  </div>
  <!--Sticky footer, END of container-fluid div included in footer-->  
  @include('layouts.footer')
</body>
</html>