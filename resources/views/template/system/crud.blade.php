@include( 'template.system.filter&pagination' )

<script>
    // default env setting
    const _modal    = $( '#modal' );
    const _form     = $( '#form' );
    const saveBTN   = $( '#saveBtn' );

    // default form input behavior
    $( 'input[type="text"], input[type="password"], select' ).each( function(){
        $(this).on( 'click', function(){
            removeErrorMessage(this);
        }); 
    });

    // standard function pack for modal and crud
    function openModal( title, __modal = _modal ) {
        __modal.find( '.modal-title' ).text( title );
        setFormToDefault();
        __modal.modal( 'show' );
    }

    function setFormToDefault() {
        _form[0].reset();

        $( 'input[type="text"], input[type="password"], select' ).each( function(){
            removeErrorMessage( this );
        });

        $( '.required-info' ).each( function() {
            $(this).show();
        });
    }

    function removeErrorMessage( el ) {
        $(el).removeClass( 'is-invalid' );
            
        if ( $(el).next().hasClass( 'invalid-feedback' ) ) {
            $(el).next().remove();
        }
    }

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

    function save( __form = _form ) {
        Swal.fire({
            text: "Sedang memproses data",
            customClass: 'swal-wide'
        });
        Swal.showLoading();

        const id        = $( 'input[name="id"]' ).val();
        const formData  = __form.serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url     : ( id == '' ) ? '/petugas' : `/petugas/${id}`,
            type    : ( id == '' ) ? 'POST' : `PUT`,
            data    : formData,
            success     : function( data ) {
                if ( data.status ) {
                    Swal.fire( '', `${data.msg}`, 'success' );
                    _modal.modal( 'hide' );
                    _load(0);
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

    function _delete( id, msg ) {
        Swal.fire({
            title   : 'Apa kamu yakin?',
            text    : msg,
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
                    url     : `/petugas/${id}`,
                    method  : 'DELETE',
                    success : function( data ) {
                        Swal.fire( '', `${data.msg}`, 'success' );
                        _load(0);
                    }
                });
            }
        })
    }
</script>