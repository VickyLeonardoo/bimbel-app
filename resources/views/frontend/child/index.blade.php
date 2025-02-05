<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            @if(session('success'))
                <div id="success-alert" class="relative mb-6">
                    <div class="p-4 rounded-lg bg-green-50 border border-green-200 shadow-sm">
                        <div class="flex items-center gap-4">
                            <!-- Success Icon -->
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            
                            <!-- Alert Content -->
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-green-800">
                                            Berhasil!
                                        </p>
                                        <p class="mt-1 text-sm text-green-700">
                                            {{ session('success') }}
                                        </p>
                                    </div>
                                    <!-- Close Button -->
                                    <button type="button" onclick="closeAlert()" class="self-center p-1.5 hover:bg-green-100 rounded-full transition-colors duration-200">
                                        <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Data Anak</h2>
                    <p class="mt-2 text-gray-600">Kelola data anak untuk pendaftaran bimbel</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('client.children.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Anak
                    </a>
                </div>
            </div>

            <!-- Search & Filter Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <form action="{{ route('client.children.index') }}" method="GET">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" 
                                       name="search" 
                                       placeholder="Cari nama anak..." 
                                       value="{{ request('search') }}"
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <!-- Icon search tetap sama -->
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <select name="age_range" 
                                    class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Umur</option>
                                <option value="5-10" {{ request('age_range') == '5-10' ? 'selected' : '' }}>5-10 tahun</option>
                                <option value="11-15" {{ request('age_range') == '11-15' ? 'selected' : '' }}>11-15 tahun</option>
                                <option value="16-18" {{ request('age_range') == '16-18' ? 'selected' : '' }}>16-18 tahun</option>
                            </select>
                            <button type="submit" 
                                    class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-150 ease-in-out">
                                Filter
                            </button>
                            <!-- Reset Filter -->
                            <a href="{{ route('client.children.index') }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Responsive Table Section -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <!-- Desktop Table View -->
                    <table class="min-w-full divide-y divide-gray-200 hidden md:table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Nama</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Umur</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Sekolah</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Kelas</th>
                                <th class="px-6 py-4 text-right text-sm font-medium text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($childrens as $child)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <span class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-blue-600 font-medium text-sm">
                                                    {{ Str::of($child->name)->explode(' ')->map(fn($word) => Str::substr($word, 0, 1))->join('') }}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $child->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $child->gender }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($child->birthdate)->age }} tahun
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $child->school }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $child->grade }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('client.children.edit',$child) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('client.children.destroy',$child) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                        </form>
                                        {{-- <a href="#" class="text-red-600 hover:text-red-900">Hapus</a> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Mobile Card View -->
                    <div class="md:hidden">
                        @foreach ($childrens as $child)
                        <div class="divide-y divide-gray-200">
                            <div class="p-4 hover:bg-gray-50">
                                <div class="flex items-center mb-3">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <span class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-blue-600 font-medium text-sm">{{ Str::of($child->name)->explode(' ')->map(fn($word) => Str::substr($word, 0, 1))->join('') }}</span>
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $child->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $child->gender }}</div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Umur</span>
                                        <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($child->birthdate)->age }} tahun</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Sekolah</span>
                                        <span class="text-sm text-gray-900">{{ $child->school }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Kelas</span>
                                        <span class="text-sm text-gray-900">{{ $child->grade }}</span>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end space-x-3">
                                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <form action="{{ route('client.children.destroy',$child) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>

            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $childrens->links() }}
            </div>
        </div>
    </div>
</x-app-layout>