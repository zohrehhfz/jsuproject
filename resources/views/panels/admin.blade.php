@extends('layouts.my_layout')
@section('title', 'پنل کاربری')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
	<div class="container-fluid">

		@if (Route::has('login'))

		<a href="{{ route('IndexTravel') }}" class="navbar-brand hover:text-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image-alt" viewBox="0 0 16 16" style="display:inline;">
				<path d="M7 2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zm4.225 4.053a.5.5 0 0 0-.577.093l-3.71 4.71-2.66-2.772a.5.5 0 0 0-.63.062L.002 13v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4.5l-4.777-3.947z" />
			</svg> سفرها</a>

		@auth
		@if(Auth::user()->roles->where("role",'Admin')->count() == "1")
		<a href="{{ route('CreateTravel') }}" class="navbar-brand hover:text-gray-700" style="margin-left:auto;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16" style="display:inline;">
				<path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
			</svg> افزودن سفر </a>

		<a href="{{route('ShowUsers')}}" class="navbar-brand hover:text-gray-700" style="margin-left:3vw"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill mypen my-2" viewBox="0 0 16 16" style="display:inline;">
				<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
				<path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
				<path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
			</svg>نمایش کاربران</a>
		<a href="{{route('ShowLeaders')}}" class="navbar-brand hover:text-gray-700" style="margin-left:50vw; margin-right:0vw"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill mypen my-2" viewBox="0 0 16 16" style="display:inline;">
				<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
				<path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
				<path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
			</svg>نمایش لیدرها</a>
		@endif
		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();" class="navbar-brand hover:text-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16" style="display:inline;">
					<path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
					<path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
				</svg> خروج از حساب </a>

		</form>

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
<x-app-layout>

	<div class="py-12" style="font-size:18px;">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200" dir=rtl style="margin: auto;">
					@if($photo_url == "/storage/files/null")
					<img src="442010812_HEADPHONES_AVATAR_3D_400px.gif" class="img-fluid img-circle" alt="profile photo Not Set">

					@else
					<img src={{$photo_url}} class="img-fluid img-circle" alt="Profile photo UnAvialable">
					@endif
					<div class="div1" style="margin: auto; box-shadow: 5px 5px 10px 5px #87E774;">
						<p style="color:green"> سلام ادمین </p>
						<p>نام :
							{{$user->name}}
						</p>
						<p> ایمیل :
							{{$user->email}}
						</p>
						<p> شماره تماس :
							{{$user->phone}}
						</p>
						<p> سال تولد :
							{{$user->birthdate}}
						</p>
						<p> حساب در تاریخ
							<?php $v = new Verta($user->created_at);
							print $v->formatJalaliDate(); ?>
							ایجاد شده است
						</p>
					</div>
				</div>
				@if($user->travels->count() != 0)
				<div class="p-6 bg-white border-b border-gray-200" dir=rtl>
					<p>سفرهای شما :</p>
					@foreach ($user->travels as $travel)
					<div class="div1" style="margin: auto; box-shadow: 5px 5px 10px 5px #A774E7;">
						<a href="{{route('ShowTravel',[$travel])}}" style="margin-left: 35vw ;"> مقصد: {{$travel->destination}}</a>
						زمان سفر: <?php $v= new Verta($travel->traveltime); 
						print $v->formatJalaliDate(); ?>
						@if($travel->cancel == 1)
						<p style="color:red; font-size:18px;"> این سفر کنسل شده است </p>
						@endif

					</div>
					<br>

					@endforeach
				</div>
				@endif
			</div>
		</div>
	</div>
</x-app-layout>
@endsection