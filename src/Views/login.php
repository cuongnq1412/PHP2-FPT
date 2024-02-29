<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="<?php echo BASE_URLC;?>public/css/login-style.css" />

    <!-- ===== BOX ICONS ===== -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />

    <title>Login form responsive</title>
</head>

<body>
    <div class="l-form">
        <div class="shape1"></div>
        <div class="shape2"></div>

        <div class="form">
            <img src="<?php echo BASE_URLC;?>public/img/authentication.svg" alt="" class="form__img" />

            <form method="post" class="form__content">
                <h1 class="form__title">Welcome</h1>

                <div class="form__div form__div-one">
                    <div class="form__icon">
                        <i class="bx bx-user-circle"></i>
                    </div>

                    <div class="form__div-input">
                        <label for="" class="form__label">Username</label>
                        <input type="text" class="form__input" name="username" />
                    </div>
                </div>

                <div class="form__div">
                    <div class="form__icon">
                        <i class="bx bx-lock"></i>
                    </div>

                    <div class="form__div-input">
                        <label for="" class="form__label">Password</label>
                        <input type="password" class="form__input" name="password" />
                    </div>
                </div>
                <a href="#" class="form__forgot">Forgot Password?</a>

                <input type="submit" class="form__button" value="Login" />
                <a href="register" class="form__forgot">Register</a>


                <div class="form__social">
                    <span class="form__social-text">Our login with</span>

                    <a href="#" class="form__social-icon"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="form__social-icon"><i class="bx bxl-google"></i></a>
                    <a href="#" class="form__social-icon"><i class="bx bxl-instagram"></i></a>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MAIN JS ===== -->
    <script src="<?php echo BASE_URLC;?>public/js/login.js"></script>
</body>

</html>