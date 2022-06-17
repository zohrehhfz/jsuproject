@extends('layouts.my_layout')
@section('title', 'سفر')
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
				@if(Auth::user()->roles->where("role",'Admin')->count() == "1")
						<a href="{{ route('CreateTravel') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
</svg>  افزودن سفر </a>
					@endif
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
					<div>
						@if ($errors->any())
				<ul>
					@foreach ($errors->all() as $error)
						<li style="color:#E74C3C">{{ $error }}</li>
					@endforeach
				</ul>
		@endif
					@if( $message == "1" )
						<p style="color:green; font-size:15px;"> این سفر با موفقیت برای شما ثبت شده است</p>
					@endif
					@if( $message == "3" )
						<p style="color:red; font-size:15px;">این سفر برای شما کنسل شد</p>
					@endif
					@if( $travel->cancel == 1 )
						<p style="color:red; font-size:15px;"> این سفر کنسل شده است </p>
					@endif
					<p> مقصد: {{$travel->destination}}</p>
								<p>زمان سفر: {{$travel->traveltime}}</p>
								<p> شروع ثبت نام: {{$travel->registerationstart}}</p>
								<p> پایان ثبت نام : {{$travel->registerationend}}</p>
								<p> توضیحات سفر : {{$travel->description}}</p>
								<p> تعداد افراد ثبت نام کرده در این سفر : {{$number}}</p>
								<br>
								<br>
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
								@if(( $message == "0" ) || ( $message == "3" ))
								<button id="submitbutton"><a href="{{route('AddTravelForUser',[$travel])}}" style="color:white; text-decoration: none;">ثبت نام در سفر <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
</svg></a></button>
							@endif
							@if( $message == "1" )
						<button id="submitbutton"><a href="{{route('CancleTrvForUser',[$travel])}}" style="color:white; text-decoration: none;">کنسل کردن سفر <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-minus-fill" viewBox="0 0 16 16">
							  <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
							  <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5ZM6 8h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1Z"/>
							</svg></a></button>
					@endif
							
								
								<br>
								<br>
								<hr>
								@auth
								@if((Auth::user()->roles->where("role",'Admin')->count() == "1") && ($travel->cancel == 0))
								<button id="submitbutton"><a href="{{route('CancleTravel',[$travel])}}" style="color:white; text-decoration: none;" > حذف سفر <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
</svg></a></button>
								<button id="submitbutton"><a href="{{ route('EditTravel',[$travel]) }}" style="color:white; text-decoration: none;"> تغییر اطلاعات سفر <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
</svg></a></button>

								@endif
								
								@endauth
						<?php
							}
						}								
					?>
					
					</div>
					<br>
					<br>
					
                    
                </div>
@endsection
