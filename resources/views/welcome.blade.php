@extends('layouts.master')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
@endif


<!-- This homepage needs major improvement! Use tree idea!! -->


<!--Welcome content-->
<div class="midContainer">
  <div class="midContainerHeader">
    <div class="midContainerHeaderText">Welcome to infotree!</div>
  </div>
  <div class="noEdit midContainerContent">
      <div class="welcome">
        <p class="text">
          Infotree is currently under production! Many parts of the website do not function properly yet and currently just serve as a front-end mockup.
        </p>
        @if (Auth::guest())
          <p class="text">
            Please register with your university account email and login so that you can start to use infotree!
          </p>   
        @endif
      </div>        
      <!--Row for carousel column layout-->
      <div class="row nomargins">
      <!-- width column to CENTRE carousel  <div class="col-md-0"></div>    -->     
          <!--8 width column for carousel-->
          <div class="col-md-12">
              <!--Main carousel-->
              <!-- Carousel only works with images size 1920*1080px -->
              <div id="indexCarousel">
                  <div id="carousel1" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel1" data-slide-to="1"></li>
                      <li data-target="#carousel1" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner carouselSize" role="listbox">
                      <div class="item active">
                        <a href="https://youtu.be/tlTKTTt47WE?list=LLa9afDVBUlyYZecvTNYNRmg" target="_blank">
                          <img src="images/1.jpg" alt="First slide image" class="carouselImage" id="test">
                            <div class="carousel-caption">
                              <h3>Is Reality Real? The Simulation Argument</h3>
                              <p>Youtube video by Kurzgesagt</p>
                            </div>
                        </a>
                      </div>
                      <div class="item">                        
                        <a href="https://youtu.be/uA9mxq3gneE?list=LLa9afDVBUlyYZecvTNYNRmg" target="_blank">
                          <img src="images/2.jpg" alt="Second slide image" class="carouselImage">
                            <div class="carousel-caption">
                              <h3>The Singularity and Friendly AI?</h3>
                              <p>Youtube video by Computerphile</p>
                            </div>
                        </a>
                      </div>
                      <div class="item">                          
                        <a href="https://waitbutwhy.com/2017/04/neuralink.html" target="_blank">
                          <img src="images/3.jpg" alt="Third slide image" class="carouselImage">
                            <div class="carousel-caption">
                              <h3 class="dark">Neuralink and the Brain’s Magical Future</h3>
                              <p>Blog post by waitbutwhy</p>
                            </div>
                        </a>
                      </div>
                    </div>
                    <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                  </div>
              </div>                
          </div>            
      </div>
  </div>
</div>
@endsection