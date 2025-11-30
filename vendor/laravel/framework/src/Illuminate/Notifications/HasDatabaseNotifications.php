<?php

namespace Illuminate\Notifications;

trait HasDatabaseNotifications
{
    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<DatabaseNotification, $this>
     */
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->latest();
    }

    /**
     * Get the entity's read notifications.
     *
<<<<<<< HEAD
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<DatabaseNotification, $this>
=======
     * @return \Illuminate\Database\Query\Builder
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     */
    public function readNotifications()
    {
        return $this->notifications()->read();
    }

    /**
     * Get the entity's unread notifications.
     *
<<<<<<< HEAD
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<DatabaseNotification, $this>
=======
     * @return \Illuminate\Database\Query\Builder
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     */
    public function unreadNotifications()
    {
        return $this->notifications()->unread();
    }
}
