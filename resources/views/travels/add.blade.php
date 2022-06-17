@extends('layouts.my_layout')
@section('title', 'افزودن سفر')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
  <div class="container-fluid"> 
	<ul class="navbar-nav">
		<li class="nav-item">
			@if (Route::has('login'))
				
			     <a href="{{ route('IndexTravel') }}" class="navbar-brand hover:text-gray-700""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image-alt" viewBox="0 0 16 16">
  <path d="M7 2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zm4.225 4.053a.5.5 0 0 0-.577.093l-3.71 4.71-2.66-2.772a.5.5 0 0 0-.63.062L.002 13v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4.5l-4.777-3.947z"/>
</svg> سفرها</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="navbar-brand"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
</svg> پنل کاربری </a>
                    @else
                        <a href="{{ route('login') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
  <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg> ورود به حساب </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm2 5.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12s5 1.755 5 1.755z"/>
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