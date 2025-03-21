<?php

namespace App\Enums;

enum SubscriptionState: string
{
    case SUBSCRIBED = 'subscribed';
    case SUBSCRIBED_UNVERIFIED = 'subscribed_unverified';
    case EXISTING = 'existing';
    case EXISTING_UNVERIFIED = 'existing_unverified';

    public function getMessage(): string
    {
        $verify_msg = 'Please verify your email address by clicking on the link we just emailed to you.';
        $visit_msg = 'Visit your dashboard to manage subscriptions.';

        return match ($this) {
            self::SUBSCRIBED => "Successfully subscribed to the listing. {$visit_msg}",
            self::SUBSCRIBED_UNVERIFIED => "Successfully subscribed to the listing. {$verify_msg}",
            self::EXISTING => "This email is already subscribed to the listing. {$visit_msg}",
            self::EXISTING_UNVERIFIED => "This email is already subscribed to the listing. {$verify_msg}",
        };
    }
}
