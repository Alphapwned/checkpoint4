<?php

namespace App\Service;

class FormManager
{
    public function incorrectMessage(string $message): string
    {
        if (empty($message)) {
            return 'Please write a message';
        } elseif (strlen($message) < 10) {
            return 'Your message must contain at least 10 characters';
        } elseif (strlen($message) > 5000) {
            return 'Your message is too long, it should not exceed 5000 characters';
        } else {
            return '';
        }
    }
}
