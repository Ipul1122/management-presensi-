    @extends('components.layouts.admin.sidebar-and-navbar')

    @section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-4 md:p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-bell text-blue-600 mr-3"></i>Notifikasi
                    </h1>
                    <p class="text-gray-600">Kelola semua notifikasi sistem Anda</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="bg-white rounded-xl p-4 shadow-sm border">
                        <div class="flex items-center space-x-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600" id="totalNotifications">{{ $notifikasi->count() }}</div>
                                <div class="text-xs text-gray-500">Total</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600" id="selectedCount">0</div>
                                <div class="text-xs text-gray-500">Dipilih</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-4 rounded-xl shadow-lg transform animate-fadeIn" id="successAlert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-xl mr-3"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                    <button onclick="closeAlert('successAlert')" class="ml-auto text-white hover:text-green-200 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-gradient-to-r from-red-500 to-rose-500 text-white px-6 py-4 rounded-xl shadow-lg transform animate-fadeIn" id="errorAlert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-xl mr-3"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                    <button onclick="closeAlert('errorAlert')" class="ml-auto text-white hover:text-red-200 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Main Content Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Action Bar -->
            <div class="bg-gradient-to-r from-gray-50 to-white border-b px-6 py-4">
                <form method="POST" action="{{ route('admin.notifikasi.bulkDelete') }}" id="bulkForm">
                    @csrf
                    @method('DELETE')
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <!-- Selection Controls -->
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="checkbox" id="checkAll" class="w-5 h-5 text-blue-600 rounded border-2 border-gray-300 focus:ring-blue-500 focus:ring-2 transition-all">
                                <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors">Pilih Semua</span>
                            </label>
                            <div class="text-sm text-gray-500" id="selectionInfo">
                                <span id="selectedText">Tidak ada yang dipilih</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <button type="submit" id="deleteSelectedBtn" 
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-medium rounded-lg hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed"
                                    disabled>
                                <i class="fas fa-trash-alt mr-2"></i>
                                Hapus Terpilih
                            </button>
                            
                            <a href="{{ route('admin.notifikasi.deleteAll') }}" 
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 text-white text-sm font-medium rounded-lg hover:from-gray-700 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                            onclick="return confirmDeleteAll()">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Semua
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Notifications Table/List -->
            <div class="overflow-hidden">
                @forelse($notifikasi as $notif)
                    <!-- Desktop Table View -->
                    <div class="hidden md:block">
                        @if($loop->first)
                            <div class="bg-gray-50 px-6 py-3 border-b">
                                <div class="grid grid-cols-12 gap-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="col-span-1">Select</div>
                                    <div class="col-span-2">Aksi</div>
                                    <div class="col-span-6">Deskripsi</div>
                                    <div class="col-span-3">Waktu</div>
                                </div>
                            </div>
                        @endif
                        
                        <div class="notification-row border-b border-gray-100 hover:bg-blue-50 transition-all duration-200 px-6 py-4">
                            <div class="grid grid-cols-12 gap-4 items-center">
                                <div class="col-span-1">
                                    <input type="checkbox" name="ids[]" value="{{ $notif->id }}" 
                                        class="notification-checkbox w-5 h-5 text-blue-600 rounded border-2 border-gray-300 focus:ring-blue-500 focus:ring-2 transition-all">
                                </div>
                                <div class="col-span-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $notif->aksi === 'create' ? 'bg-green-100 text-green-800' : 
                                        ($notif->aksi === 'update' ? 'bg-blue-100 text-blue-800' : 
                                        ($notif->aksi === 'delete' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        <i class="fas fa-{{ $notif->aksi === 'create' ? 'plus' : ($notif->aksi === 'update' ? 'edit' : ($notif->aksi === 'delete' ? 'trash' : 'info')) }} mr-1"></i>
                                        {{ ucfirst($notif->aksi) }}
                                    </span>
                                </div>
                                <div class="col-span-6">
                                    <p class="text-gray-900 font-medium">{{ $notif->deskripsi }}</p>
                                </div>
                                <div class="col-span-3">
                                    <div class="flex items-center text-gray-500">
                                        <i class="fas fa-clock mr-2"></i>
                                        <span class="text-sm">{{ $notif->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden border-b border-gray-100">
                        <div class="notification-card p-4 hover:bg-blue-50 transition-all duration-200">
                            <div class="flex items-start space-x-3">
                                <input type="checkbox" name="ids[]" value="{{ $notif->id }}" 
                                    class="notification-checkbox mt-1 w-5 h-5 text-blue-600 rounded border-2 border-gray-300 focus:ring-blue-500 focus:ring-2 transition-all">
                                
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            {{ $notif->aksi === 'create' ? 'bg-green-100 text-green-800' : 
                                            ($notif->aksi === 'update' ? 'bg-blue-100 text-blue-800' : 
                                            ($notif->aksi === 'delete' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            <i class="fas fa-{{ $notif->aksi === 'create' ? 'plus' : ($notif->aksi === 'update' ? 'edit' : ($notif->aksi === 'delete' ? 'trash' : 'info')) }} mr-1"></i>
                                            {{ ucfirst($notif->aksi) }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $notif->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-gray-900 text-sm">{{ $notif->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <i class="fas fa-bell-slash text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada notifikasi</h3>
                        <p class="text-gray-500">Belum ada notifikasi yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }

    .notification-row:hover {
        transform: translateX(4px);
    }

    .notification-card:hover {
        transform: translateX(2px);
    }

    /* Custom checkbox styling */
    input[type="checkbox"]:checked {
        background-color: #3B82F6;
        border-color: #3B82F6;
    }

    /* Smooth transitions for all interactive elements */
    * {
        transition: all 0.2s ease;
    }

    /* Loading state for buttons */
    .loading {
        position: relative;
    }

    .loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAllBox = document.getElementById('checkAll');
        const notificationCheckboxes = document.querySelectorAll('.notification-checkbox');
        const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
        const selectedCountElement = document.getElementById('selectedCount');
        const selectedTextElement = document.getElementById('selectedText');
        const bulkForm = document.getElementById('bulkForm');

        // Update selection count and UI
        function updateSelectionUI() {
            const checkedBoxes = document.querySelectorAll('.notification-checkbox:checked');
            const selectedIds = new Set();
            
            // Count unique IDs only
            checkedBoxes.forEach(checkbox => {
                selectedIds.add(checkbox.value);
            });
            
            const selectedCount = selectedIds.size;
            const totalCount = notificationCheckboxes.length / 2; // Divide by 2 since we have duplicate checkboxes for mobile/desktop

            // Update counter
            selectedCountElement.textContent = selectedCount;
            
            // Update text
            if (selectedCount === 0) {
                selectedTextElement.textContent = 'Tidak ada yang dipilih';
                deleteSelectedBtn.disabled = true;
            } else {
                selectedTextElement.textContent = `${selectedCount} dari ${totalCount} dipilih`;
                deleteSelectedBtn.disabled = false;
            }

            // Update check all state
            if (selectedCount === 0) {
                checkAllBox.indeterminate = false;
                checkAllBox.checked = false;
            } else if (selectedCount === totalCount) {
                checkAllBox.indeterminate = false;
                checkAllBox.checked = true;
            } else {
                checkAllBox.indeterminate = true;
            }

            // Add visual feedback to selected rows
            notificationCheckboxes.forEach(checkbox => {
                const row = checkbox.closest('.notification-row, .notification-card');
                if (row) {
                    if (checkbox.checked) {
                        row.classList.add('bg-blue-50', 'border-blue-200');
                    } else {
                        row.classList.remove('bg-blue-50', 'border-blue-200');
                    }
                }
            });
        }

        // Check all functionality
        checkAllBox.addEventListener('change', function() {
            const isChecked = this.checked;
            notificationCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            updateSelectionUI();
            
            // Add animation effect
            if (isChecked) {
                notificationCheckboxes.forEach((checkbox, index) => {
                    setTimeout(() => {
                        checkbox.classList.add('animate-bounce');
                        setTimeout(() => checkbox.classList.remove('animate-bounce'), 300);
                    }, index * 50);
                });
            }
        });

        // Individual checkbox change
        notificationCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectionUI);
        });

        // Form submission with confirmation
        bulkForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const checkedBoxes = document.querySelectorAll('.notification-checkbox:checked');
            if (checkedBoxes.length === 0) {
                showToast('Pilih setidaknya satu notifikasi untuk dihapus', 'warning');
                return;
            }

            showConfirmDialog(
                'Konfirmasi Hapus',
                `Apakah Anda yakin ingin menghapus ${checkedBoxes.length} notifikasi yang dipilih?`,
                () => {
                    // Add loading state
                    deleteSelectedBtn.classList.add('loading');
                    deleteSelectedBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...';
                    deleteSelectedBtn.disabled = true;
                    
                    // Submit form
                    this.submit();
                }
            );
        });

        // Initialize UI
        updateSelectionUI();

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('#successAlert, #errorAlert');
            alerts.forEach(alert => {
                if (alert) {
                    alert.style.transition = 'all 0.3s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);
    });

    // Helper functions
    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.transition = 'all 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        }
    }

    function confirmDeleteAll() {
        return showConfirmDialog(
            'Hapus Semua Notifikasi',
            'Apakah Anda yakin ingin menghapus SEMUA notifikasi? Tindakan ini tidak dapat dibatalkan.',
            () => true
        );
    }

    function showConfirmDialog(title, message, onConfirm) {
        // Simple confirm dialog - you can replace this with a custom modal
        const result = confirm(`${title}\n\n${message}`);
        if (result && onConfirm) {
            return onConfirm();
        }
        return result;
    }

    function showToast(message, type = 'info') {
        // Simple toast notification - you can enhance this with a toast library
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 
            type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + A to select all
        if ((e.ctrlKey || e.metaKey) && e.key === 'a' && !e.target.matches('input[type="text"], textarea')) {
            e.preventDefault();
            document.getElementById('checkAll').click();
        }
        
        // Delete key to delete selected
        if (e.key === 'Delete' && !e.target.matches('input, textarea')) {
            const deleteBtn = document.getElementById('deleteSelectedBtn');
            if (!deleteBtn.disabled) {
                deleteBtn.click();
            }
        }
    });
    </script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endsection