@extends('layouts.my_layout')
@section('title', 'welcome')
@section('content')

	<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="top-0 right-0 px-6 py-4 sm:block">
			     <a href="{{ route('IndexTravel') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Travels</a>
				 <a href="{{ route('CreateTravel') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ADD</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
					
                </div>
            @endif

            
				
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