<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff: New Customer') }}
        </h2>
    </x-slot>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
   
                <div class="mt-4" id="role" style="display:none">
                    <x-input-label for="role" :value="__('Role')" />
                    <x-text-input id="role" class="block mt-1 w-full" type="text" name="role" value="customer" required />
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="mt-4" id="name" >
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
                <!-- Email Address -->
                <div class="mt-4" id="username" >
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>


                <!-- Password -->
                <div class="mt-4" id="password" >
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4" id="password_confirmation" >
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-4" id="gender" >
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                    <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Choose gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <div class="mt-4" id="birth_place" >
                    <x-input-label for="birth_place" :value="__('Birth place')" />

                    <x-text-input id="birth_place" class="block mt-1 w-full"
                                    type="text"
                                    name="birth_place"/>

                    <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
                </div>

                <div class="mt-4" id="address" >
                    <x-input-label for="address" :value="__('Address')" />

                    <x-text-input id="address" class="block mt-1 w-full"
                                    type="text"
                                    name="address"/>

                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="mt-4" id="identity_picture_file" >
                    <x-input-label for="identity_picture_file" :value="__('Identity picture file')" />

                    <x-text-input id="identity_picture_file" class="block mt-1 w-full"
                                    type="file"
                                    name="identity_picture_file"/>

                    <x-input-error :messages="$errors->get('identity_picture_file')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
        </div>
    </div>
</x-app-layout>