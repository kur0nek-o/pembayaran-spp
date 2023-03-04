@extends( 'template.main' )

@section( 'main' )  
<!---------------- Modal ---------------->
<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="form" autocomplete="off" onsubmit="return save( 'kelas' )">
            <div class="modal-body">
                <input type="text" class="d-none" name="id" >
                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                    <input type="text" maxlength="10" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukan nama kelas">
                    <div class="form-text">
                        Nama kelas tidak boleh lebih dari 10 karakter.
                    </div>
                </div>
                <div class="mb-0">
                    <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian <span class="text-danger">*</span></label>
                    <input type="text" maxlength="50" class="form-control" id="kompetensi_keahlian" name="kompetensi_keahlian" placeholder="Masukan nama kompetensi keahlian">
                    <div class="form-text">
                        Nama kompetensi keahlian tidak boleh lebih dari 50 karakter.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="saveBtn" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!---------------- Main Section ---------------->
<div class="pagetitle">
    <h1>Kelas</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">Data Management</li>
            <li class="breadcrumb-item">Manajemen Siswa</li>
            <li class="breadcrumb-item">Kelas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-sm-6"><button type="button" onclick="openModal( 'Tambah kelas' )" class="btn btn-sm btn-primary mb-3">Tambah kelas</button></div>
                        <div class="col-sm-6 mb-sm-0 mb-3">
                            <div class="input-group input-group-sm">
                                <input autofocus type="search" name="keyword" id="search" class="form-control" placeholder="Cari kelas...">
                                <button type="button" class="input-group-text bg-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Ketikan keyword pada kolom pencarian lalu klik enter untuk mulai melakukan pencarian."><i class="bi bi-info-circle"></i></button>
                            </div>
                        </div>
                    </div>

                    <div id="table_data">
                        @include( 'dashboard.manajemen_siswa.kelas.table' )
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const resourceURL = 'loadKelas';

    function _edit( id ) {
        Swal.fire({
            text: "Sedang memproses data",
            customClass: 'swal-wide'
        });
        Swal.showLoading();
        
        setFormToDefault();

        $.ajax({
            url     : `/kelas/${id}/edit`,
            method  : 'GET',
            success : function( data ) {
                $( 'input[name="id"]' ).val( data.id_kelas );
                $( 'input[name="nama_kelas"]' ).val( data.nama_kelas );
                $( 'input[name="kompetensi_keahlian"]' ).val( data.kompetensi_keahlian );

                _modal.find( '.modal-title' ).text( 'Edit data kelas' );
                
                $( '.required-info' ).each( function() {
                    $(this).hide();
                });

                Swal.close();
                _modal.modal( 'show' );
            },
            error: function( jqXHR, textStatus, errorThrown ) {
                swal( "Gagal", "Gagal Mendapatkan data", "error" );
            }
        });
    }
</script>

@include( 'template.system.crud' )
@endsection
