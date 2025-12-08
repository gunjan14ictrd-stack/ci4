<!DOCTYPE html>
<html>

<head>
    <title>Create Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f4f9;
        }

        .card-box {
            max-width: 420px;
            margin: 70px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeIn .6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .password-toggle {
            cursor: pointer;
            user-select: none;
        }
    </style>
</head>

<body>

    <div class="card-box">
        <h3 class="text-center mb-3">Create Your Password</h3>
        <p class="text-muted text-center mb-4">
            Please set a secure password to complete your account setup.
        </p>

        <!-- Success Message -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="/create-password/save/<?= $id ?>" method="post">

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <span class="input-group-text password-toggle" onclick="togglePass('password')">👁</span>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="conf_password" id="conf_password" class="form-control" required>
                    <span class="input-group-text password-toggle" onclick="togglePass('conf_password')">👁</span>
                </div>
            </div>

            <button class="btn btn-primary w-100 mt-2">Save Password</button>
        </form>

    </div>

    <script>
        function togglePass(id) {
            let input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>