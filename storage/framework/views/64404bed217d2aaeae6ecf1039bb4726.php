<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="resize-handle" id="resize-handle"></div>
        <div class="sidebar-header">
            <h2><i>SYA</i></h2>
            <h2>Trucking Services</h2>
            <p><i>Since 2020</i></p>
        </div>
        <ul class="menu">
            <li><a href="#" id="delivery-records-btn" class="menu-item active"><i class="bi bi-list"></i> Delivery
                    Records</a></li>
            <li><a href="#" id="fuelManagementBtn" class="menu-item"><i class="bi bi-fuel-pump"></i> Fuel Management</a>
            </li>
            <li><a href="#" id="shipment-progress-btn" class="menu-item"><i class="bi bi-geo-alt"></i> Shipment
                    Progress</a></li>
            <li>
                <a href="#" class="menu-item dropdown-toggle" onclick="toggleDropdown(event)">
                    <i class="bi bi-gear"></i> Settings
                    <i class="bi bi-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="submenu" id="settings-submenu">
                    <li><a href="#" class="submenu-item">Profile Management</a></li>
                    <li><a href="#" class="submenu-item">Help and Support</a></li>
                </ul>
            </li>
            <li class="logout"><a href="<?php echo e(route('login')); ?>" class="menu-item"><i class="bi bi-box-arrow-left"></i>
                    Logout</a></li>
        </ul>
    </div>
    <div class="main-content" id="main-content">
        <div id="delivery-records" class="section">
            <div class="card">
                <h3>One Way Trip</h3>
                <button class="add-btn">+</button>
            </div>
            <div class="card">
                <h3>Round Trip</h3>
                <button class="add-btn">+</button>
            </div>
            <div class="card">
                <h3>Door To Door Trip</h3>
                <button class="add-btn">+</button>
            </div>
            <div class="card large-card">
                <h3>Total Trip</h3>
            </div>
        </div>
        <div id="shipment-progress" class="section" style="display: none;">
            <h3>Shipment Progress</h3>
            <div class="status-container">
                <div class="status-item" id="pending-status">
                    <div class="status-number">1</div>
                    <p>Pending</p>
                </div>
                <div class="status-item" id="in-transit-status">
                    <div class="status-number">2</div>
                    <p>In Transit</p>
                </div>
                <div class="status-item" id="delivered-status">
                    <div class="status-number">3</div>
                    <p>Delivered</p>
                </div>
            </div>
            <div class="status-bar">
                <div class="progress-bar"></div>
            </div>
            <div class="cargo-details">
                <h2>Cargo Details</h2>
                <p>Details of the cargo shipment will go here...</p>
            </div>
        </div>
        <div id="fuel-management" class="section" style="display: none;">
            <div class="fuel-stats">
                <div class="stat">
                    <h3>Total Kilometers</h3>
                    <p>379 KL</p>
                </div>
                <div class="stat">
                    <h3>Total Fuel Consumed</h3>
                    <p>30L</p>
                </div>
                <div class="stat">
                    <h3>Avg Fuel Efficiency</h3>
                    <p>6.7 km/L</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="fuelChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        function toggleDropdown(event) {
            event.preventDefault();
            const dropdown = document.getElementById('settings-submenu');
            const arrow = event.currentTarget.querySelector('.dropdown-arrow');
            dropdown.classList.toggle('show');
            arrow.classList.toggle('rotate');
        }

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function (event) {
                // Ignore clicks on the settings dropdown toggle
                if (this.classList.contains('dropdown-toggle')) {
                    return; // Do nothing if the settings item is clicked
                }

                // Proceed with the usual menu item actions
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.section').forEach(section => section.style.display = 'none');

                if (this.id === 'delivery-records-btn') {
                    document.getElementById('delivery-records').style.display = 'grid';
                }
                if (this.id === 'shipment-progress-btn') {
                    document.getElementById('shipment-progress').style.display = 'block';
                }
                if (this.id === 'fuelManagementBtn') {
                    document.getElementById('fuel-management').style.display = 'block';
                }
            });
        });

        const sidebar = document.getElementById('sidebar');
        const resizeHandle = document.getElementById('resize-handle');
        let isResizing = false;

        resizeHandle.addEventListener('mousedown', (event) => {
            isResizing = true;
            document.body.style.cursor = 'ew-resize';
            document.body.style.userSelect = 'none';
        });

        document.addEventListener('mousemove', (event) => {
            if (!isResizing) return;
            const newWidth = event.clientX;
            if (newWidth >= 50 && newWidth <= 400) sidebar.style.width = `${newWidth}px`;
        });

        document.addEventListener('mouseup', () => {
            if (isResizing) {
                isResizing = false;
                document.body.style.cursor = 'default';
                document.body.style.userSelect = '';
            }
        });

        let fuelChart = null;

        // This function is triggered only once when the Fuel Management section is displayed
        document.getElementById('fuelManagementBtn').addEventListener('click', function () {
            document.getElementById('fuel-management').style.display = 'block';

            if (!fuelChart) {  // Check if the chart is not already created
                var ctx = document.getElementById('fuelChart').getContext('2d');
                document.getElementById('fuelChart').height = 400;  // Ensure height is set here
                fuelChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [0, 50, 100, 150, 200, 250, 300, 340],
                        datasets: [{
                            label: 'Fuel Consumption (liters)',
                            data: [0, 5, 10, 15, 20, 25, 30, 35],
                            borderColor: 'green',
                            borderWidth: 2,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true, // Ensure it resizes correctly
                        maintainAspectRatio: false,  // Ensure the canvas resizes to fill the parent container
                    }
                });
            }
        });
    </script>
</body>

</html><?php /**PATH C:\Users\john carlo cervantes\trucking-services\resources\views/dashboard.blade.php ENDPATH**/ ?>