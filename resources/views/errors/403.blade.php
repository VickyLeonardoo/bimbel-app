<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="min-h-[80vh] py-8 flex items-center justify-center">
            <div class="max-w-2xl w-full">
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 left-0 w-full h-full opacity-5">
                        <div class="absolute transform rotate-45 -left-1/4 -top-1/4 w-1/2 h-1/2 bg-blue-500"></div>
                        <div class="absolute transform rotate-45 -right-1/4 -bottom-1/4 w-1/2 h-1/2 bg-blue-500"></div>
                    </div>
                    
                    <!-- Content -->
                    <div class="relative">
                        <!-- Error Code -->
                        <div class="flex items-center justify-center mb-8">
                            <h1 class="text-8xl font-bold text-blue-600 animate-number">403</h1>
                        </div>
                        
                        <!-- Error Message -->
                        <div class="text-center">
                            <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">Access Forbidden</h2>
                            <p class="text-gray-600 mb-8">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button onclick="window.history.back()" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Kembali
                                </button>
                                <a href="/" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>