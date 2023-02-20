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

        <form id="form" autocomplete="off" onsubmit="return save( 'spp' )">
            <div class="modal-body">
                <input type="text" class="d-none" name="id" >
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                    <select class="form-select" name="tahun" id="tahun">
                        <option value="">Pilih tahun</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
                <div class="mb-0">
                    <label for="nominal" class="form-label">Nominal <span class="text-danger">*</span></label>
                    <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" id="nominal" name="nominal" placeholder="Masukan nominal">
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
            <li class="breadcrumb-item">SPP</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-sm-6"><button type="button" onclick="openModal( 'Tambah SPP' )" class="btn btn-sm btn-primary mb-3">Tambah SPP</button></div>
                        <div class="col-sm-6 mb-sm-0 mb-3">
                            <input autofocus type="search" name="keyword" class="form-control form-control-sm" id="search" placeholder="Cari spp...">
                        </div>
                    </div>

                    <div id="table_data">
                        @include( 'dashboard.spp.table' )
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const resourceURL   = 'loadSpp';
    const rupiah        = $( '#nominal' )[0];
    
    function hanyaAngka( evt ) 
    {
        let charCode = ( evt.which ) ? evt.which : event.keyCode
        if ( charCode > 31 && ( charCode < 48 || charCode > 57 ))

            return false;
        return true;
    }

    rupiah.addEventListener( "keyup", function( e ) {
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    function formatRupiah( angka, prefix ) 
    {
        let number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if ( ribuan ) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

    function _edit( id ) {
        Swal.fire({
            text: "Sedang memproses data",
            customClass: 'swal-wide'
        });
        Swal.showLoading();
        
        setFormToDefault();

        $.ajax({
            url     : `/spp/${id}/edit`,
            method  : 'GET',
            success : function( data ) {
                $( 'input[name="id"]' ).val( data.id_spp );
                $( '#tahun' ).val( data.tahun ).change();
                $( 'input[name="nominal"]' ).val( data.nominal );

                _modal.find( '.modal-title' ).text( 'Edit data spp' );
                
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