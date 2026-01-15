<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Items') }}
            </h2>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-room')"
                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                + Add New
            </button>
        </div>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($errors->all() as $r)
                {{ $r }}
            @endforeach

            <div
                class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-[0.2em] font-black bg-slate-50/50 dark:bg-slate-800/50">
                                <th class="px-8 py-5">Item Name & Code</th>
                                <th class="px-8 py-5">Status</th>
                                <th class="px-8 py-5 text-right">#</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse ($data as $item)
                                <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">
                                            {{ $item->item_name }}</div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                            {{ $item->item_code }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="inline-flex items-center text-[10px] font-black uppercase tracking-widest {{ $room->status === 'Tersedia' ? 'text-emerald-500' : ($room->status === 'Terbatas' ? 'text-amber-500' : 'text-rose-500') }}">
                                            <span
                                                class="w-2 h-2 rounded-full mr-2 animate-pulse {{ $item->status === 'good' ? 'bg-emerald-500' : ($item->status === 'maintenance' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                            {{ $room->status }}
                                        </span>
                                    </td>


                                    <td class="px-8 py-6 text-right">
                                        <a href="{{ route('item.show', $item->slug) }}"
                                            class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors mx-2">
                                            <svg class="w-5 h-5" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"
                                                fill="#f5f5f5">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M0 0h48v48H0z" fill="none"></path>
                                                    <g id="Shopicon">
                                                        <circle cx="24" cy="24" r="4"></circle>
                                                        <path
                                                            d="M24,38c12,0,20-14,20-14s-8-14-20-14S4,24,4,24S12,38,24,38z M24,16c4.418,0,8,3.582,8,8s-3.582,8-8,8s-8-3.582-8-8 S19.582,16,24,16z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="">
                                    <td class="px-8 py-6 text-center" colspan="3">
                                        <span class="text-sm text-slate-600 dark:text-slate-400 px-3 py-1 rounded-lg ">
                                            Item not found
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-room" :show="false" focusable>
        <div class="p-8 dark:bg-slate-900">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white">
                        Add new item
                    </h2>
                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Create new item</p>
                </div>
                <div class="p-3 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>

            <form method="post" action="{{ route('item.store') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" value="Item Name" class="dark:text-slate-400" />
                        <x-text-input id="name" name="item_name" type="text" required :value="old('item_name')"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl" />
                        <x-input-error :messages="$errors->get('item_name')" class="mt-2" />

                    </div>

                    <div>
                        <x-input-label for="code" value="Item Code" class="dark:text-slate-400" />
                        <x-text-input id="code" name="item_code" type="text" required :value="old('item_code')"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl" />
                        <x-input-error :messages="$errors->get('item_code')" class="mt-2" />

                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="room" value="Room" class="dark:text-slate-400" />
                        <select id="room" name="room_id" required
                            class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            <option value="">Choose Room</option>
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
                            <option value="good">Good</option>
                            <option value="broke">Broke</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="code" value="Date Purchase" class="dark:text-slate-400" />
                    <x-text-input id="code" name="date_purchase" type="date" required :value="old('date')"
                        class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl" />
                    <x-input-error :messages="$errors->get('date_purchase')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="code" value="Image Item" class="dark:text-slate-400" />
                    <x-text-input id="code" name="image" type="file" required :value="old('image')"
                        class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl p-8" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                </div>

                <div>
                    <x-input-label for="category" value="Description" class="dark:text-slate-400" required />
                    <textarea name="desc" id="desc"
                        class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"></textarea>
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
