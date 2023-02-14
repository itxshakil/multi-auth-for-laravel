<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AdminResetPassword extends ResetPassword
{
    public static $createUrlCallback = [self::class, 'createActionUrl'];

    public static function createActionUrl($notifiable, $token)
    {
        return url(route('admin.password.reset', [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }

    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url): \Illuminate\Notifications\Messages\MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Reset Admin Password Notification'))
            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::get('Reset Password'), $url)
            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.admins.expire')]))
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    }
}
