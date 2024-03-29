@extends( 'template.main' )

@section( 'main' )
<!---------------- Main Section ---------------->
<div class="pagetitle">
    <h1>Siswa</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">Data Management</li>
            <li class="breadcrumb-item">Manajemen Siswa</li>
            <li class="breadcrumb-item">Siswa</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<a href="/siswa" class="btn btn-warning mb-3">Kembali</a>

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title p-0 mb-0">Edit data siswa</h5>
                </div>
                <div class="card-body">

                    <form action="/siswa/{{ $siswa->id }}" id="siswa-form" method="POST" class="row g-3" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="spp_id" value="{{ $siswa->spp_id }}">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    id="nama"
                                    name="nama"
                                    placeholder="Masukan nama siswa"
                                    maxlength="35"
                                    value="{{ old('nama', $siswa->nama) }}"
                                />
                                <label for="nama">Nama siswa</label>

                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text">
                                Maksimal karakter untuk nama siswa adalah 35.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('nisn') is-invalid @enderror"
                                    id="nisn"
                                    name="nisn"
                                    placeholder="Masukan NISN"
                                    maxlength="10"
                                    value="{{ old('nisn', $siswa->nisn) }}"
                                    onkeypress="return hanyaAngka(event)"
                                />
                                <label for="nisn">Masukan NISN</label>

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
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('nis') is-invalid @enderror"
                                    id="nis"
                                    name="nis"
                                    placeholder="Masukan NIS"
                                    maxlength="8"
                                    value="{{ old('nis', $siswa->nis) }}"
                                    onkeypress="return hanyaAngka(event)"
                                />
                                <label for="nis">Masukan NIS</label>

                                @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text">
                                NIS harus persis berjumlah 8 karakter.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-2">
                                <select
                                    class="form-select @error('kelas_id') is-invalid @enderror"
                                    id="kelas_id"
                                    name="kelas_id"
                                >
                                    <option value="">Pilih</option>
                                        
                                    @foreach( $kelas as $list )
                                        @if( old('kelas_id', $siswa->kelas_id) == $list->id_kelas )
                                            <option value="{{ $list->id_kelas }}" selected>{{ $list->nama_kelas }}</option>
                                        @else
                                            <option value="{{ $list->id_kelas }}">{{ $list->nama_kelas }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="kelas_id">Pilih kelas siswa</label>

                                @error('kelas_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="button" onclick="openModal('modal-kelas', 'Tambah kelas', 'form-kelas')" class="btn btn-secondary btn-sm">Tambah kelas</button>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-2">
                                <div class="form-floating">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="display_for_spp"
                                        name="display_for_spp"
                                        value="{{ 'Spp tahun ' . $siswa->spp->tahun . ' | ' . convert_to_rupiah($siswa->spp->nominal) }}"
                                        readonly
                                    />
                                    <label for="display_for_spp">Pilih spp yang digunakan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('no_telp') is-invalid @enderror"
                                    id="no_telp"
                                    name="no_telp"
                                    placeholder="Masukan nomor telpon siswa"
                                    maxlength="13"
                                    value="{{ old('no_telp', $siswa->no_telp) }}"
                                    onkeypress="return hanyaAngka(event)"
                                />
                                <label for="nis">Nomor telpon siswa</label>

                                @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text">
                                Maksimal karakter untuk nomor telpon siswa adalah 13.
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    placeholder="Masukan alamat"
                                    id="alamat"
                                    name="alamat"
                                    style="height: 100px"
                                >{{ old('alamat', $siswa->alamat) }}</textarea
                                ><label for="alamat">Alamat siswa</label>

                                @error( 'alamat' )
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button form="siswa-form" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

@include('template.system.sub-feature.siswa.shortcut')
@endsection
