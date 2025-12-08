<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'CI4 App' ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: white;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.25rem;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            padding: 20px;
        }

        .navbar-brand {
            padding: 0.5rem 1rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= (url_is('dashboard') ? 'active' : '') ?>" href="/dashboard">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>

                        <!-- Inventory Section -->

                        <li class="nav-item">
                            <a class="nav-link <?= (url_is('items*') ? 'active' : '') ?>" href="/items">
                                <i class="bi bi-box-seam"></i> Itmes
                            </a>
                        </li>

                       <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-boxes"></i> Inventory
                            </a>
                        </li>

                        <!-- Products Section -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-grid"></i> Products
                            </a>
                        </li>

                        <!-- Categories Section -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-collection"></i> Categories
                            </a>
                        </li>

                        <!-- Tags Section -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-tags"></i> Tags
                            </a>
                        </li>

                       

                        <!-- Customers Section -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people"></i> To do List
                            </a>
                        </li>

                        <li class="nav-item mt-4">
                            <a class="nav-link text-danger" href="/logout">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>