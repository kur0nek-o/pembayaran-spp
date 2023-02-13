<script>
    $(document).ready(function(){
        $(document).on( 'click', '.pagination a', function(e) {
            e.preventDefault();

            const page = $(this).attr('href').split('page=')[1];
            _load( page );
        });
    });

    $( '.buffer' ).hide();
    setStyleToPaginations();

    $( '#search' ).on( 'search', function() {
        _load( 0 );
    });

    function _load( page ) {
        $( '#table-body' ).hide();
        $( '.buffer' ).show();
        let keyword = $( '#search' ).val();

        $.ajax({
            url     : '/load',
            method  : 'GET',
            data    : { page : page, keyword : keyword },
            success :function( data ) {
                $('#table_data').html( data );
                setStyleToPaginations();
                $( '.buffer' ).hide();
                $( '#table-body' ).show();
            }
        });
    }

    function setStyleToPaginations() {
        $( '.pagination' ).addClass( 'mb-0 mt-3' );
    }
</script>