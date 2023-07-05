<?php
function price_converter($price) {
    return number_format($price / 100, 2, ',', '');
}