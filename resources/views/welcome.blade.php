@extends('layouts.my_layout')
@section('title', 'خانه')
@section('content')

	<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">	
					<div>
					@foreach ($travels as $travel)
					
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
								
								<a href="{{route('ShowTravel',[$travel])}}"> مقصد: {{$travel->destination}}</a>
								<p>زمان سفر : {{$travel->traveltime}}</p>
								<p> شروع ثبت نام : {{$travel->registerationstart}}</p>
								<p> پایان ثبت نام : {{$travel->registerationend}}</p>
								<p> توضیحات سفر : {{$travel->description}}</p>
								<hr style="height:1px;border-width:0;color:gray;background-color:gray">
						<?php
							}
						}							
							
					?>
					@endforeach
					</div>
					<br>
					<br>
					
                </div>
            </div>
        </div>
@endsection