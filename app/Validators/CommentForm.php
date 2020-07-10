<?php

namespace App\Validators;

use Framework\Support\FormValidation;

class CommentForm extends FormValidation
{
    /**
     * rules
     * 
     * @var array
     */
    protected static $rules = [
        'email' => 'required|valid_email',
        'comment' => 'required'
    ];

    /**
     * custom errors messages
     * 
     * @var array
     */
    protected static $error_messages = [];
}
