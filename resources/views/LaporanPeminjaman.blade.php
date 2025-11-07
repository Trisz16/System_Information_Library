<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Peminjaman') }}
            </h2>
            <div class="flex space-x-2">
                <button id="export-pdf" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Export PDF
                </button>
                <button id="export-excel" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Export Excel
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                            <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option>Semua Status</option>
                                <option>Aktif</option>
                                <option>Dikembalikan</option>
                                <option>Terlambat</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total Peminjaman</div>
                                <div class="text-2xl font-bold text-gray-900">1,247</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Dikembalikan</div>
                                <div class="text-2xl font-bold text-gray-900">1,089</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Aktif</div>
                                <div class="text-2xl font-bold text-gray-900">158</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Terlambat</div>
                                <div class="text-2xl font-bold text-gray-900">23</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Loan Status Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status Peminjaman</h3>
                        <canvas id="loanStatusChart" width="400" height="300"></canvas>
                    </div>
                </div>

                <!-- Monthly Loans Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Peminjaman Bulanan</h3>
                        <canvas id="monthlyLoansChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Report Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Peminjaman</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Report Row 1 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">L-2023-001</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">John Doe</div>
                                    <div class="text-sm text-gray-500">LIB-2023-001</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Laravel for Beginners</div>
                                    <div class="text-sm text-gray-500">978-1234567890</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15 Nov 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">29 Nov 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Dikembalikan</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                            </tr>

                            <!-- Report Row 2 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">L-2023-002</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Jane Smith</div>
                                    <div class="text-sm text-gray-500">LIB-2023-002</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">PHP Advanced Techniques</div>
                                    <div class="text-sm text-gray-500">978-0987654321</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">10 Nov 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">24 Nov 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Terlambat</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-medium">Rp 15.000</td>
                            </tr>

                            <!-- Report Row 3 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">L-2023-003</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Mike Johnson</div>
                                    <div class="text-sm text-gray-500">LIB-2023-003</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">The Great Gatsby</div>
                                    <div class="text-sm text-gray-500">978-0743273565</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">05 Nov 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">19 Nov 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Dikembalikan</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                            </tr>

                            <!-- Report Row 4 -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">L-2023-004</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Sarah Brown</div>
                                    <div class="text-sm text-gray-500">LIB-2023-004</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">JavaScript Essentials</div>
                                    <div class="text-sm text-gray-500">978-1122334455</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">20 Nov 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">04 Dec 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
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
                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">1,247</span> results
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
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">125</a>
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

    <!-- Scripts for Charts and Export -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        // Loan Status Chart
        const loanStatusCtx = document.getElementById('loanStatusChart').getContext('2d');
        const loanStatusChart = new Chart(loanStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Dikembalikan', 'Aktif', 'Terlambat'],
                datasets: [{
                    data: [1089, 158, 23],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(251, 191, 36, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Monthly Loans Chart
        const monthlyLoansCtx = document.getElementById('monthlyLoansChart').getContext('2d');
        const monthlyLoansChart = new Chart(monthlyLoansCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Peminjaman',
                    data: [85, 92, 78, 105, 120, 98, 110, 135, 125, 140, 158, 165],
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Export to PDF
        document.getElementById('export-pdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Set up colors and fonts
            const primaryColor = [59, 130, 246]; // Blue
            const secondaryColor = [107, 114, 128]; // Gray
            const accentColor = [34, 197, 94]; // Green

            // Header - Library Information
            doc.setFontSize(24);
            doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
            doc.text('PERPUSTAKAAN AZFAKUN', 105, 25, { align: 'center' });

            doc.setFontSize(12);
            doc.setTextColor(secondaryColor[0], secondaryColor[1], secondaryColor[2]);
            doc.text('Jl. Aladin, No. 777, Kota Atlantis', 105, 35, { align: 'center' });
            doc.text('Telp: (021) 12345678 | Email: info@azfakun.library.id', 105, 42, { align: 'center' });

            // Report Title
            doc.setFontSize(18);
            doc.setTextColor(0, 0, 0);
            doc.text('LAPORAN PEMINJAMAN BUKU', 105, 60, { align: 'center' });

            // Report Date
            const today = new Date();
            const dateStr = today.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            doc.setFontSize(10);
            doc.setTextColor(secondaryColor[0], secondaryColor[1], secondaryColor[2]);
            doc.text(`Tanggal: ${dateStr}`, 20, 75);

            // Statistics Section
            doc.setFontSize(14);
            doc.setTextColor(0, 0, 0);
            doc.text('RINGKASAN STATISTIK', 20, 90);

            // Statistics Box
            doc.setDrawColor(200, 200, 200);
            doc.setFillColor(248, 250, 252);
            doc.rect(20, 95, 170, 35, 'FD');

            doc.setFontSize(10);
            doc.setTextColor(0, 0, 0);
            doc.text('Total Peminjaman', 25, 108);
            doc.setTextColor(accentColor[0], accentColor[1], accentColor[2]);
            doc.text('1,247', 25, 115);

            doc.setTextColor(0, 0, 0);
            doc.text('Dikembalikan', 65, 108);
            doc.setTextColor(34, 197, 94);
            doc.text('1,089', 65, 115);

            doc.setTextColor(0, 0, 0);
            doc.text('Aktif', 105, 108);
            doc.setTextColor(251, 191, 36);
            doc.text('158', 105, 115);

            doc.setTextColor(0, 0, 0);
            doc.text('Terlambat', 145, 108);
            doc.setTextColor(239, 68, 68);
            doc.text('23', 145, 115);

            // Table Section
            doc.setFontSize(14);
            doc.setTextColor(0, 0, 0);
            doc.text('DETAIL PEMINJAMAN', 20, 150);

            // Table Header
            let yPosition = 160;
            doc.setFillColor(59, 130, 246);
            doc.rect(20, yPosition - 5, 170, 8, 'F');

            doc.setTextColor(255, 255, 255);
            doc.setFontSize(9);
            const headers = ['ID Peminjaman', 'Anggota', 'Buku', 'Tgl Pinjam', 'Tgl Kembali', 'Status'];
            const colWidths = [25, 35, 45, 25, 25, 25];
            let xPos = 20;

            headers.forEach((header, index) => {
                doc.text(header, xPos + 2, yPosition);
                xPos += colWidths[index];
            });

            yPosition += 10;

            // Table Data
            doc.setTextColor(0, 0, 0);
            doc.setFontSize(8);

            const tableData = [
                ['L-2023-001', 'John Doe', 'Laravel for Beginners', '15 Nov 2023', '29 Nov 2023', 'Dikembalikan'],
                ['L-2023-002', 'Jane Smith', 'PHP Advanced Tech.', '10 Nov 2023', '24 Nov 2023', 'Terlambat'],
                ['L-2023-003', 'Mike Johnson', 'The Great Gatsby', '05 Nov 2023', '19 Nov 2023', 'Dikembalikan'],
                ['L-2023-004', 'Sarah Brown', 'JavaScript Essentials', '20 Nov 2023', '04 Dec 2023', 'Aktif']
            ];

            tableData.forEach((row, rowIndex) => {
                // Alternate row colors
                if (rowIndex % 2 === 0) {
                    doc.setFillColor(248, 250, 252);
                    doc.rect(20, yPosition - 4, 170, 6, 'F');
                }

                xPos = 20;
                row.forEach((cell, index) => {
                    // Truncate long text
                    let displayText = cell;
                    if (cell.length > 15 && index === 2) { // Book title
                        displayText = cell.substring(0, 15) + '...';
                    }
                    doc.text(displayText, xPos + 2, yPosition);
                    xPos += colWidths[index];
                });
                yPosition += 6;
            });

            // Footer
            doc.setFontSize(8);
            doc.setTextColor(secondaryColor[0], secondaryColor[1], secondaryColor[2]);
            doc.text('Dokumen ini dihasilkan secara otomatis oleh Sistem Informasi Perpustakaan Azfakun', 20, 280);
            doc.text('© 2023 Perpustakaan Azfakun - Semua hak dilindungi undang-undang', 20, 285);

            // Save the PDF
            doc.save(`laporan_peminjaman_${dateStr.replace(/\s/g, '_')}.pdf`);
        });

        // Export to Excel
        document.getElementById('export-excel').addEventListener('click', function() {
            // Create workbook
            const wb = XLSX.utils.book_new();

            // Create info sheet
            const infoData = [
                ['PERPUSTAKAAN AZFAKUN'],
                ['Jl. Aladin, No. 777, Kota Atlantis'],
                ['Telp: (021) 12345678 | Email: info@azfakun.library.id'],
                [''],
                ['LAPORAN PEMINJAMAN BUKU'],
                [`Tanggal: ${new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}`],
                [''],
                ['RINGKASAN STATISTIK'],
                ['Total Peminjaman', '1,247'],
                ['Dikembalikan', '1,089'],
                ['Aktif', '158'],
                ['Terlambat', '23'],
                [''],
                ['DETAIL PEMINJAMAN']
            ];

            const infoWs = XLSX.utils.aoa_to_sheet(infoData);

            // Style the header rows
            if (!infoWs['!merges']) infoWs['!merges'] = [];
            infoWs['!merges'].push({s: {r: 0, c: 0}, e: {r: 0, c: 1}}); // Merge library name
            infoWs['!merges'].push({s: {r: 1, c: 0}, e: {r: 1, c: 1}}); // Merge address
            infoWs['!merges'].push({s: {r: 2, c: 0}, e: {r: 2, c: 1}}); // Merge contact
            infoWs['!merges'].push({s: {r: 4, c: 0}, e: {r: 4, c: 1}}); // Merge report title
            infoWs['!merges'].push({s: {r: 5, c: 0}, e: {r: 5, c: 1}}); // Merge date
            infoWs['!merges'].push({s: {r: 7, c: 0}, e: {r: 7, c: 1}}); // Merge statistics title
            infoWs['!merges'].push({s: {r: 12, c: 0}, e: {r: 12, c: 1}}); // Merge detail title

            // Set column widths for info sheet
            infoWs['!cols'] = [
                {wch: 30}, // Column A
                {wch: 20}  // Column B
            ];

            // Create data sheet with detailed loan information
            const data = [
                ['ID Peminjaman', 'ID Anggota', 'Nama Anggota', 'Email Anggota', 'ISBN Buku', 'Judul Buku', 'Kategori Buku', 'Pengarang', 'Penerbit', 'Tahun Terbit', 'Tanggal Pinjam', 'Tanggal Harus Kembali', 'Tanggal Dikembalikan', 'Durasi Pinjam (hari)', 'Status', 'Denda', 'Petugas', 'Catatan'],
                ['L-2023-001', 'LIB-2023-001', 'John Doe', 'john.doe@email.com', '978-1234567890', 'Laravel for Beginners', 'Programming', 'John Smith', 'Tech Books Inc', '2022', '15 Nov 2023', '29 Nov 2023', '29 Nov 2023', '14', 'Dikembalikan', '-', 'Admin User', 'Buku dalam kondisi baik'],
                ['L-2023-002', 'LIB-2023-002', 'Jane Smith', 'jane.smith@email.com', '978-0987654321', 'PHP Advanced Techniques', 'Programming', 'Jane Developer', 'Code Masters', '2021', '10 Nov 2023', '24 Nov 2023', '26 Nov 2023', '16', 'Terlambat', 'Rp 15.000', 'Librarian Bob', 'Terlambat 2 hari'],
                ['L-2023-003', 'LIB-2023-003', 'Mike Johnson', 'mike.johnson@email.com', '978-0743273565', 'The Great Gatsby', 'Fiction', 'F. Scott Fitzgerald', 'Scribner', '1925', '05 Nov 2023', '19 Nov 2023', '19 Nov 2023', '14', 'Dikembalikan', '-', 'Staff Charlie', 'Buku klasik'],
                ['L-2023-004', 'LIB-2023-004', 'Sarah Brown', 'sarah.brown@email.com', '978-1122334455', 'JavaScript Essentials', 'Programming', 'Sarah Wilson', 'JS Press', '2023', '20 Nov 2023', '04 Dec 2023', '-', '14', 'Aktif', '-', 'Admin User', 'Peminjaman aktif']
            ];

            const dataWs = XLSX.utils.aoa_to_sheet(data);

            // Set column widths for detailed data sheet
            dataWs['!cols'] = [
                {wch: 15}, // ID Peminjaman
                {wch: 15}, // ID Anggota
                {wch: 20}, // Nama Anggota
                {wch: 25}, // Email Anggota
                {wch: 15}, // ISBN Buku
                {wch: 30}, // Judul Buku
                {wch: 15}, // Kategori Buku
                {wch: 20}, // Pengarang
                {wch: 20}, // Penerbit
                {wch: 12}, // Tahun Terbit
                {wch: 15}, // Tanggal Pinjam
                {wch: 18}, // Tanggal Harus Kembali
                {wch: 15}, // Tanggal Dikembalikan
                {wch: 18}, // Durasi Pinjam
                {wch: 12}, // Status
                {wch: 12}, // Denda
                {wch: 15}, // Petugas
                {wch: 25}  // Catatan
            ];

            // Add worksheets to workbook
            XLSX.utils.book_append_sheet(wb, infoWs, 'Info & Statistik');
            XLSX.utils.book_append_sheet(wb, dataWs, 'Data Peminjaman');

            // Save the file
            const dateStr = new Date().toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }).replace(/\s/g, '_');
            XLSX.writeFile(wb, `laporan_peminjaman_azfakun_${dateStr}.xlsx`);
        });
    </script>
</x-app-layout>
