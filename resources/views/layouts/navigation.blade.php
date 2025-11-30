<nav class="sticky top-0 z-40 bg-white/95 backdrop-blur-sm border-b border-secondary-200 shadow-soft">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Hamburger -->
            <div class="flex items-center lg:hidden">
                <button @click.stop="sidebarOpen = !sidebarOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Spacer to push dropdown to the right -->
            <div class="flex-1"></div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 relative">
                <x-dropdown align="right" width="48" class="z-50">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.notification')" class="flex items-center justify-between">
                            <span>{{ __('Notifications') }}</span>
                            @if(Auth::user()->notifications()->unread()->count() > 0)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white">
                                    {{ Auth::user()->notifications()->unread()->count() }}
                                </span>
                            @endif
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('chat.index')" class="flex items-center justify-between">
                            <span>{{ __('Chat & Support') }}</span>
                            @php
                                $unreadChats = 0;
                                if (Auth::user()->isMahasiswa()) {
                                    $unreadChats = \App\Models\Chat::where('student_id', Auth::id())
                                        ->whereHas('messages', function($query) {
                                            $query->where('sender_id', '!=', Auth::id())->where('is_read', false);
                                        })->count();
                                } elseif (Auth::user()->isAdminOrStaff()) {
                                    $unreadChats = \App\Models\Chat::where('admin_staff_id', Auth::id())
                                        ->where('type', 'admin_chat')
                                        ->whereHas('messages', function($query) {
                                            $query->where('sender_id', '!=', Auth::id())->where('is_read', false);
                                        })->count();
                                }
                            @endphp
                            @if($unreadChats > 0)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-500 text-white">
                                    {{ $unreadChats }}
                                </span>
                            @endif
                        </x-dropdown-link>

                        @if(Auth::user()->isMahasiswa())
                        <x-dropdown-link :href="route('chat.ai-assistant')" class="flex items-center">
                            <i class="fas fa-robot mr-2"></i>
                            <span>{{ __('AI Assistant') }}</span>
                        </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for mobile view of settings -->
            <div class="-me-2 flex items-center sm:hidden relative">
                <x-dropdown align="right" width="48" class="z-50">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-lg"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="pt-2 pb-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('profile.notification')" class="flex items-center justify-between">
                                <span>{{ __('Notifications') }}</span>
                                @if(Auth::user()->notifications()->unread()->count() > 0)
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white">
                                        {{ Auth::user()->notifications()->unread()->count() }}
                                    </span>
                                @endif
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('chat.index')" class="flex items-center justify-between">
                                <span>{{ __('Chat & Support') }}</span>
                                @php
                                    $unreadChats = 0;
                                    if (Auth::user()->isMahasiswa()) {
                                        $unreadChats = \App\Models\Chat::where('student_id', Auth::id())
                                            ->whereHas('messages', function($query) {
                                                $query->where('sender_id', '!=', Auth::id())->where('is_read', false);
                                            })->count();
                                    } elseif (Auth::user()->isAdminOrStaff()) {
                                        $unreadChats = \App\Models\Chat::where('admin_staff_id', Auth::id())
                                            ->where('type', 'admin_chat')
                                            ->whereHas('messages', function($query) {
                                                $query->where('sender_id', '!=', Auth::id())->where('is_read', false);
                                            })->count();
                                    }
                                @endphp
                                @if($unreadChats > 0)
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-500 text-white">
                                        {{ $unreadChats }}
                                    </span>
                                @endif
                            </x-responsive-nav-link>

                            @if(Auth::user()->isMahasiswa())
                            <x-responsive-nav-link :href="route('chat.ai-assistant')" class="flex items-center">
                                <i class="fas fa-robot mr-2"></i>
                                <span>{{ __('AI Assistant') }}</span>
                            </x-responsive-nav-link>
                            @endif
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                <div class="font-medium text-sm text-blue-600">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>