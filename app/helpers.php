<?php
if (!function_exists('currency')) {

  /**
   * Conver number to format currency
   * @param integer $nominal
   * @param string $countries
   * @return string
   */
  function currency($nominal, $countries = 'blank') {
    $data['ID'] = 'Rp. '.number_format((int)$nominal, 0, '.', ',');
    $data['blank'] = number_format((int)$nominal, 0, '.', ',');
    return $data[$countries];
  }

}

if(!function_exists('valid_number')) {

  /**
   * Validate number
   * @param  string  $number
   * @param  integer $default
   * @return integer
   */
  function valid_number($number, $default = 0) {
    return is_numeric($number) ? $number : $default;
  }

}
