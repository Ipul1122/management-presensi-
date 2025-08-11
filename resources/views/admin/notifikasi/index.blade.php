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
                                {{-- <div class="col-span-3">Waktu</div> --}}
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
                            {{-- <div class="col-span-3">
                                <div class="flex items-center text-blue-500">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span class="text-sm">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                            </div> --}}
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

    function updateAllTimers() {
    const now = Math.floor(Date.now() / 1000);

    document.querySelectorAll('[data-notification-id]').forEach(row => {
        const createdAt = parseInt(row.dataset.createdAt);
        const elapsed = now - createdAt;

        // 1. Update timer countdown
        const remaining = Math.max(0, 300 - elapsed);
        updateTimerDisplay(row, remaining);

        // 2. Update field waktu real-time
        updateRealTimeClock(row, createdAt, now);

        // 3. Hapus jika expired
        if (remaining <= 0) {
            markAsExpired(row, row.dataset.notificationId);
        }
    });
}

function updateRealTimeClock(element, createdAt, now) {
    const date = new Date(createdAt * 1000); // base waktu created_at
    date.setSeconds(date.getSeconds() + (now - createdAt)); // tambah elapsed

    // Format waktu Indonesia
    const formatter = new Intl.DateTimeFormat('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });

    const timeString = formatter.format(date);

    // Update semua elemen yang punya class 'real-time-clock'
    const timeFields = element.querySelectorAll('.real-time-clock');
    timeFields.forEach(field => {
        field.textContent = timeString;
    });
}


    function updateElapsedTime(element, elapsedSeconds) {
        const minutes = Math.floor(elapsedSeconds / 60);
        const seconds = elapsedSeconds % 60;
        const timeString = `${minutes}:${seconds.toString().padStart(2, '0')}`;

        const elapsedFields = element.querySelectorAll('.elapsed-time');
        elapsedFields.forEach(field => {
            field.textContent = timeString;
        });
    }

    function updateTimerDisplay(element, remainingSeconds) {
        const minutes = Math.floor(remainingSeconds / 60);
        const seconds = remainingSeconds % 60;
        const timeString = `${minutes}:${seconds.toString().padStart(2, '0')}`;

        const timerTexts = element.querySelectorAll('.timer-text, .timer-text-mobile');
        timerTexts.forEach(text => {
            if (remainingSeconds > 0) {
                text.textContent = timeString;
            } else {
                text.textContent = 'EXPIRED';
                text.style.color = '#DC2626';
                text.style.fontWeight = 'bold';
            }
        });

        const progressCircles = element.querySelectorAll('.timer-progress');
        progressCircles.forEach(circle => {
            const radius = parseInt(circle.getAttribute('r'));
            const circumference = 2 * Math.PI * radius;
            const progress = (remainingSeconds / 300) * circumference;
            circle.style.strokeDasharray = circumference;
            circle.style.strokeDashoffset = circumference - progress;

            if (remainingSeconds <= 60) {
                circle.style.stroke = '#DC2626';
            } else if (remainingSeconds <= 120) {
                circle.style.stroke = '#F59E0B';
            } else {
                circle.style.stroke = '#EF4444';
            }
        });

        timerTexts.forEach(text => {
            if (remainingSeconds <= 30 && remainingSeconds > 0) {
                text.classList.add('timer-warning');
            } else {
                text.classList.remove('timer-warning');
            }
        });
    }

    function markAsExpired(element) {
        if (element.classList.contains('notification-expired')) return;
        element.classList.add('notification-expired');

        setTimeout(() => {
            element.style.transition = 'all 0.5s ease-out';
            element.style.opacity = '0';
            element.style.transform = 'translateX(-100%)';
            setTimeout(() => {
                element.remove();
                updateTotalCount();
            }, 500);
        }, 3000);
    }

    function updateTotalCount() {
        const currentCount = document.querySelectorAll('.notification-row, .notification-card').length;
        const totalElement = document.getElementById('totalNotifications');
        if (totalElement) totalElement.textContent = currentCount;
    }

    if (checkAllBox) {
        checkAllBox.addEventListener('change', function() {
            const isChecked = this.checked;
            notificationCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            updateSelectionUI();
        });
    }

    function updateSelectionUI() {
        const checkedBoxes = document.querySelectorAll('.notification-checkbox:checked');
        const selectedCount = checkedBoxes.length / 2;
        selectedCountElement.textContent = selectedCount;
        if (selectedCount === 0) {
            selectedTextElement.textContent = 'Tidak ada yang dipilih';
            deleteSelectedBtn.disabled = true;
        } else {
            selectedTextElement.textContent = `${selectedCount} dipilih`;
            deleteSelectedBtn.disabled = false;
        }
    }

    notificationCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectionUI);
    });

    // Jalankan update setiap 1 detik
    updateAllTimers();
    setInterval(updateAllTimers, 1000);
});
</script>
@endsection