<?php

use Carbon\Carbon;

define('TO_EMAIL', 'studytutelage@gmail.com');
define('TO_NAME', 'Team tutelage Study');
define('CC_EMAIL', 'vandana@educationmalaysia.in');
define('CC_NAME', 'Vandana Sarswat');

// define('TO_EMAIL', 'farazahmad280@gmail.com');
// define('TO_NAME', 'Mohd Faraz');
// define('CC_EMAIL', '4hm3df4r42@gmail.com');
// define('CC_NAME', 'Education Malaysia Education');


define('BCC_EMAIL', 'farazahmad280@gmail.com');
define('BCC_NAME', 'Mohd Faraz');

define('site_var', 'MYS');
define('DOMAIN', 'educationmalaysia.in');


if (!function_exists('printArray')) {
  function printArray($data)
  {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
  }
}
if (!function_exists('getFormattedDate')) {
  function getFormattedDate($date, $formate)
  {
    return date($formate, strtotime($date));
  }
}
if (!function_exists('slugify')) {
  function slugify($text)
  {
    // Swap out Non "Letters" with a -
    $text = preg_replace('/[^\\pL\d]+/u', '-', $text);
    // Trim out extra -'s
    $text = trim($text, '-');
    // Convert letters that we have left to the closest ASCII representation
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Make text lowercase
    $text = strtolower($text);
    // Strip out anything we haven't been able to convert
    $text = preg_replace('/[^-\w]+/', '', $text);
    return $text;
  }
}
if (!function_exists('unslugify')) {
  function unslugify($text)
  {
    // Swap out Non "-" with a space
    $text = str_replace('-', ' ', $text);
    // Trim out extra spaces
    $text = trim($text, ' ');
    // Make text lowercase
    $text = ucwords($text);
    return $text;
  }
}
if (!function_exists('dateDiff')) {
  function dateDiff($date1, $date2)
  {
    $date1_ts = strtotime($date1);
    $date2_ts = strtotime($date2);
    return $days_between = ceil(abs($date2_ts - $date1_ts) / 86400);
  }
}
if (!function_exists('aurl')) {
  function aurl($path = null)
  {
    $path = strtolower($path);
    if ($path != '') {
      return url('/admin/' . $path);
    } else {
      return url('/admin/');
    }
  }
}
if (!function_exists('uurl')) {
  function uurl($path = null)
  {
    $path = strtolower($path);
    if ($path != '') {
      return url('/user/' . $path);
    } else {
      return url('/user/');
    }
  }
}
if (!function_exists('j2s')) {
  function j2s($data)
  {
    if (!empty($data)) {
      $arr = json_decode($data, true);
      if (is_array($arr)) {
        $output = implode(', ', $arr);
      } else {
        $output = 'N/A';
      }
    } else {
      $output = 'N/A';
    }
    return $output;
  }
}

if (!function_exists('jsonToTextByLimit')) {
  function jsonToTextByLimit($data, $limit)
  {
    if ($data != null) {
      $arr = json_decode($data, true); // Decode JSON as associative array
      $output = implode(', ', array_slice($arr, 0, $limit)); // Get the first three elements
    } else {
      $output = 'N/A';
    }
    return $output;
  }
}
if (!function_exists('replaceTag')) {
  function replaceTag($string, $array)
  {
    foreach ($array as $key => $value) {
      $string = $string == null ? null : str_replace('%' . $key . '%', $value, $string);
    }
    $string = trim(preg_replace('/\s+/', ' ', $string));
    //$string = ucwords($string);
    return $string;
  }
}
if (!function_exists('universityLogo')) {
  function universityLogo($path = null)
  {
    if ($path != '') {
      return asset($path);
    } else {
      return asset('default/university-logo.png');
    }
  }
}
if (!function_exists('universityBanner')) {
  function universityBanner($path = null)
  {
    if ($path != '') {
      return asset($path);
    } else {
      return asset('default/university-banner.jpeg');
    }
  }
}
if (!function_exists('getPerc')) {
  function getPerc($mult, $div)
  {
    return $result = ($mult * 100) / $div;
  }
}
if (!function_exists('userIcon')) {
  function userIcon($path = null)
  {
    if ($path != null || $path != '') {
      return asset($path);
    } else {
      return asset('default/user-icon.png');
    }
  }
}
if (!function_exists('categoryIcon')) {
  function categoryIcon($path = null)
  {
    if ($path != null || $path != '') {
      return asset($path);
    } else {
      return asset('default/category.svg');
    }
  }
}
if (!function_exists('json_to_string')) {
  function json_to_string($value)
  {
    $output = $value != null ? json_decode($value) : '';
    $output = $output != null ? implode(', ', $output) : '';
    return $output;
  }
}
if (!function_exists('colToStr')) {
  function colToStr($value)
  {
    $output = str_replace('_', ' ', $value);
    $output = ucwords($output);
    return $output;
  }
}
if (!function_exists('json_to_list')) {
  function json_to_list($value)
  {
    if ($value !== null) {
      $arr = json_decode($value);
      if ($arr !== null && (is_array($arr) || is_object($arr))) {
        $output = '<ul>';
        foreach ($arr as $item) {
          $output .= "<li>$item</li>";
        }
        $output .= '</ul>';
      } else {
        $output = 'N/A';
      }
    } else {
      $output = 'N/A';
    }
    return $output;
  }
}
if (!function_exists('gr_site_key')) {
  function gr_site_key()
  {
    return "6Lf6t2wpAAAAACTIO7byB8-ucDBfIssDXcxD3PAr";
  }
}
if (!function_exists('gr_secret_key')) {
  function gr_secret_key()
  {
    return "6Lf6t2wpAAAAAO39ZjeGK4-APTubxFFWR5Thi1ZD";
  }
}
if (!function_exists('generateMathQuestion')) {
  function generateMathQuestion()
  {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $operator = ['+', '-', '*'][rand(0, 2)];

    $questionText = "$num1 $operator $num2";
    $answer = eval("return $num1 $operator $num2;");

    return [
      'text' => $questionText,
      'answer' => $answer,
    ];
  }
}
if (!function_exists('getISOFormatTime')) {
  /**
   * Get the ISO 8601 formatted time.
   *
   * @param  string  $time
   * @return string
   */
  function getISOFormatTime($time)
  {
    $time = Carbon::parse($time);
    return $time->format('Y-m-d\TH:i:sP');
  }
}
if (!function_exists('formatLocation')) {
  /**
   * Format location string based on city, state, and country values.
   *
   * @param string|null $city
   * @param string|null $state
   * @param string|null $country
   * @return string
   */
  function formatLocation(?string $city, ?string $state, ?string $country): string
  {
    $locationParts = [];

    if (!empty($city)) {
      $locationParts[] = $city;
    }

    if (!empty($state)) {
      $locationParts[] = $state;
    }

    if (!empty($country)) {
      $locationParts[] = $country;
    }

    return implode(', ', $locationParts);
  }
}
