<?php

namespace App\Listeners;

use App\Events\ResetPasswordMailEvent;
use App\Services\EmailService;

class ResetPasswordMailEventHandler
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(ResetPasswordMailEvent $event)
    {
        $emailData = $event->data;
        $content_var_values = ['NAME' => $emailData['name'], 'URL' => $emailData['reset_url']];
        $this->emailService->sendEmailToUser($emailData['email'], 'reset_password', $content_var_values);
    }
}
