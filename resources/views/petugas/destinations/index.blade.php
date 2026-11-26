@extends('layouts.petugas')

@section('title', 'Kelola Destinasi - Wisata Sulbar')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Tambah Destinasi -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200 h-fit">
        <h2 class="font-bold text-base text-slate-900 mb-3">Tambah Destinasi Baru</h2>

        @if($errors->any())
            <div class="mb-3 p-3 bg-red-50 text-red-700 text-xs rounded-xl">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('petugas.destinations.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="font-semibold block mb-1">Nama Destinasi</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 rounded-xl">
            </div>
            <div>
                <label class="font-semibold block mb-1">Kabupaten</label>
                <select name="regency" required class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                    @foreach($regencies as $reg)
                        <option value="{{ $reg }}">{{ $reg }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="font-semibold block mb-1">Harga Tiket (Rp)</label>
                    <input type="number" name="price" min="0" required class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>
                <div>
                    <label class="font-semibold block mb-1">Kuota Harian</label>
                    <input type="number" name="daily_quota" min="1" value="100" required class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>
            </div>
            <div>
                <label class="font-semibold block mb-1">Jam Operasional</label>
                <input type="text" name="open_hours" value="08:00 - 17:00 WITA" required class="w-full px-3 py-2 border border-slate-300 rounded-xl">
            </div>
            <div>
                <label class="font-semibold block mb-1">URL Foto (Opsional)</label>
                <input type="url" name="image" placeholder="https://..." class="w-full px-3 py-2 border border-slate-300 rounded-xl">
            </div>
            <div>
                <label class="font-semibold block mb-1">Deskripsi Singkat</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 border border-slate-300 rounded-xl"></textarea>
            </div>
            <button type="submit" class="w-full py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold rounded-xl">
                Simpan Destinasi
            </button>
        </form>
    </div>

    <!-- Daftar Destinasi -->
    <div class="lg:col-span-2 space-y-3">
        <h2 class="font-bold text-base text-slate-900">Daftar Destinasi Terdaftar</h2>
        @foreach($destinations as $item)
            <form action="{{ route('petugas.destinations.update', $item->id) }}" method="POST"
                  class="bg-white p-4 rounded-2xl border border-slate-200 space-y-3 text-xs">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <div>
                        <label class="text-slate-500 block">Nama</label>
                        <input type="text" name="name" value="{{ $item->name }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg font-semibold">
                    </div>
                    <div>
                        <label class="text-slate-500 block">Kabupaten</label>
                        <select name="regency" class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg">
                            @foreach($regencies as $reg)
                                <option value="{{ $reg }}" {{ $item->regency === $reg ? 'selected' : '' }}>{{ $reg }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-slate-500 block">Jam Buka</label>
                        <input type="text" name="open_hours" value="{{ $item->open_hours }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg">
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 items-end">
                    <div>
                        <label class="text-slate-500 block">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ $item->price }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg">
                    </div>
                    <div>
                        <label class="text-slate-500 block">Kuota/Hari</label>
                        <input type="number" name="daily_quota" value="{{ $item->daily_quota }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg">
                    </div>
                    <label class="flex items-center gap-2 py-2">
                        <input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}>
                        <span>Aktif Tampil</span>
                    </label>
                    <button type="submit" class="py-2 px-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-lg">
                        Update
                    </button>
                </div>
                <input type="hidden" name="description" value="{{ $item->description }}">
                <input type="hidden" name="image" value="{{ $item->image }}">
            </form>
        @endforeach
    </div>
</div>
@endsection
