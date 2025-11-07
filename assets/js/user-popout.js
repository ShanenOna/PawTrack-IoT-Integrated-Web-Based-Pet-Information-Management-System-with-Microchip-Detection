// Handles the user-profile popout: open/close, prefill, preview image, submit
(function(){
  function qs(sel, root=document){ return root.querySelector(sel); }

  function buildPopout() {
    const container = document.createElement('div');
    container.id = 'user-popout';
    container.className = 'user-popout hidden';
    container.innerHTML = `
      <div class="user-popout-card">
        <button class="close-popout" aria-label="Close">×</button>
        <h3>My Profile</h3>
        <form id="user-popout-form" enctype="multipart/form-data">
          <div class="popout-row">
            <label for="popout-name">Full name</label>
            <input id="popout-name" name="name" type="text" required />
          </div>
          <div class="popout-row">
            <label for="popout-email">Email</label>
            <input id="popout-email" name="email" type="email" required />
          </div>
          <div class="popout-row vet-only">
            <label for="popout-clinic-branch">Clinic Branch</label>
            <input id="popout-clinic-branch" name="clinicBranch" type="text" />
          </div>
          <div class="popout-row vet-only">
            <label for="popout-vet-spec">Specialization</label>
            <input id="popout-vet-spec" name="vetSpecialization" type="text" />
          </div>
          <div class="popout-row vet-only">
            <label for="popout-vet-license">License Number</label>
            <input id="popout-vet-license" name="vetLicenseNo" type="text" />
          </div>
          <div class="popout-row vet-only">
            <label for="popout-vet-exp">Years of Experience</label>
            <input id="popout-vet-exp" name="vetExperience" type="number" min="0" />
          </div>
          <div class="popout-row vet-only">
            <label for="popout-vet-contact">Contact Number</label>
            <input id="popout-vet-contact" name="vetContact" type="text" />
          </div>
          <div class="popout-row">
            <label for="popout-pic">Profile picture</label>
            <input id="popout-pic" name="pic" type="file" accept="image/*" />
            <img id="popout-pic-preview" class="popout-pic-preview" alt="Preview" />
          </div>
          <div class="popout-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary cancel">Cancel</button>
          </div>
        </form>
        <div id="popout-msg" class="popout-msg"></div>
      </div>
    `;
    document.body.appendChild(container);
    return container;
  }

  function showPopout(container){
    container.classList.remove('hidden');
    setTimeout(()=> container.classList.add('visible'), 10);
  }
  function hidePopout(container){
    container.classList.remove('visible');
    setTimeout(()=> container.classList.add('hidden'), 200);
  }

  async function fetchSessionUser(){
    try{
      const res = await fetch('/backend/get-users.php', { method: 'GET', credentials: 'same-origin' });
      if (res.ok){
        const json = await res.json();
        if (json && json.status === 'success' && json.data){
          return json.data;
        }
      }
    }catch(e){}
    const nameEl = document.querySelector('.user-name');
    const emailEl = document.querySelector('.user-email');
    const imgEl = document.querySelector('.user-avatar');
    return {
      id: window.PAWTRACK_USER_ID || null,
      role: window.PAWTRACK_USER_ROLE || 'client',
      name: nameEl ? nameEl.textContent.trim() : '',
      email: emailEl ? emailEl.textContent.trim() : '',
      pic: imgEl ? imgEl.src : ''
    };
  }

  document.addEventListener('DOMContentLoaded', async function(){
    const userIcon = document.querySelector('.user-icon') || document.querySelector('.admin-nav-icon') || document.querySelector('.vet-nav-icons .fa-user');
    if (!userIcon) return;

    const popout = buildPopout();
    const form = popout.querySelector('#user-popout-form');
    const closeBtn = popout.querySelector('.close-popout');
    const cancelBtn = popout.querySelector('.cancel');
    const fileInput = popout.querySelector('#popout-pic');
    const preview = popout.querySelector('#popout-pic-preview');
    const msg = popout.querySelector('#popout-msg');

    const session = await fetchSessionUser();
    const userIconEl = document.querySelector('.user-icon');
    if (userIconEl) {
      session.id = userIconEl.dataset.userId || session.id;
      session.role = userIconEl.dataset.userRole || session.role;
    }

    const nameInput = popout.querySelector('#popout-name');
    const emailInput = popout.querySelector('#popout-email');
    nameInput.value = session.name || '';
    emailInput.value = session.email || '';
    if (session.pic){ preview.src = session.pic; preview.style.display = 'block'; }

    const clinicInput = popout.querySelector('#popout-clinic-branch');
    const vetSpecInput = popout.querySelector('#popout-vet-spec');
    const vetLicenseInput = popout.querySelector('#popout-vet-license');
    const vetExpInput = popout.querySelector('#popout-vet-exp');
    const vetContactInput = popout.querySelector('#popout-vet-contact');

    function readVetField(label){
      const ps = document.querySelectorAll('.vet-info-card p');
      for (let p of ps){
        if (p.textContent && p.textContent.indexOf(label) !== -1){
          const sp = p.querySelector('span');
          return sp ? sp.textContent.trim() : '';
        }
      }
      return '';
    }

    const vetNameFull = document.getElementById('vetNameFull');
    if (vetNameFull && !nameInput.value) nameInput.value = vetNameFull.textContent.trim();
    const vetEmailSpan = document.getElementById('vetEmail');
    if (vetEmailSpan && !emailInput.value) emailInput.value = vetEmailSpan.textContent.trim();
    if (clinicInput && !clinicInput.value) clinicInput.value = readVetField('Clinic Branch');
    if (vetSpecInput && !vetSpecInput.value) vetSpecInput.value = readVetField('Specialization');
    if (vetLicenseInput && !vetLicenseInput.value) vetLicenseInput.value = readVetField('License Number');
    if (vetExpInput && !vetExpInput.value) vetExpInput.value = readVetField('Years of Experience');
    if (vetContactInput && !vetContactInput.value) vetContactInput.value = readVetField('Contact Number');
    const vetImg = document.getElementById('vetProfileImage');
    if (vetImg && vetImg.src) { preview.src = vetImg.src; preview.style.display = 'block'; }

    document.querySelectorAll('.user-icon, .admin-nav-icon, .vet-nav-icons .fa-user').forEach(el => {
      el.addEventListener('click', (ev)=>{
        const clickedId = ev.currentTarget.dataset.userId || session.id;
        const clickedRole = ev.currentTarget.dataset.userRole || session.role || 
          (ev.currentTarget.classList.contains('admin-nav-icon') ? 'admin' : 'client');
        session.id = clickedId;
        session.role = clickedRole;

        const nameSpan = document.querySelector('.user-name');
        const emailSpan = document.querySelector('.user-email');
        if (nameSpan) nameInput.value = nameSpan.textContent.trim();
        if (emailSpan) emailInput.value = emailSpan.textContent.trim();

        if (ev.currentTarget.closest('.vet-nav-icons') || ev.currentTarget.matches('.vet-nav-icons .fa-user')){
          document.querySelectorAll('.vet-only').forEach(n=> n.style.display = 'flex');
          if (clinicInput && !clinicInput.value) clinicInput.value = readVetField('Clinic Branch');
          if (vetSpecInput && !vetSpecInput.value) vetSpecInput.value = readVetField('Specialization');
          if (vetLicenseInput && !vetLicenseInput.value) vetLicenseInput.value = readVetField('License Number');
          if (vetExpInput && !vetExpInput.value) vetExpInput.value = readVetField('Years of Experience');
          if (vetContactInput && !vetContactInput.value) vetContactInput.value = readVetField('Contact Number');
          const vImg = document.getElementById('vetProfileImage');
          if (vImg && vImg.src) { preview.src = vImg.src; preview.style.display='block'; }
        } else {
          document.querySelectorAll('.vet-only').forEach(n=> n.style.display = 'none');
        }

        if (ev.currentTarget.querySelector('img')) {
          preview.src = ev.currentTarget.querySelector('img').src;
          preview.style.display='block';
        }
        showPopout(popout);
      });
    });

    closeBtn.addEventListener('click', ()=> hidePopout(popout));
    cancelBtn.addEventListener('click', ()=> hidePopout(popout));

    fileInput.addEventListener('change', (ev)=>{
      const f = ev.target.files && ev.target.files[0];
      if (!f) { preview.style.display='none'; preview.src=''; return; }
      const url = URL.createObjectURL(f);
      preview.src = url; preview.style.display='block';
    });

    // =======================
    // SUBMIT with Swal.fire()
    // =======================
    form.addEventListener('submit', async function(e){
      e.preventDefault();

      const confirmed = await Swal.fire({
        title: 'Save changes?',
        text: 'Your profile information will be updated.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, save it',
        cancelButtonText: 'Cancel'
      });

      if (!confirmed.isConfirmed) return;

      Swal.fire({
        title: 'Saving...',
        text: 'Please wait while we update your profile.',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
      });

      const fd = new FormData();
      fd.append('name', nameInput.value);
      fd.append('email', emailInput.value);

      const vetIdEl = document.getElementById('vetID');
      const roleVal = vetIdEl ? 'vet' : (session.role || window.PAWTRACK_USER_ROLE || 'client');
      let idVal = vetIdEl ? vetIdEl.textContent.trim() : (session.id || window.PAWTRACK_USER_ID || '');
      fd.append('role', roleVal);
      fd.append('id', idVal);

  // Use popout-scoped queries to avoid picking up duplicate elements elsewhere on the page
  const vetContactInput = popout.querySelector('#popout-vet-contact');
  const vetSpecInput = popout.querySelector('#popout-vet-spec');
  const vetLicenseInput = popout.querySelector('#popout-vet-license');
  const vetExpInput = popout.querySelector('#popout-vet-exp');
  const clinicBranchInput = popout.querySelector('#popout-clinic-branch');

      function spanOrInput(id, inputEl){
        if (inputEl) return inputEl.value || '';
        const span = document.getElementById(id);
        return span ? span.textContent.trim() : '';
      }

      fd.append('vetContact', spanOrInput('popout-vet-contact', vetContactInput));
      fd.append('vetSpecialization', spanOrInput('popout-vet-spec', vetSpecInput));
      fd.append('vetLicenseNo', spanOrInput('popout-vet-license', vetLicenseInput));
      fd.append('vetExperience', spanOrInput('popout-vet-exp', vetExpInput));
      fd.append('clinicBranch', spanOrInput('popout-clinic-branch', clinicBranchInput));
      if (fileInput.files && fileInput.files[0]) fd.append('pic', fileInput.files[0]);

      try{

        const res = await fetch('/backend/edit-user.php', { method: 'POST', body: fd, credentials: 'same-origin' });
        const text = await res.text();
        let json;
        try{ json = JSON.parse(text); } catch(e){ json = { status: 'error', message: text }; }

        Swal.close();

        if (res.ok && json.status === 'success'){
          Swal.fire({ title: 'Saved!', text: "Your Profile is Successfully Updated!", icon: 'success', timer: 1500, showConfirmButton: false });
          
          setTimeout(()=> hidePopout(popout), 5000);
          setTimeout(() => {
            location.reload();
          }, 1600);

        } else {
          Swal.fire({ title: 'Error', text: json.message || 'Save failed.', icon: 'error' });
        }
      }catch(err){
        Swal.fire({ title: 'Network Error', text: 'Could not connect to the server.', icon: 'error' });
      }
    });
  });
})();
