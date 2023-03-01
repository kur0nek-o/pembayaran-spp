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
    function openModal( title ) {
        _modal.find( '.modal-title' ).text( title );
        setFormToDefault();

        $( '.required-info' ).each( function() {
            $(this).show();
        });
        _modal.modal( 'show' );
    }

    function setFormToDefault() {
        _form[0].reset();

        $( 'input[type="text"], input[type="password"], select' ).each( function(){
            removeErrorMessage( this );
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

    function save( urlResourceName ) {
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
                switch( data.status ) {
                    case true:
                        Swal.fire( '', `${data.msg}`, 'success' );
                        break;
                    case false:
                        Swal.fire( '', `${data.msg}`, 'error' );
                        break;
                }

                _modal.modal( 'hide' );
                _load( 0, resourceURL );
            },
            error: function( data ) {
                const errors = data.responseJSON.errors;
                displayTheErrors( errors );
                Swal.close();
            }
        });

        return false;
    }

    function _delete( id, msg, urlResourceName ) {
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
                    url     : `/${urlResourceName}/${id}`,
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
                        _load( 0, resourceURL );
                    }
                });
            }
        })
    }
</script>
