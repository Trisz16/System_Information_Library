<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Manajemen Anggota') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola data anggota perpustakaan Azfakun</p>
            </div>
            <button id="addMemberBtn" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-widest hover:from-blue-700 hover:to-blue-800 focus:from-blue-700 focus:to-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Tambah Anggota Baru
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">Daftar Anggota</h3>
                            <p class="text-sm text-gray-600">Kelola data anggota perpustakaan</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative">
                                <input type="text" placeholder="Cari anggota..." class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option>Semua Status</option>
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                                <option>Diblokir</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Anggota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Member 1 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-blue-600">JD</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">John Doe</div>
                                            <div class="text-sm text-gray-500">Mahasiswa</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">LIB-2023-001</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">john.doe@email.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">+62 812-3456-7890</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15 Jan 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button class="edit-member-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-member-id="1">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="delete-member-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-member-id="1">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Member 2 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-green-600">JS</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                            <div class="text-sm text-gray-500">Dosen</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">LIB-2023-002</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">jane.smith@email.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">+62 811-2345-6789</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">22 Feb 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button class="edit-member-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-member-id="2">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="delete-member-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-member-id="2">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Member 3 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-purple-600">MJ</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Mike Johnson</div>
                                            <div class="text-sm text-gray-500">Mahasiswa</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">LIB-2023-003</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">mike.johnson@email.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">+62 813-4567-8901</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">10 Mar 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Tidak Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button class="edit-member-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-member-id="3">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="delete-member-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-member-id="3">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Member 4 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-red-600">SB</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Sarah Brown</div>
                                            <div class="text-sm text-gray-500">Staff</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">LIB-2023-004</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">sarah.brown@email.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">+62 814-5678-9012</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">05 Apr 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Diblokir</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button class="edit-member-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-member-id="4">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="delete-member-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-member-id="4">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Modal for Add/Edit Member -->
                <div id="memberModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
                        <div class="mt-3">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold text-gray-900" id="memberModalTitle">Tambah Anggota Baru</h3>
                                <button id="closeMemberModalBtn" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <form id="memberForm">
                                @csrf
                                <input type="hidden" id="memberId" name="member_id">

                                <div class="space-y-4">
                                    <div>
                                        <label for="memberName" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                                        <input type="text" id="memberName" name="name" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="Masukkan nama lengkap">
                                    </div>

                                    <div>
                                        <label for="memberEmail" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                        <input type="email" id="memberEmail" name="email" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="Masukkan email">
                                    </div>

                                    <div>
                                        <label for="memberPhone" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                        <input type="tel" id="memberPhone" name="phone"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="Masukkan nomor telepon">
                                    </div>

                                    <div>
                                        <label for="memberRole" class="block text-sm font-medium text-gray-700 mb-1">Peran</label>
                                        <select id="memberRole" name="role"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                            <option value="Mahasiswa">Mahasiswa</option>
                                            <option value="Dosen">Dosen</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Umum">Umum</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="memberStatus" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                        <select id="memberStatus" name="status"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                            <option value="Diblokir">Diblokir</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-3 mt-8">
                                    <button type="button" id="cancelMemberBtn"
                                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                                        Batal
                                    </button>
                                    <button type="submit"
                                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <span id="memberSubmitText">Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteMemberModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
                        <div class="mt-3 text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Anggota</h3>
                            <p class="text-sm text-gray-500 mb-6">
                                Apakah Anda yakin ingin menghapus anggota "<span id="deleteMemberName"></span>"? Tindakan ini tidak dapat dibatalkan.
                            </p>
                            <div class="flex justify-center space-x-3">
                                <button id="cancelDeleteMemberBtn"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                                    Batal
                                </button>
                                <button id="confirmDeleteMemberBtn"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal functionality
        const memberModal = document.getElementById('memberModal');
        const deleteMemberModal = document.getElementById('deleteMemberModal');
        const addMemberBtn = document.getElementById('addMemberBtn');
        const closeMemberModalBtn = document.getElementById('closeMemberModalBtn');
        const cancelMemberBtn = document.getElementById('cancelMemberBtn');
        const cancelDeleteMemberBtn = document.getElementById('cancelDeleteMemberBtn');
        const confirmDeleteMemberBtn = document.getElementById('confirmDeleteMemberBtn');
        const memberForm = document.getElementById('memberForm');

        // Open add member modal
        addMemberBtn.addEventListener('click', () => {
            document.getElementById('memberModalTitle').textContent = 'Tambah Anggota Baru';
            document.getElementById('memberSubmitText').textContent = 'Simpan';
            memberForm.reset();
            document.getElementById('memberId').value = '';
            memberModal.classList.remove('hidden');
        });

        // Close modals
        [closeMemberModalBtn, cancelMemberBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                memberModal.classList.add('hidden');
            });
        });

        cancelDeleteMemberBtn.addEventListener('click', () => {
            deleteMemberModal.classList.add('hidden');
        });

        // Edit member functionality
        document.querySelectorAll('.edit-member-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const memberId = e.target.closest('.edit-member-btn').dataset.memberId;
                // Here you would typically fetch member data from server
                // For demo purposes, we'll populate with sample data
                document.getElementById('memberModalTitle').textContent = 'Edit Anggota';
                document.getElementById('memberSubmitText').textContent = 'Update';
                document.getElementById('memberId').value = memberId;

                // Sample data - replace with actual data fetching
                if (memberId === '1') {
                    document.getElementById('memberName').value = 'John Doe';
                    document.getElementById('memberEmail').value = 'john.doe@email.com';
                    document.getElementById('memberPhone').value = '+62 812-3456-7890';
                    document.getElementById('memberRole').value = 'Mahasiswa';
                    document.getElementById('memberStatus').value = 'Aktif';
                } else if (memberId === '2') {
                    document.getElementById('memberName').value = 'Jane Smith';
                    document.getElementById('memberEmail').value = 'jane.smith@email.com';
                    document.getElementById('memberPhone').value = '+62 811-2345-6789';
                    document.getElementById('memberRole').value = 'Dosen';
                    document.getElementById('memberStatus').value = 'Aktif';
                }

                memberModal.classList.remove('hidden');
            });
        });

        // Delete member functionality
        document.querySelectorAll('.delete-member-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const memberId = e.target.closest('.delete-member-btn').dataset.memberId;
                const memberName = e.target.closest('tr').querySelector('td:nth-child(1) .text-sm.font-medium.text-gray-900').textContent;
                document.getElementById('deleteMemberName').textContent = memberName;
                confirmDeleteMemberBtn.dataset.memberId = memberId;
                deleteMemberModal.classList.remove('hidden');
            });
        });

        // Confirm delete
        confirmDeleteMemberBtn.addEventListener('click', () => {
            const memberId = confirmDeleteMemberBtn.dataset.memberId;
            // Here you would send delete request to server
            alert(`Anggota dengan ID ${memberId} telah dihapus`);
            deleteMemberModal.classList.add('hidden');
            // Refresh page or update grid
            location.reload();
        });

        // Form submission
        memberForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(memberForm);
            const memberId = document.getElementById('memberId').value;

            // Here you would send the form data to your Laravel backend
            // For demo purposes, we'll just show an alert
            if (memberId) {
                alert('Anggota berhasil diupdate!');
            } else {
                alert('Anggota berhasil ditambahkan!');
            }

            memberModal.classList.add('hidden');
            // Refresh page or update grid
            location.reload();
        });

        // Close modal when clicking outside
        [memberModal, deleteMemberModal].forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">156</span> results
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
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">15</a>
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
</x-app-layout>
