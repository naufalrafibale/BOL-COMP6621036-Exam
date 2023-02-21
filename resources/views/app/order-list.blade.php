<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order List') }}
            </h2>
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
                                    Customer
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Details
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $transaction->id }}
                                </td>
                                <th class="px-6 py-4">
                                    {{ $transaction->customer->user->name }}
                                </th>
                                <td class="px-6 py-4">
                                    @foreach ($transaction->orders as $order)
                                        Item name:{{ $order->item->name }},
                                        Quantity:{{ $order->quantity }},
                                        Total price:{{ $order->total_price }}
                                        <br>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->total_price }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->confirmed == 0)
                                        Unconfirmed
                                    @else
                                        Confirmed
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->confirmed == 0)
                                        <a class="ml-3 px-6 py-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" href="{{ route('dashboard.item-order-confirm', [$transaction->id]) }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('order-confirm-form').submit();">
                                            {{ __('Confirm') }}
                                        </a>
                                        <form id="order-confirm-form" action="{{ route('dashboard.item-order-confirm', [$transaction->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form> 
                                    @else
                                        <a disabled class="ml-3 px-6 py-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Confirmed') }}
                                        </a>
                                    @endif
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