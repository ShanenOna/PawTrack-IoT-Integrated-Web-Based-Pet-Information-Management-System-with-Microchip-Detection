document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchPetInput");
  const searchBtn = document.getElementById("searchPetBtn");
  const petDetailsGrid = document.getElementById("petDetailsGrid");
  const petImage = document.getElementById("petImage");
  const petMicrochip = document.getElementById("petMicrochip");
  const petDetailsDiv = document.getElementById("petDetails");
  const petRecordsDiv = document.getElementById("petRecords");

  // Reports buttons
  const updateVaccBtn = document.querySelector(".vet-actions-list button:nth-child(1)");
  const generateReportBtn = document.querySelector(".vet-actions-list button:nth-child(2)");
  const writeNoteBtn = document.querySelector(".vet-actions-list button:nth-child(3)");

  if (!searchInput || !searchBtn || !petDetailsGrid || !petImage || !petMicrochip || !petDetailsDiv || !petRecordsDiv) {
    console.error("One or more pet detail elements are missing in HTML!");
    return;
  }

  let currentPet = null;

  // ------------------- SEARCH PET BY MICROCHIP -------------------
  const searchPet = async () => {
    const query = searchInput.value.trim();
    if (!query) return Swal.fire("Missing Input", "Please enter Microchip Number.", "warning");

    try {
      Swal.fire({
        title: "Searching...",
        text: "Please wait while we look up the pet record.",
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });

      const response = await fetch("/backend/fetch-pet-api.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `PetChipNum=${encodeURIComponent(query)}`
      });

      if (!response.ok) {
        Swal.close();
        return Swal.fire("Error", `Server returned status ${response.status}`, "error");
      }

      const data = await response.json();
      Swal.close();

      if (data.status !== "success") return Swal.fire("Not Found", data.message, "warning");

      const pet = data.details;
      currentPet = pet;

      // Display pet info
      petDetailsGrid.style.display = "grid";
      petImage.src = pet.PetPic ? `/storage/images/pets/${pet.PetPic}` : "../storage/images/pets/pet1.png";
      petMicrochip.textContent = pet.PetChipNum;

      petDetailsDiv.innerHTML = `
        <p><strong>Name:</strong> ${pet.PetName}</p>
        <p><strong>Species:</strong> ${pet.Species}</p>
        <p><strong>Breed:</strong> ${pet.Breed}</p>
        <p><strong>Gender:</strong> ${pet.Gender}</p>
        <p><strong>Age:</strong> ${pet.Age}</p>
        <p><strong>Weight:</strong> ${pet.Weight} kg</p>
        <p><strong>Color/Markings:</strong> ${pet.ColorMarkings}</p>
      `;

      petRecordsDiv.innerHTML = `
        <button class="vet-action-btn" onclick="openPopout('records-vaccination', '${pet.PetID}', '${pet.PetName}')">Vaccination History</button>
        <button class="vet-action-btn" onclick="openPopout('records-medical', '${pet.PetID}', '${pet.PetName}')">Medical Records</button>
        <button class="vet-action-btn" onclick="openPopout('records-notes', '${pet.PetID}', '${pet.PetName}')">Notes</button>
        <button class="vet-action-btn" onclick="downloadFullRecord('${pet.PetID}', '${pet.PetName}')">Download Full Record</button>
      `;
    } catch (error) {
      console.error("Fetch Error:", error);
      Swal.fire("Error", "Error fetching pet details.", "error");
    }
  };

  searchBtn.addEventListener("click", searchPet);
  searchInput.addEventListener("keypress", e => e.key === "Enter" && searchPet());

  // ------------------- POPUPS FOR ACTION BUTTONS -------------------
  if (updateVaccBtn)
    updateVaccBtn.addEventListener("click", () =>
      openPopoutForm("update-vaccination", currentPet?.PetID, currentPet?.PetName, currentPet?.ClientID)
    );
  if (generateReportBtn)
    generateReportBtn.addEventListener("click", () =>
      openPopoutForm("generate-medical", currentPet?.PetID, currentPet?.PetName, currentPet?.ClientID)
    );
  if (writeNoteBtn)
    writeNoteBtn.addEventListener("click", () =>
      openPopoutForm("write-note", currentPet?.PetID, currentPet?.PetName, currentPet?.ClientID)
    );
});

/* ------------------------- POPUP CREATION ------------------------- */
function openPopoutForm(type, petID, petName, clientID) {
  if (!petID || !petName) return Swal.fire("No Pet Selected", "Please search a pet first.", "warning");

  const popoutID = `${type}-${petID}`;
  let popout = document.getElementById(popoutID);

  if (!popout) {
    popout = document.createElement("div");
    popout.id = popoutID;
    popout.className = "popout-modal";

    let formHTML = "";

    // 🔹 Vaccination Form
    if (type === "update-vaccination") {
      formHTML = `
        <form id="formVaccination-${petID}" class="vet-form">
          <label>Shot Type</label>
          <input type="text" name="ShotType" required>

          <label>Date</label>
          <input type="date" name="Date" required>

          <label>Next Due Date</label>
          <input type="date" name="NextDueDate" required>

          <label>Veterinarian Name</label>
          <input type="text" name="Veterinarian" required>

          <label>Clinic</label>
          <input type="text" name="Clinic" required>

          <button type="submit" class="vet-submit-btn">Save Record</button>
        </form>
      `;
    }

    // 🔹 Medical Record Form
    else if (type === "generate-medical") {
      formHTML = `
        <form id="formMedical-${petID}" class="vet-form">
          <label>Diagnosis</label>
          <input type="text" name="Diagnosis" required>

          <label>Date Diagnosed</label>
          <input type="date" name="DateDiagnosed" required>

          <label>Treatment</label>
          <input type="text" name="Treatment" required>

          <label>Notes</label>
          <textarea name="Notes" rows="3"></textarea>

          <button type="submit" class="vet-submit-btn">Save Medical Record</button>
        </form>
      `;
    }

    // 🔹 Notes Form
    else if (type === "write-note") {
      formHTML = `
        <form id="formNote-${petID}" class="vet-form">
          <label>Veterinarian</label>
          <input type="text" name="Veterinarian" required>

          <label>Clinic</label>
          <input type="text" name="Clinic" required>

          <label>Visit Type</label>
          <input type="text" name="VisitType" required>

          <label>Notes</label>
          <textarea name="Notes" rows="3"></textarea>

          <label>Follow Up Recommendation</label>
          <textarea name="FollowUp" rows="2"></textarea>

          <button type="submit" class="vet-submit-btn">Save Note</button>
        </form>
      `;
    }

    popout.innerHTML = `
      <div class="popout-content">
        <span class="close-btn" onclick="togglePopout('${popoutID}')">&times;</span>
        <h4>${formatType(type)} for ${petName}</h4>
        <div class="popout-body">${formHTML}</div>
      </div>
    `;

    document.body.appendChild(popout);

    // ------------------- FORM SUBMISSION HANDLER -------------------
    const form = popout.querySelector("form");
    if (form) {
      form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        formData.append("PetID", petID);
        formData.append("ClientID", clientID);

        let endpoint = "";
        if (type === "update-vaccination") endpoint = "/backend/upload-vaccination.php";
        else if (type === "generate-medical") endpoint = "/backend/upload-medical.php";
        else if (type === "write-note") endpoint = "/backend/upload-note.php";

        try {
          Swal.fire({
            title: "Saving...",
            text: "Please wait while we save the record.",
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
          });

          const res = await fetch(endpoint, { method: "POST", body: formData });
          const result = await res.json();

          Swal.close();

          if (result.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Record Saved!",
              text: "The record was successfully uploaded.",
              confirmButtonColor: "#3085d6"
            }).then(() => {
              togglePopout(popoutID);
              location.reload(); // 🔄 reload page to reflect updated image/info
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Failed!",
              text: result.message || "An error occurred while saving."
            });
          }
        } catch (err) {
          console.error("Error saving record:", err);
          Swal.fire("Error", "Unable to save the record. Please try again.", "error");
        }
      });
    }
  }

  popout.style.display = "block";
}

/* ------------------------- UTILS ------------------------- */
function togglePopout(popoutID) {
  const popout = document.getElementById(popoutID);
  if (!popout) return;
  popout.style.display = popout.style.display === "block" ? "none" : "block";
}

function formatType(type) {
  return type.replace(/-/g, " ").replace(/\b\w/g, l => l.toUpperCase());
}

/* ------------------------- POPUP FOR RECORD TABLES ------------------------- */
async function openPopout(type, petID, petName) {
  if (!petID || !petName) return Swal.fire("No Pet Selected", "Please search a pet first.", "warning");

  const popoutID = `${type}-${petID}`;
  let popout = document.getElementById(popoutID);

  if (!popout) {
    popout = document.createElement("div");
    popout.id = popoutID;
    popout.className = "popout-modal";

    popout.innerHTML = `
      <div class="popout-content">
        <span class="close-btn" onclick="togglePopout('${popoutID}')">&times;</span>
        <h4>${formatType(type)} for ${petName}</h4>
        <div class="popout-body">
          <p>Loading records...</p>
        </div>
      </div>
    `;

    document.body.appendChild(popout);
    await fetchRecords(type, petID, popout.querySelector(".popout-body"));
  }

  popout.style.display = "block";
}

/* ------------------------- FETCH RECORDS ------------------------- */
async function fetchRecords(type, petID, container) {
  let endpoint = "";
  if (type === "records-vaccination") endpoint = "/backend/fetch-vaccination.php";
  else if (type === "records-medical") endpoint = "/backend/fetch-medical.php";
  else if (type === "records-notes") endpoint = "/backend/fetch-notes.php";

  try {
    const res = await fetch(endpoint, {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `PetID=${encodeURIComponent(petID)}`
    });

    const data = await res.json();

    if (data.status !== "success" || !Array.isArray(data.records) || data.records.length === 0) {
      container.innerHTML = `<p>No records found.</p>`;
      return;
    }

    let tableHTML = "<table class='vet-table'><thead><tr>";

    if (type === "records-vaccination") {
      tableHTML += `
        <th>Shot Type</th><th>Date</th><th>Next Due</th><th>Veterinarian</th><th>Clinic</th>
      </tr></thead><tbody>`;
      data.records.forEach(r => {
        tableHTML += `<tr><td>${r.ShotType}</td><td>${r.Date}</td><td>${r.NextDueDate}</td><td>${r.Veterinarian}</td><td>${r.Clinic}</td></tr>`;
      });
    } else if (type === "records-medical") {
      tableHTML += `
        <th>Diagnosis</th><th>Date Diagnosed</th><th>Treatment</th><th>Notes</th>
      </tr></thead><tbody>`;
      data.records.forEach(r => {
        tableHTML += `<tr><td>${r.Diagnosis}</td><td>${r.DateDiagnosed}</td><td>${r.Treatment}</td><td>${r.Notes || "-"}</td></tr>`;
      });
    } else if (type === "records-notes") {
      tableHTML += `
        <th>Veterinarian</th><th>Clinic</th><th>Visit Type</th><th>Notes</th><th>Follow Up</th>
      </tr></thead><tbody>`;
      data.records.forEach(r => {
        tableHTML += `<tr><td>${r.Veterinarian}</td><td>${r.Clinic}</td><td>${r.VisitType}</td><td>${r.Notes || "-"}</td><td>${r.FollowUp || "-"}</td></tr>`;
      });
    }

    tableHTML += "</tbody></table>";
    container.innerHTML = tableHTML;
  } catch (error) {
    console.error("Error fetching records:", error);
    container.innerHTML = `<p>Error loading records.</p>`;
  }
}

/* ------------------------- DOWNLOAD FULL RECORD ------------------------- */
async function downloadFullRecord(petID, petName) {
  if (!petID) return Swal.fire("No Pet Selected", "Please search a pet first.", "warning");

  try {
    Swal.fire({
      title: "Preparing Download...",
      text: "Generating the full pet record PDF.",
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading()
    });

    const res = await fetch("/backend/download-pet-record.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `PetID=${encodeURIComponent(petID)}`
    });

    if (!res.ok) throw new Error(`Server returned ${res.status}`);

    const blob = await res.blob();
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = `${petName.replace(/\s+/g, "_")}_Full_Record.pdf`;
    document.body.appendChild(a);
    a.click();
    a.remove();
    window.URL.revokeObjectURL(url);

    Swal.close();
    Swal.fire("Success", "Full record downloaded successfully.", "success");
  } catch (err) {
    Swal.close();
    console.error("Download error:", err);
    Swal.fire("Error", "❌ Failed to download full record.", "error");
  }
}
