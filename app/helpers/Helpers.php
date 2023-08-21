<?php



use Nilambar\NepaliDate\NepaliDate;

function ad_to_bs($year, $month, $day)
{

    $obj = new NepaliDate();

    // Convert BS to AD.
    // $date = $obj->convertBsToAd('2077', '1', '1');

    // Convert AD to BS.
    $date = $obj->convertAdToBs($year, $month, $day);

    return $date;
    // Get Nepali date details by BS date.
    $date = $obj->getDetails('2077', '1', '1', 'bs');

    // Get Nepali date details by AD date.
    $date = $obj->getDetails('2020', '1', '1', 'ad');
}
