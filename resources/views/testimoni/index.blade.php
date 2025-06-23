<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Testimoni</h1>
                        <p class="mt-2 text-gray-600">Kelola dan moderasi testimoni pelanggan</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                        <!-- Toggle Filter Button -->
                        <div class="flex items-center bg-white rounded-lg border border-gray-200 p-1">
                            <button id="showPublic" class="px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 bg-red-500 text-white">
                                Tampil ({{ $publicCount }})
                            </button>
                            <button id="showHidden" class="px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900">
                                Tersembunyi ({{ $hiddenCount }})
                            </button>
                            <button id="showAll" class="px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900">
                                Semua ({{ $totalCount }})
                            </button>
                        </div>
                        
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            {{ $testimonials->total() }} Total
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-50 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ number_format($averageRating, 1) }}</h3>
                            <p class="text-sm text-gray-600">Rating Rata-rata</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-50 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $publicCount }}</h3>
                            <p class="text-sm text-gray-600">Ditampilkan</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-50 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m-3.122-3.122l4.242 4.242M21 3l-6.878 6.878"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $hiddenCount }}</h3>
                            <p class="text-sm text-gray-600">Disembunyikan</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $fiveStarPercentage }}%</h3>
                            <p class="text-sm text-gray-600">Rating 5 Bintang</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div id="loading" class="hidden">
                <div class="flex justify-center items-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-500"></div>
                </div>
            </div>

            <!-- Testimonials Grid -->
            <div id="testimonialsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($testimonials as $testimonial)
                    <div class="testimonial-card bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 {{ $testimonial->is_public ? 'border-l-4 border-l-green-500' : 'border-l-4 border-l-red-500 opacity-75' }}" 
                         data-public="{{ $testimonial->is_public ? 'true' : 'false' }}"
                         data-id="{{ $testimonial->id }}">
                        
                        <!-- Status Badge -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                @if($testimonial->is_public)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Tampil
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12"/>
                                        </svg>
                                        Tersembunyi
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Action Button -->
                            <button onclick="toggleVisibility({{ $testimonial->id }}, {{ $testimonial->is_public ? 'false' : 'true' }})" 
                                    class="toggle-btn inline-flex items-center px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200 {{ $testimonial->is_public ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                @if($testimonial->is_public)
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12"/>
                                    </svg>
                                    Sembunyikan
                                @else
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Tampilkan
                                @endif
                            </button>
                        </div>

                        <!-- Rating Stars -->
                        <div class="flex items-center mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-red-500' : 'text-gray-300' }}" 
                                     fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">{{ $testimonial->rating }}/5</span>
                        </div>

                        <!-- Review Text -->
                        <p class="text-gray-700 mb-4 leading-relaxed">{{ $testimonial->review }}</p>

                        <!-- Author Info -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $testimonial->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-400">
                                ID: {{ $testimonial->id }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada testimoni</h3>
                        <p class="text-gray-600">Belum ada testimoni yang tersedia</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($testimonials->hasPages())
                <div class="mt-8">
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4 max-w-sm">
            <div class="flex items-center">
                <div id="toastIcon" class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center">
                    <!-- Icon will be inserted here -->
                </div>
                <div class="ml-3">
                    <p id="toastMessage" class="text-sm font-medium text-gray-900"></p>
                </div>
                <button onclick="hideToast()" class="ml-4 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const showPublicBtn = document.getElementById('showPublic');
            const showHiddenBtn = document.getElementById('showHidden');
            const showAllBtn = document.getElementById('showAll');
            const testimonialCards = document.querySelectorAll('.testimonial-card');

            function setActiveButton(activeBtn) {
                [showPublicBtn, showHiddenBtn, showAllBtn].forEach(btn => {
                    btn.classList.remove('bg-red-500', 'text-white');
                    btn.classList.add('text-gray-600', 'hover:text-gray-900');
                });
                activeBtn.classList.add('bg-red-500', 'text-white');
                activeBtn.classList.remove('text-gray-600', 'hover:text-gray-900');
            }

            function filterTestimonials(filter) {
                testimonialCards.forEach(card => {
                    const isPublic = card.dataset.public === 'true';
                    let shouldShow = false;

                    switch(filter) {
                        case 'public':
                            shouldShow = isPublic;
                            break;
                        case 'hidden':
                            shouldShow = !isPublic;
                            break;
                        case 'all':
                            shouldShow = true;
                            break;
                    }

                    if (shouldShow) {
                        card.style.display = 'block';
                        card.classList.remove('hidden');
                    } else {
                        card.style.display = 'none';
                        card.classList.add('hidden');
                    }
                });
            }

            showPublicBtn.addEventListener('click', () => {
                setActiveButton(showPublicBtn);
                filterTestimonials('public');
            });

            showHiddenBtn.addEventListener('click', () => {
                setActiveButton(showHiddenBtn);
                filterTestimonials('hidden');
            });

            showAllBtn.addEventListener('click', () => {
                setActiveButton(showAllBtn);
                filterTestimonials('all');
            });
        });

        // Toggle visibility function
        async function toggleVisibility(testimonialId, newStatus) {
            const card = document.querySelector(`[data-id="${testimonialId}"]`);
            const button = card.querySelector('.toggle-btn');
            
            // Show loading state
            button.disabled = true;
            button.innerHTML = '<svg class="animate-spin w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>Memproses...';

            try {
                const response = await fetch(`/testimonials/${testimonialId}/toggle-visibility`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        is_public: newStatus
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Update the card UI
                    updateCardUI(card, newStatus);
                    showToast('success', data.message);
                    
                    // Update counters if needed
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('error', 'Terjadi kesalahan saat memperbarui status');
                
                // Reset button
                updateButtonUI(button, !newStatus);
            }
        }

        function updateCardUI(card, isPublic) {
            const badge = card.querySelector('span');
            const button = card.querySelector('.toggle-btn');
            
            // Update data attribute
            card.dataset.public = isPublic.toString();
            
            // Update border color
            if (isPublic) {
                card.classList.remove('border-l-red-500', 'opacity-75');
                card.classList.add('border-l-green-500');
            } else {
                card.classList.remove('border-l-green-500');
                card.classList.add('border-l-red-500', 'opacity-75');
            }
            
            // Update badge
            if (isPublic) {
                badge.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800';
                badge.innerHTML = '<svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>Tampil';
            } else {
                badge.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800';
                badge.innerHTML = '<svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12"/></svg>Tersembunyi';
            }
            
            // Update button
            updateButtonUI(button, isPublic);
        }

        function updateButtonUI(button, isPublic) {
            button.disabled = false;
            
            if (isPublic) {
                button.className = 'toggle-btn inline-flex items-center px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200 bg-red-100 text-red-700 hover:bg-red-200';
                button.innerHTML = '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12"/></svg>Sembunyikan';
                button.onclick = () => toggleVisibility(button.closest('[data-id]').dataset.id, false);
            } else {
                button.className = 'toggle-btn inline-flex items-center px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200 bg-green-100 text-green-700 hover:bg-green-200';
                button.innerHTML = '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>Tampilkan';
                button.onclick = () => toggleVisibility(button.closest('[data-id]').dataset.id, true);
            }
        }

        // Toast notification functions
        function showToast(type, message) {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toastIcon');
            const toastMessage = document.getElementById('toastMessage');

            if (type === 'success') {
                toastIcon.className = 'flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center bg-green-100';
                toastIcon.innerHTML = '<svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            } else {
                toastIcon.className = 'flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center bg-red-100';
                toastIcon.innerHTML = '<svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>';
            }

            toastMessage.textContent = message;
            toast.classList.remove('hidden');

            setTimeout(() => {
                hideToast();
            }, 5000);
        }

        function hideToast() {
            document.getElementById('toast').classList.add('hidden');
        }
    </script>
</x-app-layout>