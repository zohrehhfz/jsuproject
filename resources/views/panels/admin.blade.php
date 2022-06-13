<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
					@endforeach
                </div>
				@endif
            </div>
        </div>
    </div>
</x-app-layout>
