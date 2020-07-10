<?php

namespace App\Validators;

use Framework\Support\FormValidation;

class UpdateCommentForm extends FormValidation
{
    /**
     * rules
     * 
     * @var array
     */
    protected static $rules = [
        'comment' => 'required'
    ];

    /**
     * custom errors messages
     * 
     * @var array
     */
    protected static $error_messages = [];
}
