    <?php require_once "inc/header.php" ?>


    <style>
        .form-elements {
            max-width: 600px;
            margin: 0 auto;
            padding-top: 150px;
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

        input[type="email"],
        input[type="password"] {
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

        .link {
            margin-top: 10px;
            display: block;
            font-size: 14px;
            color: #0b74de;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container form-elements">
        <div class="card">

            <?php require_once "inc/conn.php" ?>
            <?php require_once "inc/errors.php" ?>
            <h1>Login</h1>
            <form method="post" action="handle/handleLogin.php" autocomplete="off">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="user@mail.com" required>

                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter Password" required>

                <button type="submit" name="submit" class="btn-primary">Login</button>
                <button type="reset" class="btn-reset">Reset</button>

                <a class="link" href="superAdmin/register.php">Don't have an account? Sign Up</a>
            </form>
        </div>
    </div>
    <?php require_once "inc/footer.php" ?>