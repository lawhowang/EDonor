<div class="member-info">
    <span class="welcome-msg">Welcome back, <?php echo $user["firstName"].', '.$user["lastName"]; ?></span>
    <a class="logout u" href="/auth/logout">Logout</a><br>
</div>

<div class="member-actions">
    <?php if ($user["isDonor"] == 1) { ?>
    <div class="box-container">
        <a class="box" href="/user/info">
            <div class="box-inner">
                <div class="title blue"><i class="fas fa-user"></i>Personal Information</div>
                <div class="hint">View or update your personal information in our database</div>
            </div>
        </a>
        <a class="box" href="/donation/history">
            <div class="box-inner">
                <div class="title orange"><i class="fas fa-history"></i>Donation History</div>
                <div class="hint">Check your donation records and the details</div>
            </div>
        </a>
        <a class="box" href="/appointment/make">
            <div class="box-inner">
                <div class="title pink"><i class="fas fa-tint"></i>Online Appointment</div>
                <div class="hint">Online appointment service for blood donation by selecting donor centre and time</div>
            </div>
        </a>
        <a class="box" href="/appointment/review">
            <div class="box-inner">
                <div class="title green"><i class="fas fa-calendar-check"></i>My Appointments</div>
                <div class="hint">Review or cancel your appointments for blood donation</div>
            </div>
        </a>
    </div>
    <?php } ?>
    <?php if ($user["isStaff"] == 1) { ?>
    <div class="box-container">
        <a class="box" href="/staff/verify">
            <div class="box-inner">
                <div class="title blue"><i class="fas fa-check"></i>Add Donation Record</div>
                <div class="hint">Add a donation record of a donor to the database. The donor will be verified meanwhile.</div>
            </div>
        </a>
    </div>
    <?php } ?>
    <?php if ($user["isMedicalStaff"] == 1) { ?>
    <div class="box-container">
        <a class="box" href="/medicalstaff/search">
            <div class="box-inner">
                <div class="title pink"><i class="fas fa-search"></i>Search for Blood Pack</div>
                <div class="hint">Look up and reserve for blood pack in the database</div>
            </div>
        </a>
        <a class="box" href="/medicalstaff/review">
            <div class="box-inner">
                <div class="title pink"><i class="fas fa-hand-holding-heart"></i>My Hospital Reservations</div>
                <div class="hint">Review reserved blood pack for your hospital</div>
            </div>
        </a>
    </div>
    <?php } ?>
</div>