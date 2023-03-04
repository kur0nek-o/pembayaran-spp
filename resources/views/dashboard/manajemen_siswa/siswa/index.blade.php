@extends( 'template.main' )

@section( 'main' )
<!---------------- Main Section ---------------->
<div name="msg_storage" data-message="{{ session()->get('successMessage') }}" ></div>

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

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-sm-6"><a href="/siswa/create" class="btn btn-sm btn-primary mb-3">Tambah siswa</a></div>
                        <div class="col-sm-6 mb-sm-0 mb-3">
                            <div class="input-group input-group-sm">
                                <input autofocus type="search" name="keyword" id="search" class="form-control" placeholder="Cari siswa...">
                                <button type="button" class="input-group-text bg-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Ketikan keyword pada kolom pencarian lalu klik enter untuk mulai melakukan pencarian."><i class="bi bi-info-circle"></i></button>
                            </div>
                        </div>
                    </div>

                    <div id="table_data">
                        @include( 'dashboard.manajemen_siswa.siswa.table' )
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const resourceURL = 'loadSiswa';
    const theMessage  = $( 'div[name="msg_storage"]' ).data( 'message' );

    $(document).ready(function() {
        if ( theMessage ) {
            Swal.fire('', `${theMessage}`, 'success');
        }
    });

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
                Swal.fire( "Gagal", "Gagal Mendapatkan data", "error" );
            }
        });
    }
</script>

@include( 'template.system.crud' )
@endsection
