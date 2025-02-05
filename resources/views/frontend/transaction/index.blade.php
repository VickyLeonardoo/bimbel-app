<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <!-- New Registration CTA Section -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Ingin melakukan pendaftaran?</h3>
                        <p class="mt-1 text-sm text-gray-500">Daftar sekarang dan mulai belajar bersama kami</p>
                    </div>
                    <a href="{{ route('client.transaction.create') }}"
                        class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition duration-150 ease-in-out">
                        <span>Daftar Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Section Header -->
            <div class="mb-6">
                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Daftar Transaksi</h4>
                <p class="mt-1 text-sm text-gray-600">Kelola semua transaksi pendaftaran Anda</p>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No Reg</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Course Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Transaction Row 1 -->
                                @foreach ($transactions as $transaction)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $transaction->transaction_no }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                @php
                                                    $uniqueCourses = [];
                                                @endphp
                                                @foreach ($transaction->courses as $course)
                                                    @if (!in_array($course->name, $uniqueCourses))
                                                        @php
                                                            $uniqueCourses[] = $course->name;
                                                        @endphp
                                                        <span
                                                            class="text-sm font-medium text-gray-900">{{ $course->name }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp. {{ number_format($transaction->amount) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="{{ route('client.transaction.show',$transaction) }}"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
