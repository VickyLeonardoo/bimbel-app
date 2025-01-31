<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8 py-12">
        {{-- <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-lg p-8"> --}}
        <div class="mx-auto bg-white shadow-xl rounded-lg p-8">
            <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center">Create New Course</h2>

            <form action="{{ route('courses.update',$course) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Course Name')" />
                        <x-text-input id="name"
                            class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            type="text" name="name" value="{{ $course->name }}" placeholder="Enter course name" required
                            autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Course Price</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" name="price" id="price" required min="0" step="1000"
                                class="w-full pl-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Enter course price" value="{{ $course->price }}">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Course
                            Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Describe the course content and objectives">{{ $course->description }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="session" class="block text-sm font-medium text-gray-700 mb-2">Number of
                            Sessions</label>
                        <input type="number" name="session" id="session" required min="1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Enter number of course session" value="{{ $course->session }}">
                        @error('session')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('courses.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                        Update Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
