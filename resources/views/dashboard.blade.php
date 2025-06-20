<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center space-x-4">
                <div class="text-sm text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded-lg">
                    <i class="fas fa-clock mr-1"></i>
                    {{ now()->format('d M Y, H:i') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
                <div class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 rounded-3xl p-8 text-white shadow-2xl overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute -top-4 -right-4 w-24 h-24 border-4 border-white rounded-full"></div>
                        <div class="absolute top-8 right-8 w-16 h-16 border-2 border-white rounded-full"></div>
                        <div class="absolute bottom-4 right-12 w-8 h-8 bg-white rounded-full"></div>
                    </div>
                    
                    <div class="relative flex items-center justify-between">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-3xl font-bold">Welcome Back, {{ auth()->user()->name }}!</h3>
                                <span class="text-2xl">👋</span>
                            </div>
                            <p class="text-indigo-100 text-lg">Ready to make today productive and amazing?</p>
                        </div>
                        <div class="hidden lg:block">
                            <div class="w-32 h-32 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Enhanced Welcome Section -->

            <!-- Enhanced Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Students Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-600 transform hover:-translate-y-1">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-300 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-green-500 font-semibold flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    +12%
                                </div>
                            </div>
                        </div>
                        <h4 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            {{ number_format($student_count) }}
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">Total Students</p>
                        <div class="mt-4 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full w-3/4 transition-all duration-1000"></div>
                        </div>
                    </div>
                </div>

                <!-- Instructors Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-700 hover:border-purple-200 dark:hover:border-purple-600 transform hover:-translate-y-1">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="p-4 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl group-hover:from-purple-600 group-hover:to-purple-700 transition-all duration-300 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                            </div>
                        </div>
                        <h4 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            {{ number_format($instructor_count) }}
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">Active Instructors</p>
                        <div class="mt-4 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600 rounded-full w-2/3 transition-all duration-1000"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Applications Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-700 hover:border-yellow-200 dark:hover:border-yellow-600 transform hover:-translate-y-1">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="p-4 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl group-hover:from-yellow-600 group-hover:to-orange-600 transition-all duration-300 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                
                            </div>
                        </div>
                        <h4 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors">
                            {{ number_format($application_count) }}
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">New Applications</p>
                        <div class="mt-4 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full w-4/5 transition-all duration-1000"></div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-700 hover:border-green-200 dark:hover:border-green-600 transform hover:-translate-y-1">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="p-4 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl group-hover:from-green-600 group-hover:to-emerald-600 transition-all duration-300 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                @php
                                    $isUp = $revenue_change >= 0;
                                @endphp

                                <div class="text-xs {{ $isUp ? 'text-green-500' : 'text-red-500' }} font-semibold flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        @if ($isUp)
                                            <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        @else
                                            <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 15.586V3a1 1 0 112 0v12.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        @endif
                                    </svg>
                                    {{ $isUp ? '+' : '-' }}{{ number_format(abs($revenue_change), 2) }}%
                                </div>
                            </div>
                        </div>
                        <h4 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                            Rp {{ number_format($revenue) }}
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">Total Revenue</p>
                        <div class="mt-4 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full w-5/6 transition-all duration-1000"></div>
                        </div>
                    </div>
                </div>
            </div>

            @role('Admin')
            <!-- Enhanced Recent Applications -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                <div class="p-8 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Recent Applications</h3>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                {{ count($recent_transactions) }} Active
                            </span>
                            <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="space-y-6" id="applications-list">
                        @forelse ($recent_transactions as $index => $transaction)
                        <div class="application-item {{ $index >= 5 ? 'hidden' : '' }} flex items-center space-x-4 p-4 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 group border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                    </svg>
                                </div>
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $transaction->user->name }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Applied for <span class="font-medium text-indigo-600 dark:text-indigo-400">Programming Course</span>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($transaction->updated_at)->diffForHumans() }}
                                        </p>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                                Pending
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('transaction.show',$transaction)}}" class="p-2 text-indigo-600 hover:bg-indigo-100 dark:hover:bg-indigo-900 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Applications Yet</h3>
                            <p class="text-gray-500 dark:text-gray-400">New applications will appear here when students apply for courses.</p>
                        </div>
                        @endforelse
                    </div>
                    
                    @if(count($recent_transactions) > 5)
                    <div class="mt-8 text-center">
                        <button id="show-more-btn" onclick="toggleApplications()" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <span id="btn-text">Show More Applications</span>
                            <svg id="btn-icon" class="w-5 h-5 ml-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                    @endif
                    
                    @if(count($recent_transactions) > 0)
                    <div class="mt-8 flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('transaction.index') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition-colors">
                            View All Applications
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Showing {{ min(5, count($recent_transactions)) }} of {{ count($recent_transactions) }} applications
                        </div>
                    </div>
                    @endif
                </div>
                @endrole
            </div>
        </div>
    </div>

    <script>
        function toggleApplications() {
            const hiddenItems = document.querySelectorAll('.application-item.hidden');
            const btn = document.getElementById('show-more-btn');
            const btnText = document.getElementById('btn-text');
            const btnIcon = document.getElementById('btn-icon');
            
            if (hiddenItems.length > 0) {
                // Show hidden items
                hiddenItems.forEach(item => {
                    item.classList.remove('hidden');
                    item.style.animation = 'fadeInUp 0.5s ease-out forwards';
                });
                btnText.textContent = 'Show Less';
                btnIcon.style.transform = 'rotate(180deg)';
            } else {
                // Hide items beyond first 5
                const allItems = document.querySelectorAll('.application-item');
                for (let i = 5; i < allItems.length; i++) {
                    allItems[i].classList.add('hidden');
                }
                btnText.textContent = 'Show More Applications';
                btnIcon.style.transform = 'rotate(0deg)';
            }
        }

        // Add CSS animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>