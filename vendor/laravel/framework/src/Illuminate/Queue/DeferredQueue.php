<?php

namespace Illuminate\Queue;

<<<<<<< HEAD
=======
use Illuminate\Contracts\Queue\Job;

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
class DeferredQueue extends SyncQueue
{
    /**
     * Push a new job onto the queue.
     *
     * @param  string  $job
     * @param  mixed  $data
     * @param  string|null  $queue
     * @return mixed
     *
     * @throws \Throwable
     */
    public function push($job, $data = '', $queue = null)
    {
        return \Illuminate\Support\defer(fn () => parent::push($job, $data, $queue));
    }
}
