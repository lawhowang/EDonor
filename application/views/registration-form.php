<form method="post" action="processRegistration">
<div class="subheader">Register<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
    <div>
        <input type="text" name="firstname" placeholder="First Name" autocomplete="off"/><br><br>
        <input type="text" name="lastname" placeholder="Last Name" autocomplete="off"/><br><br>
        <input type="text" name="birthDate" placeholder="Birth Date" autocomplete="off" onfocus="(this.type='date')" onblur="(this.type='text')"><br><br>
        <input type="radio" name="gender" id="male" value="male" checked><label for="male"> Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" id="female" value="female"><label for="female"> Female</label><br><br>
        <input type="text" name="username" placeholder="Username" autocomplete="off"/><br><br>
        <input type="password" name="password" placeholder="Password" autocomplete="off"/><br><br>
        <input type="email" name="email" placeholder="Email" autocomplete="off"/><br><br><br>
        <button type="submit" value="Submit">Register</button>
    </div>
    <br>
    <br>
    <div class="login-now"><a class="u" href="/auth/login">Already have an account? Log-in from here!</a></div>
</form>