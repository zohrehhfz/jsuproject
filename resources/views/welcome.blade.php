@extends('layouts.my_layout')
@section('title', 'خانه')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
	<div class="container-fluid">
		<ul class="navbar-nav">
			<li class="nav-item">
				@if (Route::has('login'))

				<a href="{{ route('IndexTravel') }}" class="navbar-brand hover:text-gray-700""><svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image-alt" viewBox="0 0 16 16">
					<path d="M7 2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zm4.225 4.053a.5.5 0 0 0-.577.093l-3.71 4.71-2.66-2.772a.5.5 0 0 0-.63.062L.002 13v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4.5l-4.777-3.947z" />
					</svg> سفرها
				</a>

				@auth
				@if(Auth::user()->roles->where("role",'Admin')->count() == "1")
				<a href="{{ route('CreateTravel') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
					</svg> افزودن سفر </a>
				@endif
				<a href="{{ url('/dashboard') }}" class="navbar-brand"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
						<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
					</svg> پنل کاربری </a>
				@else
				<a href="{{ route('login') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
						<path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
					</svg> ورود به حساب </a>

				@if (Route::has('register'))
				<a href="{{ route('register') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person-fill" viewBox="0 0 16 16">
						<path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm2 5.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12s5 1.755 5 1.755z" />
					</svg>
					ثبت نام</a>
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
				<img src="img1.jpg" class="d-block w-50 wlcomimg" alt="picture not found">
				<div class="carousel-caption d-none d-md-block">
					<h5> قلعه رودخان</h5>
					<p>جاذبه گردشگری استان گیلان</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="img3.jpg" class="d-block w-50 wlcomimg" alt="picture not found">
				<div class="carousel-caption d-none d-md-block">
					<h5>شهرستان سروآباد</h5>
					<p>جاذبه گردشگری استان کردستان</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="img2.jpg" class="d-block w-50 wlcomimg" alt="picture not found">
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

	<?php
	$time = strtotime($travel->registerationend);
	$day = date('d', $time);
	$month = date('m', $time);
	$year = date('Y', $time);

	$currentyear = date("Y");
	$currentmonth = date("m");
	$currentday = date("d");
	if (($currentyear <= $year) && ($travel->cancel == 0)) {

		if ((($currentmonth == $month) && ($currentday <= $day)) || ($currentmonth < $month)) {

	?>
			<div class="container">
			<div class="div1 divhover">
			<div class="row">
				<div class="col-sm">
					<?php
					$photo_url = Storage::url('public/travels/' . $travel->photoname);
					if ($photo_url == "/storage/travels/") {
					?>
						<img src="/travel-agency.jpg" class="img-fluid img-circle2" style="margin:auto; width:85%; height:85%;" alt=" photo Not Set">
					<?php
					} else {
					?>
						<img src="{{$photo_url}}" class="img-fluid img-circle2" alt=" photo UnAvialable" style="margin:auto; width:85%; height:85%;">

					<?php
					}

					?>
				</div>
				<div class="col-sm">
					<a href="{{route('ShowTravel',[$travel])}}" style="color:black;"> مقصد: {{$travel->destination}}</a>
					<br>
					<br>

					<p>زمان سفر: {{$travel->traveltime}}</p>

					<p> شروع ثبت نام: {{$travel->registerationstart}}</p>
					<p> پایان ثبت نام : {{$travel->registerationend}}</p>
					<p> توضیحات سفر : {{$travel->description}}</p>
					@if( $travel->cancel == 1 )
					<p style="color:red; font-size:15px;"> این سفر کنسل شده است </p>
					@endif
					<?php
					$time = strtotime($travel->registerationend);
					$day = date('d', $time);
					$month = date('m', $time);
					$year = date('Y', $time);

					$currentyear = date("Y");
					$currentmonth = date("m");
					$currentday = date("d");
					if (($currentyear <= $year) && ($travel->cancel == 0)) {
						if ((($currentmonth == $month) && ($currentday <= $day)) || ($currentmonth < $month)) {

					?>

							<button id="submitbutton"><a href="{{route('ShowTravel',[$travel])}}" style="color: #E2F1F1; text-decoration:none;">ثبت نام در سفر <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
										<path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
									</svg>
								</a></button>

				</div>
				<br>
				<br>
				
		<?php
						}
					}

		?>
			</div>
			</div>
		</div>
			<br>
			<br>
	<?php
		}
	}

	?>

	@endforeach

	<br>
	<br>

</div>
</div>
@endsection