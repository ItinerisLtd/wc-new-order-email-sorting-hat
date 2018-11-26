<?php
declare(strict_types=1);

namespace Itineris\WCNewOrderEmailSortingHat;

interface NotifierInterface
{
    public function getSettingFields(): array;

    public function shouldNotify(int ...$productIds): bool;

    public function mergeRecipient(array $recipients): array;
}
