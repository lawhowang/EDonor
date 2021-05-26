<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>
<div class="subheader c">Overview</div></div>
<div class="user-info-summary">
    <div class="item">
        <div class="key">First Name</div>
        <div class="value"><?php echo $user["firstName"]; ?></div>
    </div>
    <div class="item">
        <div class="key">Last Name</div>
        <div class="value"><?php echo $user["lastName"]; ?></div>
    </div>
    <div class="item">
        <div class="key">Gender</div>
        <div class="value"><?php echo $gender; ?></div>
    </div>
    <div class="item">
        <div class="key">Birth Date</div>
        <div class="value"><?php echo $birthDate; ?></div>
    </div>
    <div class="item">
        <div class="key">Username</div>
        <div class="value"><?php echo $user["username"]; ?></div>
    </div>
    <div class="item">
        <div class="key">Password</div>
        <div class="value"><?php echo '********'; ?></div>
    </div>
    <div class="item">
        <div class="key">Email</div>
        <div class="value"><?php echo $user["email"]; ?></div>
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
        <div class="key">Emergency Contact</div>
        <div class="value"><?php echo $emergencyContact ?></div>
    </div>
    <div class="item">
        <div class="key">Verification Status</div>
        <div class="value"><?php echo $verificationStatus ?></div>
    </div>
</div>
<div class="c">
    <button class="info-edit" onclick="location.href='/user/edit'">Edit</button>
</div>