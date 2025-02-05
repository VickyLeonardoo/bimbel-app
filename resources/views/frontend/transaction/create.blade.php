<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        
        <div class="py-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="py-3 w-full bg-red-500 text-white font-bold mb-3">
                        <p class="ml-3">{{$error}}</p>
                    </div>
                @endforeach
            @endif
            @if(session('error'))
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
                                            Gagal!
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
            <div class="mb-6">
                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pendaftaran Baru</h4>
                <p class="mt-1 text-sm text-gray-600">Silakan isi form pendaftaran di bawah ini</p>
            </div>

            <!-- Main Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('client.transaction.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <!-- Academic Year & Child Selection Section -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-md">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Informasi Pendaftaran</h3>
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <!-- Academic Year Selection -->
                                    <div>
                                        <x-input-label for="type" :value="__('Tahun Ajaran')" />
                                        <select data-hs-select='{
                                            "placeholder": "Select option...",
                                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                            }' class="hidden" name="year_id">
                                            <option value="">Choose</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}" {{ old('year_id') == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                                            @endforeach
                                            </select>
                                        <x-input-error :messages="$errors->get('year_id')" class="mt-2" />
                                    </div>
                                    

                                    <!-- Child Selection -->
                                    <div>
                                        <x-input-label for="child_id" :value="__('Child')" />
                                        <select multiple=""
                                            data-hs-select='{
                                            "placeholder": "Select course options...",
                                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500",
                                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100",
                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                            }'
                                            class="hidden" name="child_id[]">
                                            <option value="">Choose</option>
                                            @foreach (auth()->user()->childs as $child)
                                            <option value="{{ $child->id }}" 
                                                {{ collect(old('child_id', []))->contains($child->id) ? 'selected' : '' }}>
                                                {{ $child->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('child_id')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Selection Section -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-md">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Pilihan Mata Pelajaran</h3>
                                <p class="text-sm text-gray-500 mb-4">Pilih mata pelajaran yang ingin Anda ikuti</p>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Course Card 1 -->
                                    @foreach ($courses as $course)
                                    <div class="relative border rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input type="checkbox" name="courses[]" value="{{ $course->id }}" 
                                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <label class="font-medium text-gray-700">{{ $course->name }}</label>
                                                <p class="text-sm text-gray-500">Rp. {{ number_format($course->price) }}</p>
                                                <span class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Tersedia
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('courses')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Payment & Promo Section -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-md">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Informasi Pembayaran</h3>
                                
                                <!-- Promo Code Section -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Promo</label>
                                    <div class="flex space-x-2">
                                        <input type="text" name="promo_code" placeholder="Masukkan kode promo (biarkan kosong jika tidak memiliki kode promo)" 
                                            class="flex-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <button id="apply-promo" type="button" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Terapkan
                                        </button>
                                    </div>
                                    <!-- Dummy Applied Promo -->
                                    <div class="mt-2 p-3 bg-green-50 rounded-md hidden" id="applied-promo">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-green-800">Kode promo berhasil diterapkan!</h3>
                                                <div class="mt-2 text-sm text-green-700">
                                                    <p>Anda mendapatkan potongan 10% untuk pendaftaran ini.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('client.transaction.index') }}" 
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('apply-promo').addEventListener('click', function (e) {
                e.preventDefault();
                
                let promoCode = document.querySelector("input[name='promo_code']").value;
                let promoSection = document.getElementById('applied-promo');
                let messageBox = promoSection.querySelector('.text-green-700');
    
                fetch("{{ route('check-promo') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ promo_code: promoCode })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        promoSection.classList.remove('hidden');
                        messageBox.innerHTML = `<p>${data.message} Diskon: <strong>${data.discount}</strong></p>`;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    </script>
</x-app-layout>