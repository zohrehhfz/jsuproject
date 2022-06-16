@extends('layouts.my_layout')
@section('title', 'سفرها')
@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            
	<div>
					@foreach ($travels as $travel)
					<a href="{{route('ShowTravel',[$travel])}}"> مقصد: {{$travel->destination}}</a>
					<p>زمان سفر: {{$travel->traveltime}}</p>
								<p> شروع ثبت نام: {{$travel->registerationstart}}</p>
								<p> پایان ثبت نام : {{$travel->registerationend}}</p>
								<p> توضیحات سفر : {{$travel->description}}</p>
								@if( $travel->cancel == 1 )
						<p style="color:red; font-size:15px;"> این سفر کنسل شده است </p>
					@endif
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
								
								<button style="background-color:white; color:white; font-size:15px;"><a href="{{route('ShowTravel',[$travel])}}">ثبت نام در سفر </a></button>
								<br>
								<br>
								<hr>
						<?php
							}
						}							
							
					?>
					@endforeach
					</div>
					<br>
					<br>
					<br>
					<br>
</div>
@endsection
