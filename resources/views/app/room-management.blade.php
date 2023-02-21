<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Hotel Room Management') }}
            </h2>
            <button class="mx-6 text-green-500 hover:text-green-300 text-white font-bold rounded" x-data="{}"
                    x-on:click.prevent="$dispatch('open-modal', 'add-room')"
                >{{ __('Add room') }}
            </button>
            <x-modal name="add-room" focusable>
                <form method="post" action="{{ route('dashboard.room-management') }}" class="text-left p-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Add new hotel room:') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('.') }}
                    </p>

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Type')" />
                        <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type')" required autofocus autocomplete="room type" />
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>

                    <div>
                        <x-input-label for="price_per_night" :value="__('Price per night')" />
                        <x-text-input id="price_per_night" name="price_per_night" type="text" class="mt-1 block w-full" :value="old('price_per_night')" required autofocus autocomplete="price_per_night" />
                        <x-input-error class="mt-2" :messages="$errors->get('price_per_night')" />
                    </div>

                    <div>
                        <x-input-label for="available_rooms" :value="__('Available Rooms')" />
                        <x-text-input id="available_rooms" name="available_rooms" type="text" class="mt-1 block w-full" :value="old('available_rooms')" required autofocus autocomplete="available_rooms" />
                        <x-input-error class="mt-2" :messages="$errors->get('available_rooms')" />
                    </div>

                    <div>
                        <x-input-label for="booked_rooms" :value="__('Booked Rooms')" />
                        <x-text-input id="booked_rooms" name="booked_rooms" type="text" class="mt-1 block w-full" :value="old('booked_rooms')" required autofocus autocomplete="booked_rooms" />
                        <x-input-error class="mt-2" :messages="$errors->get('booked_rooms')" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <button class="ml-3 px-6 py-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Add room') }}
                        </button>
                    </div>
                </form>
            </x-modal>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price per Night
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Available Rooms
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Booked Rooms
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($rooms as $room)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $room->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $room->type }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $room->price_per_night }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $room->available_rooms }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $room->booked_rooms }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end">
                                        <button class="ml-3 px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            x-data="{}"
                                            x-on:click.prevent="$dispatch('open-modal', 'edit-room-{{$room->id}}')"
                                        >{{ __('Edit') }}</button>
                                        <x-modal name="edit-room-{{$room->id}}" focusable>
                                            <form method="post" action="{{ route('dashboard.room-management.update', [$room->id]) }}" class="text-left p-6 space-y-6">
                                                @csrf
                                                @method('POST')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Edit room: :name', ['name' => $room->name]) }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('.') }}
                                                </p>

                                                <div style="display:none">
                                                    <x-input-label for="id" :value="__('id')" />
                                                    <x-text-input id="id" name="id" type="text" class="mt-1 block w-full" :value="old('id', $room->id)" required/>
                                                    <x-input-error class="mt-2" :messages="$errors->get('id')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="name" :value="__('Name')" />
                                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="type" :value="__('Type')" />
                                                    <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type')" required autofocus autocomplete="room type" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('type')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="price_per_night" :value="__('Price per night')" />
                                                    <x-text-input id="price_per_night" name="price_per_night" type="text" class="mt-1 block w-full" :value="old('price_per_night')" required autofocus autocomplete="price_per_night" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('price_per_night')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="available_rooms" :value="__('Available Rooms')" />
                                                    <x-text-input id="available_rooms" name="available_rooms" type="text" class="mt-1 block w-full" :value="old('available_rooms')" required autofocus autocomplete="available_rooms" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('available_rooms')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="booked_rooms" :value="__('Booked Rooms')" />
                                                    <x-text-input id="booked_rooms" name="booked_rooms" type="text" class="mt-1 block w-full" :value="old('booked_rooms')" required autofocus autocomplete="booked_rooms" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('booked_rooms')" />
                                                </div>                 

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <button class="ml-3 px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        {{ __('Update room') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </x-modal>
                                        <x-danger-button class="ml-3"
                                            x-data="{}"
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{$room->id}}')"
                                        >{{ __('Delete') }}</x-danger-button>
                                        <x-modal name="confirm-user-deletion-{{$room->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('dashboard.room-management.destroy', [$room->id]) }}" class="text-left p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to delete room :name ?', ['name' => $room->name]) }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Once the room is deleted, all of its resources and data will be permanently deleted.') }}
                                                </p>
                                                
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ml-3">
                                                        {{ __('Delete room') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>