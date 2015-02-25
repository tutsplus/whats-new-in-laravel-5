<?php namespace App\Handlers\Events;

use App\Events\PostWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use Illuminate\Session\SessionManager;

class Celebrate {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(SessionManager $session)
	{
	    $this->session = $session;
	}

	/**
	 * Handle the event.
	 *
	 * @param  PostWasCreated  $event
	 * @return void
	 */
	public function onPostCreated(PostWasCreated $event)
	{
		$msg = "Post '{$event->post['title']}' was created at '{$event->timestamp}'";
        $this->session->flash('success', $msg);
	}

    public function subscribe($events)
    {
        $events->listen(PostWasCreated::class, static::class.'@onPostCreated');
    }

}
