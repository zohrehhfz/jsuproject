@extends('layouts.my_layout')
@section('title', 'خانه')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
  <div class="container-fluid"> 
	<ul class="navbar-nav">
		<li class="nav-item">
			@if (Route::has('login'))
				
			     <a href="{{ route('IndexTravel') }}" class="navbar-brand">سفرها</a>
				
                    @auth
					@if(Auth::user()->roles->where("role",'Admin')->count() == "1")
						<a href="{{ route('CreateTravel') }}" class="navbar-brand">افزودن سفر</a>
					@endif
                        <a href="{{ url('/dashboard') }}" class="navbar-brand">پنل کاربری</a>
                    @else
                        <a href="{{ route('login') }}" class="navbar-brand">ورود به حساب</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="navbar-brand">ثبت نام</a>
                        @endif
                    @endauth
					
                </div>
            @endif
		</li>
		
	</ul>
  </div>
</nav>

	<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">	
			<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
			  <div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
			  </div>
			  <div class="carousel-inner">
				<div class="carousel-item active">
				  <img src="img1.jpg" class="d-block w-50" alt="picture not found">
				  <div class="carousel-caption d-none d-md-block">
					<h5> قلعه رودخان</h5>
					<p>جاذبه گردشگری استان گیلان</p>
				  </div>
				</div>
				<div class="carousel-item">
				  <img src="img3.jpg" class="d-block w-50" alt="picture not found">
				  <div class="carousel-caption d-none d-md-block">
					<h5>شهرستان سروآباد</h5>
					<p>جاذبه گردشگری استان کردستان</p>
				  </div>
				</div>
				<div class="carousel-item">
				  <img src="img2.jpg" class="d-block w-50" alt="picture not found">
				  <div class="carousel-caption d-none d-md-block">
					<h5>دربند</h5>
					<p>جاذبه گردشگری استان تهران</p>
				  </div>
				</div>
			  </div>
			  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			  </button>
			  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			  </button>
			</div>
					@foreach ($travels as $travel)
					<div class="div1">
					<?php
							$time = strtotime($travel->registerationend);
							$day = date('d',$time);
							$month = date('m',$time);
							$year = date('Y',$time);
							
							$currentyear = date("Y");
							$currentmonth = date("m");
							$currentday = date("d");
						if(($currentyear <= $year) && ( $travel->cancel == 0))
						{
							
							if ((($currentmonth == $month) && ($currentday <= $day)) || ($currentmonth < $month))
							{
								
						?>
								
								<a href="{{route('ShowTravel',[$travel])}}" style="color:black;"> مقصد: {{$travel->destination}}</a>
								<br>
								<br>
								<p>زمان سفر : {{$travel->traveltime}}</p>
								<p> شروع ثبت نام : {{$travel->registerationstart}}</p>
								<p> پایان ثبت نام : {{$travel->registerationend}}</p>
								<p> توضیحات سفر : {{$travel->description}}</p>
								<hr style="height:1px;border-width:0;color:gray;background-color:gray">
						<?php
							}
						}							
							
					?>
					</div>
					<br>
					<br>
					<br>
					<br>
					@endforeach
					
					<br>
					<br>
					
                </div>
            </div>
        </div>
@endsection