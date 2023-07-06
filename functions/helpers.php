<?php
function price_converter($price)
{
    return number_format($price / 100, 2, ',', '');
}

function date_converter($date)
{
    $timestamp = strtotime($date);
    $formattedDate = date("d/m/Y", $timestamp);

    return $formattedDate;
}
