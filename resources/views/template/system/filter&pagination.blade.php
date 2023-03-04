<script>
    $(document).ready(function(){
        $(document).on( 'click', '.pagination a', function(e) {
            e.preventDefault();

            const page = $(this).attr('href').split('page=')[1];
            _load( page, resourceURL );
        });
    });

    setStyleToPaginations();

    $( '#search' ).on( 'keypress', function(e) {
        if(e.which == 13) {
            _load( 0, resourceURL );
        }
    });

    function _load( page, urlResourceName ) {
        $( '#table-body' ).hide();
        $( '.buffer' ).toggleClass('d-none');
        let keyword = $( '#search' ).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url     : `/${urlResourceName}`,
            method  : 'POST',
            data    : { page : page, keyword : keyword },
            success :function( data ) {
                $('#table_data').html( data );
                setStyleToPaginations();
                $( '#table-body' ).show();
            },
            error: function( jqXHR, textStatus, errorThrown ) {
                Swal.fire( "Gagal", "Gagal Mendapatkan data", "error" );
            }
        });
    }

    function setStyleToPaginations() {
        $( '.pagination' ).addClass( 'mb-0 mt-3' );
    }
</script>
