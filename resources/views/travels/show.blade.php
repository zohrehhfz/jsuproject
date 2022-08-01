@extends('layouts.my_layout')
@section('title', 'سفر')
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
				@if($role == 1)
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
	<div class="div1" style="width:70%; margin:auto;">
		@if ($errors->any())
		<ul>
			@foreach ($errors->all() as $error)
			@if($error == "سفر فعال شد")
			<li style="color:green">{{ $error }}</li>
			@else
			<li style="color:#E74C3C">{{ $error }}</li>
			@endif

			@endforeach
		</ul>
		@endif
		@if( $message == "5" )
		<p style="color:red; font-size:15px;"> این سفر قبلا برای شما ثبت شده است</p>
		@endif
		@if( $message == "1" )
		<p style="color:green; font-size:15px;"> این سفر با موفقیت برای شما ثبت شده است</p>
		@endif
		@if(( $message == "3" ) && ($travel->cancel != 1))
		<p style="color:red; font-size:15px;">این سفر برای شما کنسل شد</p>
		@endif
		@if( $travel->cancel == 1 )
		<p style="color:red; font-size:15px;"> این سفر کنسل شده است </p>
		@endif
		<br>
		@if($photo_url == "/storage/travels/")
		<figure>
			<img src="/travel-agency.jpg" class="img-fluid" style="margin:auto; width:25%; height:25%;" alt="profile photo Not Set">
			<figcaption style="font-size: 14px;">تصویر سفر یافت نشد</figcaption>
		</figure>

		@else
		<img src={{$photo_url}} class="img-fluid img-circle2" style="margin:auto; width:60%; height:60%;" alt="Profile photo UnAvialable">
		@endif
		<br>
		<br>
		<p> مقصد: {{$travel->destination}}</p>

		<p>زمان سفر: <?php $v = new Verta($travel->traveltime);
						print $v->formatJalaliDate(); ?></p>

		<p> شروع ثبت نام: <?php $v1 = new Verta($travel->registerationstart);
							print $v1->formatJalaliDate(); ?></p>

		<p> پایان ثبت نام : <?php $v2 = new Verta($travel->registerationend);
							print $v2->formatJalaliDate(); ?></p>

		<p> توضیحات سفر : {{$travel->description}}</p>
		<p> تعداد افراد ثبت نام کرده در این سفر : {{$number}}</p>
		@if($leader_name != "empty")
		<p> نام لیدر این سفر : {{$leader_name}}</p>
		@endif
		@if($role == 1)
		<p>اعضای این سفر</p>
		@foreach($travel->users as $u)
		<p>{{$u->name}}</p>
		@endforeach
		@endif

		<br>
		<br>
		<?php
		$time = strtotime($travel->registerationend);
		$day = date('d', $time);
		$month = date('m', $time);
		$year = date('Y', $time);

		$currentyear = date("Y");
		$currentmonth = date("m");
		$currentday = date("d");
		if (($currentyear <= $year)) {
			if ((($currentmonth == $month) && ($currentday <= $day)) || ($currentmonth < $month)) {
		?>
				@if((( $message == "0" ) || ( $message == "3" )) && ($travel->cancel == 0))
				<button id="submitbutton"><a href="{{route('AddTravelForUser',[$travel])}}" style="color:white; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
							<path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
						</svg> ثبت نام در سفر </a></button>
				@endif
				<?php
				$user = Auth::user();
				if ($user) {
					$user_with_travels = $user->travels;
					$count_t = $user_with_travels->where('id', $travel->id)->count();
					$admin = $user->roles->where('role', 'Admin')->count();
					if (($count_t > 0) || ($admin > 0)) { ?>
						<button id="submitbutton"><a href="{{route('ShowChat',[$travel])}}" style="color:white; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16">
									<path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z" />
								</svg> صفحه چت </a></button>
				<?php
					}
				}
				?>
				@if(( $message == "1" ) || ($message == "5"))
				<button id="submitbutton"><a href="{{route('CancleTrvForUser',[$travel])}}" style="color:white; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-minus-fill" viewBox="0 0 16 16">
							<path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z" />
							<path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5ZM6 8h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1Z" />
						</svg> کنسل کردن سفر </a></button>
				@endif


				<br>
				<br>
				<hr>

				@auth
				@if(($role == 1) && ($travel->cancel == 0))
				<button id="submitbutton" onclick="document.getElementById('id01').style.display='block'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z" />
					</svg> حذف سفر </button>
				<div id="id01" class="modal">
					<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
					<form class="modal-content" method="get" action="{{route('CancleTravel',[$travel])}}">
						@csrf
						<div class="container">
							<h1>کنسل کردن سفر</h1>
							<p>آیا از کنسل کردن سفر اطمینان دارید؟</p>

							<div class="clearfix">
								<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
								<button type="submit" onclick="document.getElementById('id01').style.display='none'" class="deletebtn">Delete</button>
							</div>
						</div>
					</form>
				</div>

				<button id="submitbutton"><a href="{{ route('EditTravel',[$travel]) }}" style="color:white; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
							<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
						</svg> تغییر اطلاعات سفر </a></button>
				@endif
				@if(($role == 1) && ($travel->cancel == 1))
				<button id="submitbutton"><a href="{{route('ActiveTravel',[$travel])}}" style="color:white; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
							<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
							<path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z" />
						</svg> فعال کردن سفر </a></button>

				@endif
				@endauth
		<?php
			}
		}
		?>
	</div>
	<br>
	<br>
	<div class="comments container" style="margin: auto;">

		<br>
		<div class="sub_cm" style="background: none;">
			<div class="row">
				<div style="text-align: right;">
					<h6> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-collection-fill" viewBox="0 0 16 16">
							<path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z" />
						</svg> &nbsp; نظرات</h6>
				</div>
			</div>
		</div>
		@if($travel->comments->count() == 0)
		<div class="sub_cm">
			<div class="row">
				<div class="col">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16">
						<path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z" />
					</svg>
				</div>
				<div class="col-11">
					اولین نفری باشید که برای این سفر نظری ثبت می‌کند.
				</div>
			</div>
		</div>
		@else
		@foreach($travel->comments as $c)
		<div class="sub_cm">
			<div class="row">
				<div class="col">
					<?php
					$user = $c->user;
					$photo_url = Storage::url('public/files/' . $user->photoname);
					$name = $user->name;
					if ($photo_url == "/storage/files/null") {
					?>
						<img src="/user.gif" class="img-fluid img-circle" style="margin-right:0vw; width:40px; height:40px;" alt="profile photo Not Set">
					<?php
					} else {
					?>
						<img src="{{$photo_url}}" class="img-fluid img-circle" alt="Profile photo UnAvialable" style="margin-right:0vw; width:30px; height:30px;">
					<?php
					}
					?>
				</div>
				<div class="col-11">
					<p style="font-size:1vw;">{{$name}}:</p>
					<p style="font-size:0.99vw;">{{$c->message}}</p>
				</div>
			</div>
		</div>
		@endforeach
		@endif
		<div class="sub_cm">
			<div class="row">
				<form id="commentform" action="{{route('SetComment')}}" method="post">
					@csrf
					<textarea name="message" id="commentform" cols="90" rows="1" placeholder="نظر خود را درباره این سفر بنویسید." style="border: none;"></textarea>
					<input type="hidden" id="travel" name="travel" value={{ $travel->id }}>
					<button id="submitbutton" type="submit" style="color:white; width:auto; display:inline; margin:auto;"> ثبت <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
							<path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
						</svg></button>
				</form>
			</div>
		</div>
		<br>
		<br>
	</div>
	<br>
	<br>

	<br>
	<br>


</div>
@endsection