<?php

namespace App\Validators;

use Framework\Support\FormValidation;

class PostForm extends FormValidation
{
    /**
     * rules
     * 
     * @var array
     */
    protected static $rules = [
        'title' => 'required',
        'content' => 'required'
    ];

    /**
     * custom errors messages
     * 
     * @var array
     */
    protected static $error_messages = [];
}