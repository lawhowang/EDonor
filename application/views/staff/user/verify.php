<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Add Donation Record<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
<form method="post" action="/staff/verify">
    <input type="text" name="referenceNumber" placeholder="Reference Number"><br/><br/>
    <select name="bloodType">
        <option value="" disabled selected>Donor Blood Type</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
    </select><br/><br/>
    <input type="text" name="whiteBloodCell" placeholder="White Blood Cell"><br/><br/>
    <input type="text" name="redBloodCell" placeholder="Red Blood Cell"><br/><br/>
    <input type="text" name="hemoglobin" placeholder="Hemoglobin"><br/><br/>
    <input type="text" name="hematocrit" placeholder="Hematocrit"><br/><br/>
    <input type="text" name="entryDate" placeholder="Entry Date" onfocus="(this.type='date')" onblur="(this.type='text')"><br/><br/>
    <input type="text" name="expiryDate" placeholder="Expiry Date" onfocus="(this.type='date')" onblur="(this.type='text')"><br/>
    <br/><br/><br/>
    <div class="c">
        <button type="submit" class="info-confirm color">Confirm</button>
    </div>
</form>