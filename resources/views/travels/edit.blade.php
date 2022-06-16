@extends('layouts.my_layout')
@section('title', 'تغییر اطلاعات سفر')
@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            
			
					
					<div>
					@if ($errors->any())
				<ul>
					@foreach ($errors->all() as $error)
						<li style="color:#E74C3C">{{ $error }}</li>
					@endforeach
				</ul>
		@endif
					<form action="{{route('UpdateTravel',[$travel])}}" method="post" >
			@csrf
			
				<p style="font-size:20px;"> مقصد: </p>
				 <input type="text" name="destination" value="{{$travel->destination}}" style="font-size:20px;">
				  
				 <p style="font-size:20px;">زمان سفر : </p>
				 <input type="text" name="traveltime" placeholder="{{$travel->traveltime}}" value="{{$travel->traveltime}}" onfocus="(this.type='date')" style="font-size:20px;">
				 
				 <p style="font-size:20px;">شروع ثبت نام : </p>
				<input type="text" name="registerationstart" placeholder="{{$travel->registerationstart}}" value="{{$travel->registerationstart}}" onfocus="(this.type='date')" style="font-size:20px;">
				
				<p style="font-size:20px;">پایان ثبت نام : </p>
				<input type="text" name="registerationend" placeholder="{{$travel->registerationend}}" value="{{$travel->registerationend}}" onfocus="(this.type='date')" style="font-size:20px;">
				
				<p style="font-size:20px;"> توضیحات سفر : </p>
					<input type="text" name="description" value="{{$travel->description}}" style="font-size:18px;">
				<br>
				<button type="submit" style="background-color:#8859d5; color:white; font-size:20px;"> ثبت تغییرات </button></div>
			</div>
		</form>
@endsection
