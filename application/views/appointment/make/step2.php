<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Please Select a Date<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
<form method="post" action="/appointment/make">
    <div class="appointment-make">
    <div class="value"><input type="text" name="date" placeholder="Appointment Date" required onfocus="(this.type='date')" onblur="(this.type='text')"/></div>
        <br/><br/><br/>
    </div>
    <div class="c">
        <button type="button" onclick="window.history.back();">Prev</button>
        <button type="submit" class="info-confirm color">Next</button>
        <button type="button" onclick="location.href='/main'">Cancel</button>
    </div>
</form>