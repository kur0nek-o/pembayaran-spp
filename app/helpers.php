<?php

if ( !function_exists('convert_to_int') ) {
    function convert_to_int( $number ) {
        $num            = [ 'Rp', '.' ];
        $num_replace    = [ '', '' ];

        $hasil = str_replace( $num, $num_replace, $number );
        return $hasil;
    }
}

if ( !function_exists('convert_to_rupiah') ) {
    function convert_to_rupiah( $number ) {
        $rupiah = number_format( $number, 0, "", ".");
        return 'Rp. ' . $rupiah;
    }
}