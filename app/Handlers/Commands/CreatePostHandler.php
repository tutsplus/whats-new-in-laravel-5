<?php namespace App\Handlers\Commands;

use App\Commands\CreatePost;

use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Contracts\Cache\Repository as Cache;

class CreatePostHandler {

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(Cache $cache)
	{
		$this->cache = $cache;
	}

	/**
	 * Handle the command.
	 *
	 * @param  CreatePost  $command
	 * @return void
	 */
	public function handle(CreatePost $command)
	{
        $posts   = $this->cache->get('posts', []);
        $posts[] = ['title' => $command->title, 'body' => $command->body];
        $this->cache->put('posts', $posts, 5);
	}

}
