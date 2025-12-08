<!DOCTYPE html>
<html>

<head>
    <title>Register</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef1f5;
        }

        .register-box {
            max-width: 500px;
            margin: 60px auto;
            padding: 35px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.15);
        }

        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h3 class="text-center mb-4">Create Account</h3>

        <!-- Success Message -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Validation Errors -->
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="/register/save" method="post">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="number" class="form-control" name="number" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" required>
                    <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                        &#128065;
                    </span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                    <span class="input-group-text password-toggle" onclick="togglePassword('confirm_password')">
                        &#128065;
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="mt-3 text-center">
            Already have an account?<a href="/login"> Login</a>
        </p>
    </div>

    <script>
        function togglePassword(id) {
            const field = document.getElementById(id);
            field.type = field.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>