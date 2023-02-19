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

        <form id="form" autocomplete="off" onsubmit="return save( 'petugas' )">
            <div class="modal-body">
                <input type="text" class="d-none" name="id" >
                <input type="text" class="d-none" name="id_user" >
                <div class="mb-3">
                    <label for="nama_petugas" class="form-label">Nama Petugas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error( 'nama_petugas' ) is-invalid @enderror" id="nama_petugas" name="nama_petugas" placeholder="Masukan nama petugas">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" maxlength="25" class="form-control" id="username" name="username" placeholder="Masukan username">
                    <div class="form-text">
                        Username harus terdiri dari 4-25 karakter.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger required-info">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
                </div>
                
                <div class="mb-0">
                    <label for="level" class="form-label">Level Petugas <span class="text-danger">*</span></label>
                    <select class="form-select" name="level" id="level">
                        <option value="">Pilih level</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
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
    <h1>Petugas</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">Data Management</li>
            <li class="breadcrumb-item">Petugas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-sm-6"><button type="button" onclick="openModal( 'Tambah petugas' )" class="btn btn-sm btn-primary mb-3">Tambah Petugas</button></div>
                        <div class="col-sm-6 mb-sm-0 mb-3">
                            <input autofocus type="search" name="keyword" class="form-control form-control-sm" id="search" placeholder="Cari petugas...">
                        </div>
                    </div>

                    <div id="table_data">
                        @include( 'dashboard.petugas.table' )
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const resourceURL = 'loadPetugas';

    function _edit( id ) {
        Swal.fire({
            text: "Sedang memproses data",
            customClass: 'swal-wide'
        });
        Swal.showLoading();
        
        setFormToDefault();

        $.ajax({
            url     : `/petugas/${id}/edit`,
            method  : 'GET',
            success : function( data ) {
                const user = data.user;

                $( 'input[name="id"]' ).val( data.id_petugas );
                $( 'input[name="id_user"]' ).val( user.id );
                $( 'input[name="nama_petugas"]' ).val( data.nama_petugas );
                $( 'input[name="username"]' ).val( user.username );

                $( '#level' ).val( user.level ).change();

                _modal.find( '.modal-title' ).text( 'Edit data petugas' );
                
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