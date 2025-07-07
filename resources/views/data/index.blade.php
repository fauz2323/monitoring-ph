@extends('layout.app')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-tint me-2"></i>Monitoring Kualitas Air
                    </h1>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success me-2">
                            <i class="fas fa-circle me-1"></i>Online
                        </span>
                        <small class="text-muted">Last Update: <span
                                id="lastUpdate">{{ now()->format('H:i:s') }}</span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Cards -->
        <div class="row mb-4">
            <!-- pH Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    pH Level
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="phValue">
                                    {{ $dataAlat->ph ?? '0.00' }}
                                </div>
                                <div class="mt-2">
                                    <span class="badge" id="phStatus">Loading...</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-flask fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TDS Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    TDS (Total Dissolved Solids)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="tdsValue">
                                    {{ $dataAlat->tds ?? '0' }} ppm
                                </div>
                                <div class="mt-2">
                                    <span class="badge" id="tdsStatus">Loading...</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-water fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Turbidity Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Turbidity
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="turbidityValue">
                                    {{ $dataAlat->turbidity ?? '0' }} NTU
                                </div>
                                <div class="mt-2">
                                    <span class="badge" id="turbidityStatus">Loading...</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall Status Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Status Keseluruhan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="alert" id="overallStatus" role="alert">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <span id="statusMessage">Memuat status...</span>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="{{ route('data.export') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-sync-alt me-1"></i>Download Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Data Cards -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Terakhir</h6>
                    </div>
                    <div class="card-body">
                        <div class="row" id="latestDataCards">
                            @forelse($recentData->take(5) as $data)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div
                                        class="card h-100 border-left-{{ $loop->index % 3 == 0 ? 'primary' : ($loop->index % 3 == 1 ? 'success' : 'info') }} shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div>
                                                    <h6 class="card-title text-primary mb-1">
                                                        <i class="fas fa-clock me-2"></i>Data #{{ $loop->iteration }}
                                                    </h6>
                                                    <small
                                                        class="text-muted">{{ $data->created_at->format('d/m/Y H:i:s') }}</small>
                                                </div>
                                                <span class="badge bg-success">Normal</span>
                                            </div>

                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="border-end">
                                                        <div class="h4 mb-1 text-primary">{{ $data->ph }}</div>
                                                        <small class="text-muted">pH</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="border-end">
                                                        <div class="h4 mb-1 text-success">{{ $data->tds }}</div>
                                                        <small class="text-muted">TDS (ppm)</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="h4 mb-1 text-info">{{ $data->turbidity }}</div>
                                                    <small class="text-muted">Turbidity (NTU)</small>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <small class="text-muted">
                                                    <i class="fas fa-comment me-1"></i>
                                                    {{ $data->keterangan }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-4">
                                        <i class="fas fa-database fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Tidak ada data tersedia</h5>
                                        <p class="text-muted">Data monitoring akan muncul di sini setelah sensor
                                            mengirimkan data.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .border-left-primary {
                border-left: 0.25rem solid #4e73df !important;
            }

            .border-left-success {
                border-left: 0.25rem solid #1cc88a !important;
            }

            .border-left-info {
                border-left: 0.25rem solid #36b9cc !important;
            }

            .text-gray-800 {
                color: #5a5c69 !important;
            }

            .text-gray-300 {
                color: #dddfeb !important;
            }

            .font-weight-bold {
                font-weight: 700 !important;
            }

            .text-xs {
                font-size: 0.7rem;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid #e3e6f0;
                border-radius: 0.35rem;
                transition: transform 0.2s ease-in-out;
            }

            .card:hover {
                transform: translateY(-2px);
            }

            .shadow {
                box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
            }

            .shadow-sm {
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
            }

            .card-body {
                flex: 1 1 auto;
                padding: 1.25rem;
            }

            .card-header {
                padding: 0.75rem 1.25rem;
                margin-bottom: 0;
                background-color: #f8f9fc;
                border-bottom: 1px solid #e3e6f0;
            }

            .badge {
                display: inline-block;
                padding: 0.35em 0.65em;
                font-size: 0.75em;
                font-weight: 700;
                line-height: 1;
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: 0.375rem;
            }

            .bg-success {
                background-color: #1cc88a !important;
                color: white;
            }

            .bg-warning {
                background-color: #f6c23e !important;
                color: white;
            }

            .bg-danger {
                background-color: #e74a3b !important;
                color: white;
            }

            .bg-info {
                background-color: #36b9cc !important;
                color: white;
            }

            .border-end {
                border-right: 1px solid #e3e6f0 !important;
            }

            .h4 {
                font-size: 1.5rem;
                font-weight: 700;
            }

            .text-primary {
                color: #4e73df !important;
            }

            .text-success {
                color: #1cc88a !important;
            }

            .text-info {
                color: #36b9cc !important;
            }

            .text-muted {
                color: #858796 !important;
            }
        </style>
    @endpush

    @push('js')
        <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>

        <script>
            // Function to update status badges
            function updateStatusBadge(elementId, value, thresholds) {
                const element = document.getElementById(elementId);
                if (value <= thresholds.good) {
                    element.className = 'badge bg-success';
                    element.textContent = 'Baik';
                } else if (value <= thresholds.warning) {
                    element.className = 'badge bg-warning';
                    element.textContent = 'Peringatan';
                } else {
                    element.className = 'badge bg-danger';
                    element.textContent = 'Buruk';
                }
            }

            // Function to update overall status
            function updateOverallStatus(latestData) {
                const overallStatus = document.getElementById('overallStatus');
                const statusMessage = document.getElementById('statusMessage');

                let isGood = true;
                let message = 'Semua parameter dalam batas normal';

                // Check pH
                if (latestData.ph < 6.5 || latestData.ph > 8.5) {
                    isGood = false;
                    message = 'pH di luar batas normal';
                }

                // Check TDS
                if (latestData.tds > 500) {
                    isGood = false;
                    message = 'TDS melebihi batas normal';
                }

                // Check Turbidity
                if (latestData.turbidity > 5000) {
                    isGood = false;
                    message = 'Turbidity melebihi batas normal';
                }

                if (isGood) {
                    overallStatus.className = 'alert alert-success';
                } else {
                    overallStatus.className = 'alert alert-warning';
                }

                statusMessage.textContent = message;
            }

            // Function to update latest data cards
            function updateLatestDataCards(data) {
                const container = document.getElementById('latestDataCards');

                if (data.length === 0) {
                    container.innerHTML = `
                        <div class="col-12">
                            <div class="text-center py-4">
                                <i class="fas fa-database fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada data tersedia</h5>
                                <p class="text-muted">Data monitoring akan muncul di sini setelah sensor mengirimkan data.</p>
                            </div>
                        </div>
                    `;
                    return;
                }

                let html = '';
                data.slice(0, 5).forEach((item, index) => {
                    const borderClass = index % 3 === 0 ? 'primary' : (index % 3 === 1 ? 'success' : 'info');
                    const createdDate = new Date(item.created_at).toLocaleString('id-ID');

                    html += `
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-left-${borderClass} shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="card-title text-primary mb-1">
                                                <i class="fas fa-clock me-2"></i>Data #${index + 1}
                                            </h6>
                                            <small class="text-muted">${createdDate}</small>
                                        </div>
                                        <span class="badge bg-success">${item.keterangan}</span>
                                    </div>

                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="border-end">
                                                <div class="h4 mb-1 text-primary">${item.ph}</div>
                                                <small class="text-muted">pH</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="border-end">
                                                <div class="h4 mb-1 text-success">${item.tds}</div>
                                                <small class="text-muted">TDS (ppm)</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="h4 mb-1 text-info">${item.turbidity}</div>
                                            <small class="text-muted">Turbidity (NTU)</small>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-comment me-1"></i>
                                            ${item.keterangan}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                container.innerHTML = html;
            }

            // Function to fetch and update data
            async function fetchAndUpdateData() {
                try {
                    // Fetch latest data
                    const latestResponse = await fetch('/data/fetch-latest');
                    const latestData = await latestResponse.json();

                    if (latestData) {
                        // Update main cards
                        document.getElementById('phValue').textContent = latestData.ph || '0.00';
                        document.getElementById('tdsValue').textContent = (latestData.tds || '0') + ' ppm';
                        document.getElementById('turbidityValue').textContent = (latestData.turbidity || '0') + ' NTU';

                        // Update status badges
                        updateStatusBadge('phStatus', latestData.ph, {
                            good: 7.0,
                            warning: 8.0
                        });
                        updateStatusBadge('tdsStatus', latestData.tds, {
                            good: 300,
                            warning: 500
                        });
                        updateStatusBadge('turbidityStatus', latestData.turbidity, {
                            good: 1000,
                            warning: 5000
                        });

                        // Update overall status
                        updateOverallStatus(latestData);
                    }

                    // Fetch recent data for cards
                    const recentResponse = await fetch('/data/fetch');
                    const recentData = await recentResponse.json();

                    if (recentData) {
                        updateLatestDataCards(recentData);
                    }

                    // Update last update time
                    document.getElementById('lastUpdate').textContent = new Date().toLocaleTimeString('id-ID');

                } catch (error) {
                    console.error('Error fetching data:', error);
                    // Update status to show error
                    document.getElementById('overallStatus').className = 'alert alert-danger';
                    document.getElementById('statusMessage').textContent = 'Error: Gagal mengambil data dari server';
                }
            }

            // Function to refresh data manually
            function refreshData() {
                fetchAndUpdateData();
            }

            // Start real-time updates when page loads
            document.addEventListener('DOMContentLoaded', function() {
                // Initial fetch
                fetchAndUpdateData();

                // Set up interval to fetch data every 1 second
                setInterval(fetchAndUpdateData, 2000);
            });
        </script>
    @endpush
@endsection
