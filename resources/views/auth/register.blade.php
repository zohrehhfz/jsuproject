<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" dir="rtl">
            @csrf
			<div class="col-lg-2 col-md-2 mt-3 "> :آپلود عکس شما  </div>
			<div class="col-lg-3 col-md-3  mt-3"> <input class="form-control" type="file" name="photo" id="photo"> </div>

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('نام')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('ایمیل')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
			
			<!-- phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('شماره تلفن')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>
			<!-- year of birth -->
            <div class="mt-4">
                <x-label for="birthdate" :value="__('سال تولد')" />

                <x-input id="birthdate" class="block mt-1 w-full" type="text" name="birthdate" :value="old('birthdate')" required />
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
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('تکرار رمز عبور')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
