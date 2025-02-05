<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8 py-8">
        <!-- Status Messages -->
        @if(session('success'))
            <div id="success-alert" class="relative mb-6">
                <div class="p-4 rounded-lg bg-green-50 border border-green-200 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <!-- Discount Alert -->
        @if($transaction->discount_id)
        <div class="relative mb-6">
            <div class="p-4 rounded-lg bg-blue-50 border border-blue-200 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-blue-800">
                            Transaksi berhasil dibuat! Anda menggunakan kode promo <span class="font-bold">{{ $transaction->discount->code }}</span> dan mendapatkan diskon sebesar Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}
                        </p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-blue-600 hover:text-blue-800">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endif
        <!-- Transaction Header -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">Transaction Details</h1>
                        <p class="text-sm text-gray-600 mt-1">Transaction No: {{ $transaction->transaction_no }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($transaction->status === 'Draft')
                            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">
                                Draft
                            </span>
                        @elseif($transaction->status === 'Pending')
                            <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">
                                Approved
                            </span>
                        @elseif($transaction->status === 'Payment Receive')
                            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">
                                Approved
                            </span>
                        @else
                            <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">
                                Rejected
                            </span>
                        @endif
                        
                        @if(auth()->user()->hasRole('admin'))
                            <div class="flex gap-2">
                                <form action="{{ route('admin.transaction.approve', $transaction) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.transaction.reject', $transaction) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Transaction Summary -->
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Academic Year</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $transaction->year->name }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Transaction Date</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total Amount</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Proof Section -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Payment Proof</h2>
            </div>
            <div class="px-6 py-4">
                <div class="relative mb-6">
                    <div class="p-4 rounded-lg bg-yellow-50 border border-yellow-200 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-yellow-800">
                                    Lakukan pembayaran sejumlah <span class="font-bold">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span> pada rekening 1090020804423 Atas Nama <span class="font-bold">Bimbel BUC Teva</span>. Download bukti pembayaran dan upload pada form dibawah!.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($transaction->payment_proof)
                    <div class="mb-4">
                        <img src="{{ Storage::url($transaction->payment_proof) }}" 
                             alt="Payment Proof" 
                             class="max-w-lg rounded-lg shadow cursor-pointer"
                             onclick="openImageViewer(this.src)">
                    </div>
                @endif

                @if(!$transaction->payment_proof || auth()->user()->hasRole('admin'))
                    <form action="#" 
                          method="POST" 
                          enctype="multipart/form-data"
                          class="max-w-lg">
                        @csrf
                        @method('PATCH')
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
                                </div>
                                <input type="file" name="payment_proof" class="hidden" accept="image/*" required>
                            </label>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                Upload Payment Proof
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- Transaction Items -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Registered Courses</h2>
            </div>
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($transaction->items->groupBy('children_id') as $childId => $items)
                        <div class="border rounded-lg p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                {{ $items->first()->children->name }}
                            </h3>
                            <div class="space-y-3">
                                @foreach($items as $item)
                                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $item->course->name }}</h4>
                                            <p class="text-sm text-gray-500">Course ID: {{ $item->course->id }}</p>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Image Viewer Modal -->
    <div id="imageViewer" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center" onclick="closeImageViewer()">
        <div class="max-w-4xl mx-auto p-4">
            <img id="viewerImage" src="" alt="Payment Proof" class="max-w-full max-h-[80vh] rounded-lg">
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

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageViewer();
            }
        });
    </script>
</x-app-layout>