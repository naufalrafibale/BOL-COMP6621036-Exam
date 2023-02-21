<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Item Management') }}
            </h2>
            <button class="mx-6 text-green-500 hover:text-green-300 text-white font-bold rounded" x-data="{}"
                    x-on:click.prevent="$dispatch('open-modal', 'add-item')"
                >{{ __('Add Item') }}
            </button>
            <x-modal name="add-item" focusable>
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
                        <x-input-label for="available_rooms" :value="__('Stock Quantity')" />
                        <x-text-input id="stock_qty" name="stock_qty" type="text" class="mt-1 block w-full" :value="old('stock_qty')" required autofocus autocomplete="stock_qty" />
                        <x-input-error class="mt-2" :messages="$errors->get('stock_qty')" />
                    </div>

                    <div>
                        <x-input-label for="buying_price" :value="__('Buying Price')" />
                        <x-text-input id="buying_price" name="buying_price" type="text" class="mt-1 block w-full" :value="old('buying_price')" required autofocus autocomplete="buying_price" />
                        <x-input-error class="mt-2" :messages="$errors->get('buying_price')" />
                    </div>

                    <div>
                        <x-input-label for="selling_price" :value="__('Selling Price')" />
                        <x-text-input id="selling_price" name="selling_price" type="text" class="mt-1 block w-full" :value="old('selling_price')" required autofocus autocomplete="selling_price" />
                        <x-input-error class="mt-2" :messages="$errors->get('selling_price')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="picture_file" :value="__('Item Picture File')" />

                        <x-text-input id="picture_file" class="block mt-1 w-full"
                                        type="file"
                                        name="picture_file"/>

                        <x-input-error :messages="$errors->get('picture_file')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <button class="ml-3 px-6 py-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Add Item') }}
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
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stock Qty
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Buying Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Selling Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Picture
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->type }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->stock_qty }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->buying_price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->selling_price }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ asset('thisshouldbesecret/'.$item->picture_file)}}" target="_blank">View</a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end">
                                        <button class="ml-3 px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            x-data="{}"
                                            x-on:click.prevent="$dispatch('open-modal', 'edit-item-{{$item->id}}')"
                                        >{{ __('Edit') }}</button>
                                        <x-modal name="edit-item-{{$item->id}}" focusable>
                                            <form method="post" action="{{ route('dashboard.item-management.update', [$item->id]) }}" class="text-left p-6 space-y-6">
                                                @csrf
                                                @method('POST')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Edit item: :name', ['name' => $item->name]) }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('.') }}
                                                </p>

                                                <div style="display:none">
                                                    <x-input-label for="id" :value="__('id')" />
                                                    <x-text-input id="id" name="id" type="text" class="mt-1 block w-full" :value="old('id', $item->id)" required/>
                                                    <x-input-error class="mt-2" :messages="$errors->get('id')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="name" :value="__('Name')" />
                                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $item->name)" required autofocus/>
                                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="description" :value="__('Description')" />
                                                    <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $item->description)" required />
                                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="type" :value="__('Type')" />
                                                    <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type', $item->type)" required />
                                                    <x-input-error class="mt-2" :messages="$errors->get('type')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="stock_qty" :value="__('Stock Quantity')" />
                                                    <x-text-input id="stock_qty" name="stock_qty" type="text" class="mt-1 block w-full" :value="old('stock_qty', $item->stock_qty)" required />
                                                    <x-input-error class="mt-2" :messages="$errors->get('stock_qty')" />
                                                </div>
                                                
                                                <div>
                                                    <x-input-label for="buying_price" :value="__('Buying Price')" />
                                                    <x-text-input id="buying_price" name="buying_price" type="text" class="mt-1 block w-full" :value="old('buying_price', $item->buying_price)" required />
                                                    <x-input-error class="mt-2" :messages="$errors->get('buying_price')" />
                                                </div>
                                                
                                                <div>
                                                    <x-input-label for="selling_price" :value="__('Selling Price')" />
                                                    <x-text-input id="selling_price" name="selling_price" type="text" class="mt-1 block w-full" :value="old('selling_price', $item->selling_price)" required/>
                                                    <x-input-error class="mt-2" :messages="$errors->get('selling_price')" />
                                                </div>                                                

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <button class="ml-3 px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        {{ __('Update Item') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </x-modal>
                                        <x-danger-button class="ml-3"
                                            x-data="{}"
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{$item->id}}')"
                                        >{{ __('Delete') }}</x-danger-button>
                                        <x-modal name="confirm-user-deletion-{{$item->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('dashboard.item-management.destroy', [$item->id]) }}" class="text-left p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to delete item :name ?', ['name' => $item->name]) }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Once the item is deleted, all of its resources and data will be permanently deleted.') }}
                                                </p>
                                                
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ml-3">
                                                        {{ __('Delete Item') }}
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