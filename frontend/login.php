<?php
$pageTitle = "PawTrack - Login";
?>

<body class="auth-page">
    <div class="auth-background"></div>

    <div class="auth-container">
        <div class="auth-branding">
            <h1 class="auth-logo">PawTrack</h1>
            <p class="auth-tagline">Caring Made Simple<br>for You and Your Pet!</p>
        </div>

        <div class="auth-form-wrapper">
            <div class="auth-form-card">
                <h1>Client Login</h1>
                <form class="auth-form" id="loginForm">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email">
                        <span id="emailError" class="error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter password">
                        <span id="passwordError" class="error-message"></span>
                    </div>
                
                    <button type="submit" id="signInBtn" class="auth-btn">Sign In</button>

                    <div class="auth-link">
                        <p>Sign up as:</p>
                        <div>
                            <a href="/admin/login">Admin</a>
                        <a href="/vet/login">Veterinarian</a>
                        </div>
                        <hr>
                        <a href="/signup">No account? Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/login.js"></script>
</body>
