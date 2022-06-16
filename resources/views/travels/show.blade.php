@extends('layouts.my_layout')
@section('title', 'سفر')
@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">	
					<div>
					@if( $message == "1" )
						<p style="color:green; font-size:15px;"> این سفر با موفقیت برای شما ثبت شده است</p>
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
								
								<button style="background-color:#8859d5; color:white; font-size:15px;"><a href="{{route('AddTravelForUser',[$travel])}}">ثبت نام در سفر </a></button>
								<br>
								<br>
								<hr>
								@auth
								@if((Auth::user()->roles->where("role",'Admin')->count() == "1") && ($travel->cancel == 0))
								<button style="background-color:#8859d5; color:white; font-size:15px;"><a href="{{route('CancleTravel',[$travel])}}"> حذف سفر</a></button>
								<button style="background-color:#8859d5; color:white; font-size:15px;"><a href="{{ route('EditTravel',[$travel]) }}"> تغییر اطلاعات سفر</a></button>

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
