<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Review your appointment<div class="message">It only shows the appointment in the past 60 days</div></div>
<div class="appointment-make">
    <?php foreach ($appointments as $appointment) {
        ?>
        <div class="flex-box" style="max-width:500px; margin-bottom: 60px;">
            <div class="flex-item">
                Reference Number
            </div>
            <div class="flex-item">
                <?php
                    echo $appointment['id'];
                ?>
            </div>
            <div class="flex-item">
                Date
            </div>
            <div class="flex-item">
                <?php
                    echo $appointment['date'];
                ?>
            </div>
            <div class="flex-item">
                Time
            </div>
            <div class="flex-item">
                <?php
                    echo $appointment['time'];
                ?>
            </div>
            <div class="flex-item">
                Venue Name
            </div>
            <div class="flex-item">
                <?php
                    echo $appointment['venueName'];
                ?>
            </div>
            <div class="flex-item">
                Venue Address
            </div>
            <div class="flex-item">
                <?php
                    echo $appointment['address'];
                ?>
            </div>
            <div class="flex-item">
                Cancel this appointment
            </div>
            <div class="flex-item">
                <a href="javascript: if (confirm('Are you sure you want to cancel this appointment?')) { location.href = '/appointment/cancel?id=<?php echo $appointment['id'] ?>'; }"><i class="fas fa-times pink" style="margin-top: 2px;"></i></a>
            </div>
        </div>
        <?php
    }
    ?>
    <br/><br/><br/>
</div>