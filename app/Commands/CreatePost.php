<?php namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class CreatePost extends Command implements ShouldBeQueued {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($title, $body)
	{
        $this->title = $title;
        $this->body  = $body;
	}
}
