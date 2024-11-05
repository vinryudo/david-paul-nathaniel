<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login Form</title>
    <style>
        body, html {
            height: 100%;
        }
        .card-container {
            max-width: 350px;
            padding: 40px;
            margin: 50px auto;
            background-color: #F7F7F7;
            border-radius: 2px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .profile-img-card {
            width: 96px;
            height: 96px;
            margin: 10px auto;
            border-radius: 50%;
        }
        .form-control:focus {
            border-color: rgb(104, 145, 162);
            box-shadow: 0 0 8px rgb(104, 145, 162);
        }
        .btn-signin {
            background-color: rgb(104, 145, 162);
            font-weight: 700;
            border: none;
            transition: background-color 0.218s;
        }
        .btn-signin:hover {
            background-color: rgb(12, 97, 33);
        }
        .alert {
            max-width: 300px; 
            margin: 20px auto; 
            padding: 10px; 
            text-align: center;
            position: relative; 
        }
        .alert button.close {
            position: absolute;
            right: 10px; 
            top: 0px; 
            border: none;
            background: none;
            color: inherit; 
            font-size: 1.5rem; 
            cursor: pointer;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .form-group, .form-control {
            margin-bottom: 15px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            $showAlert = false;
            $successAlert = false;

            $validCredentials = [
                (object)['role' => 'admin', 'username' => 'admin', 'password' => 'Pass1234'],
                (object)['role' => 'admin', 'username' => 'renmark', 'password' => 'Pogi1234'],
                (object)['role' => 'content-manager', 'username' => 'paul', 'password' => 'david'],
                (object)['role' => 'content-manager', 'username' => 'richard', 'password' => 'yap'],
                (object)['role' => 'system-user', 'username' => 'pedro', 'password' => 'penduko'],
            ];

            function validateUser($role, $username, $password, $validCredentials) {
                foreach ($validCredentials as $user) {
                    if ($user->role === $role && $user->username === $username && $user->password === $password) {
                        return true;  
                    }
                }
                return false; 
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $role = $_POST['userRole'];

                if (validateUser($role, $username, $password, $validCredentials)) {
                    $successAlert = true; 
                } else {
                    $showAlert = true;
                }
            }
        ?>

        <?php if ($showAlert): ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Invalid username or password.
            </div>
        <?php endif; ?>

        <?php if ($successAlert): ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Welcome to the System: <?= htmlspecialchars($username); ?>
            </div>
        <?php endif; ?>

        <div class="card card-container">
            <img class="profile-img-card" src="img/avatar_2x.png" alt="Profile Image">
            <form class="form-signin" method="POST">
                <div class="form-group">
                    <select name="userRole" class="form-control" required>
                        <option value="admin" selected>Admin</option>
                        <option value="content-manager">Content Manager</option>
                        <option value="system-user">System User</option>
                    </select>
                </div>
                <input type="text" name="username" class="form-control" placeholder="User Name" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
