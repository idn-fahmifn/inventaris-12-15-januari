<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Rooms') }}
            </h2>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-room')"
                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                + Add New
            </button>
        </div>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-[0.2em] font-black bg-slate-50/50 dark:bg-slate-800/50">
                                <th class="px-8 py-5">Room Name & Code</th>
                                <th class="px-8 py-5">Desc</th>
                                <th class="px-8 py-5 text-right">#</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @foreach ($rooms as $room)
                                <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">
                                            {{ $room->name }}</div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                            {{ $room->code }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="text-sm text-slate-600 dark:text-slate-400 px-3 py-1 rounded-lg">
                                            {{ Str::limit('Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure perspiciatis corporis ipsa laborum exercitationem est, omnis a reiciendis nihil ratione, enim odit harum, minus maxime quaerat eos soluta neque fugiat.', 10) }}
                                        </span>
                                    </td>
                                   
                                    
                                    <td class="px-8 py-6 text-right">
                                        <button
                                            class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors mx-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
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
                        Add new room
                    </h2>
                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Create new room</p>
                </div>
                <div class="p-3 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>

            <form method="post" action="#" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" value="Room Name" class="dark:text-slate-400" />
                        <x-text-input id="name" name="room_name" type="text"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl"
                            placeholder="ex: Server Room" />
                    </div>

                    <div>
                        <x-input-label for="code" value="Room Code" class="dark:text-slate-400" />
                        <x-text-input id="code" name="room_code" type="text"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl"
                            placeholder="SRV-001" />
                    </div>
                </div>

                <div>
                    <x-input-label for="category" value="Description" class="dark:text-slate-400" />
                    <textarea name="desc" id="desc" class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"></textarea>

                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition transform active:scale-95">
                        Simpan Ruangan
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>