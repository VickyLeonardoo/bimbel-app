<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative" role="alert">
                    <span class="font-medium">{{ session('success') }}</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button" class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                <a href="{{ route('instructor.create') }}" class="loader-button inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Add New Instructor
                </a>
                
                <form method="GET" action="{{ route('instructor.index') }}" class="flex w-full md:w-auto">
                    <input type="text" name="search" placeholder="Search instructor..." 
                        class="w-full md:w-64 px-4 py-2 border-2 border-r-0 border-indigo-300 rounded-l-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        value="{{ request('search') }}">
                    <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 text-white rounded-r-full hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($instructors as $instructor)
                        <tr class="hover:bg-indigo-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $instructor->user->name }}</td>
                            <td class="px-6 py-4">{{ $instructor->user->email }}</td>
                            <td class="px-6 py-4">{{ $instructor->user->phone }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('instructor.show', $instructor) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4 text-center" colspan="5">
                                No instructor found. Try a different search or add a new instructor.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $instructors->links() }}
            </div>
        </div>
    </div>
</x-app-layout>