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
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    id="nama"
                                    name="nama"
                                    placeholder="Masukan nama siswa"
                                    maxlength="35"
                                    value="{{ $siswa->nama }}"
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
                                    value="{{ $siswa->nisn }}"
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
                                    value="{{ $siswa->nis }}"
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
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select
                                        class="form-select @error('kelas_id') is-invalid @enderror"
                                        id="kelas_id"
                                        name="kelas_id"
                                    >
                                        <option value="">Pilih</option>
                                        
                                        @foreach( $kelas as $list )
                                            @if( $list->id_kelas == $siswa->kelas_id )
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
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select
                                    class="form-select @error('spp_id') is-invalid @enderror"
                                    id="spp_id"
                                    name="spp_id"
                                >
                                    <option value="">Pilih</option>

                                    @foreach( $spp as $list )
                                        @if( $list->id_spp == $siswa->spp_id )
                                            <option value="{{ $list->id_spp }}" selected>{{ "Spp tahun $list->tahun | " . convert_to_rupiah($list->nominal) }}</option>
                                        @else
                                            <option value="{{ $list->id_spp }}">{{ "Spp tahun $list->tahun | " . convert_to_rupiah($list->nominal) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="spp_id">Pilih spp yang digunakan</label>
                                
                                @error('spp_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                    value="{{ $siswa->no_telp }}"
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
                                >{{ $siswa->alamat }}</textarea
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

<script>
    $( 'input[type="text"], input[type="password"], select, textarea' ).each( function(){
        $(this).on( 'click', function(){
            removeErrorMessage(this);
        }); 
    });

    function removeErrorMessage( el ) {
        $(el).removeClass( 'is-invalid' );
        $(el).parent().find('.invalid-feedback').remove();
    }
</script>
@endsection