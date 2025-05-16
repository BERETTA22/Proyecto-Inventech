<!-- Componente de Notificaciones -->
<nav x-data="notificationComponent()" x-init="fetchNotifications()">
    <script>
        function notificationComponent() {
            return {
                openNotifications: false,
                unreadCount: 0,
                notifications: [],

                async fetchNotifications() {
                    try {
                        let response = await fetch('/notificaciones');
                        let data = await response.json();
                        console.log(data);
                        this.notifications = data;
                        this.unreadCount = data.filter(n => !n.read).length;
                    } catch (error) {
                        console.error('Error al obtener notificaciones:', error);
                    }
                },

                async markAllAsRead() {
                    try {
                        let response = await fetch('/notificaciones/mark-all-as-read', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').content,
                                'Content-Type': 'application/json',
                            },
                        });

                        let data = await response.json();
                        if (data.success) {
                            this.notifications.forEach(notification => notification.read = true);
                            this.unreadCount = 0;
                        }
                    } catch (error) {
                        console.error('Error al marcar todas como leídas:', error);
                    }
                },

                async markAsRead(notificationId) {
                    try {
                        let response = await fetch(`/notificaciones/mark-as-read/${notificationId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').content,
                                'Content-Type': 'application/json',
                            },
                        });

                        let data = await response.json();
                        if (data.success) {
                            const notification = this.notifications.find(n => n.id === notificationId);
                            if (notification && !notification.read) {
                                notification.read = true;
                                this.unreadCount -= 1;
                            }
                        }
                    } catch (error) {
                        console.error('Error al marcar la notificación como leída:', error);
                    }
                }
            };
        }
    </script>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Enlace al Dashboard -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Sección Derecha (Notificaciones + Usuario) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Notificaciones -->
                <div class="relative">
                    <button @click="openNotifications = !openNotifications; fetchNotifications()" class="relative p-2">
                        <svg class="w-6 h-6 text-gray-600 hover:text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341A6.002 6.002 0 006 11v3c0 .386-.149.735-.405 1.005L4 17h5m6 0a3 3 0 11-6 0" />
                        </svg>
                        <span x-show="unreadCount > 0" class="absolute top-0 right-0 inline-block w-3 h-3 bg-red-600 border-2 border-white rounded-full"></span>
                    </button>

                    <!-- Dropdown de Notificaciones -->
                    <div x-show="openNotifications" @click.away="openNotifications = false" 
                        class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <div class="p-2 text-gray-700 font-semibold border-b flex justify-between items-center">
                            <span>Notificaciones</span>
                            <button @click="markAllAsRead()" class="text-blue-500 text-sm">Marcar todas como leídas</button>
                        </div>
                        <div class="p-2 space-y-2">
                            <template x-for="notification in notifications" :key="notification.id">
                                <div class="p-2 border-b">
                                <a :href="notification.data.url" @click="markAsRead(notification.id)" class="block p-2 border-b hover:bg-gray-100">
                                    <span x-text="notification.data.mensaje"></span>
                                    <span class="block text-xs text-gray-500" x-text="new Date(notification.created_at).toLocaleString()"></span>
                                    <button x-show="!notification.read" @click="markAsRead(notification.id)" class="text-blue-500 text-xs">Marcar como leída</button>
                                </div>
                            </template>

                            <div x-show="notifications.length === 0" class="text-center text-gray-500">No hay notificaciones</div>
                        </div>
                    </div>
                </div>

                <!-- Menú de Usuario -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Cerrar Sesión -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Salir') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

<!-- Cargar Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>