<!doctype html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Arial;
            background: #f5f7fb;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin: 0 0 20px;
            font-size: 22px;
            color: #222;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-primary {
            background: #0b74de;
            color: #fff;
        }

        .btn-reset {
            background: #eee;
            margin-right: 8px;
        }
    </style>
</head>


<body>
    <div class="container">
        <div class="card">
            <?php require_once "../inc/errors.php" ?>

            <h1>SignUp Form</h1>
            <!-- أضفت autocomplete="off" هنا -->
            <form method="post" action="handle/handleRegister.php" autocomplete="off">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" placeholder="Write Your Name" required>

                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="user@mail.com" required>

                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter Password" required>

                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="tel" placeholder="0123456789" required>

                <button type="submit" name="submit" class="btn-primary">Sign Up</button>
                <button type="reset" class="btn-reset">Reset</button>
            </form>
        </div>
    </div>

</body>

<?php require_once "../inc/footer.php" ?>

</html>