document.addEventListener("DOMContentLoaded", () => {
  const loginForms = document.querySelectorAll("form[id$='loginForm']");

  loginForms.forEach((form) => {
    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData(form);
      console.log("JS Activated");
      let loginType, redirectURL;

      switch (form.id) {
        case "vet-loginForm":
          console.log("Role: Vet");
          loginType = "vet";
          redirectURL = "/vet/profile";
          break;

        case "admin-loginForm":
          console.log("Role: admin");
          loginType = "admin";
          redirectURL = "/admin/management";
          break;

        case "loginForm":
          console.log("Role: Client");
          loginType = "client";
          redirectURL = "/dashboard";
        
        default: 
          console.log("No role detected:")
          break;
      }

      formData.append("loginType", loginType);

      try {
        const response = await fetch("/backend/login.php", {
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
            text: "Password or email is incorrect. Please try again.",
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
