@extends('components.layouts.admin.sidebar-and-navbar')

@section('content')

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

/* Timer styling */
/* Timer styling */
.timer-circle {
    position: relative;
}

.timer-progress {
    transition: stroke-dashoffset 1s linear;
    stroke-linecap: round;
}

.timer-text {
    font-family: 'Courier New', monospace;
    font-weight: 600;
}

.timer-text-mobile {
    font-family: 'Courier New', monospace;
    font-weight: 600;
}

/* Expired notification styling */
.notification-expired {
    opacity: 0.7;
    background-color: #FEF2F2 !important;
    border-left: 4px solid #EF4444;
}

.notification-expired .timer-text,
.notification-expired .timer-text-mobile {
    color: #DC2626 !important;
    font-weight: bold !important;
}

/* Pulse animation for near expiry */
@keyframes pulse-red {
    0%, 100% { 
        color: #EF4444;
        transform: scale(1);
    }
    50% { 
        color: #DC2626;
        transform: scale(1.1);
    }
}

.timer-warning {
    animation: pulse-red 1s infinite;
}

/* Progress circle animations */
@keyframes progress-warning {
    0%, 100% { 
        stroke: #EF4444;
    }
    50% { 
        stroke: #DC2626;
    }
}

.timer-progress.warning {
    animation: progress-warning 1s infinite;
}

/* Ensure SVG circles are properly initialized */
.timer-circle svg circle {
    stroke-width: 2;
    fill: none;
}

.timer-circle svg circle:first-child {
    stroke: #E5E7EB;
}

.timer-circle svg circle.timer-progress {
    stroke: #EF4444;
    stroke-dasharray: inherit;
    stroke-dashoffset: 0;
    transform-origin: center;
}
/* Grid system update for 13 columns */
.grid-cols-13 {
    grid-template-columns: repeat(13, minmax(0, 1fr));
}

.col-span-13 {
    grid-column: span 13 / span 13;
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

/* Pulse animation for near expiry */
@keyframes pulse-red {
    0%, 100% { 
        color: #EF4444;
        transform: scale(1);
    }
    50% { 
        color: #DC2626;
        transform: scale(1.05);
    }
}

.timer-warning {
    animation: pulse-red 1s infinite;
}
</style>


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
                            <div class="text-2xl font-bold text-yellow-600" id="selectedCount">0</div>
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
                            <input type="checkbox" id="checkAll" class="w-5 h-5 text-blue-600 rounded border-2 border-blue-600 focus:ring-blue-500 focus:ring-2 transition-all">
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
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white text-sm font-medium rounded-lg hover:from-gray-700 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
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
                            <div class="grid grid-cols-13 gap-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="col-span-1">Select</div>
                                <div class="col-span-2">Aksi</div>
                                <div class="col-span-5">Deskripsi</div>
                                <div class="col-span-3">Waktu</div>
                                <div class="col-span-2">Timer</div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="notification-row border-b border-gray-100 hover:bg-blue-50 transition-all duration-200 px-6 py-4" data-notification-id="{{ $notif->id }}" data-created-at="{{ $notif->created_at->timestamp }}">
                        <div class="grid grid-cols-13 gap-4 items-center">
                            <div class="col-span-1">
                                <input type="checkbox" name="ids[]" value="{{ $notif->id }}" 
                                    class="notification-checkbox w-5 h-5 text-blue-600 rounded border-2 border-gray-300 focus:ring-blue-500 focus:ring-2 transition-all">
                            </div>
                            <div class="col-span-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $notif->aksi === 'create' ? 'bg-green-100 text-green-800' : 
                                    ($notif->aksi === 'update' ? 'bg-blue-100 text-blue-800' : 
                                    ($notif->aksi === 'delete' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-blue-800')) }}">
                                    <i class="fas fa-{{ $notif->aksi === 'create' ? 'plus' : ($notif->aksi === 'update' ? 'edit' : ($notif->aksi === 'delete' ? 'trash' : 'info')) }} mr-1"></i>
                                    {{ ucfirst($notif->aksi) }}
                                </span>
                            </div>
                            <div class="col-span-5">
                                <p class="text-gray-900 font-medium">{{ $notif->deskripsi }}</p>
                            </div>
                            <div class="col-span-3">
                                <div class="flex items-center text-blue-500">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span class="text-sm">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="timer-container">
                                    <div class="flex items-center space-x-2">
                                        <div class="timer-circle relative w-8 h-8">
                                            <svg class="w-8 h-8 transform -rotate-90" viewBox="0 0 32 32">
                                                <circle cx="16" cy="16" r="14" stroke="#E5E7EB" stroke-width="2" fill="none"/>
                                                <circle cx="16" cy="16" r="14" stroke="#EF4444" stroke-width="2" fill="none" class="timer-progress" stroke-dasharray="88" stroke-dashoffset="0"/>
                                            </svg>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <span class="timer-text text-xs font-medium text-red-500">5:00</span>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500">Auto delete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden border-b border-gray-100">
                    <div class="notification-card p-4 hover:bg-blue-50 transition-all duration-200" data-notification-id="{{ $notif->id }}" data-created-at="{{ $notif->created_at->timestamp }}">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" name="ids[]" value="{{ $notif->id }}" 
                                class="notification-checkbox mt-1 w-5 h-5 text-blue-600 rounded border-2 border-gray-300 focus:ring-blue-500 focus:ring-2 transition-all">
                            
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $notif->aksi === 'create' ? 'bg-green-100 text-green-800' : 
                                        ($notif->aksi === 'update' ? 'bg-blue-100 text-blue-800' : 
                                        ($notif->aksi === 'delete' ? 'bg-blue-400 text-blue-800' : 'bg-gray-100 text-blue-800')) }}">
                                        <i class="fas fa-{{ $notif->aksi === 'create' ? 'plus' : ($notif->aksi === 'update' ? 'edit' : ($notif->aksi === 'delete' ? 'trash' : 'info')) }} mr-1"></i>
                                        {{ ucfirst($notif->aksi) }}
                                    </span>
                                    <span class="text-xs text-blue-500">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $notif->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-gray-900 text-sm mb-2">{{ $notif->deskripsi }}</p>
                                
                                <!-- Mobile Timer -->
                                <div class="timer-container">
                                    <div class="flex items-center space-x-2">
                                        <div class="timer-circle relative w-6 h-6">
                                            <svg class="w-6 h-6 transform -rotate-90" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" stroke="#E5E7EB" stroke-width="2" fill="none"/>
                                                <circle cx="12" cy="12" r="10" stroke="#EF4444" stroke-width="2" fill="none" class="timer-progress" stroke-dasharray="63" stroke-dashoffset="0"/>
                                            </svg>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <span class="timer-text text-xs font-medium text-red-500">5:00</span>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500">Auto delete dalam</span>
                                        <span class="timer-text-mobile text-xs font-medium text-red-500">5:00</span>
                                    </div>
                                </div>
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

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAllBox = document.getElementById('checkAll');
    const notificationCheckboxes = document.querySelectorAll('.notification-checkbox');
    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    const selectedCountElement = document.getElementById('selectedCount');
    const selectedTextElement = document.getElementById('selectedText');
    const bulkForm = document.getElementById('bulkForm');

    // Timer management
    let timerIntervals = new Map();
    let autoRefreshInterval;

    // Initialize timers for all notifications
    function initializeTimers() {
        const notificationRows = document.querySelectorAll('[data-notification-id]');
        
        notificationRows.forEach(row => {
            const notificationId = row.dataset.notificationId;
            const createdAt = parseInt(row.dataset.createdAt);
            
            // Calculate initial remaining time
            const now = Math.floor(Date.now() / 1000);
            const elapsed = now - createdAt;
            const remaining = Math.max(0, 300 - elapsed); // 5 minutes = 300 seconds
            
            if (remaining > 0) {
                startTimer(notificationId, createdAt, row);
            } else {
                // Already expired
                markAsExpired(row, notificationId);
            }
        });
    }

    // Start timer for a specific notification
    function startTimer(notificationId, createdAt, element) {
        // Clear existing timer if any
        if (timerIntervals.has(notificationId)) {
            clearInterval(timerIntervals.get(notificationId));
        }

        // Update timer immediately
        updateTimerForElement(element, createdAt);

        const interval = setInterval(() => {
            updateTimerForElement(element, createdAt);
        }, 1000);

        timerIntervals.set(notificationId, interval);
    }

    // Update timer for specific element
    function updateTimerForElement(element, createdAt) {
        const now = Math.floor(Date.now() / 1000);
        const elapsed = now - createdAt;
        const remaining = Math.max(0, 300 - elapsed); // 5 minutes = 300 seconds

        updateTimerDisplay(element, remaining);

        if (remaining <= 0) {
            const notificationId = element.dataset.notificationId;
            if (timerIntervals.has(notificationId)) {
                clearInterval(timerIntervals.get(notificationId));
                timerIntervals.delete(notificationId);
            }
            markAsExpired(element, notificationId);
        }
    }

    // Update timer display
    function updateTimerDisplay(element, remainingSeconds) {
        const minutes = Math.floor(remainingSeconds / 60);
        const seconds = remainingSeconds % 60;
        const timeString = `${minutes}:${seconds.toString().padStart(2, '0')}`;

        // Update timer text for both desktop and mobile
        const timerTexts = element.querySelectorAll('.timer-text');
        const timerTextsMobile = element.querySelectorAll('.timer-text-mobile');
        
        [...timerTexts, ...timerTextsMobile].forEach(text => {
            if (text) {
                text.textContent = timeString;
            }
        });

        // Update progress circle
        const progressCircles = element.querySelectorAll('.timer-progress');
        
        progressCircles.forEach(circle => {
            const radius = parseInt(circle.getAttribute('r'));
            const circumference = 2 * Math.PI * radius;
            const progress = (remainingSeconds / 300) * circumference;
            
            // Set initial stroke-dasharray if not set
            if (!circle.style.strokeDasharray) {
                circle.style.strokeDasharray = circumference;
            }
            
            circle.style.strokeDashoffset = circumference - progress;
            
            // Change color based on remaining time
            if (remainingSeconds <= 60) {
                circle.style.stroke = '#DC2626'; // Red for last minute
            } else if (remainingSeconds <= 120) {
                circle.style.stroke = '#F59E0B'; // Yellow for last 2 minutes
            } else {
                circle.style.stroke = '#EF4444'; // Default red
            }
        });

        // Add warning animation for last 30 seconds
        const allTimerTexts = [...timerTexts, ...timerTextsMobile];
        if (remainingSeconds <= 30 && remainingSeconds > 0) {
            allTimerTexts.forEach(text => {
                if (text) text.classList.add('timer-warning');
            });
        } else {
            allTimerTexts.forEach(text => {
                if (text) text.classList.remove('timer-warning');
            });
        }
    }

    // Mark notification as expired
    function markAsExpired(element, notificationId) {
        element.classList.add('notification-expired');
        
        // Show expired message
        const timerTexts = element.querySelectorAll('.timer-text');
        const timerTextsMobile = element.querySelectorAll('.timer-text-mobile');
        
        [...timerTexts, ...timerTextsMobile].forEach(text => {
            if (text) {
                text.textContent = 'EXPIRED';
                text.style.color = '#DC2626';
                text.style.fontWeight = 'bold';
            }
        });

        // Update progress circles to show complete
        const progressCircles = element.querySelectorAll('.timer-progress');
        progressCircles.forEach(circle => {
            circle.style.stroke = '#DC2626';
            circle.style.strokeDashoffset = '0';
        });

        // Auto-remove after 3 seconds
        setTimeout(() => {
            element.style.transition = 'all 0.5s ease-out';
            element.style.opacity = '0';
            element.style.transform = 'translateX(-100%)';
            
            setTimeout(() => {
                element.remove();
                updateTotalCount();
                // Refresh page to get updated data
                window.location.reload();
            }, 500);
        }, 3000);
    }

    // Update total notification count
    function updateTotalCount() {
        const currentCount = document.querySelectorAll('.notification-row, .notification-card').length;
        const totalElement = document.getElementById('totalNotifications');
        if (totalElement) {
            totalElement.textContent = currentCount;
        }
    }

    // Update selection count and UI
    function updateSelectionUI() {
        const checkedBoxes = document.querySelectorAll('.notification-checkbox:checked');
        const selectedIds = new Set();
        
        // Count unique IDs only
        checkedBoxes.forEach(checkbox => {
            selectedIds.add(checkbox.value);
        });
        
        const selectedCount = selectedIds.size;
        const totalCount = Math.floor(notificationCheckboxes.length / 2); // Divide by 2 since we have duplicate checkboxes for mobile/desktop

        // Update counter
        if (selectedCountElement) {
            selectedCountElement.textContent = selectedCount;
        }
        
        // Update text
        if (selectedTextElement) {
            if (selectedCount === 0) {
                selectedTextElement.textContent = 'Tidak ada yang dipilih';
                if (deleteSelectedBtn) deleteSelectedBtn.disabled = true;
            } else {
                selectedTextElement.textContent = `${selectedCount} dari ${totalCount} dipilih`;
                if (deleteSelectedBtn) deleteSelectedBtn.disabled = false;
            }
        }

        // Update check all state
        if (checkAllBox) {
            if (selectedCount === 0) {
                checkAllBox.indeterminate = false;
                checkAllBox.checked = false;
            } else if (selectedCount === totalCount) {
                checkAllBox.indeterminate = false;
                checkAllBox.checked = true;
            } else {
                checkAllBox.indeterminate = true;
            }
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
    if (checkAllBox) {
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
    }

    // Individual checkbox change
    notificationCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectionUI);
    });

    // Form submission with confirmation
    if (bulkForm) {
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
                    if (deleteSelectedBtn) {
                        deleteSelectedBtn.classList.add('loading');
                        deleteSelectedBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...';
                        deleteSelectedBtn.disabled = true;
                    }
                    
                    // Submit form
                    this.submit();
                }
            );
        });
    }

    // Initialize everything
    updateSelectionUI();
    initializeTimers();

    // Auto-refresh to clean up expired notifications every 30 seconds
    autoRefreshInterval = setInterval(() => {
        // Check if any notifications should be expired
        const now = Math.floor(Date.now() / 1000);
        const notificationRows = document.querySelectorAll('[data-notification-id]');
        let hasExpired = false;

        notificationRows.forEach(row => {
            const createdAt = parseInt(row.dataset.createdAt);
            const elapsed = now - createdAt;
            
            if (elapsed >= 300) { // 5 minutes
                hasExpired = true;
            }
        });

        if (hasExpired) {
            window.location.reload();
        }
    }, 30000);

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

    // Clean up intervals when page unloads
    window.addEventListener('beforeunload', () => {
        timerIntervals.forEach(interval => clearInterval(interval));
        if (autoRefreshInterval) clearInterval(autoRefreshInterval);
    });
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
    }, 300);
}

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + A to select all
    if ((e.ctrlKey || e.metaKey) && e.key === 'a' && !e.target.matches('input[type="text"], textarea')) {
        e.preventDefault();
        const checkAllBox = document.getElementById('checkAll');
        if (checkAllBox) checkAllBox.click();
    }
    
    // Delete key to delete selected
    if (e.key === 'Delete' && !e.target.matches('input, textarea')) {
        const deleteBtn = document.getElementById('deleteSelectedBtn');
        if (deleteBtn && !deleteBtn.disabled) {
            deleteBtn.click();
        }
    }
});
</script>
@endsection