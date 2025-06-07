<?php

if (! function_exists('formatRupiah')) {
    function formatRupiah($angka, $prefix = 'Rp ')
    {
        return $prefix.number_format($angka, 0, ',', '.');
    }
}
