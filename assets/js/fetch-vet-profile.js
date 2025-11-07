document.addEventListener("DOMContentLoaded", function () {

  function loadVetData() {
    fetch("/backend/fetch-vet-api.php")
      .then(response => response.json())
      .then(data => {
        if (data.status === "success") {
          const vet = data.vet;

          //  Profile Sidebar
          const nameTag = document.querySelector(".vet-name");
          const profileImg = document.querySelector(".vet-profile-image");

          if (nameTag) nameTag.textContent = `Dr. ${vet.VetFName} ${vet.VetSName}`;
          if (profileImg) profileImg.src = `${vet.VetPic}`;

          //  Main Profile Info Section (optional elements)
          const fullNameTag = document.getElementById("vetNameFull");
          if (fullNameTag) fullNameTag.textContent = `Dr. ${vet.VetFName} ${vet.VetSName}`;
          //  Employee ID and Email
          const vetIdTag = document.getElementById("vetID");
          const vetEmailTag = document.getElementById("vetEmail");
          if (vetIdTag) vetIdTag.textContent = vet.VetID || ''; 
          if (vetEmailTag) vetEmailTag.textContent = vet.VetEmail || '';
          // Vet-specific fields
          const vetSpecTag = document.getElementById('vetSpecialization');
          const vetLicenseTag = document.getElementById('vetLicense');
          const vetExpTag = document.getElementById('vetExperience');
          const vetContactTag = document.getElementById('vetContact');
          const vetClinicTag = document.getElementById('vetClinic');
          if (vetSpecTag) vetSpecTag.textContent = vet.VetSpecialization || 'N/A';
          if (vetLicenseTag) vetLicenseTag.textContent = vet.VetLicenseNo || 'N/A';
          if (vetExpTag) vetExpTag.textContent = vet.VetExperience || 'N/A';
          if (vetContactTag) vetContactTag.textContent = vet.VetContact || 'N/A';
          if (vetClinicTag) vetClinicTag.textContent = vet.ClinicBranch || 'N/A';
        }
      });
  }

  loadVetData();
});
