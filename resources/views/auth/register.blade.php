@extends('layouts.my_layout')
@section('title', 'ایجاد حساب ')
@section('content')
	    <x-auth-validation-errors class="mb-4" :errors="$errors" />
	
        <form method="POST" action="{{ route('register') }}" dir="rtl" enctype="multipart/form-data">
            @csrf
			
			<div> آپلود عکس شما : </div>
			<div> <input type="file" name="photo" id="photo"> </div>
			<br>
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('نام')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus/>
            </div>
			
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('ایمیل')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required style="margin-left: 16px;"/>
            </div>
			
			<!-- phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('شماره تلفن')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required style="margin-left: 55px;"/>
            </div>
			<!-- year of birth -->
            <div class="mt-4">
                <x-label for="birthdate" :value="__('سال تولد')" />

                <x-input id="birthdate" class="block mt-1 w-full" type="text" name="birthdate" :value="old('birthdate')" required style="margin-left: 40px;"/>
            </div>
				
			<div class="mt-4">
				
				<input type="radio" id="user" name="role" value="user">
				  <label for="html">کاربر</label>
				  <input type="radio" id="leader" name="role" value="leader">
				  <label for="css">لیدر</label>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('رمز عبور')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" style="margin-left: 35px;"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('تکرار رمز عبور')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required style="margin-left: 70px;"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('ورود به حساب') }}
                </a>

                <x-button id="submitbutton">
                    {{ __('ثبت نام') }}
                </x-button>
            </div>
        </form>
		
@endsection
