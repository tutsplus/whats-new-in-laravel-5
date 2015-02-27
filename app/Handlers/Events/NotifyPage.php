<?php namespace App\Handlers\Events;

use App\Events\PostWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Session\SessionManager as Session;

class NotifyPage {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	/**
	 * Handle the event.
	 *
	 * @param  PostWasCreated  $event
	 * @return void
	 */
	public function onPostCreation(PostWasCreated $event)
	{
		$msg = "Post '{$event->post['title']}' created at '{$event->timestamp}'";
        $this->session->flash('success', $msg);
	}

    public function subscribe($events)
    {
        $events->listen(PostWasCreated::class, static::class.'@onPostCreation');
    }
}
