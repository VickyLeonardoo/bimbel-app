<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $course->name }}</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage your attendance student</p>
            </div>

            <!-- Error Alert -->
            @if (session('error'))
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

            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Card Header with Filters -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Attendance Report</h2>

                        <!-- Filter Controls -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <!-- Year Dropdown -->
                            <div class="min-w-0 flex-1 sm:min-w-[200px]">
                                <label for="yearDropdown" class="sr-only">Select Year</label>
                                <select id="yearDropdown"
                                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                    <option selected disabled>Select Year</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}"
                                            {{ $year->id == $selected_year ? 'selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Class Dropdown -->
                            <div class="min-w-0 flex-1 sm:min-w-[200px]">
                                <label for="classDropdown" class="sr-only">Select Class</label>
                                <select id="classDropdown"
                                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                    <option disabled selected>Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class }}"
                                            {{ $class == $selected_class ? 'selected' : '' }}>
                                            Class {{ $class }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th scope="col"
                                        class="sticky left-0 z-10 bg-gray-50 dark:bg-gray-900 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider border-r border-gray-200 dark:border-gray-700">
                                        Student Name
                                    </th>
                                    @foreach ($sessions as $session)
                                        <th scope="col"
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">
                                            {{ $session->name }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($childs as $child)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <td
                                            class="sticky left-0 z-10 bg-white dark:bg-gray-800 px-6 py-4 whitespace-nowrap border-r border-gray-200 dark:border-gray-700">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-white">
                                                            {{ substr($child->children->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $child->children->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($sessions as $session)
                                            @php
                                                $attendance =
                                                    $attendances->get($child->children_id)?->get($session->id) ?? null;
                                            @endphp
                                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                                @if ($attendance)
                                                    @if ($attendance->status == 'Present')
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Present
                                                        </span>
                                                    @elseif ($attendance->status == 'Absent')
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Absent
                                                        </span>
                                                    @elseif ($attendance->status == 'Late')
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Late
                                                        </span>
                                                    @elseif ($attendance->status == 'Leave')
                                                        <!-- Clickable Status Badge -->
                                                        <button onclick="openModal('modal-{{ $attendance->id }}')"
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors duration-200 cursor-pointer">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Permission
                                                        </button>

                                                        <!-- Modal -->
                                                        <div id="modal-{{ $attendance->id }}"
                                                            class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
                                                            <div
                                                                class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-2xl bg-white dark:bg-gray-800">
                                                                <!-- Modal Header -->
                                                                <div
                                                                    class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                                                                    <div class="flex items-center">
                                                                        <div class="flex-shrink-0">
                                                                            <div
                                                                                class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                                                                    fill="currentColor"
                                                                                    viewBox="0 0 20 20">
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                                                        clip-rule="evenodd"></path>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                        <div class="ml-3">
                                                                            <h3
                                                                                class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                                Leave Details
                                                                            </h3>
                                                                            <p
                                                                                class="text-sm text-gray-500 dark:text-gray-400">
                                                                                Permission Information
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <button
                                                                        onclick="closeModal('modal-{{ $attendance->id }}')"
                                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white transition-colors duration-200">
                                                                        <svg class="w-5 h-5" fill="currentColor"
                                                                            viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd"
                                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                                clip-rule="evenodd"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                <!-- Modal Body -->
                                                                <div class="p-6">
                                                                    <div
                                                                        class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                                                                        <div class="flex items-start">
                                                                            <div class="flex-shrink-0">
                                                                                <svg class="w-5 h-5 text-blue-400"
                                                                                    fill="currentColor"
                                                                                    viewBox="0 0 20 20">
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                                                        clip-rule="evenodd"></path>
                                                                                </svg>
                                                                            </div>
                                                                            <div class="ml-3 flex-1">
                                                                                <h4
                                                                                    class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">
                                                                                    Reason for Leave
                                                                                </h4>
                                                                                <p
                                                                                    class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                                                                    {{ $attendance->reason ?? 'No reason provided' }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal Footer -->
                                                                <div
                                                                    class="flex items-center justify-end p-4 border-t border-gray-200 dark:border-gray-700">
                                                                    <button
                                                                        onclick="closeModal('modal-{{ $attendance->id }}')"
                                                                        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                                                                        Close
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400 dark:text-gray-500">-</span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($sessions) + 1 }}" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No
                                                    students found</h3>
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Please select
                                                    a year and class to view attendance data.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Summary Footer (Optional) -->
                @if ($childs->count() > 0)
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                Showing <span class="font-medium">{{ $childs->count() }}</span> students
                                @if ($selected_class)
                                    in <span class="font-medium">Class {{ $selected_class }}</span>
                                @endif
                            </div>
                            <div class="flex items-center space-x-4 text-xs">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-1"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Present</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-red-500 rounded-full mr-1"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Absent</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-1"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Late</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-1"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Permission</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function updateUrl() {
            const selectedYear = document.getElementById('yearDropdown').value;
            const selectedClass = document.getElementById('classDropdown').value;
            const url = new URL(window.location.href);

            if (selectedYear && selectedYear !== 'Select Year') {
                url.searchParams.set('year_id', selectedYear);
            }

            if (selectedClass && selectedClass !== 'Select Class') {
                url.searchParams.set('class', selectedClass);
            }

            window.location.href = url.toString();
        }

        document.getElementById('yearDropdown').addEventListener('change', updateUrl);
        document.getElementById('classDropdown').addEventListener('change', updateUrl);

        // Add loading state for better UX
        function showLoading(element) {
            element.style.opacity = '0.5';
            element.style.pointerEvents = 'none';
        }

        document.getElementById('yearDropdown').addEventListener('change', function() {
            showLoading(document.querySelector('.bg-white'));
        });

        document.getElementById('classDropdown').addEventListener('change', function() {
            showLoading(document.querySelector('.bg-white'));
        });
    </script>
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scroll
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto'; // Restore background scroll
        }
        
        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('[id^="modal-"]');
            modals.forEach(modal => {
                if (event.target === modal) {
                    closeModal(modal.id);
                }
            });
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('[id^="modal-"]:not(.hidden)');
                modals.forEach(modal => {
                    closeModal(modal.id);
                });
            }
        });
        </script>
</x-app-layout>
