<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Academic Years</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage academic years and registration periods</p>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div id="alert-success" class="flex items-center p-4 mb-6 rounded-lg bg-green-50 border-l-4 border-green-500 dark:bg-gray-800 dark:border-green-400" role="alert">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-400">
                    {{ session('success') }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-green-500 hover:text-green-800 focus:outline-none p-1.5" onclick="document.getElementById('alert-success').style.display='none';">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @elseif (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative"
                role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Action Bar -->
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-6">
            <!-- Search Bar -->
            <form method="GET" action="{{ route('year.index') }}" class="relative w-full lg:w-96">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                    placeholder="Search academic years...">
                <button type="submit" class="absolute right-2 bottom-2 top-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                    Search
                </button>
            </form>
            
            <!-- Add New Year Button -->
            <a href="{{ route('year.create') }}" class="loader-button inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 w-full lg:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Academic Year
            </a>
        </div>

        <!-- Years Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-700 border-b border-indigo-100 dark:border-gray-600">
                            <th rowspan="2" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 dark:text-indigo-300 uppercase tracking-wider">No</th>
                            <th rowspan="2" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 dark:text-indigo-300 uppercase tracking-wider">Year Name</th>
                            <th colspan="2" class="px-6 py-3 text-center text-xs font-semibold text-indigo-700 dark:text-indigo-300 uppercase tracking-wider">Registration Period</th>
                            <th rowspan="2" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 dark:text-indigo-300 uppercase tracking-wider">Actions</th>
                        </tr>
                        <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-700">
                            <th class="px-6 py-3 text-xs font-semibold text-indigo-700 dark:text-indigo-300 uppercase tracking-wider text-center">Start Date</th>
                            <th class="px-6 py-3 text-xs font-semibold text-indigo-700 dark:text-indigo-300 uppercase tracking-wider text-center">End Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($years as $year)
                        <tr class="hover:bg-indigo-50 dark:hover:bg-gray-700 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                {{ $year->name }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-300">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ date('d M Y', strtotime($year->reg_start_date)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-300">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ date('d M Y', strtotime($year->reg_end_date)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <!-- Edit Button -->
                                    <a href="{{ route('year.edit', $year) }}" class="flex items-center justify-center h-9 w-9 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors duration-200 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800" title="Edit Academic Year">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('year.destroy', $year) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this academic year?')" class="flex items-center justify-center h-9 w-9 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-colors duration-200 dark:bg-red-900 dark:text-red-200 dark:hover:bg-red-800" title="Delete Academic Year">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-10 text-center text-gray-500 dark:text-gray-400" colspan="5">
                                <div class="flex flex-col items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-lg font-medium">No academic years found</p>
                                    <p class="text-sm mt-1">Try a different search or add a new academic year</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $years->links() }}
        </div>
    </div>
</x-app-layout>