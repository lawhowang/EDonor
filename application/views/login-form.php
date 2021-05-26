<form method="post" action="/auth/processLogin">
    <div class="subheader">Log-in<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
    <div>
        <input type="text" name="username" placeholder="Username / Email" autocomplete="off"/><br><br>
        <input type="password" name="password" placeholder="Password" autocomplete="off"/><br><br><br>
        <button type="submit" value="Submit">Login</button>
    </div>
    <br>
    <br>
    <div class="register-now"><a class="u" href="/auth/register">Don't have an account yet? Register as a donor now!</a></div>
</form>