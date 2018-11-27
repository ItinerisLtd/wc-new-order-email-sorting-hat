# wc-new-order-email-sorting-hat

[![Packagist Version](https://img.shields.io/packagist/v/itinerisltd/wc-new-order-email-sorting-hat.svg)](https://packagist.org/packages/itinerisltd/wc-new-order-email-sorting-hat)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/itinerisltd/wc-new-order-email-sorting-hat.svg)](https://packagist.org/packages/itinerisltd/wc-new-order-email-sorting-hat)
[![Packagist Downloads](https://img.shields.io/packagist/dt/itinerisltd/wc-new-order-email-sorting-hat.svg)](https://packagist.org/packages/itinerisltd/wc-new-order-email-sorting-hat)
[![GitHub License](https://img.shields.io/github/license/itinerisltd/wc-new-order-email-sorting-hat.svg)](https://github.com/ItinerisLtd/wc-new-order-email-sorting-hat/blob/master/LICENSE)
[![Hire Itineris](https://img.shields.io/badge/Hire-Itineris-ff69b4.svg)](https://www.itineris.co.uk/contact/)

Send new order emails to different recipients according to product types.

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->


- [Minimum Requirements](#minimum-requirements)
- [Installation](#installation)
- [Usage](#usage)
- [FAQ](#faq)
  - [Will you add support for older PHP versions?](#will-you-add-support-for-older-php-versions)
  - [It looks awesome. Where can I find some more goodies like this?](#it-looks-awesome-where-can-i-find-some-more-goodies-like-this)
  - [This plugin isn't on wp.org. Where can I give a ⭐️⭐️⭐️⭐️⭐️ review?](#this-plugin-isnt-on-wporg-where-can-i-give-a-%EF%B8%8F%EF%B8%8F%EF%B8%8F%EF%B8%8F%EF%B8%8F-review)
- [Feedback](#feedback)
- [Change Log](#change-log)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Minimum Requirements

- PHP v7.2
- WordPress v4.9.8
- WooCommerce v3.5.1
- *Optional* [Event Tickets](https://wordpress.org/plugins/event-tickets/) v4.8.2.1

## Installation

```bash
$ composer require itinerisltd/wc-new-order-email-sorting-hat
```

## Usage

Enable `Enable new order email notification` on **WooCommerce** » **Emails** » **New Order** » **Manage**

Define your notifiers: 

```php
// This is an example!
add_filter('wc_new_order_email_sorting_hat_notifiers', function (array $notifiers): array {
    return array_merge([
        new SpecificEventTicketNotifier(
            'new_order_email_refinery_course_event_ticket_recipients',
            __('Course Event Ticket Recipient(s)', 'fabric'),
            'course'
        ),
        new EventTicketNotifier(),
    ], $notifiers);
});
```

Enter comma-separated recipients lists on **WooCommerce** » **Emails** » **New Order Email Sorting Hat** 

## FAQ

### Will you add support for older PHP versions?

Never! This plugin will only works on [actively supported PHP versions](https://secure.php.net/supported-versions.php).

Don't use it on **end of life** or **security fixes only** PHP versions.

### It looks awesome. Where can I find some more goodies like this?

- Articles on [Itineris' blog](https://www.itineris.co.uk/blog/)
- More projects on [Itineris' GitHub profile](https://github.com/itinerisltd)
- Follow [@itineris_ltd](https://twitter.com/itineris_ltd) and [@TangRufus](https://twitter.com/tangrufus) on Twitter
- Hire [Itineris](https://www.itineris.co.uk/services/) to build your next awesome site

### This plugin isn't on wp.org. Where can I give a ⭐️⭐️⭐️⭐️⭐️ review?

Thanks! Glad you like it. It's important to make my boss know somebody is using this project. Instead of giving reviews on wp.org, consider:

- tweet something good with mentioning [@itineris_ltd](https://twitter.com/itineris_ltd)
- star this [Github repo](https://github.com/ItinerisLtd/wc-new-order-email-sorting-hat)
- watch this [Github repo](https://github.com/ItinerisLtd/wc-new-order-email-sorting-hat)
- write blog posts
- submit pull requests
- [hire Itineris](https://www.itineris.co.uk/services/)

## Feedback

**Please provide feedback!** We want to make this library useful in as many projects as possible.
Please submit an [issue](https://github.com/ItinerisLtd/wc-new-order-email-sorting-hat/issues/new) and point out what you do and don't like, or fork the project and make suggestions.
**No issue is too small.**

## Change Log

Please see [CHANGELOG](./CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email [hello@itineris.co.uk](mailto:hello@itineris.co.uk) instead of using the issue tracker.

## Credits

[wc-new-order-email-sorting-hat](https://github.com/ItinerisLtd/wc-new-order-email-sorting-hat) is a [Itineris Limited](https://www.itineris.co.uk/) project created by [Tang Rufus](https://typist.tech).

## License

[wc-new-order-email-sorting-hat](https://github.com/ItinerisLtd/wc-new-order-email-sorting-hat) is released under the [MIT License](https://opensource.org/licenses/MIT).
