<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8 py-12">
        <div class="mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden max-w-7xl">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative" role="alert">
                    <span class="font-medium">{{ session('success') }}</span>
                    <button type="button" class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Modern Action Buttons Section -->
            <div class="bg-white border-b border-gray-100 px-8 py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('instructor.index') }}"
                        class="group inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                    <div class="flex space-x-3">
                        <a href="{{ route('instructor.education.create',$instructor) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add Education
                        </a>
                        <a href="{{ route('instructor.edit', $instructor->id) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Rest of your existing code -->
            <div class="relative bg-gradient-to-r from-indigo-600 via-blue-500 to-purple-500 p-12">
                <!-- Previous header content remains the same -->
                <div class="absolute inset-0 bg-black opacity-10 pattern-grid"></div>
                <div class="relative z-10">
                    <h1 class="text-4xl font-bold text-white tracking-tight">{{ $instructor->user->name }}</h1>
                    <p class="text-xl mt-3 text-indigo-100">{{ $instructor->user->email }}</p>
                </div>
            </div>

            <!-- Body Section -->
            <div class="p-8 lg:p-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Photo and Basic Info section remains the same -->
                    <div class="space-y-8">
                        <div class="relative h-[28rem] rounded-2xl overflow-hidden shadow-lg group">
                            <img src="{{ Storage::url($instructor->photo) }}" alt="{{ $instructor->name }}"
                                class="w-full h-full object-cover object-top transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <span class="text-sm text-indigo-600 font-medium uppercase tracking-wider">Phone</span>
                                <p class="mt-2 text-gray-800 font-medium">{{ $instructor->user->phone }}</p>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <span class="text-sm text-indigo-600 font-medium uppercase tracking-wider">Gender</span>
                                <p class="mt-2 text-gray-800 font-medium">{{ $instructor->gender }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Courses Taught section -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-8 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Courses Taught
                        </h2>

                        <!-- Courses list remains the same -->
                        <div class="space-y-6">
                            @if ($instructor->courses->count() > 0)
                                @foreach ($instructor->courses as $course)
                                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-xl font-semibold text-indigo-600">{{ $course->name }}</h3>
                                            <span class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm font-medium">Active</span>
                                        </div>
                                        <p class="text-gray-600 leading-relaxed">{{ $course->description }}</p>
                                    </div>
                                @endforeach
                            @else
                                <div class="bg-gray-50 p-8 rounded-xl text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="mt-4 text-gray-600">No courses assigned yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Education List Section -->
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-8 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Education List
                    </h2>

                    <!-- Education list remains the same -->
                    <div class="space-y-6">
                        @if ($instructor->educations->count() > 0)
                            @foreach ($instructor->educations as $education)
                                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-xl font-semibold text-indigo-600">{{ $education->degree }} {{ $education->major }}</h3>
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('instructor.education.destroy',$education) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this education record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <p class="text-gray-600 leading-relaxed">{{ $education->university }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-gray-50 p-8 rounded-xl text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="mt-4 text-gray-600">No education records found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>