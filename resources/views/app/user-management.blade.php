<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
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
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Details
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->username }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->roles->name }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($user->roles->name != "admin")
                                        gender:{{ $user->gender ? $user->gender : "none" }},
                                    @endif
                                    
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end">
                                        <button class="ml-3 px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            x-data="{}"
                                            x-on:click.prevent="$dispatch('open-modal', 'edit-user-{{$user->id}}')"
                                        >{{ __('Edit') }}</button>
                                        <x-modal name="edit-user-{{$user->id}}" focusable>
                                            {{--<form method="post" action="{{ route('dashboard.user-management.update', [$user->id]) }}" class="text-left p-6 space-y-6">--}}
                                            <form method="post" action="{{ route('dashboard.user-management.update') }}" class="text-left p-6 space-y-6">
                                                @csrf
                                                @method('POST')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Edit user: :username', ['username' => $user->username]) }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('.') }}
                                                </p>

                                                <div class="hidden">
                                                    <x-text-input id="id" name="id" type="text" class="mt-1 block w-full" :value="old('id', $user->id)" readonly="readonly"/>
                                                </div>

                                                <div>
                                                    <x-input-label for="name" :value="__('Name')" />
                                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" autofocus autocomplete="name" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="username" :value="__('Username')" />
                                                    <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" autocomplete="username" readonly="readonly"/>
                                                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                                                </div>

                                                <div>
                                                    <x-input-label for="role" :value="__('Role')" />
                                                    <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $user->roles->name)" readonly="readonly"/>
                                                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                                                </div>
                                                
                                                @if ($user->roles->name != "admin")
                                                    <div class="mt-4" id="gender" >
                                                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                                                        <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option {{old('gender',$user->gender)=="male"? 'selected':''}}  value="male">Male</option>
                                                            <option {{old('gender',$user->gender)=="female"? 'selected':''}} value="female">Female</option>
                                                            <option {{old('gender',$user->gender)=="others"? 'selected':''}} value="others">Others</option>
                                                        </select>
                                                    </div>
                                                @endif

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <button class="ml-3 px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        {{ __('Update User') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </x-modal>

                                        <x-danger-button class="ml-3"
                                            x-data="{}"
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{$user->id}}')"
                                        >{{ __('Delete') }}</x-danger-button>
                                        <x-modal name="confirm-user-deletion-{{$user->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('dashboard.user-management.destroy', [$user->id]) }}" class="text-left p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to delete user :username ?', ['username' => $user->username]) }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Once the user is deleted, all of its resources and data will be permanently deleted.') }}
                                                </p>
                                               
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ml-3">
                                                        {{ __('Delete User') }}
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