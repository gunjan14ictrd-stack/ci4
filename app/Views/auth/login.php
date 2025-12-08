<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .login-box {
            max-width: 450px;
            margin: 70px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.15);
        }

        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h3 class="text-center mb-4">Login</h3>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/login/check" method="post">

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <span class="input-group-text password-toggle" onclick="togglePassword()">👁</span>
                </div>
            </div>

            <button class="btn btn-primary w-100">Login</button>

        </form>

        <p class="mt-3 text-center">
            Don't have an account? <a href="/register">Register</a>
        </p>
    </div>

    <script>
        function togglePassword() {
            const field = document.getElementById('password');
            field.type = field.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>