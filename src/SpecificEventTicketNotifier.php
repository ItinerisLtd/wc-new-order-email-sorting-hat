<?php

declare(strict_types=1);

namespace Itineris\WCNewOrderEmailSortingHat;

use Illuminate\Support\Arr;

class SpecificEventTicketNotifier extends EventTicketNotifier
{
    /**
     * Option ID
     *
     * @var string
     */
    protected $optionId;

    /**
     * Option title
     *
     * @var string
     */
    protected $optionTitle;

    /**
     * Targeted post types
     *
     * @var string[]
     */
    protected $includePostTypes;

    public function __construct(string $optionId, string $optionTitle, string ...$includePostTypes)
    {
        $this->optionId = $optionId;
        $this->optionTitle = $optionTitle;
        $this->includePostTypes = $includePostTypes;
    }

    public function shouldNotify(int ...$productIds): bool
    {
        $first = Arr::first($productIds, function ($id): bool {
            $tribeWoo = tribe('tickets-plus.commerce.woo');
            $event = $tribeWoo->get_event_for_ticket($id);
            return is_a($event, 'WP_Post') &&
                in_array($event->post_type, $this->includePostTypes, true); // phpcs:ignore
        });

        return null !== $first;
    }

    protected function getOptionId(): string
    {
        return $this->optionId;
    }

    protected function getOptionTitle(): string
    {
        return $this->optionTitle;
    }
}
