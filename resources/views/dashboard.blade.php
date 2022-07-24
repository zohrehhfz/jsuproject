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
		<a href="{{ route('CreateTravel') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16" style="display:inline;">
				<path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
			</svg> افزودن سفر </a>
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

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200" dir=rtl>
					@if($user->roles->first()->active != true)
					@if($user->certificates->certificatename == NULL)
					<div class="alert alert-primary d-flex align-items-center" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
						</svg>
						برای اینکه حساب شما به عنوان لیدر فعال شود مدرک خود را آپلود کنید.
						<div style="margin:auto">
							<button id="submitbutton" style="margin-left: -30vw;"><a href="{{route('ChangeUserInfo')}}" style="color:white; text-decoration: none; "> به روز رسانی حساب</a></button>
						</div>
					</div>
					@else
					<div class="alert alert-primary d-flex align-items-center" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
						</svg>
						مدرک شما به زودی بررسی خواهد شد.
					</div>
					@endif
					@endif
					@if($photo_url == "/storage/files/null")
					<img src="/user.gif" class="img-fluid img-circle" alt="profile photo Not Set">
					@else
					<img src={{$photo_url}} class="img-fluid img-circle" alt="Profile photo UnAvialable">
					@endif
					<div class="div1" style="margin: auto; ">
						@if($user->roles->where("role",'leader')->count() == "1")
						@if($user->certificates->certificatename != NULL)
						<button class="certificatebutton"><a href="{{route('ShowCertificate')}}" style="color:white; text-decoration: none;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;نمایش مدرک <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill mypen" viewBox="0 0 16 16">
									<path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z" />
									<path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
								</svg></a></button>

						@endif
						@if($user->roles->first()->active == true)
						<p>وضعیت: فعال </p>
						@else
						<p> وضعیت : غیر فعال</p>
						@endif
						@endif
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
							{{$user->created_at}}
							ایجاد شده است
						</p>
					</div>
				</div>
				@if($user->travels->count() != 0)
				<div class="p-6 bg-white border-b border-gray-200" dir=rtl>
					<p>سفرهای شما :</p>
					@foreach ($user->travels as $travel)
					<div class="div1" style="margin: auto;">
						<a href="{{route('ShowTravel',[$travel])}}"> مقصد: {{$travel->destination}}</a>
						زمان سفر: {{$travel->traveltime}}


						@if($travel->cancel == 1)
						<p style="color:red; font-size:18px;"> این سفر کنسل شده است </p>
						@endif
						<hr style="height:1px;border-width:0;color:gray;background-color:gray">
					</div>
					<br>
					@endforeach
				</div>
				@endif
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(window).on('load', function() {
			console.log("fffffff")
			$('#myModal').modal('show');
		});
	</script>
</x-app-layout>
@endsection