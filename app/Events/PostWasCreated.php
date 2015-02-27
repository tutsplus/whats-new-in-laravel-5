<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class PostWasCreated extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($post)
	{
        $this->post = $post;
        $this->timestamp = \Carbon\Carbon::now();
	}

}
