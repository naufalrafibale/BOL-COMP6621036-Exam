<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Hotel News Management') }}
            </h2>
            <button class="mx-6 text-green-500 hover:text-green-300 text-white font-bold rounded" x-data="{}"
                    x-on:click.prevent="$dispatch('open-modal', 'add-news')"
                >{{ __('Add news') }}
            </button>
            <x-modal name="add-news" focusable>
                <form method="post" action="{{ route('dashboard.news-management') }}" class="text-left p-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Add new post:') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('.') }}
                    </p>

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Type')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full h-full" :value="old('description')" required autofocus autocomplete="description" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <button class="ml-3 px-6 py-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Add news') }}
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
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($news as $n)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $n->id }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $n->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $n->description }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end">
                                        <button class="ml-3 px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            x-data="{}"
                                            x-on:click.prevent="$dispatch('open-modal', 'edit-news-{{$n->id}}')"
                                        >{{ __('Edit') }}</button>
                                        <x-modal name="edit-news-{{$n->id}}" focusable>
                                            <form method="post" action="{{ route('dashboard.news-management.update', [$n->id]) }}" class="text-left p-6 space-y-6">
                                                @csrf
                                                @method('POST')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Edit news: :name', ['name' => $n->name]) }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('.') }}
                                                </p>

                                                <div style="display:none">
                                                    <x-input-label for="id" :value="__('id')" />
                                                    <x-text-input id="id" name="id" type="text" class="mt-1 block w-full" :value="old('id', $n->id)" required/>
                                                    <x-input-error class="mt-2" :messages="$errors->get('id')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="title" :value="__('Title')" />
                                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                                </div>
         
                                                <div>
                                                    <x-input-label for="description" :value="__('Description')" />
                                                    <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" required autofocus autocomplete="description" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <button class="ml-3 px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        {{ __('Update news') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </x-modal>
                                        <x-danger-button class="ml-3"
                                            x-data="{}"
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{$n->id}}')"
                                        >{{ __('Delete') }}</x-danger-button>
                                        <x-modal name="confirm-user-deletion-{{$n->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('dashboard.news-management.destroy', [$n->id]) }}" class="text-left p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to delete news :name ?', ['name' => $n->name]) }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Once the news is deleted, all of its resources and data will be permanently deleted.') }}
                                                </p>
                                                
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ml-3">
                                                        {{ __('Delete news') }}
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