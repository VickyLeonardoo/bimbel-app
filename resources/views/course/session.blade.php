<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('success') }}</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @elseif(session('error'))
                <div id="success-alert" class="relative mb-6">
                    <div class="p-4 rounded-lg bg-red-50 border border-red-200 shadow-sm">
                        <div class="flex items-center gap-4">
                            <!-- Success Icon -->
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            
                            <!-- Alert Content -->
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-red-800">
                                            Error!
                                        </p>
                                        <p class="mt-1 text-sm text-red-700">
                                            {{ session('error') }}
                                        </p>
                                    </div>
                                    <!-- Close Button -->
                                    <button type="button" onclick="closeAlert()" class="self-center p-1.5 hover:bg-red-100 rounded-full transition-colors duration-200">
                                        <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                <button type="button" onclick="openSessionModal()"
                    class="loader-button inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Get Session
                </button>
            </div>

            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">
                                Name</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($sessions as $session) 
                        <tr class="hover:bg-indigo-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $session->name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4 text-center" colspan="2">
                                No sessions found. Try a different search or add a new session.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- <div class="mt-4">
                {{ $years->links() }}
            </div> --}}
        </div>
    </div>
    <!-- Modal -->
    <!-- Modal Background -->
<div id="sessionModal" class="fixed inset-0 z-40 hidden overflow-y-auto">
    <!-- Modal Overlay -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <!-- Modal Content -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-visible rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form action="{{ route('courses.session.store',$course) }}" method="POST">
                @csrf
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">Select Session</h3>
                            <div class="relative">
                                <x-input-label for="type" class="mb-1" :value="__('Type')" />
                                <select data-hs-select='{
                                    "placeholder": "Select option...",
                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                    "dropdownClasses": "absolute mt-2 z-[60] w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                    }' class="hidden" name="year_id">
                                    <option value="">Choose</option>
                                    @foreach ($years as $year)
                                    <option value="{{ $year->id }}" {{ old('year_id') == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                        Confirm
                    </button>
                    <button type="button" onclick="closeSessionModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
        function openSessionModal() {
            document.getElementById('sessionModal').classList.remove('hidden');
        }

        function closeSessionModal() {
            document.getElementById('sessionModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('sessionModal');
            if (event.target == modal) {
                closeSessionModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSessionModal();
            }
        });
    </script>
</x-app-layout>
