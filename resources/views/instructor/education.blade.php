<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8 py-12">
        {{-- <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-lg p-8"> --}}
        <div class="mx-auto bg-white shadow-xl rounded-lg p-8">
            <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center">Education for {{ $instructor->user->name }}</h2>
            @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="py-3 w-full bg-red-500 text-white font-bold mb-3">
                    <p class="ml-3">{{$error}}</p>
                </div>
            @endforeach
        @endif
            <form action="{{ route('instructor.education.store',$instructor) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="degree" :value="__('Degree Level')" />
                        <select data-hs-select='{
                            "placeholder": "Select option...",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                          }' class="hidden" name="degree">
                            <option value="">Choose</option>
                            <option value="SMA" {{ old('degree') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="D3" {{ old('degree') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ old('degree') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('degree') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('degree') == 'S3' ? 'selected' : '' }}>S3</option>
                          </select>
                        <x-input-error :messages="$errors->get('degree')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="major" :value="__('Instructor Majority')" />
                        <x-text-input id="major"
                            class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            type="text" name="major" :value="old('major')" placeholder="Enter instructor major"
                            required autofocus autocomplete="major" />
                        <x-input-error :messages="$errors->get('major')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="university" :value="__('Instructor University')" />
                        <x-text-input id="university"
                            class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            type="text" name="university" :value="old('university')" placeholder="Enter instructor university"
                            required autofocus autocomplete="university" />
                        <x-input-error :messages="$errors->get('university')" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('instructor.show',$instructor) }}"
                        class="px-6 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                        Add Education
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
