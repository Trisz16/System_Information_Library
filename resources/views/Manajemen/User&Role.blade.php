<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen User & Role') }}
            </h2>
            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
            <button id="addUserBtn" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Tambah User Baru
            </button>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">Daftar User & Role</h3>
                            <p class="text-sm text-gray-600">Kelola pengguna dan peran sistem perpustakaan</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative">
                                <input type="text" placeholder="Cari user..." class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option>Semua Role</option>
                                <option>Admin</option>
                                <option>Librarian</option>
                                <option>Staff</option>
                                <option>Member</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir Login</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- User 1 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-blue-600">AD</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Admin User</div>
                                            <div class="text-sm text-gray-500">Administrator</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">admin@library.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Admin</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2 jam yang lalu</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                                        <button class="edit-user-btn text-blue-600 hover:text-blue-900" data-user-id="1">Edit</button>
                                        <button class="delete-user-btn text-red-600 hover:text-red-900" data-user-id="1">Hapus</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- User 2 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-green-600">LB</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Librarian Bob</div>
                                            <div class="text-sm text-gray-500">Pustakawan</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">librarian@library.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Librarian</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1 hari yang lalu</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                                        <button class="edit-user-btn text-blue-600 hover:text-blue-900" data-user-id="2">Edit</button>
                                        <button class="delete-user-btn text-red-600 hover:text-red-900" data-user-id="2">Hapus</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- User 3 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-purple-600">SC</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Staff Charlie</div>
                                            <div class="text-sm text-gray-500">Staff Administrasi</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">staff@library.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Staff</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3 hari yang lalu</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                                        <button class="edit-user-btn text-blue-600 hover:text-blue-900" data-user-id="3">Edit</button>
                                        <button class="delete-user-btn text-red-600 hover:text-red-900" data-user-id="3">Hapus</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- User 4 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-red-600">MD</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Member David</div>
                                            <div class="text-sm text-gray-500">Anggota</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">member@library.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Member</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Tidak Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1 minggu yang lalu</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                                        <button class="edit-user-btn text-blue-600 hover:text-blue-900" data-user-id="4">Edit</button>
                                        <button class="delete-user-btn text-red-600 hover:text-red-900" data-user-id="4">Hapus</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">24</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 01-.001-1.414l4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</a>
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">6</a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 01.001 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add/Edit User -->
    <div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900" id="userModalTitle">Tambah User Baru</h3>
                    <button id="closeUserModalBtn" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="userForm">
                    @csrf
                    <input type="hidden" id="userId" name="user_id">

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                            <input type="password" id="password" name="password" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                            <select id="role" name="role" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-8">
                        <button type="button" id="cancelUserBtn"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <span id="userSubmitText">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus User</h3>
                <p class="text-sm text-gray-500 mb-6">
                    Apakah Anda yakin ingin menghapus user "<span id="deleteUserName"></span>"? Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-center space-x-3">
                    <button id="cancelDeleteUserBtn"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="confirmDeleteUserBtn"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal functionality
        const userModal = document.getElementById('userModal');
        const deleteUserModal = document.getElementById('deleteUserModal');
        const addUserBtn = document.getElementById('addUserBtn');
        const closeUserModalBtn = document.getElementById('closeUserModalBtn');
        const cancelUserBtn = document.getElementById('cancelUserBtn');
        const cancelDeleteUserBtn = document.getElementById('cancelDeleteUserBtn');
        const confirmDeleteUserBtn = document.getElementById('confirmDeleteUserBtn');
        const userForm = document.getElementById('userForm');

        // Open add user modal
        addUserBtn.addEventListener('click', () => {
            document.getElementById('userModalTitle').textContent = 'Tambah User Baru';
            document.getElementById('userSubmitText').textContent = 'Simpan';
            userForm.reset();
            document.getElementById('userId').value = '';
            userModal.classList.remove('hidden');
        });

        // Close modals
        [closeUserModalBtn, cancelUserBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                userModal.classList.add('hidden');
            });
        });

        cancelDeleteUserBtn.addEventListener('click', () => {
            deleteUserModal.classList.add('hidden');
        });

        // Edit user functionality
        document.querySelectorAll('.edit-user-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const userId = e.target.closest('.edit-user-btn').dataset.userId;
                // Here you would typically fetch user data from server
                // For demo purposes, we'll populate with sample data
                document.getElementById('userModalTitle').textContent = 'Edit User';
                document.getElementById('userSubmitText').textContent = 'Update';
                document.getElementById('userId').value = userId;

                // Sample data - replace with actual data fetching
                if (userId === '1') {
                    document.getElementById('name').value = 'Admin User';
                    document.getElementById('email').value = 'admin@library.com';
                    document.getElementById('role').value = 'admin';
                    document.getElementById('password').required = false;
                    document.getElementById('password_confirmation').required = false;
                } else if (userId === '2') {
                    document.getElementById('name').value = 'Librarian Bob';
                    document.getElementById('email').value = 'librarian@library.com';
                    document.getElementById('role').value = 'staff';
                    document.getElementById('password').required = false;
                    document.getElementById('password_confirmation').required = false;
                }

                userModal.classList.remove('hidden');
            });
        });

        // Delete user functionality
        document.querySelectorAll('.delete-user-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const userId = e.target.closest('.delete-user-btn').dataset.userId;
                const userName = e.target.closest('tr').querySelector('td:nth-child(2) .text-sm.font-medium.text-gray-900').textContent;
                document.getElementById('deleteUserName').textContent = userName;
                confirmDeleteUserBtn.dataset.userId = userId;
                deleteUserModal.classList.remove('hidden');
            });
        });

        // Confirm delete
        confirmDeleteUserBtn.addEventListener('click', () => {
            const userId = confirmDeleteUserBtn.dataset.userId;
            // Here you would send delete request to server
            alert(`User dengan ID ${userId} telah dihapus`);
            deleteUserModal.classList.add('hidden');
            // Refresh page or update table
            location.reload();
        });

        // Form submission
        userForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(userForm);
            const userId = document.getElementById('userId').value;

            // Here you would send the form data to your Laravel backend
            // For demo purposes, we'll just show an alert
            if (userId) {
                alert('User berhasil diupdate!');
            } else {
                alert('User berhasil ditambahkan!');
            }

            userModal.classList.add('hidden');
            // Refresh page or update table
            location.reload();
        });

        // Close modal when clicking outside
        [userModal, deleteUserModal].forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
