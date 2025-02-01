<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/manager.css')); ?>">
    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            padding-top: 60px; /* Location of the box */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-input {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .form-label {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .actions {
            text-align: center; /* Center align action buttons */
        }

        .actions button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px; /* Rounded corners */
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .actions .edit-btn {
            background-color: transparent; /* Bootstrap primary color */
            color: blue;
        }

        .actions .delete-btn {
            background-color: transparent; /* Bootstrap danger color */
            color: red;
        }
    </style>
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
            <li><a href="#" class="menu-item active"><i class="bi bi-truck"></i> Manage Trip Records</a></li>
            <li><a href="#" class="menu-item"><i class="bi bi-map"></i> GPS Control</a></li>
            <li><a href="#" class="menu-item" id="fuelManagementBtn"><i class="bi bi-geo-alt"></i> Fuel Management</a></li>
            <li>
                <a href="#" class="menu-item dropdown-toggle" onclick="toggleDropdown(event)">
                    <i class="bi bi-fuel-pump"></i> Settings
                    <i class="bi bi-chevron-down dropdown-arrow"></i> <!-- Arrow icon -->
                </a>
                <ul class="submenu" id="settings-submenu">
                    <li><a href="#" class="submenu-item"><i class="bi bi-graph-up"></i> Profile Management</a></li>
                </ul>
            </li>
            <li><a href="#" class="menu-item"><i class="bi bi-question-circle"></i> Help & Support</a></li>
            <li><a href="<?php echo e(route('login')); ?>" class="menu-item logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
        </ul>
    </div>
    <div class="main-content" id="main-content">
        <div id="trip-records" class="section" style="display: grid;">
            <div class="content-header">
                <h2>View and Update Trip Records</h2>
                <select class="driver-select" style="
                    font-size: 17px;
                    border-radius: 8px;">
                    <option disabled selected>-- Select Driver --</option>
                    <option>Reginald Apelado</option>
                    <option>John Carlo Cervantes</option>
                </select>
            </div>

            <div class="table-container">
                <table class="trip-table">
                    <thead>
                        <tr>
                            <th>Trip ID</th>
                            <th>Date</th>
                            <th>Start Location</th>
                            <th>End Location</th>
                            <th>Kilometers</th>
                            <th>Fuel Consumed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TRP-001</td>
                            <td>2025-01-20</td>
                            <td>Station A</td>
                            <td>Station B</td>
                            <td>120</td>
                            <td>30</td>
                            <td class="actions">
                                <button class="edit-btn" onclick="openModal('TRP-001', '2025-01-20', 'Station A', 'Station B', 120, 30)">
                                    <i class="bi bi-pencil"></i> 
                                </button>
                                <button class="delete-btn"><i class="bi bi-trash"></i> </button>
                            </td>
                        </tr>
                        <tr>
                            <td>TRP-002</td>
                            <td>2025-02-15</td>
                            <td>Station C</td>
                            <td>Station D</td>
                            <td>80</td>
                            <td>20</td>
                            <td class="actions">
                                <button class="edit-btn" onclick="openModal('TRP-002', '2025-02-15', 'Station C', 'Station D', 80, 20)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="delete-btn"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <!-- Repeat for other rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <div id="fuel-management" class="section" style="display: none;">
            <h3>Fuel Management</h3>
            <!-- Contents for Fuel Management -->
        </div>

        <!-- Modal for Updating Trip Record -->
        <div id="updateModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>Update Trip Record</h3>
                <form id="updateForm">
                    <label class="form-label">Trip ID:</label>
                    <input type="text" id="tripId" class="form-input" readonly>

                    <label class="form-label">Date:</label>
                    <input type="date" id="date" class="form-input" required>

                    <label class="form-label">Start Location:</label>
                    <input type="text" id="startLocation" class="form-input" required>

                    <label class="form-label">End Location:</label>
                    <input type="text" id="endLocation" class="form-input" required>

                    <label class="form-label">Kilometers:</label>
                    <input type="number" id="kilometers" class="form-input" required>

                    <label class="form-label">Fuel Consumed (L):</label>
                    <input type="number" id="fuelConsumed" class="form-input" required>

                    <button type="submit" class="edit-btn">Update Record</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Open the modal and set form values
        function openModal(tripId, date, startLocation, endLocation, kilometers, fuelConsumed) {
            document.getElementById('tripId').value = tripId;
            document.getElementById('date').value = date;
            document.getElementById('startLocation').value = startLocation;
            document.getElementById('endLocation').value = endLocation;
            document.getElementById('kilometers').value = kilometers;
            document.getElementById('fuelConsumed').value = fuelConsumed;

            document.getElementById('updateModal').style.display = "block";
        }

        // Close the modal
        function closeModal() {
            document.getElementById('updateModal').style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == document.getElementById('updateModal')) {
                closeModal();
            }
        }

        // Add event listener to close modal on form submission (optional)
        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission for demo purposes
            closeModal(); // Close the modal
            // You can add code here to submit the form data to the server
            alert("Trip record updated!"); // Just for demonstration
        });

        // Dropdown and other functionalities...
        function toggleDropdown(event) {
            event.preventDefault();
            const dropdown = document.getElementById('settings-submenu');
            const arrow = event.currentTarget.querySelector('.dropdown-arrow'); // Get the arrow element
            dropdown.classList.toggle('show');

            // Rotate the arrow based on dropdown visibility
            if (dropdown.classList.contains('show')) {
                arrow.classList.add('rotate');
            } else {
                arrow.classList.remove('rotate');
            }
        }

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function () {
                // Hide settings submenu when clicking on other menu items
                if (!this.classList.contains('dropdown-toggle')) {
                    document.getElementById('settings-submenu').classList.remove('show');
                    document.querySelector('.dropdown-arrow').classList.remove('rotate'); // Remove rotation if submenu is closed
                }

                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.section').forEach(section => section.style.display = 'none');
                if (this.classList.contains('active')) document.getElementById('trip-records').style.display = 'grid';
                if (this.id === 'fuelManagementBtn') document.getElementById('fuel-management').style.display = 'block';
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

</html><?php /**PATH C:\Users\john carlo cervantes\trucking-services\resources\views/manager.blade.php ENDPATH**/ ?>