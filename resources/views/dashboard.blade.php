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
					
					<p>نام :
						@php
						echo Auth::user()->name;
						@endphp
						</p>
						<p> ایمیل :
						@php
						echo Auth::user()->email;
						@endphp
						</p>
						<p> شماره تماس :
						@php
						echo Auth::user()->phone;
						@endphp
						</p>
						<p> سال تولد :
						@php
						echo Auth::user()->birthdate;
						@endphp
						</p>
						<p> حساب در تاریخ 
						@php
						echo Auth::user()->created_at;
						@endphp
						 ایجاد شده است </p>
                </div>
				
				<div class="p-6 bg-white border-b border-gray-200" dir=rtl>
					
					
                </div>
				
            </div>
        </div>
    </div>
</x-app-layout>
