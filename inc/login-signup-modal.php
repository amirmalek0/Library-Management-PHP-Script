<?php login();
signup();
// x = username , y = password
if (isset($_COOKIE['x']) && isset($_COOKIE['y'])) {
    $user_cookie = base64_decode(str_rot13($_COOKIE['x']));
    $pass_cookie = base64_decode(str_rot13($_COOKIE['y']));
}
?>
<div class="modal" id="ls-modal">
    <div class="modal-content">
        <span class="close" onclick="closeForm()">&times;</span>

        <form action="" class="login-inputs" id="login-inputs" method="POST">
            <h2>ورود به حساب</h2>
            <label for="login-username">نام کاربری:</label>
            <input id="login-username" name="username" type="text"
                   value="<?php if (isset($user_cookie)) echo $user_cookie; ?>">
            <label for="login-password">پسورد:</label>

            <span class="show-password" id="show-password" onclick="ShowPassLogin()"> نمایش &#128065; </span>

            <input id="login-password" name="password" type="password"
                   value="<?php if (isset($pass_cookie)) echo $pass_cookie; ?>">
            <label for="remember-me"> مرا بخاطر داشته باش</label>
            <input id="remember-me" type="checkbox"
                   name="remember-me" <?php if (isset($user_cookie) && isset($pass_cookie)) echo "checked"; ?>>
            <button class="submit-login" type="submit" name="Login">ورود</button>
            <p>حساب کاربری ندارید؟ <a onclick="goToSignUp()">ثبت نام کنید</a></p>
        </form>

        <form action="" class="signup-inputs" id="signup-inputs" method="POST">
            <h2>ثبت نام</h2>
            <label for="name">نام:</label>
            <input id="name" name="name" type="text">
            <label for="surname">نام خانوادگی:</label>
            <input id="surname" name="surname" type="text">
            <label for="signup-username">نام کاربری:</label>
            <input id="signup-username" name="username" type="text">
            <label for="signup-password">پسورد:</label>
            <span class="show-password" id="show-password-signup" onclick="ShowPassSignup()"> نمایش &#128065; </span>
            <input id="signup-password" name="password" type="password" minlength="8">
            <div class="password-strength">
                قدرت پسورد:
                <progress class="bar" id="bar" max="100" value="0"></progress>
                <div id="hint"></div>
            </div>

            <button class="submit-signup" type="submit" name="Signup" id="signup-button">ثبت نام</button>
            <p>حساب کاربری دارید؟ <a onclick="goToLogin()">ورود به حساب</a></p>
        </form>
    </div>
</div>