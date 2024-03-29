@extends( 'template.main' )

@section( 'main' )
<!---------------- Main Section ---------------->
<div name="msg_storage" data-message="{{ session()->get('successMessage') }}" ></div>

<div class="pagetitle">
    <h1>History Pembayaran</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item">History & Pembayaran</li>
            <li class="breadcrumb-item">History Pembayaran</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-body p-0">
                    <div class="row mb-2">
                        <div class="col-sm-6 mb-sm-0">
                            <input autofocus type="search" name="keyword" class="form-control form-control-sm" id="search" placeholder="Cari history...">
                        </div>
                    </div>

                    <table id="table_data" style="width:100%" class="table table-striped table-bordered nowrap">
                        <thead style="background: yellow;">
                            <tr>
                                <th style="background: yellow;">No</th>
                                <th>Nama siswa</th>
                                <th>Kelas</th>
                                <th>Pembayaran SPP</th>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const theMessage  = $( 'div[name="msg_storage"]' ).data( 'message' );
    let table;

    $(document).ready(function() {
        if ( theMessage ) {
            Swal.fire('', `${theMessage}`, 'success');
        }  

        table = $('#table_data').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            lengthChange: false,
            ordering: false,
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: true,
            language: {
                sProcessing:   "Sedang memproses...",
                sLengthMenu:   "Tampilkan _MENU_ entri",
                sZeroRecords:  "Tidak ditemukan data yang sesuai",
                sInfo:         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                sInfoEmpty:    "Menampilkan 0 sampai 0 dari 0 entri",
                sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                sInfoPostFix:  "",
                sSearch:       "Cari:",
                sUrl:          "",
                oPaginate: {
                    sFirst:    "Pertama",
                    sPrevious: "Sebelumnya",
                    sNext:     "Selanjutnya",
                    sLast:     "Terakhir"
                }
            },
            ajax: {
                url: '/loadHistory',
                method: 'GET'
            },
            info: false
        });

        $("#search").on("keyup search input paste cut", function() {
            table.search(this.value).draw();
        });
    });

    function reloadTable() {
        table.ajax.reload();
    }

    function _delete( id ) {
        Swal.fire({
            title   : 'Apa kamu yakin?',
            text    : 'Kamu akan menghapus data history!',
            icon    : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            cancelButtonText    : 'Batal',
            confirmButtonText   : 'Ya!'
        }).then((result) => {
            if ( result.isConfirmed ) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    url     : `/delete-history/${id}`,
                    method  : 'DELETE',
                    success : function( data ) {
                        switch( data.status ) {
                            case true:
                                Swal.fire( '', `${data.msg}`, 'success' );
                                break;
                            case false:
                                Swal.fire( '', `${data.msg}`, 'error' );
                                break;
                        }
                        reloadTable();
                    }
                });
            }
        })
    }
</script>
@endsection
