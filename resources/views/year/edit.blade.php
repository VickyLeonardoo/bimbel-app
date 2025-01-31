<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8 py-12">
        {{-- <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-lg p-8"> --}}
        <div class="mx-auto bg-white shadow-xl rounded-lg p-8">
            <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center">Edit Registration Year</h2>

            <form action="{{ route('year.update',$year) }}" method="POST" class="space-y-6">
                @method('PUT')
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name"
                            class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            type="text" name="name" value="{{ $year->name }}" placeholder="Enter course name" required
                            autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="reg_start_date" :value="__('Registration Start Date')" />
                        <x-text-input id="reg_start_date" class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" type="date" name="reg_start_date" value="{{ old('reg_start_date', $year->reg_start_date ? \Carbon\Carbon::parse($year->reg_start_date)->format('Y-m-d') : '') }}" placeholder="Enter registration start date" required autofocus autocomplete="reg_start_date" />
                        <x-input-error :messages="$errors->get('reg_start_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="reg_end_date" :value="__('Registration End Date')" />
                        <x-text-input id="reg_end_date" class="block mt-1 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" type="date" name="reg_end_date" value="{{ old('reg_start_date', $year->reg_start_date ? \Carbon\Carbon::parse($year->reg_end_date)->format('Y-m-d') : '') }}" placeholder="Enter registration start date" required autofocus autocomplete="reg_end_date" />
                        <x-input-error :messages="$errors->get('reg_end_date')" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('year.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
