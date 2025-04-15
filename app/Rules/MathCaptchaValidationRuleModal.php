<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MathCaptchaValidationRuleModal implements Rule
{
  public function passes($attribute, $value)
  {
    // Retrieve the CAPTCHA answer from the session
    $captchaAnswer = session('modal_captcha_answer');

    // Check if the user's answer matches the CAPTCHA answer
    return $value == $captchaAnswer;
  }

  public function message()
  {
    return 'The CAPTCHA answer is incorrect.2';
  }
}
