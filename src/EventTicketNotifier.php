<?php

declare(strict_types=1);

namespace Itineris\WCNewOrderEmailSortingHat;

class EventTicketNotifier extends AbstractNotifier
{
    public function shouldNotify(int ...$productIds): bool
    {
        $first = array_first($productIds, function ($id): bool {
            $tribeWoo = tribe('tickets-plus.commerce.woo');
            $event = $tribeWoo->get_event_for_ticket($id);
            return is_a($event, 'WP_Post');
        });

        return null !== $first;
    }

    protected function getOptionId(): string
    {
        return 'new_order_email_refinery_event_ticket_recipients';
    }

    protected function getOptionTitle(): string
    {
        return __('Event Ticket Recipient(s)', 'wc-new-order-email-sorting-hat');
    }
}
