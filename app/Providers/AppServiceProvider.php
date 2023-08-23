<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // email verifikasi
        VerifyEmail::toMailUsing(function ($notifiable) {
            $verifyUrl = Url::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );

            $user = User::whereEmail($notifiable->getEmailForVerification())->first();
            return (new MailMessage)
                ->from($address = 'no-reply_emedia@tubaba.go.id', $name = 'Diskominfo Tubaba E-media')
                ->subject('Verifikasi Akun ' . config('app.name'))
                ->markdown('emails.verify', ['user' => $user, 'verifyUrl' => $verifyUrl]);
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            // $resetUrl = url(route('password.reset', [
            //     'token' => $token,
            //     'email' => $notifiable->getEmailForPasswordReset(),
            // ], false));

            $resetUrl = URL::temporarySignedRoute(
                'password.reset',
                Carbon::now()->addMinutes(Config::get('auth.passwords.expire', 15)),
                [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ]
            );

            $user = User::whereEmail($notifiable->getEmailForVerification())->first();
            return (new MailMessage)
                ->from($address = 'no-reply_emedia@tubaba.go.id', $name = 'Diskominfo Tubaba E-media')
                ->subject('Verifikasi Akun ' . config('app.name'))
                ->markdown('emails.reset', ['user' => $user, 'resetUrl' => $resetUrl]);
        });
    }
}
