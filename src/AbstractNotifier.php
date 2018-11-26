<?php
declare(strict_types=1);

namespace Itineris\WCNewOrderEmailSortingHat;

abstract class AbstractNotifier implements NotifierInterface
{
    public function getSettingFields(): array
    {
        return [
            'title' => $this->getOptionTitle(),
            'id' => $this->getOptionId(),
            'type' => 'email',
            'custom_attributes' => [
                'multiple' => 'multiple',
            ],
            'css' => 'min-width:300px;',
            'default' => $this->getOptionDefault(),
            'autoload' => false,
        ];
    }

    abstract protected function getOptionId(): string;

    abstract protected function getOptionTitle(): string;

    protected function getOptionDefault(): string
    {
        return (string) get_option('admin_email', '');
    }

    public function mergeRecipients(array $recipients): array
    {
        return array_merge($recipients, $this->getRecipients());
    }

    protected function getRecipients(): array
    {
        $recipients = array_map(function (string $recipient): string {
            return sanitize_email($recipient);
        }, explode(',', $this->getOption()));

        return array_filter($recipients);
    }

    protected function getOption(): string
    {
        return (string) get_option(
            $this->getOptionId(),
            ''
        );
    }
}
