// Tab switching functionality
function showTab(tabName) {
  // Hide all tabs
  const tabs = document.querySelectorAll(".tab-pane");
  tabs.forEach((tab) => {
    tab.classList.remove("active");
  });

  // Remove active class from all menu items
  const menuItems = document.querySelectorAll(".menu-item");
  menuItems.forEach((item) => {
    item.classList.remove("active");
  });

  // Show selected tab
  const selectedTab = document.getElementById(tabName + "-tab");
  if (selectedTab) {
    selectedTab.classList.add("active");
  }

  // Add active class to clicked menu item
  event.target.classList.add("active");
}

// Contact form validation and submission
const contactForm = document.getElementById("contactForm");
if (contactForm) {
  contactForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const surname = document.getElementById("surname").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    // Validate all fields are filled
    if (!name || !surname || !email || !message) {
      alert("Please fill in all fields");
      return;
    }

    // Validate email format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address");
      return;
    }

    // Success message
    alert("Thank you for contacting us! We will get back to you soon.");
    contactForm.reset();
  });
}

// Vet search pet microchip functionality
function searchPetMicrochip() {
  const searchInput = document.getElementById("vetSearchInput");
  if (searchInput) {
    const microchipNumber = searchInput.value.trim();

    if (microchipNumber.length === 0) {
      alert("Please enter a microchip number");
      return;
    }

    if (microchipNumber.length < 15 || microchipNumber.length > 17) {
      alert("Microchip number must be 15-17 digits");
      return;
    }

    // Store microchip number and redirect to pet details
    sessionStorage.setItem("searchedMicrochip", microchipNumber);
    window.location.href = "vet-pet-details.html";
  }
}

function vetLogout() {
  Swal.fire({
    title: "Do you want to log out?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#0F9D58",
    cancelButtonColor: "#DB4437",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "/pawtrack/backend/vet-logout.php";
    }
  });
}

function logout() {
  Swal.fire({
    title: "Do you want to log out?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#0F9D58",
    cancelButtonColor: "#DB4437",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "/pawtrack/backend/logout.php";
    }
  });
}

function adminLogout() {
  Swal.fire({
    title: "Do you want to log out?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#0F9D58",
    cancelButtonColor: "#DB4437",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "/pawtrack/backend/admin-logout.php";
    }
  });
}

// Initialize page
document.addEventListener("DOMContentLoaded", function () {
  // Check if we're on the pets page
  if (window.location.pathname.includes("pets.html")) {
    const petId = sessionStorage.getItem("currentPetId");
    console.log("Current pet ID:", petId);
    // You can load specific pet data based on petId here
  }

  // Add smooth scrolling
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
        });
      }
    });
  });

  // Microchip scanner input validation
  const microchipInput = document.querySelector(".microchip-input");
  if (microchipInput) {
    microchipInput.addEventListener("input", function (e) {
      // Only allow numbers
      this.value = this.value.replace(/[^0-9]/g, "");

      // Limit to 17 digits
      if (this.value.length > 17) {
        this.value = this.value.slice(0, 17);
      }
    });
  }

  // Add button functionality
  const addBtn = document.querySelector(".add-btn");
  if (addBtn) {
    addBtn.addEventListener("click", function () {
      const input = document.querySelector(".microchip-input");
      if ((input && input.value.length === 15) || input.value.length === 17) {
        alert("Microchip number added: " + input.value);
        // Here you would typically send this to a backend
        input.value = "";
      } else {
        alert("Please enter a valid microchip number (15 or 17 digits)");
      }
    });
  }

  // Add expand button functionality
  const expandBtn = document.querySelector(".expand-btn");
  if (expandBtn) {
    expandBtn.addEventListener("click", function () {
      alert("Expand functionality - Add new pet");
      // This would open a modal or form to add a new pet
    });
  }

  // Add microchip button functionality
  const addMicrochipBtn = document.querySelector(".add-microchip-btn");
  if (addMicrochipBtn) {
    addMicrochipBtn.addEventListener("click", function () {
      alert("Add/Edit microchip number functionality");
      // This would open a modal or form to edit microchip
    });
  }
});
