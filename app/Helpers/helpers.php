<?php

if (!function_exists('format_price')) {
    /**
    * Formata valor pra ficar em dinheiro, RS 0,00, to sem mais ideia pra helper
     */
    function format_price($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }
}