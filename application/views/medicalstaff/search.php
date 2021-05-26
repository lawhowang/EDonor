<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Search for Blood Pack<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
<form method="post" action="/medicalstaff/search">
    <select name="bloodType">
        <option value="" disabled selected>Patient's Blood Type</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
    </select>
    <br/><br/>
    <input type="checkbox" name="nonReservedOnly" id="nonReservedOnly"><label for="nonReservedOnly">Show non-reserved blood pack only</label><br/><br/>
    <input type="checkbox" name="showCompatible" id="showCompatible"><label for="showCompatible">Show compatible blood type also</label><br/><br/>
    <br/><br/><br/>
    <div class="c">
        <button type="submit" class="info-confirm color">Search</button>
    </div>
</form>