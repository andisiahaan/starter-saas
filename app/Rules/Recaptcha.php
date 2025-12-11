<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip validation if captcha provider is none or not configured
        if (setting('captcha.provider', 'none') === 'none') {
            return;
        }

        $secretKey = setting('captcha.secret_key');
        
        if (empty($secretKey)) {
            return; // Skip if no secret key configured
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (!$response->successful() || !$response->json('success')) {
            $fail('The reCAPTCHA verification failed. Please try again.');
        }
    }
}
