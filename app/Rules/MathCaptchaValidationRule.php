<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MathCaptchaValidationRule implements Rule
{
  public function passes($attribute, $value)
  {
    // Retrieve the CAPTCHA answer from the session
    $captchaAnswer = session('captcha_answer');

    // Check if the user's answer matches the CAPTCHA answer
    return $value == $captchaAnswer;
  }

  public function message()
  {
    return 'The CAPTCHA answer is incorrect.';
  }
}
