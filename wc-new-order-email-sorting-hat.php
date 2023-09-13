<?php
/**
 * Plugin Name:     WC New Order Email Sorting Hat
 * Plugin URI:      https://www.itineris.co.uk/
 * Description:     Send new order emails to different recipients according to product types
 * Version:         0.2.1
 * Author:          Itineris Limited
 * Author URI:      https://www.itineris.co.uk/
 * Text Domain:     wc-new-order-email-sorting-hat
 */
declare(strict_types=1);

namespace Itineris\WCNewOrderEmailSortingHat;

use Illuminate\Support\Arr;

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Order matters!
 *
 * @return NotifierInterface[]
 */
function getNotifications(): array
{
    return apply_filters('wc_new_order_email_sorting_hat_notifiers', [
        new FallbackNotifier(),
    ]);
}

add_filter('woocommerce_email_settings', function (array $settings): array {
    return array_merge(
        [
            [
                'title' => __('New Order Email Sorting Hat', 'wc-new-order-email-sorting-hat'),
                'type' => 'title',
                'id' => 'new_order_email_refinery',
            ],
        ],
        array_map(function (NotifierInterface $notification): array {
            return $notification->getSettingFields();
        }, getNotifications()),
        [
            [
                'type' => 'sectionend',
                'id'   => 'new_order_email_refinery',
            ],
        ],
        $settings
    );
});

/**
 * @todo Extract `NotifierCollection` class.
 */
add_filter('woocommerce_email_recipient_new_order', function ($recipient, $order) {
    if (! is_a($order, 'WC_Order')) {
        return $recipient;
    }

    /** @var \WC_Order $order */
    $productIds = array_map(function ($itemProduct) {
        /** @var \WC_Order_Item_Product $itemProduct */
        return $itemProduct->get_product_id();
    }, $order->get_items());

    $newRecipient = [];
    foreach ($productIds as $productId) {
        $notification = Arr::first(getNotifications(), function (NotifierInterface $notification) use ($productId): bool {
            return $notification->shouldNotify($productId);
        });

        if (null === $notification) {
            continue;
        }

        $newRecipient = $notification->mergeRecipients($newRecipient);
    }
    $newRecipient = array_unique($newRecipient);

    return empty($newRecipient)
        ? $recipient // Fail safe.
        : implode(',', $newRecipient);
}, 100, 2);
