@extends('admin.layout')

@section('title', 'Edit Booking | Admin')

@section('titleNav', 'Edit Booking')

@section('css')
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2>Manajemen Paket</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="{{ route('admin.booking') }}">Booking</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Manajemen Paket</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('menu')
    <li>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-th-large"></i>
            <span class="nav-label">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.kalender') }}"><i class="fa fa-calendar"></i>
            <span class="nav-label">Kalender</span></a>
    </li>
    <li>
        <a href="{{ route('admin.booking') }}"><i class="fa fa-users"></i>
            <span class="nav-label">Booking</span></a>
    </li>
    <li>
        <a href="{{ route('admin.laporan') }}"><i class="fa fa-book"></i>
            <span class="nav-label">Laporan</span></a>
    </li>
    <li class="text-white px-4 mt-3">
        <h4>Manajemen Paket</h4>
    </li>
    <li class="active">
        <a href="{{ route('admin.paket.index') }}"><i class="fa fa-bar-chart-o"></i>
            <span class="nav-label">Paket</span></a>
    </li>
@endsection

@section('content')
    {{-- <form method="POST" action="{{ route('admin.bookingUpdate', ['id' => $data->id]) }}">
        @csrf --}}

    <div class="row mt-3">
        <div class="col-12">
            @foreach ($pakets as $judul => $items)
                <div class="ibox mb-4">
                    <div class="ibox-title d-flex justify-content-between align-items-center bg-primary text-white">
                        <h5 class="mb-0">{{ $judul }}</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="row px-3">
                            @foreach ($items as $item)
                                <div class="col-xl-3 px-2">
                                    <div class="ibox">
                                        <div class="ibox-title bg-info text-white">
                                            <h4>{{ $item->nama }}</h4>
                                        </div>

                                        <div class="ibox-content border">
                                            <form
                                                action="{{ route('admin.paket.update', ['model' => strtolower(str_replace(' ', '_', $judul)), 'id' => $item->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <!-- Deskripsi -->
                                                <div class="form-group mb-2">
                                                    <label class="form-label mb-1 font-weight-bold">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="3" data-original="{{ $item->deskripsi }}">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                                                </div>

                                                <!-- Harga -->
                                                @if ($judul === 'Paket Kesenian')
                                                    <div class="form-group mb-2">
                                                        <label class="form-label mb-1 font-weight-bold">Harga
                                                            Belajar</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rp.</span>
                                                            <input type="text" name="harga_belajar" class="form-control"
                                                                value="{{ number_format($item->harga_belajar, 0, ',', '.') }}"
                                                                data-original="{{ number_format($item->harga_belajar, 0, ',', '.') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label class="form-label mb-1 font-weight-bold">Harga
                                                            Pementasan</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rp.</span>
                                                            <input type="text" name="harga_pementasan"
                                                                class="form-control"
                                                                value="{{ number_format($item->harga_pementasan, 0, ',', '.') }}"
                                                                data-original="{{ number_format($item->harga_pementasan, 0, ',', '.') }}">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="form-group mb-2">
                                                        <label class="form-label mb-1 font-weight-bold">Harga</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rp.</span>
                                                            <input type="text" name="harga" class="form-control"
                                                                value="{{ number_format($item->harga ?? 0, 0, ',', '.') }}"
                                                                data-original="{{ number_format($item->harga ?? 0, 0, ',', '.') }}">
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Gambar -->
                                                <div class="form-group mb-2">
                                                    <label class="form-label mb-1 font-weight-bold">Gambar</label>

                                                    @if (!empty($item->gambar))
                                                        <div class="mb-2">
                                                            <img src="{{ asset('storage/' . strtolower(str_replace(' ', '_', $judul)) . '/' . $item->gambar) }}"
                                                                alt="Gambar" class="img-thumbnail"
                                                                style="max-width: 150px;">
                                                        </div>
                                                    @endif

                                                    <input type="file" name="gambar" class="form-control"
                                                        accept="image/*">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="ibox-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-success font-weight-bold btn-save"
                            data-section="{{ strtolower(str_replace(' ', '_', $judul)) }}">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- </form> --}}

@endsection

@section('menuHp')
    <div class="col text-center ">
        <a href="{{ route('admin.dashboard') }}" class="text-secondary">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
        </a>
    </div>
    <div class="col text-center border-end">
        <a href="{{ route('admin.kalender') }}" class="text-secondary">
            <p><i class="fa-regular fa-calendar-days m-0 p-0 pt-2"></i></p>
            <p>Kalender</p>
        </a>
    </div>
    <div class="col text-center">
        <a href="{{ route('admin.booking') }}" class="text-secondary">
            <p><i class="fa-solid fa-house-lock m-0 p-0 pt-2"></i></p>
            <p>Booking</p>
        </a>
    </div>
    <div class="col text-center ">
        <a href="{{ route('admin.laporan') }}" class="text-secondary">
            <p><i class="fa-solid fa-file-lines m-0 p-0 pt-2"></i></p>
            <p>Laporan</p>
        </a>
    </div>
    <div class="col text-center rounded-top bg-secondary">
        <a href="{{ route('admin.paket.index') }}" class="text-white">
            <p><i class="fa fa-bar-chart-o m-0 p-0 pt-2"></i></p>
            <p>Paket</p>
        </a>
    </div>
@endsection

@section('scripts')
    <!-- Script Format Angka -->
    <script>
        const hargaInput = document.getElementById('harga');

        hargaInput.addEventListener('input', function(e) {
            // Hapus semua karakter non-angka
            let value = e.target.value.replace(/\D/g, '');

            // Format ke ribuan (misal 75000 -> 75.000)
            if (value) {
                value = new Intl.NumberFormat('id-ID').format(value);
            }

            e.target.value = value;
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simpan nilai awal biar bisa dibandingkan nanti
            document.querySelectorAll('input, textarea').forEach(input => {
                if (!input.dataset.original && input.type !== 'file') {
                    input.dataset.original = input.value ?? '';
                }
            });

            document.querySelectorAll('.btn-save').forEach(button => {
                button.addEventListener('click', async function() {
                    const section = this.dataset.section;
                    const forms = document.querySelectorAll(`form[action*="${section}"]`);
                    let updatedCount = 0;

                    // 🔹 Ubah tombol jadi loading
                    const originalText = this.innerHTML;
                    this.disabled = true;
                    this.innerHTML = `<i class="fa fa-spinner fa-spin mr-2"></i> Menyimpan...`;

                    for (const form of forms) {
                        const inputs = form.querySelectorAll('input, textarea');
                        let hasChange = false;
                        const normalize = str => str.replace(/[.,\s]/g, '').trim();

                        inputs.forEach(input => {
                            // 🔹 Kalau file input, cek apakah user pilih file baru
                            if (input.type === 'file') {
                                if (input.files && input.files.length > 0) {
                                    hasChange = true;
                                }
                                return;
                            }

                            // 🔹 Untuk teks, bandingkan dengan data-original
                            const original = input.dataset.original ?? '';
                            const current = input.value ?? '';
                            if (normalize(original) !== normalize(current)) {
                                hasChange = true;
                            }
                        });

                        if (!hasChange) continue; // skip kalau tidak ada perubahan

                        updatedCount++;

                        const formData = new FormData(form);

                        try {
                            const response = await fetch(form.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });

                            const text = await response.text();
                            try {
                                const data = JSON.parse(text);
                                if (data.success) {
                                    console.log('✅ ' + data.message);
                                } else {
                                    console.error('❌ Gagal:', data);
                                }
                            } catch (err) {
                                console.error('Respons bukan JSON:', text);
                            }
                        } catch (error) {
                            console.error('❌ Error fetch:', error);
                        }
                    }

                    // 🔹 Kembalikan tombol seperti semula
                    this.disabled = false;
                    this.innerHTML = originalText;

                    if (updatedCount === 0) {
                        alert('⚠️ Tidak ada perubahan pada data apa pun.');
                    } else {
                        alert(`✅ Berhasil menyimpan ${updatedCount} data yang diperbarui.`);
                    }
                });
            });
        });
    </script>

@endsection
