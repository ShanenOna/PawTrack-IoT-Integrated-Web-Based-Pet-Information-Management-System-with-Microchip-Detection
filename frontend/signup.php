
<?php
$pageTitle = "PawTrack - Sign Up";
?>
<body class="auth-page">
    <!-- Background with dog -->
    <div class="auth-background"></div>

    <div class="auth-container">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <h1 class="auth-logo">PawTrack</h1>
            <p class="auth-tagline">Caring Made Simple<br>for You and Your Pet!</p>
        </div>

        <!-- Right Side - Sign Up Form -->
        <div class="auth-form-wrapper">
            <div class="auth-form-card">
                <h1>Sign Up</h1>
                <form class="auth-form" id="signupForm">
                    <div class="form-group">
                        <label for="signup-email">First Name</label>
                        <input type="text" id="signup-fname" name="fname" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="signup-email">Last Name</label>
                        <input type="text" id="signup-lname" name="lname" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="signup-email">Email</label>
                        <input type="email" id="signup-email" name="email" placeholder="Enter a valid email" required>
                    </div>

                    <div class="form-group">
                        <label for="signup-password">Password</label>
                        <input type="password" id="signup-password" name="password" placeholder="Enter a password"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="signup-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="password" placeholder="Enter a password"
                            required>
                    </div>

                    <button type="submit" class="auth-btn">Register</button>

                    <div class="auth-link">
                        <a href="/login">Already have an account? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/signup.js"></script>
</body>
