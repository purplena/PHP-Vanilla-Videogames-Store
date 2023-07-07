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

function generateQueryParameters(array $newQueryParameters)
{
    $currentQueryParameters = [];
    parse_str($_SERVER['QUERY_STRING'], $currentQueryParameters);

    foreach ($newQueryParameters as $key => $value) {
        $currentQueryParameters[$key] = $value;
    }
    return http_build_query($currentQueryParameters);
};
