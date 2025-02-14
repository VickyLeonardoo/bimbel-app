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
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Invoice</h1>
                        <p class="text-sm text-gray-600">Transaction No: {{ $transaction->transaction_no }}</p>
                    </div>
                    <div class="flex gap-3">
                        @if ($transaction->status === 'Draft')
                            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                        @elseif($transaction->status === 'Pending')
                            <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">Pending</span>
                        @elseif($transaction->status === 'Payment Receive')
                            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">Approved</span>
                        @else
                            <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">Rejected</span>
                        @endif
                    </div>
                </div>

                <!-- Transaction Info Grid -->
                <div class="grid grid-cols-2 gap-6 p-6 border-b border-gray-200">
                    <div>
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Invoice Details</h3>
                        <dl class="space-y-3 text-sm">
                            <div>
                                <dt class="text-gray-500">Academic Year</dt>
                                <dd class="font-medium text-gray-900">{{ $transaction->year->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Transaction Date</dt>
                                <dd class="font-medium text-gray-900">{{ $transaction->created_at->format('d M Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Status</dt>
                                <dd class="font-medium text-gray-900">{{ $transaction->status }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div>
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Payment Information</h3>
                        <dl class="space-y-3 text-sm">
                            <div>
                                <dt class="text-gray-500">Amount</dt>
                                <dd class="font-medium text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</dd>
                            </div>
                            @if($transaction->discount_id)
                            <div>
                                <dt class="text-gray-500">Discount Code</dt>
                                <dd class="font-medium text-gray-900">{{ $transaction->discount->code }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Discount Amount</dt>
                                <dd class="font-medium text-gray-900">Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Action Buttons -->
                @if($transaction->status === 'Pending')
                <div class="flex justify-end gap-3 p-6 bg-gray-50">
                    <form action="{{ route('transaction.reject',$transaction) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="button" onclick="openRejectModal()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                            Reject Payment
                        </button>
                    
                        <!-- Modal Background -->
                        <div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                            <!-- Modal Overlay -->
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    
                            <!-- Modal Content -->
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <h3 class="text-base font-semibold leading-6 text-gray-900">Reject Transaction</h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500">Are you sure you want to reject this transaction? Please provide a reason for rejection.</p>
                                                    <div class="mt-4">
                                                        <label for="reason" class="block text-sm font-medium text-gray-700">Reason for Rejection</label>
                                                        <textarea
                                                            name="reason"
                                                            id="reason"
                                                            rows="4"
                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                            placeholder="Enter rejection reason..."
                                                            required
                                                        ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                                            Confirm Rejection
                                        </button>
                                        <button type="button" onclick="closeRejectModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('transaction.approve',$transaction) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                            Approve Payment
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <!-- Payment Proof Section -->
            @if($transaction->payment_image)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Payment Proof</h2>
                </div>
                <div class="p-6">
                    <div class="w-full max-w-2xl mx-auto">
                        <div class="aspect-[16/9] rounded-lg overflow-hidden bg-gray-100">
                            <img 
                                src="{{ Storage::url($transaction->payment_image) }}" 
                                alt="Payment Proof"
                                class="w-full h-full object-cover cursor-pointer"
                                onclick="openImageViewer(this.src)"
                            >
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Unified Course Table Section -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Course Details</h2>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $uniqueStudents = $transaction->items->pluck('children')->unique('id');
                                    $courses = $transaction->items->pluck('course')->unique('id');
                                    $studentCount = $uniqueStudents->count();
                                @endphp
                                
                                @foreach($courses as $index => $course)
                                    <tr>
                                        @if($index === 0)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" rowspan="{{ count($courses) }}">
                                                @foreach($uniqueStudents as $student)
                                                    {{ $student->name }}<br>
                                                @endforeach
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $course->name }} (x{{ $studentCount }})
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                            Rp {{ number_format($course->price * $studentCount, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-sm font-medium text-gray-900 text-right">
                                        Subtotal
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 text-right">
                                        Rp {{ number_format($transaction->items->sum('price'), 0, ',', '.') }}
                                    </td>
                                </tr>
                                @if($transaction->discount_id)
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-sm font-medium text-gray-900 text-right">
                                        Discount ({{ $transaction->discount->code }})
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-red-600 text-right">
                                        - Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endif
                                <tr class="bg-gray-100">
                                    <td colspan="2" class="px-6 py-4 text-base font-semibold text-gray-900 text-right">
                                        Total
                                    </td>
                                    <td class="px-6 py-4 text-base font-semibold text-gray-900 text-right">
                                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Image Viewer Modal -->
            <div id="imageViewer" class="fixed inset-0 z-50 hidden">
                <div class="absolute inset-0 bg-black bg-opacity-75" onclick="closeImageViewer()"></div>
                <div class="relative flex h-full w-full items-center justify-center p-4">
                    <div class="max-h-[90vh] max-w-[90vw] overflow-hidden">
                        <img id="viewerImage" src="" alt="Payment Proof" class="h-auto w-full max-h-[85vh] object-contain rounded-lg">
                        <button onclick="closeImageViewer()" class="absolute top-4 right-4 rounded-full bg-white/90 p-2 text-gray-800 shadow-lg transition-transform hover:scale-110">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openImageViewer(src) {
            document.getElementById('viewerImage').src = src;
            document.getElementById('imageViewer').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageViewer() {
            document.getElementById('imageViewer').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageViewer();
            }
        });
    </script>
    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        
        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('rejectModal');
            if (event.target == modal) {
                closeRejectModal();
            }
        }
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeRejectModal();
            }
        });
        </script>
</x-app-layout>