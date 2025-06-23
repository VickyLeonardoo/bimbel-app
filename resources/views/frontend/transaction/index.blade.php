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
                                                    Cancelled
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
<!-- Floating Testimonial Button & Popup -->
<div x-data="{
    showModal: false,
    rating: 0,
    hoverRating: 0,
    name: '',
    review: '',
    isSubmitting: false,
    setRating(star) {
        this.rating = star;
    },
    setHoverRating(star) {
        this.hoverRating = star;
    },
    resetHoverRating() {
        this.hoverRating = 0;
    },
    async submitTestimonial() {
        if (this.name && this.review && this.rating > 0) {
            this.isSubmitting = true;
            
            try {
                // Ganti dengan route Laravel Anda
                const response = await fetch('{{ route('testimonial.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: this.name,
                        review: this.review,
                        rating: this.rating
                    })
                });

                if (response.ok) {
                    // Success
                    this.showModal = false;
                    this.name = '';
                    this.review = '';
                    this.rating = 0;
                    
                    // Show success message (bisa gunakan toaster library)
                    alert('Testimoni berhasil dikirim! Terima kasih atas feedback Anda.');
                } else {
                    throw new Error('Failed to submit testimonial');
                }
            } catch (error) {
                alert('Gagal mengirim testimoni. Silakan coba lagi.');
            } finally {
                this.isSubmitting = false;
            }
        } else {
            alert('Mohon lengkapi semua field!');
        }
    }
}">
    <!-- Floating Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button 
            @click="showModal = true"
            class="group bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white p-4 rounded-full shadow-2xl hover:shadow-red-500/25 transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-red-500/30"
        >
            <div class="flex items-center justify-center">
                <!-- Heart Icon -->
                <svg class="w-6 h-6 group-hover:animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            <!-- Tooltip -->
            <div class="absolute bottom-full right-0 mb-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                Berikan Testimoni
                <div class="absolute top-full right-4 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
        </button>
    </div>

    <!-- Modal Overlay -->
    <div 
        x-show="showModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        @click.self="showModal = false"
    >
        <!-- Modal Content -->
        <div 
            x-show="showModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden"
        >
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-500 to-pink-500 px-6 py-4 text-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold">Berikan Testimoni</h3>
                    </div>
                    <button 
                        @click="showModal = false"
                        class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors duration-200"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            @if (auth()->user()->is_testimonials())
                
            @endif
            <!-- Form Content -->
            <div class="p-6 space-y-6">
                @if (auth()->user()->is_testimonials())
                    <!-- Already Submitted State -->
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Kamu sudah membuat ulasan</h4>
                        <p class="text-gray-600 text-sm">Terima kasih atas feedback yang telah Anda berikan sebelumnya!</p>
                    </div>
                @else
                <!-- Form for New Testimonial -->
                    <!-- Name Input -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Nama Anda</label>
                        <input 
                            x-model="name"
                            type="text" 
                            placeholder="Masukkan nama Anda"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                            :disabled="isSubmitting"
                        >
                    </div>

                    <!-- Star Rating -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Rating</label>
                        <div class="flex items-center space-x-1">
                            <template x-for="star in 5" :key="star">
                                <button
                                    @click="setRating(star)"
                                    @mouseenter="setHoverRating(star)"
                                    @mouseleave="resetHoverRating()"
                                    class="focus:outline-none transition-all duration-200 transform hover:scale-110"
                                    :disabled="isSubmitting"
                                >
                                    <svg 
                                        class="w-8 h-8 transition-colors duration-200"
                                        :class="(hoverRating || rating) >= star ? 'text-red-500 drop-shadow-sm' : 'text-gray-300'"
                                        fill="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </button>
                            </template>
                            <span x-show="rating > 0" class="ml-2 text-sm text-gray-600" x-text="rating + ' dari 5 bintang'"></span>
                        </div>
                    </div>

                    <!-- Review Textarea -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Ulasan Anda</label>
                        <textarea 
                            x-model="review"
                            rows="4" 
                            placeholder="Ceritakan pengalaman Anda dengan layanan kami..."
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white resize-none"
                            :disabled="isSubmitting"
                        ></textarea>
                    </div>
                @endif
            </div>

            <!-- Footer Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                @if (auth()->user()->is_testimonials())
                    <!-- Only show view reviews button for users who already submitted -->
                    <div class="text-center">
                        <a href="{{ route('testimonials.index') }}" 
                        class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-red-500/25 transform hover:scale-105 group"
                        >
                            <svg class="w-4 h-4 mr-1.5 group-hover:transform group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat ulasan lainnya
                        </a>
                    </div>
                @else
                    <!-- Action Buttons for new testimonial -->
                    <div class="flex space-x-3 mb-3">
                        <button 
                            @click="showModal = false"
                            class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 transition-colors duration-200 font-medium"
                            :disabled="isSubmitting"
                        >
                            Batal
                        </button>
                        <button 
                            @click="submitTestimonial()"
                            class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-red-500/25 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                            :disabled="isSubmitting"
                        >
                            <span x-show="!isSubmitting">Kirim Testimoni</span>
                            <span x-show="isSubmitting" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Mengirim...
                            </span>
                        </button>
                    </div>
                    
                    <!-- View Other Reviews Link -->
                    <div class="text-center">
                        <a href="{{ route('testimonials.index') }}" 
                        class="inline-flex items-center text-sm text-red-600 hover:text-red-700 font-medium transition-colors duration-200 group"
                        >
                            <svg class="w-4 h-4 mr-1.5 group-hover:transform group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat ulasan lain
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
