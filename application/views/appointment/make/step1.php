<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Please Select a Donation Venue<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
<form method="post" action="/appointment/make">
    <div class="appointment-make">
        <select id="venue" name="venue" placeholder="Select a donation venue" required onchange="updateAddress()">
            <option value="" disabled selected>Select a venue</option>
            <?php
                foreach ($venue as $row)
                {
                    echo '<option value='.$row['id'].' >'.$row['name'].'</option>';
                }
            ?>
        </select>
        <?php
            foreach ($venue as $row)
            {
                echo '
                <div class="address-hint" id="address-hint-'.$row['id'].'" style="max-height: 0; color: #999; overflow: hidden; transition: all .35s ease-in-out;">
                <br/><br/><br/>
                Address : <span id="address">'.$row['address'].'</span><br/>
                Office hours : <span id="hour">'.$row['openTime'].' - '.$row['closeTime'].'</span><br/>
                </div>
                ';
            }
        ?>

        <br/><br/><br/>
    </div>
    <div class="c">
        <button type="submit" class="info-confirm color">Next</button>
    </div>
</form>
<script>
function updateAddress() {
    var elements = document.getElementsByClassName("address-hint");
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.maxHeight = "0";
    }
    var e = document.getElementById("venue");
    var index = e.options[e.selectedIndex].value;
    var element = document.getElementById("address-hint-" + index);
    element.style.maxHeight = "100px";
}
</script>