<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckDisposableEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $filePath = storage_path('app/disposable.txt');
        

        if (!file_exists($filePath)) {
            return false; // Allow validation if the file doesn't exist
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            [$user, $domain] = explode("@", $value, 2);

            $domains = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            return !in_array($domain, $domains);
        }

        return true; // Pass validation in non-production environments
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please enter a valid email address.';
    }
}
