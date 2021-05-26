<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Donation Survey<div class="message">You have to completed the survey before making an appointment</div></div>
<div class="donation-history">
    <form method="post" action="/donation/survey">
        <div class="flex-box" style="max-width:600px; margin-bottom: 60px;">
            <div class="flex-item">
                Have you donated before?
            </div>
            <div class="flex-item">
                <input type="checkbox" name="donatedBefore" value="1"/>
            </div>
            <div class="flex-item">
                What is your last donation date
            </div>
            <div class="flex-item">
                <input type="date" name="lastDonationDate"/>
            </div>
            <div class="flex-item">
                Have you travel recently?
            </div>
            <div class="flex-item">
                <input type="checkbox" name="hasTravel" value="1"/>
            </div>
        </div>
        <br/><br/><br/>
        <button type="submit" name="submit" value="submit" class="color">Submit</button>
        <button type="button" onclick="location.href='/main'">Cancel</button>
    </form>
</div>