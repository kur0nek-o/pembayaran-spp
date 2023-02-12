<script>
    $(document).ready(function(){
        setStyleToPaginations();

        $(document).on( 'click', '.pagination a', function(e) {
            e.preventDefault();

            const page = $(this).attr('href').split('page=')[1];
            _load( page );
        });

        function _load( page ) {
            $.ajax({
                url     : '/load',
                method  : 'GET',
                data    : { page : page },
                success :function( data ) {
                    $('#table_data').html( data );
                    setStyleToPaginations();
                }
            });
        }
    });

    function setStyleToPaginations() {
        $( '.pagination' ).addClass( 'mb-0 mt-3' );
    }
</script>