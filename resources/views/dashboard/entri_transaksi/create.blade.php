@extends( 'template.main' )

@section( 'main' )
<!---------------- Main Section ---------------->
<div class="pagetitle">
    <h1>Transaksi Pembayaran</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">History & Pembayaran</li>
            <li class="breadcrumb-item">Transaksi Pembayaran</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<a href="/pembayaran" class="btn btn-warning mb-3">Kembali</a>

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title p-0 mb-0">Transaksi Pembayaran</h5>
                </div>
                <div class="card-body">

                    <form action="/transaksi-pembayaran" id="pembayaran-form" method="POST" class="row g-3" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id_petugas" value="{{ auth()->user()->petugas->id_petugas }}">
                        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('nama_siswa') is-invalid @enderror"
                                    id="nama_siswa"
                                    name="nama_siswa"
                                    placeholder="Masukan nama siswa"
                                    value="{{ old('nama_siswa', $siswa->nama) }}"
                                    readonly
                                />
                                <label for="nama_siswa">Nama Siswa</label>

                                @error('nama_siswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('nisn') is-invalid @enderror"
                                    id="nisn"
                                    name="nisn"
                                    placeholder="Masukan nisn"
                                    value="{{ old('nisn', $siswa->nisn) }}"
                                    readonly
                                />
                                <label for="nisn">NISN</label>

                                @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text">
                                NISN harus persis berjumlah 10 karakter.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input
                                    type="date"
                                    class="form-control @error('tgl_bayar') is-invalid @enderror"
                                    id="tgl_bayar"
                                    name="tgl_bayar"
                                    value="{{ date('Y-m-d') }}"
                                    readonly
                                />
                                <label for="nisn">Tanggal Bayar</label>

                                @error('tgl_bayar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select
                                    class="form-select @error('pembayaran-spp') is-invalid @enderror"
                                    id="pembayaran-spp"
                                    name="pembayaran-spp"
                                    autofocus
                                >
                                    <option value="">Pilih</option>

                                    @foreach($bulan as $item)
                                        <option value="{{ $item }}" {{ old('pembayaran-spp') == $item ? 'selected' : '' }} >{{ $item }}</option>
                                    @endforeach
                                </select>
                                <label for="spp_id">Pilih bulan pembayaran</label>
                                
                                @error('pembayaran-spp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                    id="jumlah_bayar"
                                    name="jumlah_bayar"
                                    placeholder="Masukan jumlah bayar"
                                    maxlength="35"
                                    value="{{ old('jumlah_bayar', convert_to_rupiah($siswa->spp->nominal)) }}"
                                    readonly
                                />
                                <label for="jumlah_bayar">Jumlah Bayar</label>

                                @error('jumlah_bayar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button form="pembayaran-form" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
