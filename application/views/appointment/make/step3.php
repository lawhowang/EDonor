<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Please Select a Time Slot<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
<form method="post" action="/appointment/make">
    <div class="appointment-make">
        <div class="flex-box">
            <div class="flex-item">
                Time Slot
            </div>
            <div class="flex-item">
                
            </div>
            <?php
                $closeTime = DateTime::createFromFormat('H:i', $closeTime);
                for ($timeSlot = DateTime::createFromFormat('H:i', $openTime); $timeSlot < $closeTime; $timeSlot->modify('+15 minutes'))
                {
                    echo '<div class="flex-item">'.$timeSlot->format('H:i').'</div>';
                    echo '<div class="flex-item"><input type="radio" name="timeSlot" value='.$timeSlot->format('H:i').' required></div>';
                }
            ?>
        </div>
        <br/><br/><br/>
    </div>
    <div class="c">
        <button type="button" onclick="window.history.back();">Prev</button>
        <button type="submit" class="info-confirm color">Next</button>
        <button type="button" onclick="location.href='/main'">Cancel</button>
    </div>
</form>