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

function generateQueryParameters(array $newQueryParameters, $parameterToRemove = null)
{
    $currentQueryParameters = [];
    parse_str($_SERVER['QUERY_STRING'], $currentQueryParameters);

    foreach ($newQueryParameters as $key => $value) {
        $currentQueryParameters[$key] = $value;
    }

    if ($parameterToRemove && array_key_exists($parameterToRemove, $currentQueryParameters)) {
        unset($currentQueryParameters[$parameterToRemove]);
    }


    return http_build_query($currentQueryParameters);
};


function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
