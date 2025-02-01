<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> <!-- For icons -->
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="resize-handle" id="resize-handle"></div>
        <div class="sidebar-header">
            <h2>SYA Trucking Services</h2>
            <p>Since 2020</p>
        </div>
        <ul class="menu">
            <li><a href="#" class="menu-item active"><i class="bi bi-list"></i> System Settings</a></li>
            <li><a href="#" class="menu-item"><i class="bi bi-truck"></i> Manage Trip Records</a></li>
            <li><a href="#" class="menu-item"><i class="bi bi-geo-alt"></i> GPS Control</a></li>
            <li><a href="#" class="menu-item"><i class="bi bi-fuel-pump"></i> Fuel Management</a></li>
            <li><a href="#" class="menu-item"><i class="bi bi-graph-up"></i> Profit Analysis</a></li>
            <li class="menu-spacer"></li>
            <li class="menu-spacer"></li>
            <li class="menu-spacer"></li>
            <li class="menu-spacer"></li>
            <li class="menu-spacer"></li>
            <li><a href="#" class="menu-item"><i class="bi bi-question-circle"></i> Help & Support</a></li>
            <li class="logout"><a href="<?php echo e(route('login')); ?>" class="menu-item"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
        </ul>        
    </div>
    <div class="main-content">
        <!-- Add content here -->
    </div>
    <script>
        // Function to toggle the dropdown menu
        function toggleDropdown(event) {
            event.preventDefault();
            const dropdown = document.getElementById('settings-submenu');
            const arrow = event.currentTarget.querySelector('.dropdown-arrow');
            dropdown.classList.toggle('show');
            arrow.classList.toggle('rotate');
        }

        // Function to manage active state of menu items
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
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
    if (newWidth >= 50 && newWidth <= 400) {
        sidebar.style.width = `${newWidth}px`;
    }
});

document.addEventListener('mouseup', () => {
    if (isResizing) {
        isResizing = false;
        document.body.style.cursor = 'default';
        document.body.style.userSelect = '';
    }
});

    </script>
</body>
</html>
<?php /**PATH C:\Users\john carlo cervantes\trucking-services\resources\views/admin.blade.php ENDPATH**/ ?>