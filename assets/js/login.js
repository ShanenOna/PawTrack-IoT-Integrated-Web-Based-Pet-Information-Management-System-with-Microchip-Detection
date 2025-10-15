document.addEventListener("DOMContentLoaded", () => {
  const loginForms = document.querySelectorAll("form[id$='loginForm']");

  loginForms.forEach((form) => {
    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData(form);

      let loginType, redirectURL;

      switch (form.id) {
        case "vet-loginForm":
          loginType = "vet";
          redirectURL = "/pawtrack/frontend/vet/vet-profile.php";
          break;

        case "admin-loginForm":
          loginType = "admin";
          redirectURL = "/pawtrack/frontend/admin/admin-management.php";
          break;

        default:
          loginType = "client";
          redirectURL = "/pawtrack/frontend/dashboard.php";
      }

      formData.append("loginType", loginType);

      try {
        const response = await fetch("/pawtrack/backend/login.php", {
          method: "POST",
          body: formData,
        });

        const data = await response.json();

        if (!response.ok) {
          Swal.fire({
            icon: "error",
            title:
              response.status === 400
                ? "Invalid Password"
                : response.status === 404
                ? "Email Not Found"
                : "Something went wrong",
            text: data.message,
          });
          return;
        }

        Swal.fire({
          icon: "success",
          title: "Welcome Back!",
          text: data.message,
          showConfirmButton: false,
          timer: 1200,
        }).then(() => {
          window.location.href = redirectURL;
        });
      } catch (error) {
        Swal.fire({
          icon: "error",
          title: "Network Error",
          text: "Unable to connect to the server. Please try again later.",
        });
        console.error(error);
      }
    });
  });
});
