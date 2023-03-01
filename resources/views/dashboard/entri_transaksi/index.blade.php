@extends( 'template.main' )

@section( 'main' )
<!---------------- Main Section ---------------->
<div name="msg_storage" data-message="{{ session()->get('successMessage') }}" ></div>

<div class="pagetitle">
    <h1>Daftar Entri</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">History & Pembayaran</li>
            <li class="breadcrumb-item">Entri Transaksi Pembayaran</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-body p-0">
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-sm-0">
                            <input autofocus type="search" name="keyword" class="form-control form-control-sm" id="search" placeholder="Cari siswa...">
                        </div>
                    </div>

                    <div id="table_data">
                        @include( 'dashboard.entri_transaksi.table' )
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const resourceURL = 'loadPembayaran';
    const theMessage  = $( 'div[name="msg_storage"]' ).data( 'message' );

    $(document).ready(function() {
        if ( theMessage ) {
            Swal.fire('', `${theMessage}`, 'success');
        }
    });
</script>

@include( 'template.system.filter&pagination' )
@endsection
