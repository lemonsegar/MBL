
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-color: #f5f7fa;
}

.login-container {
    text-align: center;
}

.login-box {
    background-color: #ffffff;
    padding: 40px;
    width: 300px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.login-icon img {
    width: 50px;
    height: 50px;
    margin-bottom: 20px;
}

h2 {
    font-size: 24px;
    color: #555555;
    margin-bottom: 20px;
}

h3 {
    color: #8a2be2;
    margin-bottom: 20px;
}

form input[type="text"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 10px 0;
}

.options label {
    color: #555;
}

.options .forgot-password {
    color: #8a2be2;
    text-decoration: none;
    font-size: 14px;
}

.login-button {
    width: 100%;
    padding: 10px;
    background-color: #8a2be2;
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.login-button:hover {
    background-color: #7a1ed9;
}

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login #08</h2>
        <div class="login-box">
            <div class="login-icon">
                <img src="<?=base_url()?>/assets/images/al.jpg" alt="User Icon">
            </div>
            <?php
                if (session()->getFlashdata('msg')) : ?>
                    <div class="alert aler-danger">
                        <?= session()->getFlashdata('msg') ?> </div>

                <?php
                endif;
                ?>
            <h3>Have an account?</h3>
            <form action="<?= base_url('login/ceklogin') ?>" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="options">
                    <label>
                        <input type="checkbox" name="remember_me"> Remember Me
                    </label>
                    <a href="#" class="forgot-password">Forgot Password</a>
                </div>
                <button type="submit" class="login-button">Get Started</button>
            </form>
        </div>
    </div>
</body>
</html>



