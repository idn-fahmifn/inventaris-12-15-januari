<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Detail Item') }}
            </h2>

            <form action="{{ route('item.destroy', $data->slug) }}" method="post">
                @csrf
                @method('delete')
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-room')"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                    Edit
                </button>

                <button type="submit" onclick="return confirm('Yakin mau dihapus?')"
                    class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                    Delete
                </button>

            </form>
        </div>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div
                class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden my-2 p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="">
                        <div class="my-2">
                            <p class="font-bold text-slate-400 dark:text-slate-500 text-lg">Item Name</p>
                            <span class=" text-slate-400 dark:text-slate-500">{{ $data->item_name }}</span>
                        </div>
                        <div class="my-2">
                            <p class="font-bold text-slate-400 dark:text-slate-500 text-lg">Item Code</p>
                            <span class=" text-slate-400 dark:text-slate-500">{{ $data->item_code }}</span>
                        </div>
                        <div class="my-2">
                            <p class="font-bold text-slate-400 dark:text-slate-500 text-lg">Status</p>
                            <span
                                class="inline-flex items-center text-[10px] font-black uppercase tracking-widest {{ $data->status === 'good' ? 'text-emerald-500' : ($data->status === 'maintenance' ? 'text-amber-500' : 'text-rose-500') }}">
                                <span
                                    class="w-2 h-2 rounded-full mr-2 animate-pulse {{ $data->status === 'good' ? 'bg-emerald-500' : ($data->status === 'maintenance' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                {{ $data->status }}
                            </span>
                        </div>
                        <div class="my-2">
                            <p class="font-bold text-slate-400 dark:text-slate-500 text-lg">Date Purchase</p>
                            <span class=" text-slate-400 dark:text-slate-500">{{ $data->date_purchase }}</span>
                        </div>
                        <div class="my-2">
                            <p class="font-bold text-slate-400 dark:text-slate-500 text-lg">Room</p>
                            <span class=" text-slate-400 dark:text-slate-500">{{ $data->room->room_name }}</span>
                        </div>
                        <div class="my-2">
                            <p class="font-bold text-slate-400 dark:text-slate-500 text-lg">Description</p>
                            <span class=" text-slate-400 dark:text-slate-500">{{ $data->desc }}</span>
                        </div>
                    </div>
                    <div class="">
                        <div class="my-2">
                            <img src="{{ asset('storage/images/items/' . $data->image) }}"
                                class="img-fluid max-w-full" alt="Image Item">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-room" :show="false" focusable>
        <div class="p-8 dark:bg-slate-900">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white">
                        Edit Item
                    </h2>
                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Edit {{ $data->item_name }} </p>
                </div>
                <div class="p-3 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>

            <form method="post" action="{{ route('item.update', $data->slug) }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" value="Item Name" class="dark:text-slate-400" />
                        <x-text-input id="name" name="item_name" type="text" required value="{{ $data->item_name }}"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl" />
                        <x-input-error :messages="$errors->get('item_name')" class="mt-2" />

                    </div>

                    <div>
                        <x-input-label for="code" value="Item Code" class="dark:text-slate-400" />
                        <x-text-input id="code" name="item_code" type="text" required value="{{ $data->item_code }}"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl" />
                        <x-input-error :messages="$errors->get('item_code')" class="mt-2" />

                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="room" value="Room" class="dark:text-slate-400" />
                        <select id="room" name="room_id" required
                            class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            <option value="{{ $data->room_id }}">{{ $data->room->room_name }}</option>
                            @foreach ($rooms as $item)
                                <option value="{{ $item->id }}">{{ $item->room_name }}</option>
                            @endforeach

                        </select>
                        <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="status" value="Status Condition" class="dark:text-slate-400" />
                        <select id="status" name="status" required
                            class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            <option value="{{ $data->status }}">{{ $data->status }}</option>
                            <option value="good">Good</option>
                            <option value="broke">Broke</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="code" value="Date Purchase" class="dark:text-slate-400" />
                    <x-text-input id="code" name="date_purchase" type="date" required value="{{ $data->date_purchase }}"
                        class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl" />
                    <x-input-error :messages="$errors->get('date_purchase')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="code" value="Image Item" class="dark:text-slate-400" />
                    <x-text-input id="code" name="image" type="file"
                        class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl p-8" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                </div>

                <div>
                    <x-input-label for="category" value="Description" class="dark:text-slate-400" required />
                    <textarea name="desc" id="desc"
                        class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">{{ $data->desc }}</textarea>
                    <x-input-error :messages="$errors->get('desc')" class="mt-2" />

                </div>


                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                        Close
                    </button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition transform active:scale-95">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
