@include( 'template.system.filter&pagination' )

<script>
    // default env setting
    const _modal    = $( '#modal' );
    const _form     = $( '#form' )[0];
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
        _form.reset();

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

    function save( __form = _form ) {
        Swal.fire({
            text: "Sedang memproses data",
            customClass: 'swal-wide'
        });
        Swal.showLoading();

        const formData  = new FormData( __form );
    
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
</script>