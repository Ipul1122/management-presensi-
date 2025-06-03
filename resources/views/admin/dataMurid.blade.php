@extends('components.layouts.admin') {{-- Sesuaikan dengan layout yang kamu gunakan --}}

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-800">Statistik Data Murid</h2>
                    <p class="text-slate-600 mt-1">Visualisasi data siswa dan statistik pembelajaran</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        {{-- Jenis Kelamin Chart --}}
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Jenis Kelamin</h3>
                    <p class="text-slate-600 text-sm">Distribusi siswa berdasarkan gender</p>
                </div>
            </div>
            
            <div class="relative h-64 sm:h-80">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        {{-- Jenis Bacaan Chart --}}
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Jenis Bacaan</h3>
                    <p class="text-slate-600 text-sm">Distribusi materi pembelajaran</p>
                </div>
            </div>
            
            <div class="relative h-64 sm:h-80">
                <canvas id="bacaanChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Kelas Chart --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800">Distribusi Kelas</h3>
                <p class="text-slate-600 text-sm">Jumlah siswa per kelas</p>
            </div>
        </div>
        
        <div class="relative h-80 sm:h-96">
            <canvas id="kelasChart"></canvas>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-700">{{ $totalLaki + $totalPerempuan }}</div>
                <div class="text-sm text-blue-600">Total Siswa</div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl p-4 border border-emerald-200">
            <div class="text-center">
                <div class="text-2xl font-bold text-emerald-700">{{ $totalLaki }}</div>
                <div class="text-sm text-emerald-600">Laki-laki</div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl p-4 border border-pink-200">
            <div class="text-center">
                <div class="text-2xl font-bold text-pink-700">{{ $totalPerempuan }}</div>
                <div class="text-sm text-pink-600">Perempuan</div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 border border-purple-200">
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-700">{{ count($kelasCounts) }}</div>
                <div class="text-sm text-purple-600">Total Kelas</div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modern color palette
    const colors = {
        primary: ['#3B82F6', '#8B5CF6', '#10B981', '#F59E0B', '#EF4444', '#06B6D4', '#8B5A2B', '#EC4899'],
        light: ['#DBEAFE', '#EDE9FE', '#D1FAE5', '#FEF3C7', '#FEE2E2', '#CFFAFE', '#F3E8FF', '#FCE7F3'],
        gradient: [
            'rgba(59, 130, 246, 0.8)',
            'rgba(139, 92, 246, 0.8)',
            'rgba(16, 185, 129, 0.8)',
            'rgba(245, 158, 11, 0.8)',
            'rgba(239, 68, 68, 0.8)',
            'rgba(6, 182, 212, 0.8)',
            'rgba(139, 90, 43, 0.8)',
            'rgba(236, 72, 153, 0.8)'
        ]
    };

    // Chart.js default configuration
    Chart.defaults.font.family = "'Inter', 'system-ui', sans-serif";
    Chart.defaults.color = '#64748B';
    Chart.defaults.borderColor = '#E2E8F0';

    // 1. Gender Chart (Doughnut)
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $totalLaki }}, {{ $totalPerempuan }}],
                backgroundColor: [
                    colors.gradient[0],
                    colors.gradient[7]
                ],
                borderColor: [
                    colors.primary[0],
                    colors.primary[7]
                ],
                borderWidth: 2,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 14,
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#374151',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed * 100) / total).toFixed(1);
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '60%'
        }
    });

    // 2. Bacaan Chart (Pie)
    const bacaanCtx = document.getElementById('bacaanChart').getContext('2d');
    new Chart(bacaanCtx, {
        type: 'pie',
        data: {
            labels: ['Iqro', 'Al-Qur\'an'],
            datasets: [{
                data: [{{ $totalIqro }}, {{ $totalQuran }}],
                backgroundColor: [
                    colors.gradient[3],
                    colors.gradient[2]
                ],
                borderColor: [
                    colors.primary[3],
                    colors.primary[2]
                ],
                borderWidth: 2,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 14,
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#374151',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed * 100) / total).toFixed(1);
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // 3. Kelas Chart (Bar)
    const kelasCtx = document.getElementById('kelasChart').getContext('2d');
    const kelasData = @json($kelasCounts);
    
    new Chart(kelasCtx, {
        type: 'bar',
        data: {
            labels: kelasData.map(item => `Kelas ${item.kelas}`),
            datasets: [{
                label: 'Jumlah Siswa',
                data: kelasData.map(item => item.total),
                backgroundColor: colors.gradient.slice(0, kelasData.length),
                borderColor: colors.primary.slice(0, kelasData.length),
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#F1F5F9'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#374151',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed.y} siswa`;
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
});
</script>
@endsection