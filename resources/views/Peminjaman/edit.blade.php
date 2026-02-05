<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-2xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">
            Edit Peminjaman
        </h1>

        <a href="{{ route('peminjaman.index') }}"
           class="text-sm text-gray-600 hover:underline">
            ← Kembali
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('peminjaman.update', $item->id) }}"
              method="POST"
              class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Barang -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Barang
                </label>
                <select name="id_inventaris" required
                        class="w-full rounded-md border-gray-300
                               focus:border-purple-500 focus:ring-purple-500">
                    @foreach ($inventaris as $inv)
                        <option value="{{ $inv->id }}"
                            {{ $item->id_inventaris == $inv->id ? 'selected' : '' }}>
                            {{ $inv->id_unique }} - {{ $inv->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Peminjam -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Peminjam
                </label>
                <input type="text"
                       name="nama_peminjam"
                       value="{{ $item->nama_peminjam }}"
                       required
                       class="w-full rounded-md border-gray-300
                              focus:border-purple-500 focus:ring-purple-500">
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Pinjam
                    </label>
                    <input type="date"
                           name="tgl_pinjam"
                           value="{{ $item->tgl_pinjam }}"
                           required
                           class="w-full rounded-md border-gray-300
                                  focus:border-purple-500 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Kembali
                    </label>
                    <input type="date"
                           name="tgl_kembali"
                           value="{{ $item->tgl_kembali }}"
                           required
                           class="w-full rounded-md border-gray-300
                                  focus:border-purple-500 focus:ring-purple-500">
                </div>
            </div>

            <!-- Petugas -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Petugas
                </label>
                <input type="text"
                       name="petugas"
                       value="{{ $item->petugas }}"
                       required
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
                    <option value="proses"
                        {{ $item->status == 'proses' ? 'selected' : '' }}>
                        Proses
                    </option>
                    <option value="belum kembali"
                        {{ $item->status == 'belum kembali' ? 'selected' : '' }}>
                        Belum Kembali
                    </option>
                    <option value="kembali"
                        {{ $item->status == 'kembali' ? 'selected' : '' }}>
                        Kembali
                    </option>
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
                    Update
                </button>
            </div>

        </form>
    </div>

</div>
