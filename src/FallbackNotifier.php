<?php

declare(strict_types=1);

namespace Itineris\WCNewOrderEmailSortingHat;

class FallbackNotifier extends AbstractNotifier
{
    public function shouldNotify(int ...$productIds): bool
    {
        return true;
    }

    protected function getOptionId(): string
    {
        return 'new_order_email_refinery_fallback_recipients';
    }

    protected function getOptionTitle(): string
    {
        return __('Fallback Recipient(s)', 'wc-new-order-email-sorting-hat');
    }
}
