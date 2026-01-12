<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Denda Keterlambatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('admin.penalty.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nominal Denda (Rp)</label>
                            <input type="number" name="nominal_denda" value="{{ $setting->nominal_denda }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Tipe Denda</label>
                            <select name="tipe_denda" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="flat" {{ $setting->tipe_denda == 'flat' ? 'selected' : '' }}>Flat (Per Hari)</option>
                                <option value="persentase" {{ $setting->tipe_denda == 'persentase' ? 'selected' : '' }}>Persentase (%)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Masa Tenggang (Hari)</label>
                            <input type="number" name="masa_tenggang" value="{{ $setting->masa_tenggang }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-600">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>