<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8 py-12">
        {{-- <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-lg p-8"> --}}
        <div class="mx-auto bg-white shadow-xl rounded-lg p-8">
            <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center">Create New Instructor</h2>

            <form action="{{ route('instructor.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Instructor Name')" />
                        <x-text-input id="name"
                            class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            type="text" name="name" :value="old('name')" placeholder="Enter instructor name" required
                            autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Instructor Email')" />
                        <x-text-input id="email"
                            class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            type="email" name="email" :value="old('email')" placeholder="Enter instructor email"
                            required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Instructor Phone')" />
                        <x-text-input id="phone"
                            class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            type="text" name="phone" :value="old('phone')" placeholder="Enter instructor phone"
                            required autofocus autocomplete="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="gender" :value="__('Gender')" />
                        <select name="gender" id="gender" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Instructor Photo')" />
                        <x-text-input id="image"
                            class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            type="file" name="image" :value="old('image')" placeholder="Select instructor image"
                             autofocus autocomplete="image" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="course_id" :value="__('Course')" />
                        <select multiple=""
                            data-hs-select='{
                            "placeholder": "Select course options...",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500",
                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100",
                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                            }'
                            class="hidden" name="course_id[]">
                            <option value="">Choose</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{$course->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
                    </div>
                    <!-- End Select -->
                </div>

                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('courses.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                        Create Instructor
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
