<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnquiryMailer
{
    public static function adminEmail(): string
    {
        return (string) config('mail.enquiry_to', 'sankalp@ycstech.in');
    }

    /**
     * @param  array{reply_to?: string, attachments?: string[]}  $options
     */
    public static function sendView(string $view, array $data, string $to, string $subject, array $options = []): bool
    {
        $replyTo = isset($options['reply_to']) ? $options['reply_to'] : null;
        $attachments = isset($options['attachments']) ? $options['attachments'] : [];

        try {
            Mail::send($view, $data, function ($message) use ($to, $subject, $replyTo, $attachments) {
                $message->to($to)->subject($subject);

                if ($replyTo) {
                    $message->replyTo($replyTo);
                }

                foreach ($attachments as $attachment) {
                    if (is_string($attachment) && is_file($attachment)) {
                        $message->attach($attachment);
                    }
                }
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Enquiry email failed', [
                'to' => $to,
                'subject' => $subject,
                'view' => $view,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * @param  array{reply_to?: string, attachments?: string[]}  $options
     */
    public static function send(string $to, string $subject, string $html, array $options = []): bool
    {
        $replyTo = isset($options['reply_to']) ? $options['reply_to'] : null;
        $attachments = isset($options['attachments']) ? $options['attachments'] : [];

        try {
            Mail::send([], [], function ($message) use ($to, $subject, $html, $replyTo, $attachments) {
                $message->to($to)->subject($subject);
                $message->setBody($html, 'text/html');

                if ($replyTo) {
                    $message->replyTo($replyTo);
                }

                foreach ($attachments as $attachment) {
                    if (is_string($attachment) && is_file($attachment)) {
                        $message->attach($attachment);
                    }
                }
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Enquiry email failed', [
                'to' => $to,
                'subject' => $subject,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
