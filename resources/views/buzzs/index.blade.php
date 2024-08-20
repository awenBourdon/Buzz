<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('buzzs.store') }}" enctype="multipart/form-data">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('Faire le buzz ?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            
            <input type="file" name="image" class="mt-2 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-black-50 file:text-black-700
                hover:file:bg-indigo-100">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
            
            <x-primary-button class="mt-4">{{ __('Buzzer') }}</x-primary-button>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($buzzs as $buzz)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $buzz->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $buzz->created_at->locale('fr')->isoFormat('D MMMM YYYY, HH:mm') }}</small>
                                @unless ($buzz->created_at->eq($buzz->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('Modifié') }}</small>
                                @endunless
                            </div>
                            @if ($buzz->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('buzzs.edit', $buzz)">
                                            {{ __('Modifier la légende') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('buzzs.destroy', $buzz) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('buzzs.destroy', $buzz)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Supprimer') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $buzz->message }}</p>
                        @if($buzz->image)
                            <div class="mt-4 flex justify-center">
                                <img src="{{ asset('storage/' . $buzz->image) }}" alt="Buzz Image" class="mt-4 rounded-lg max-w-full h-auto">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>