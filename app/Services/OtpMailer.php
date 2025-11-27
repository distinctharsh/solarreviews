<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class OtpMailer
{
    protected static bool $bootstrapped = false;

    protected function ensureBootstrap(): void
    {
        if (self::$bootstrapped) {
            return;
        }

        $basePath = base_path('app/Libraries/phpmailer/src');

        require_once $basePath.'/Exception.php';
        require_once $basePath.'/PHPMailer.php';
        require_once $basePath.'/SMTP.php';

        self::$bootstrapped = true;
    }

    public function send(string $recipientEmail, string $otp): bool
    {
        $this->ensureBootstrap();

        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = env('PHPMAILER_HOST', env('MAIL_HOST', 'smtp.gmail.com'));
            $mail->SMTPAuth = true;
            $mail->Username = env('PHPMAILER_USERNAME', env('MAIL_USERNAME'));
            $mail->Password = env('PHPMAILER_PASSWORD', env('MAIL_PASSWORD'));
            $mail->SMTPSecure = env('PHPMAILER_ENCRYPTION', env('MAIL_ENCRYPTION', 'ssl'));
            $mail->Port = env('PHPMAILER_PORT', env('MAIL_PORT', 465));
            $mail->SMTPAutoTLS = (bool) env('PHPMAILER_AUTOTLS', false);
            $mail->Timeout = (int) env('PHPMAILER_TIMEOUT', 15);

            $fromAddress = env('PHPMAILER_FROM_ADDRESS', env('MAIL_FROM_ADDRESS', $mail->Username));
            $fromName = env('PHPMAILER_FROM_NAME', env('MAIL_FROM_NAME', config('app.name')));

            if ($fromAddress) {
                $mail->setFrom($fromAddress, $fromName);
            } else {
                $mail->setFrom($mail->Username ?? 'noreply@example.com', $fromName);
            }

            $mail->addAddress($recipientEmail);

            $mail->isHTML(true);
            $mail->Subject = __('Your Solar Reviews verification code');
            $mail->Body = '<p>'.__('Your one-time verification code is:').'</p><p style="font-size:20px;"><strong>'.$otp.'</strong></p>';
            $mail->AltBody = __('Your one-time verification code is: :code', ['code' => $otp]);

            return $mail->send();
        } catch (\PHPMailer\PHPMailer\Exception $exception) {
            Log::error('PHPMailer failed to send OTP', [
                'message' => $exception->getMessage(),
            ]);

            return false;
        }
    }
}
