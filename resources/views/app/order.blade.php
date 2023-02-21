<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Make an Order') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <form method="post" action="{{ route('dashboard.order') }}">
                        @csrf
                        @method('POST')
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" >
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Item
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <!-- <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Action</span>
                                    </th> -->
                                </tr>
                            </thead>
                            <tbody id="order-table">
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <select id="item_order[0]" name="item_order[0]" class="item_order bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" selected>Select item</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ __(':name - Rp.:price', ['name' => $item->name, 'price' => $item->selling_price]) }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <x-text-input id="quantity[0]" name="quantity[0]" type="number" class="mt-1 block w-20" value="0" required/>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-6 flex justify-end">
                            <button type="button" name="add" id="add-button" class="add-button ml-3 px-6 py-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Add Item
                            </button>
                            <button type="submit" class="ml-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @yield('order-script')
        <script type="text/javascript">
            var i = 0;
            $('body').on('change', "[id^=item_order]", function(e) {
                // var test = e.target.name;
                // console.log(test);
                // var suffix = test.match(/\d+/);
                // console.log(suffix);
                // var items = {!! json_encode($items->toArray()) !!};
                // for (let i = 0; i < Object.keys(items).length; i++) {
                //     if ($(this).val() == items[i].id) {
                //         // console.log(items[i]);
                //         // var price = '#price[' + suffix + ']';
                //         // console.log(price);
                //         // $('#' + price[0]).text(1000);
                //         // $('#price[0]').innerHTML = 1000;
                //         // console.log(items[i].selling_price);
                //         // console.log($('#price[0]').attr('id'));
                //     }
                // }
            });

            // $("[id^=item-order]").change(function() {
            //     var test = $('.item-order').attr('name')
            //     console.log("A");
            //     console.log(test);
            // });

            $('body').on('click', ".add-button", function (e) {
                // console.log($(this).prop('class', '.remove-button bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'));
                // $(this).text('Remove');
                ++i;
                $("#order-table").append('<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><select id="item_order[' + i + ']" name="item_order[' + i + ']" class="item_order bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><option value="" selected>Select item</option>@foreach ($items as $item)<option value="{{ $item->id }}">{{ __(":name - Rp.:price", ["name" => $item->name, "price" => $item->selling_price]) }}</option>@endforeach</select></th><th scope="col" class="px-6 py-3"><input id="quantity[' + i + ']" name="quantity[' + i + ']" type="number" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-20" value="0" required/></th></tr>')
            });
        </script>
</x-app-layout>