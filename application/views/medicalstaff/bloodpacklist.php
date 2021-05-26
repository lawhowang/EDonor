<style>
.blood-pack-list {
    display: flex;
    flex-wrap: wrap;
}
.blood-pack-item {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: center;
    padding: 10px 5px;
}
.blood-pack-item > div {
    width: 25%;
    text-align: center;
}
.blood-pack-item:nth-child(odd) {
    background-color: #f2f2f2;
}
</style>
<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Search for Blood Pack<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
    <div class="blood-pack-list">
    <div class="blood-pack-item" style="margin-bottom: 30px;">
        <div class="BloodType">Blood Type</div>
        <div class="WhiteBloodCell">Details</div>
        <div class="EntryDate">Entry Date</div>
        <div class="ExpiryDate">Expiry Date</div>
        <div class="Select"></div>
    </div>
    <?php
    foreach ($bloodPacks as $bloodPack) {
        ?>
        <div class="blood-pack-item">
            <div class="BloodType"><?php echo $bloodPack['bloodType']; ?></div>
            <div class="Details">
                White Blood Cell - <?php echo $bloodPack['whiteBloodCell']; ?> <br/>
                Red Blood Cell - <?php echo $bloodPack['redBloodCell']; ?> <br/>
                Hemoglobin - <?php echo $bloodPack['hemoglobin']; ?> <br/>
                Hematocrit - <?php echo $bloodPack['hematocrit']; ?> <br/>
            </div>
            <div class="EntryDate"><?php echo $bloodPack['entryDate']; ?></div>
            <div class="ExpiryDate"><?php echo $bloodPack['expiryDate']; ?></div>
            <div class="Select">
                <?php if ($bloodPack['reserved']) { ?>
                    Reserved on <?php echo $bloodPack['reservedDate'] ?>
                <?php } else { ?>
                    <button type="button" onclick="location.href='/medicalstaff/reserve?bloodPackId=<?php echo $bloodPack['bloodPackId']; ?>'">Reserve</button>
                <?php } ?>
            </div>
        </div>
        <?php
    }
    ?>
    </div>
    <br/><br/><br/>
    <div class="c">
        <button type="button" onclick="location.href='/medicalstaff/search?reset=1'" class="info-confirm">Back</button>
    </div>