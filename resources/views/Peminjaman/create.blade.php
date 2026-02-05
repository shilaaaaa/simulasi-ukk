<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-2xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Peminjaman
        </h1>

        <a href="{{ route('peminjaman.index') }}"
           class="text-sm text-gray-600 hover:underline">
            ← Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Barang -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Barang
                </label>
                <select name="id_inventaris" required
                        class="w-full rounded-md border-gray-300
                               focus:border-purple-500 focus:ring-purple-500">
                    <option value="">-- pilih barang --</option>
                    @foreach ($inventaris as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->stok < 1 ? 'disabled' : '' }}>
                            {{ $item->id_unique }} - {{ $item->nama_barang }}
                            (Stok: {{ $item->stok }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Peminjam -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Peminjam
                </label>
                <input type="text" name="nama_peminjam" required
                       class="w-full rounded-md border-gray-300
                              focus:border-purple-500 focus:ring-purple-500">
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Pinjam
                    </label>
                    <input type="date" name="tgl_pinjam" required
                           class="w-full rounded-md border-gray-300
                                  focus:border-purple-500 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Kembali
                    </label>
                    <input type="date" name="tgl_kembali" required
                           class="w-full rounded-md border-gray-300
                                  focus:border-purple-500 focus:ring-purple-500">
                </div>
            </div>

            <!-- Petugas -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Petugas
                </label>
                <input type="text" name="petugas" required
                       class="w-full rounded-md border-gray-300
                              focus:border-purple-500 focus:ring-purple-500">
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <select name="status" required
                        class="w-full rounded-md border-gray-300
                               focus:border-purple-500 focus:ring-purple-500">
                    <option value="proses">Proses</option>
                    <option value="belum kembali">Belum Kembali</option>
                    <option value="kembali">Kembali</option>
                </select>
            </div>

            <!-- Action -->
            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('peminjaman.index') }}"
                   class="px-4 py-2 rounded-md border border-gray-300
                          text-gray-600 hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700
                               text-white px-6 py-2 rounded-md font-semibold">
                    Simpan
                </button>
            </div>

        </form>
    </div>

</div>
