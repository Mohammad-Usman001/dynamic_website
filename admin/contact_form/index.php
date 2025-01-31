<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

// $user = fetchUser($conn, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }

        .sidebar {
            height: calc(100vh - 56px);
            width: 250px;
            position: fixed;
            top: 56px;
            left: 0;
            background-color: #f8f9fa;
            overflow-x: hidden;
            padding-top: 20px;
            transition: 0.3s;
        }

        .content {
            margin-left: 250px;
            padding: 16px;
            transition: 0.3s;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
            }
        }

        .navbar-nav .nav-link {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <button id="sidebarToggle" class="btn btn-outline-secondary d-lg-none me-2">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../edit_profile.php">Edit Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="sidebar" class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="../dashboard.php"><i class="fas fa-home me-2"></i>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../blogs/index.php"><i class="fas fa-chart-bar me-2"></i>Blogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./index.php"><i class="fas fa-cog me-2"></i>Contact Form</a>
            </li>
        </ul>
    </div>
</body>

</html>

<?php

require_once '../db.php';
require_once 'functions.php';

$posts = getAllcontact($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-header {
            background-color: #f8f9fa;
            padding: 20px 0;
            margin-bottom: 20px;
        }
        .container {
            margin-left: 280px;
            max-width: 1180px;
        }
    </style>
</head>

<body>
    <div class="dashboard-header">
        <div class="container">
            <h1 class="display-4">Contact Form Dashboard</h1>
        </div>
    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone no.</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['name']); ?></td>
                        <td><?php echo htmlspecialchars($post['email']); ?></td>
                        <td><?php echo htmlspecialchars($post['phone']); ?></td>
                        <td><?php echo htmlspecialchars($post['subject']); ?></td>
                        <td><?php echo htmlspecialchars($post['message']); ?></td>
                        <td>
                            <a href="delete.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>