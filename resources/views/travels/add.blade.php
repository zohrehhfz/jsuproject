@extends('layouts.my_layout')
@section('title', 'افزودن سفر')
@section('content')
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <div class="container-fluid"> 
	<ul class="navbar-nav">
		<li class="nav-item">
			@if (Route::has('login'))
			     <a href="{{ route('IndexTravel') }}" class="navbar-brand">سفرها</a>
                    @auth
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


	@if ($errors->any())
				<ul>
					@foreach ($errors->all() as $error)
						<li style="color:#E74C3C">{{ $error }}</li>
					@endforeach
				</ul>
		@endif
		
				@if( $message == "1" )
				<p> سفر با موفقیت ثبت شده است</p>
				@endif
					<form action="{{route('StoreTravel')}}" method="post" >
					@csrf
			
				<p style="font-size:20px;"> مقصد: </p>
				 <input type="text" name="destination" placeholder="مقصد را وارد کنید" style="font-size:20px;">
				  <p style="font-size:20px;">زمان سفر : </p>
				 <input type="date" name="traveltime" style="font-size:20px;">
				 <p style="font-size:20px;">شروع ثبت نام : </p>
				<input type="date" name="registerationstart" style="font-size:20px;">
				<p style="font-size:20px;">پایان ثبت نام : </p>
					<input type="date" name="registerationend" style="font-size:20px;">
				<p style="font-size:20px;"> توضیحات سفر : </p>
					<input type="text" name="description" value=" " style="font-size:18px;">
				<br>
				<button type="submit" style="background-color:#8859d5; color:white; font-size:20px;"> ثبت </button>
		
			</div>
		</form>
@endsection