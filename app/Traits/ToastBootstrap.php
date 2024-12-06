<?php

namespace App\Traits;

use Livewire\Features\SupportEvents\Event;
use function Livewire\store;

trait ToastBootstrap{

    protected array $payload = [
        'toast' => true,
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

    public function confirmToastBootstrap($confirmed = null, $options = []): void
    {
        $this->payload['toast'] = false;
        $this->payload['type'] = 'warning';
        if (!empty($confirmed)){
            $this->payload['confirmed'] = $confirmed;
        }
        $this->getOptions($options);
        $this->show('toastBootstrap', $this->payload);
    }

    public function htmlToastBoostrap($confirmed = null, $options = []): void
    {
        if (empty($options['message'])){
            $options['message'] = '
            <div class="row">
                <div class="col-12 p-2">
                    <div class="small-box" style="box-shadow: none; min-height: 40px;">
                        <div class="overlay bg-light">
                            <i class="far fa-4x fa-lightbulb opacity-75 text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-justify">
                    El registro que intenta borrar ya se encuentra vinculado con otros procesos.
                </div>
            </div>
        ';
        }

        if (empty($options['type'])){
            $options['type'] = 'info';
        }

        $this->confirmToastBootstrap($confirmed, $options);

    }

    public function flashBootstrap($type = 'success', $message = "", $options = []): void
    {
        $this->payload['type'] = $type;
        if (!empty($message)) {
            $this->payload['message'] = $message;
        }
        $this->getOptions($options);
        session()->flash('toastBootstrap-flash', $this->payload);
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
