document.addEventListener("DOMContentLoaded", () => {
  const expandBtn = document.querySelector(".expand-btn");
  if (!expandBtn) return;

  // Open modal when ⊕ button is clicked
  expandBtn.addEventListener("click", openAddPetModal);
});

// Function to create and show the Add Pet modal
function openAddPetModal() {
  // Prevent multiple modals
  if (document.getElementById("addPetModal")) return;

  const modal = document.createElement("div");
  modal.id = "addPetModal";
  modal.className = "modal-overlay";
  modal.innerHTML = `
    <div class="modal-content">
      <span class="close-btn" onclick="closeAddPetModal()">&times;</span>
      <h2>Add a New Pet</h2>
      <form id="addPetForm" enctype="multipart/form-data">
        <label>Pet Microchip Number</label>
        <input type="text" name="PetChipNum" required>

        <label>Pet Name</label>
        <input type="text" name="PetName" required>

        <label>Species</label>
        <input type="text" name="Species" required>

        <label>Breed</label>
        <input type="text" name="Breed">

        <label>Gender</label>
        <select name="Gender" required>
          <option value="">Select Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>

        <label>Age</label>
        <input type="number" name="Age" min="0">

        <label>Weight (kg)</label>
        <input type="number" step="0.1" name="Weight" min="0">

        <label>Color/Markings</label>
        <input type="text" name="ColorMarkings">

        <label>Pet Image</label>
        <input type="file" name="PetPic" accept="image/*">

        <button type="submit" class="submit-btn">Add Pet</button>
      </form>
    </div>
  `;
  document.body.appendChild(modal);

  // Handle form submission
  const form = document.getElementById("addPetForm");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Confirm before saving
    const confirmAdd = await Swal.fire({
      title: "Add this pet?",
      text: "Are you sure you want to add this new pet record?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Yes, add pet",
      cancelButtonText: "Cancel",
    });

    if (!confirmAdd.isConfirmed) return;

    // Show loading alert
    Swal.fire({
      title: "Adding pet...",
      text: "Please wait while we save the new pet record.",
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading(),
    });

    const formData = new FormData(form);

    try {
      const response = await fetch("/backend/add-pet-api.php", {
        method: "POST",
        body: formData,
      });

      const contentType = response.headers.get("content-type");
      if (!contentType || !contentType.includes("application/json")) {
        throw new Error("Server did not return JSON.");
      }

      const data = await response.json();

      Swal.close(); // close loading state

      if (data.status === "success") {
        // Success alert + reload
        await Swal.fire({
          icon: "success",
          title: "Pet Added!",
          text: data.message || "New pet has been added successfully.",
          timer: 1500,
          showConfirmButton: false,
        });

        closeAddPetModal();

        // Optional: reload so new image/cards show up
        setTimeout(() => location.reload(), 1000);
      } else {
        Swal.fire("Error", data.message || "Failed to add pet.", "error");
      }
    } catch (err) {
      Swal.close();
      console.error("Fetch Error:", err);
      Swal.fire("Error", "Failed to add pet.", "error");
    }
  });
}

// Function to close the modal
function closeAddPetModal() {
  const modal = document.getElementById("addPetModal");
  if (modal) modal.remove();
}
