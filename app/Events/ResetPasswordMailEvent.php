<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ResetPasswordMailEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}
