@extends('layouts.my_layout')
@section('title', 'ایجاد حساب ')
@section('content')
	    <x-auth-validation-errors class="mb-4" :errors="$errors" />
	
        <form method="POST" action="" dir="rtl" enctype="multipart/form-data">
            @csrf
			
			<div> آپلود عکس شما : </div>
			<div> <input type="file" name="photo" id="photo"> </div>
			<br>
            <div> آپلود مدرک شما : </div>
			<div> <input type="file" name="certificate"> </div>
			<br>
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('نام')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus/>
            </div>
			
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('ایمیل')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required style="margin-left: 9px;"/>
            </div>
			
			<!-- phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('شماره تلفن')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{$user->phone}}" required style="margin-left: 45px;"/>
            </div>
			<!-- year of birth -->
            <div class="mt-4">
                <x-label for="birthdate" :value="__('سال تولد')" />

                <x-input id="birthdate" class="block mt-1 w-full" type="text" name="birthdate" value="{{$user->birthdate}}" required style="margin-left: 20px;"/>
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
                                required autocomplete="new-password" style="margin-left: 20px;"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('تکرار رمز عبور')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required style="margin-left: 40px;"/>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button id="submitbutton">
                    {{ __('به روز رسانی') }}
                </x-button>
            </div>
        </form>
		
@endsection