<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Result of your appointment<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
<form method="post" action="/appointment/make">
    <div class="appointment-make">
        <div class="flex-box" style="max-width:500px;">
            <div class="flex-item">
                Reference Number
            </div>
            <div class="flex-item">
                <?php echo $referenceNumber; ?>
            </div>
            <div class="flex-item">
                Name
            </div>
            <div class="flex-item">
                <?php echo $user["lastName"].' '.$user["firstName"]; ?>
            </div>
            <div class="flex-item">
                Venue Name
            </div>
            <div class="flex-item">
                <?php echo $venueName; ?>
            </div>
            <div class="flex-item">
                Date
            </div>
            <div class="flex-item">
                <?php echo $date; ?>
            </div>
            <div class="flex-item">
                Time
            </div>
            <div class="flex-item">
                <?php echo $timeSlot; ?>
            </div>
            <div class="flex-item">
                Contact
            </div>
            <div class="flex-item">
                <?php echo $emergencyContact; ?>
            </div>
            <div class="flex-item">
                Email
            </div>
            <div class="flex-item">
                <?php echo $user["email"]; ?>
            </div>
        </div>
        <br/><br/><br/>
    </div>
    <div class="c">
        <button type="button" class="info-confirm color" onclick="location.href='/main'">Back to portal</button>
        <button type="button" onclick="window.print()">Print</button>
    </div>
</form>