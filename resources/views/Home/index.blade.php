<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-800">
            Data Inventaris
        </h1>

        <!-- Search -->
        <form action="{{ route('home.index') }}" method="GET" class="flex gap-2">
            <input type="text"
                   name="search"
                   placeholder="Cari nama barang..."
                   value="{{ $keyword ?? '' }}"
                   class="w-64 rounded-md border-gray-300
                          focus:border-purple-500 focus:ring-purple-500">

            <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700
                           text-white px-4 py-2 rounded-md font-semibold">
                Cari
            </button>

            @if(!empty($keyword))
                <a href="{{ route('home.index') }}"
                   class="px-4 py-2 rounded-md border border-gray-300
                          text-gray-600 hover:bg-gray-100">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">ID Inventaris</th>
                    <th class="px-4 py-3 text-left">Nama Barang</th>
                    <th class="px-4 py-3 text-left">Kondisi</th>
                    <th class="px-4 py-3 text-left">Stok</th>
                    <th class="px-4 py-3 text-left">Tgl Register</th>
                    <th class="px-4 py-3 text-center">Foto</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($inventaris as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 font-medium">
                            {{ $item->id_unique }}
                        </td>

                        <td class="px-4 py-2">
                            {{ $item->nama_barang }}
                        </td>

                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                {{ $item->kondisi == 'Baik'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $item->kondisi }}
                            </span>
                        </td>

                        <td class="px-4 py-2">
                            {{ $item->stok }}
                        </td>

                        <td class="px-4 py-2">
                            {{ $item->tgl_register }}
                        </td>

                        <td class="px-4 py-2 text-center">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     class="w-20 h-20 object-cover rounded-md mx-auto border">
                            @else
                                <span class="text-gray-400 italic text-xs">
                                    Tidak ada foto
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="text-center py-8 text-gray-500">
                            Data inventaris belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
