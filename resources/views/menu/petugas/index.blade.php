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

        <form id="form" autocomplete="off">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama-petugas" class="form-label">Nama Petugas</label>
                    <input type="text" class="form-control @error( 'nama_petugas' ) is-invalid @enderror" id="nama-petugas" name="nama_petugas" placeholder="Masukan nama petugas">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username">
                    <div class="form-text">
                        Username harus 8-25 karakter.
                    </div>
                </div>
                <div class="mb-0">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
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
                    <button type="button" id="add" class="btn btn-sm btn-primary mb-3">Tambah Petugas</button>

                    <div class="table-responsive">
                        <table class="table table-bordered border-dark text-center mb-0">
                            <thead style="background: yellow">
                                <tr class="text-nowrap">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama petugas</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $petugas as $p )
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $p->nama_petugas }}</td>
                                        <td>{{ $p->user->username }}</td>
                                        <td>tidak ada</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const addBtn    = $( '#add' );
    const _modal    = $( '#modal' );
    const _form     = $( '#form' )[0];
    const saveBTN   = $( '#saveBtn' );

    $( 'input[type="text"], input[type="password"]' ).each( function(){
        $(this).on( 'click', function(){
            $(this).removeClass( 'is-invalid' );
            
            if (! $(this).next().hasClass( 'form-text' ) ) {
                $(this).next().remove();
            }
        }); 
    });

    addBtn.on('click', function() {
        _modal.find( '.modal-title' ).text( 'Tambah Petugas' );
        _modal.modal( 'show' );
        _form.reset();
    });

    saveBTN.on( 'click', function(e) {
        e.preventDefault();
        const formData  = new FormData( _form );

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url     : '{{ url( "/petugas" ) }}',
            method  : 'POST',
            data    : formData,
            cache   : false,
            processData : false,
            contentType : false,
            success     : function( data ) {
                if ( data.status ) {
                    alert( data.msg );
                }
            },
            error: function( data ) {
                const errors = data.responseJSON.errors;
                displayTheErrors( errors );
            }
        });

        function displayTheErrors( errors ) {
            $.each( errors, function( key, message ) {
                const el = $( `input[name='${key}']` );
                const errorMessage = createErrorFeedback( message );

                el.addClass( 'is-invalid' );
                $( errorMessage ).insertAfter( el );
            });
        }

        function createErrorFeedback( errorMessage ) {
            const message = `<div class="invalid-feedback">${errorMessage}</div>`;
            return message;
        }
    });
</script>
@endsection