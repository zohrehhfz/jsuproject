@extends('layouts.my_layout')
@section('title', 'پنل کاربری')
@section('content')
<x-app-layout>
<x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
	    <div class="py-12" style="font-size:18px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" dir=rtl>
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
						{{$user->created_at}}
						 ایجاد شده است </p>
                </div>
				@if($user->travels->count() != 0)
				<div class="p-6 bg-white border-b border-gray-200" dir=rtl>
					<p>سفرهای شما :</p>
					@foreach ($user->travels as $travel)
					<a href="{{route('ShowTravel',[$travel])}}"> مقصد: {{$travel->destination}}</a>
								<p>زمان سفر: {{$travel->traveltime}}</p>
								<p> شروع ثبت نام: {{$travel->registerationstart}}</p>
								<p> پایان ثبت نام : {{$travel->registerationend}}</p>
								<p> توضیحات سفر : {{$travel->description}}</p>
								@if($travel->cancel == 1)
									<p style="color:red; font-size:18px;"> این سفر کنسل شده است </p>
								@endif
								<hr style="height:2px;border-width:0;color:gray;background-color:gray">
					@endforeach
                </div>
				@endif
				
				@if($nonactive_leaders->count() != 0)
				<div class="p-6 bg-white border-b border-gray-200" dir=rtl>
					<p>لیدرهای ثبت نام کرده :</p>
					@foreach ($nonactive_leaders as $leader)
					<p>نام :{{$leader->user->name}}</p>
						@if($leader->active == 1)
							<a href="{{route('unactiveleader',[$leader])}}"><button style="background-color: #4CAF50; font-size: 24px;">غیر فعال کردن</button></a>
						@else
							<a href="{{route('activeleader',[$leader])}}"><button style="background-color: #4CAF50; font-size: 24px;">فعال کردن</button></a>
						@endif
					@endforeach
                </div>
				@endif
            </div>
        </div>
    </div>
	</x-app-layout>
@endsection
