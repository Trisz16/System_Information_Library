<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications
     */
    public function index(Request $request)
    {
        $query = Notification::where('user_id', auth()->id());

        // Filter by type
        if ($request->has('type') && !empty($request->type)) {
            $query->ofType($request->type);
        }

        // Filter by status (read/unread)
        if ($request->has('status')) {
            if ($request->status === 'read') {
                $query->read();
            } elseif ($request->status === 'unread') {
                $query->unread();
            }
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('message', 'LIKE', "%{$search}%");
            });
        }

        $notifications = $query->latest()->paginate(10);

        // Statistics
        $totalNotifications = Notification::where('user_id', auth()->id())->count();
        $unreadNotifications = Notification::where('user_id', auth()->id())->unread()->count();
        $readNotifications = Notification::where('user_id', auth()->id())->read()->count();
        $todayNotifications = Notification::where('user_id', auth()->id())->whereDate('created_at', today())->count();

        return view('profile.notification', compact(
            'notifications',
            'totalNotifications',
            'unreadNotifications',
            'readNotifications',
            'todayNotifications'
        ));
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())->unread()->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete a notification
     */
    public function destroy($id)
    {
        $notification = Notification::where('user_id', auth()->id())->findOrFail($id);
        $notification->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Clear all notifications
     */
    public function clearAll()
    {
        Notification::where('user_id', auth()->id())->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Create a new notification
     */
    public static function create(array $data)
    {
        return Notification::create($data);
    }
}
