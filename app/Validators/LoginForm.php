<?php

namespace App\Validators;

use Framework\Support\FormValidation;

class LoginForm extends FormValidation
{
    /**
     * rules
     * 
     * @var array
     */
    protected static $rules = [
        'email' => 'required|valid_email',
        'password' => 'required'
    ];

    /**
     * custom errors messages
     * 
     * @var array
     */
    protected static $error_messages = [];
}