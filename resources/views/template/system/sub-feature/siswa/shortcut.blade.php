<!---------------- Modal ---------------->
<div class="modal fade" id="modal-kelas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="form-kelas" autocomplete="off">
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

<div class="modal fade" id="modal-spp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="form-spp" autocomplete="off">
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

<script>
    $('#form-kelas').on('submit', function(e){
        e.preventDefault();
        
        save('modal-kelas', 'form-kelas', 'kelas', 'getKelasList', function(data) {
            let items = `<option value="">Pilih</option>`;

            for (let i = 0; i < data.length; i++) {
                items += `<option value="${data[i].id_kelas}">${data[i].nama_kelas}</option>`;
            }
            $('#kelas_id').html(items);
        });
    });

    $('#form-spp').on('submit', function(e){
        e.preventDefault();
        
        save('modal-spp', 'form-spp', 'spp', 'getSppList', function(data) {
            let items = `<option value="">Pilih</option>`;

            for (let i = 0; i < data.length; i++) {
                items += `<option value="${data[i].id_spp}">Spp tahun ${data[i].tahun} | ${data[i].nominal}</option>`;
            }
            $('#spp_id').html(items);
        });
    });

    // default form input behavior
    $( 'input[type="text"], input[type="password"], select, textarea' ).each( function(){
        $(this).on( 'click', function(){
            removeErrorMessage(this);
        }); 
    });

    // javascript input formatter to rupiah 
    const rupiah = $( '#nominal' )[0];
    
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

    // standard modal method 
    function openModal( modalName, title, formName ) {
        const _modal = $(`#${modalName}`);

        _modal.find( '.modal-title' ).text( title );
        setFormToDefault(formName);

        $( '.required-info' ).each( function() {
            $(this).show();
        });
        _modal.modal( 'show' );
    }

    function setFormToDefault( formName ) {
        const _form = $(`#${formName}`);
        _form[0].reset();

        $( 'input[type="text"], input[type="password"], select' ).each( function(){
            removeErrorMessage( this );
        });
    }

    // create and display the errors 
    function displayTheErrors( errors ) {
        $.each( errors, function( key, message ) {
            const el = $( `#${key}` );
            const errorMessage = createErrorFeedback( message );
        
            el.addClass( 'is-invalid' );
        
            if ( el.next().hasClass( 'invalid-feedback' ) ) {
                el.next().remove();
            }
            $( errorMessage ).insertAfter( el );
        });
    }
        
    function createErrorFeedback( errorMessage ) {
        const message = `<div class="invalid-feedback">${errorMessage}</div>`;
        return message;
    }

    // remove error message
    function removeErrorMessage( el ) {
        $(el).removeClass( 'is-invalid' );
        $(el).parent().find('.invalid-feedback').remove();
    }

    // saving sub feature
    function save( modalName, formName, urlResourceName, subResourceURL, actionAfter ) {
        const _form  = $(`#${formName}`);
        const _modal = $(`#${modalName}`);

        Swal.fire({
            text: "Sedang memproses data",
            customClass: 'swal-wide'
        });
        Swal.showLoading();

        const id        = $( 'input[name="id"]' ).val();
        const formData  = _form.serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url     : ( id == '' ) ? `/${urlResourceName}` : `/${urlResourceName}/${id}`,
            type    : ( id == '' ) ? 'POST' : `PUT`,
            data    : formData,
            success     : function( data ) {
                if ( data.status ) {
                    Swal.fire( '', `${data.msg}`, 'success' );
                    _modal.modal( 'hide' );

                    getItems(subResourceURL, actionAfter);
                }
            },
            error: function( data ) {
                const errors = data.responseJSON.errors;
                displayTheErrors( errors );
                Swal.close();
            }
        });

        return false;
    }

    // set select elements list
    function getItems( resouceURL, displayTheData ) {
        $.ajax({
            url     : `/${resouceURL}`,
            method  : 'GET',
            success : function( data ) {
                displayTheData(data);
            },
            error: function( jqXHR, textStatus, errorThrown ) {
                swal( "Gagal", "Gagal Mendapatkan data", "error" );
            }
        });
    }
</script>
