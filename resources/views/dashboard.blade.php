@extends('layouts.my_layout')
@section('title', 'پنل کاربری')
@section('content')
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <div class="container-fluid"> 
	<ul class="navbar-nav">
		<li class="nav-item">
			@if (Route::has('login'))
			     <a href="{{ route('IndexTravel') }}" class="navbar-brand">سفرها</a>
				 @if($user->roles->where("role",'leader')->count() == "1")
						<a href="{{ route('CreateTravel') }}" class="navbar-brand">افزودن سفر</a>
					@endif
                    
					
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
				
					@if($user->roles->where("role",'leader')->count() == "1")
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
								<hr style="height:1px;border-width:0;color:gray;background-color:gray">
					@endforeach
                </div>
				@endif
            </div>
        </div>
    </div>
	</x-app-layout>
@endsection

