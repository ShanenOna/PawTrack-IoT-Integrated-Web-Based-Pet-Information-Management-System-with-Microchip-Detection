document.addEventListener("DOMContentLoaded", () => {

    const signupForm = document.getElementById("signupForm");

    signupForm.addEventListener("submit", async (e) => {
        e.preventDefault();
    
        // Get Form Data
        const data = {
            fname: document.getElementById("signup-fname").value.trim(),
            lname: document.getElementById("signup-lname").value.trim(),
            email: document.getElementById("signup-email").value.trim(),
            password: document.getElementById("signup-password").value,
            confPass: document.getElementById("confirm-password").value
        }

        // Check if password matches
        if (data.password !== data.confPass) {
            Swal.fire({
                icon: "error",
                title: "Password Mismatch",
                text: "Your passwords do not match. Please try again.",
            });
            return;
        }

        try {
            // Sending data to backend
            const response = await fetch("/backend/signup.php", {
                method: "POST",
                body: JSON.stringify({
                    action: "register",
                    ...data
                }),
                headers: {
                    "Content-Type": "application/json"
                }
            });

            const fetch_data = await response.json();

            if (fetch_data.status === "error") {
                Swal.fire({
                    icon: "error",
                    title: "Signup Failed",
                    text: fetch_data.message || "Something went wrong. Try again.",
                });
                return;
            }

            // Success
            Swal.fire({
                icon: "success",
                title: "Account Created!",
                text: fetch_data.message || "You can now log in",
                showConfirmButton: false,
                timer: 1500,
            }).then(() => {
                window.location.href = "/";
            });

        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Network Error",
                text: "Unable to connect to the server. Please try again later.",
            });
            console.log(error);
        }
    });
});
