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
            <div class="flex flex-col md:flex-row justify-end items-center mb-6 space-y-4 md:space-y-0">
                <form method="GET" action="{{ route('courses.index') }}" class="flex w-full md:w-auto">
                    <input type="text" name="search" placeholder="Search courses..." 
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Transaction No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Transaction Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-indigo-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $transaction->transaction_no }}</td>
                            <td class="px-6 py-4">{{ $transaction->user->name }}</td>
                            <td class="px-6 py-4">Rp. {{ number_format($transaction->amount) }}</td>
                            <td class="px-6 py-4">{{ date('d M Y h:s', strtotime($transaction->created_at)) }}</td>
                            <td class="px-6 py-4">
                                @if ($transaction->status == 'Draft')
                                    <span
                                        class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <span class="w-2 h-2 mr-1.5 rounded-full bg-yellow-600"></span>
                                        Draft
                                    </span>
                                @elseif ($transaction->status == 'Pending')
                                    <span
                                        class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        <span class="w-2 h-2 mr-1.5 rounded-full bg-blue-600"></span>
                                        Pending
                                    </span>
                                @elseif($transaction->status == 'Payment Receive')
                                    <span
                                        class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <span class="w-2 h-2 mr-1.5 rounded-full bg-green-600"></span>
                                        Payment Receive
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <span class="w-2 h-2 mr-1.5 rounded-full bg-red-600"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('transaction.show',$transaction) }}"
                                    class="inline-flex items-center px-3 py-1.5 border border-indigo-600 text-indigo-600 hover:bg-indigo-50 rounded-md text-sm font-medium transition duration-150">
                                    <span>View Details</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4 text-center" colspan="7">
                                No transactions found. Try a different search or refresh page.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>