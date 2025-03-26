<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Patient extends Model
{
	use Notifiable;

	protected $table = 'patients';

	public function routeNotificationForWhatsApp()
    {
        return preg_replace('/[^0-9]/', '', $this->phone);
    }

	
}
