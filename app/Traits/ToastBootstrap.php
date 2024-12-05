<?php

namespace App\Traits;

use Livewire\Features\SupportEvents\Event;
use function Livewire\store;

trait ToastBootstrap{

    protected array $payload = [
        'toast' => 'toast',
        'type' => 'success',
    ];

    public function toastBootstrap($type = 'success', $message = "", $options = []): void
    {
        $this->payload['type'] = $type;
        if (!empty($message)) {
            $this->payload['message'] = $message;
        }
        $this->getOptions($options);
        $this->show('toastBootstrap', $this->payload);

    }

    public function confirmToastBootstrap($confirmed, $options = []): void
    {
        $this->payload['toast'] = 'confirmToastBootstrap';
        $this->payload['type'] = 'warning';
        $this->payload['confirmed'] = $confirmed;
        $this->getOptions($options);
        $this->show('toastBootstrap', $this->payload);
    }

    protected function show($event, $params): Event
    {
        $event = new Event($event, $params);

        store($this)->push('dispatched', $event);

        return $event;
    }

    protected function getOptions(array $options): void
    {
        foreach ($options as $key => $value) {
            $this->payload[$key] = $value;
        }
    }

}
