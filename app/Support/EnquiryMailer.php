<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnquiryMailer
{
    /**
     * @return string[]
     */
    public static function normalizeRecipients($to): array
    {
        $list = is_array($to) ? $to : explode(',', (string) $to);

        return array_values(array_filter(array_map('trim', $list), function ($email) {
            return $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL);
        }));
    }

    /**
     * @return string[]
     */
    public static function adminEmails(): array
    {
        $emails = self::normalizeRecipients(config('mail.enquiry_to', 'sankalp@ycstech.in'));

        return $emails ?: ['sankalp@ycstech.in'];
    }

    public static function adminEmail(): string
    {
        return self::adminEmails()[0];
    }

    /**
     * @param  string|string[]  $to
     * @param  array{reply_to?: string, attachments?: string[]}  $options
     */
    public static function sendView(string $view, array $data, $to, string $subject, array $options = []): bool
    {
        $recipients = self::normalizeRecipients($to);
        if ($recipients === []) {
            Log::error('Enquiry email skipped — no valid recipients', ['subject' => $subject, 'view' => $view]);

            return false;
        }

        $replyTo = isset($options['reply_to']) ? $options['reply_to'] : null;
        $attachments = isset($options['attachments']) ? $options['attachments'] : [];

        try {
            Mail::send($view, $data, function ($message) use ($recipients, $subject, $replyTo, $attachments) {
                $message->to($recipients)->subject($subject);

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
                'to' => $recipients,
                'subject' => $subject,
                'view' => $view,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * @param  string|string[]  $to
     * @param  array{reply_to?: string, attachments?: string[]}  $options
     */
    public static function send(string $to, string $subject, string $html, array $options = []): bool
    {
        $recipients = self::normalizeRecipients($to);
        if ($recipients === []) {
            Log::error('Enquiry email skipped — no valid recipients', ['subject' => $subject]);

            return false;
        }

        $replyTo = isset($options['reply_to']) ? $options['reply_to'] : null;
        $attachments = isset($options['attachments']) ? $options['attachments'] : [];

        try {
            Mail::send([], [], function ($message) use ($recipients, $subject, $html, $replyTo, $attachments) {
                $message->to($recipients)->subject($subject);
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
                'to' => $recipients,
                'subject' => $subject,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
