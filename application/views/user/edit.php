<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Overview<div class="message"><?php if (isset($message)) { echo $message; } ?></div></div>
<form method="post" action="/user/edit">
    <div class="user-info-summary">
        <div class="item">
            <div class="key">First Name<span class="pink"> *</span></div>
            <div class="value"><input type="text" name="firstname" value="<?php echo $user["firstName"]; ?>" required/></div>
        </div>
        <div class="item">
            <div class="key">Last Name<span class="pink"> *</span></div>
            <div class="value"><input type="text" name="lastname" value="<?php echo $user["lastName"]; ?>" required/></div>
        </div>
        <div class="item">
            <div class="key">Gender<span class="pink"> *</span></div>
            <div class="value">
                <select name="gender">
                    <option value="M" <?php if ($gender == 'M') echo ' selected="selected"' ?>>Male</option>
                    <option value="F" <?php if ($gender == 'F') echo ' selected="selected"' ?>>Female</option>
                </select>
            </div>
        </div>
        <div class="item">
            <div class="key">Birth Date<span class="pink"> *</span></div>
            <div class="value"><input type="text" name="birthDate" value="<?php echo $birthDate; ?>" required onfocus="(this.type='date')" onblur="(this.type='text')"/></div>
        </div>
        <div class="item">
            <div class="key">Username</div>
            <div class="value"><?php echo $user["username"]; ?></div>
        </div>
        <div class="item">
            <div class="key">Password</div>
            <div class="value"><input type="password" name="password" placeholder="New Password"/></div>
        </div>
        <div class="item">
            <div class="key">Email<span class="pink"> *</span></div>
            <div class="value"><input type="email" name="email" value="<?php echo $user["email"]; ?>" required/></div>
        </div>
        <div class="item">
            <div class="key">Registration Date</div>
            <div class="value"><?php echo $registrationDate; ?></div>
        </div>
        <div class="item">
            <div class="key">Blood Type</div>
            <div class="value"><?php echo $bloodType; ?></div>
        </div>
        <div class="item">
            <div class="key">Emergency Contact<span class="pink"> *</span></div>
            <div class="value"><input type="tel" name="emergencyContact" value="<?php echo $emergencyContact; ?>" required/></div>
        </div>
        <div class="item">
            <div class="key">Verification Status</div>
            <div class="value"><?php echo $verificationStatus ?></div>
        </div>
    </div>
    <div class="c">
        <button type="submit" class="info-confirm color">Confirm</button>
    </div>
</form>