<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Donation History<div class="message">It only shows the donations in the past 60 days</div></div>
<div class="donation-history">
    <?php foreach ($donations as $donation) {
        ?>
        <div class="flex-box" style="max-width:500px; margin-bottom: 60px;">
            <div class="flex-item">
                Reference number
            </div>
            <div class="flex-item">
                <?php
                    echo $donation['id'];
                ?>
            </div>
            <div class="flex-item">
                Date
            </div>
            <div class="flex-item">
                <?php
                    echo $donation['donationDate'];
                ?>
            </div>
            <div class="flex-item">
                Venue
            </div>
            <div class="flex-item">
                <?php
                    echo $donation['venueName'];
                ?>
            </div>
            <div class="flex-item">
                Status
            </div>
            <div class="flex-item green">
                <?php
                    echo $donation['status'];
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <br/><br/><br/>
</div>