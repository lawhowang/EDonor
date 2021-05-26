<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Review your reservation<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
<div class="reservations">
    <?php foreach ($reservations as $reservation) {
        ?>
        <div class="flex-box" style="max-width:500px; margin-bottom: 60px;">
            <div class="flex-item">
                Reserved Datetime
            </div>
            <div class="flex-item">
                <?php
                    echo $reservation["reservedDate"];
                ?>
            </div>
            <div class="flex-item">
                Blood Type
            </div>
            <div class="flex-item">
                <?php
                    echo $reservation["bloodType"];
                ?>
            </div>
            <div class="flex-item">
                Details
            </div>
            <div class="flex-item">
                White Blood Cell - <?php echo $reservation['whiteBloodCell']; ?> <br/>
                Red Blood Cell - <?php echo $reservation['redBloodCell']; ?> <br/>
                Hemoglobin - <?php echo $reservation['hemoglobin']; ?> <br/>
                Hematocrit - <?php echo $reservation['hematocrit']; ?> <br/>
            </div>
            <div class="flex-item">
                Entry Date
            </div>
            <div class="flex-item">
                <?php
                    echo $reservation["entryDate"];
                ?>
            </div>
            <div class="flex-item">
                Expiry Date
            </div>
            <div class="flex-item">
                <?php
                    echo $reservation["expiryDate"];
                ?>
            </div>
            <div class="flex-item">
                Cancel reservation
            </div>
            <div class="flex-item">
                <a href="javascript: if (confirm('Are you sure you want to cancel this reservation?')) { location.href = '/medicalstaff/cancel?id=<?php echo $reservation['bloodPackId'] ?>'; }"><i class="fas fa-times pink" style="margin-top: 2px;"></i></a>
            </div>
            <div class="flex-item">
                Request blood pack
            </div>
            <div class="flex-item">
                <a href="javascript: if (confirm('Are you sure you want this blood pack?')) { location.href = '/medicalstaff/request?id=<?php echo $reservation['bloodPackId'] ?>'; }"><i class="fas fa-check green" style="margin-top: 2px;"></i></a>
            </div>
        </div>
        <?php
    }
    ?>
    <br/><br/><br/>
</div>