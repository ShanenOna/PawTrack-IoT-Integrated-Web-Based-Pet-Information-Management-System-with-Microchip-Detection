document.addEventListener('DOMContentLoaded', function () {
  const petID = window.PAWTRACK_PET_ID || (function(){
    // derive petID from URL like /pets/P002
    const path = window.location.pathname.replace(/\/$/, '');
    const parts = path.split('/').filter(Boolean);
    return parts[1] || new URLSearchParams(window.location.search).get('pet_id');
  })();

  function postJson(url, data){
    return fetch(url, {method: 'POST', body: new URLSearchParams(data)})
      .then(r => r.json());
  }

  function fillVaccination(records){
    const tbody = document.querySelector('#vaccination-tab table.records-table tbody');
    tbody.innerHTML = '';
    if (!records || records.length === 0) {
      tbody.innerHTML = '<tr><td colspan="3">No records found.</td></tr>';
      return;
    }
    records.forEach(rec => {
      const tr = document.createElement('tr');
      tr.innerHTML = `<td>${rec.ShotType || rec.ShotType || ''}</td><td>${rec.Date || ''}</td><td>${rec.NextDueDate || rec.NextDueDate || '-'}</td>`;
      tbody.appendChild(tr);
    });
  }

  function fillMedical(records){
    const tbody = document.querySelector('#medical-tab table.records-table tbody');
    tbody.innerHTML = '';
    if (!records || records.length === 0) {
      tbody.innerHTML = '<tr><td colspan="3">No records found.</td></tr>';
      return;
    }
    records.forEach(rec => {
      const tr = document.createElement('tr');
      tr.innerHTML = `<td>${rec.Diagnosis || rec.MedRecord || ''}</td><td>${rec.DateDiagnosed || rec.Date || ''}</td><td>${rec.Treatment || rec.VaxRecord || ''}</td>`;
      tbody.appendChild(tr);
      if (rec.Notes) {
        const noteRow = document.createElement('tr');
        noteRow.innerHTML = `<td colspan="3">Notes: ${rec.Notes}</td>`;
        tbody.appendChild(noteRow);
      }
    });
  }

  function fillNotes(records){
    const container = document.querySelector('#notes-tab .notes-container');
    container.innerHTML = '';
    if (!records || records.length === 0) {
      container.innerHTML = '<p>No veterinarian notes found.</p>';
      return;
    }
    records.forEach(rec => {
      const div = document.createElement('div');
      div.className = 'note-block';
      div.innerHTML = `<div class="note-header"><p><strong>Date:</strong> ${rec.VisitDate || ''}</p><p><strong>Veterinarian:</strong> Dr. ${rec.Veterinarian || ''}</p></div><div class="note-content"><p><strong>Notes:</strong><br/>${rec.Notes || ''}</p></div>`;
      container.appendChild(div);
    });
  }

  if (!petID) {
    console.warn('PetID not found; aborting record fetch');
    return;
  }

  postJson('/backend/fetch-vaccination.php', {PetID: petID}).then(res => {
    if (res && (res.status === 'success' || res.status === 'empty')) {
      fillVaccination(res.records || []);
    } else console.warn('Unexpected vaccination response', res);
  }).catch(err=>{ console.error('Vaccination fetch error', err); });

  postJson('/backend/fetch-medical-history.php', {PetID: petID}).then(res => {
    if (res && (res.status === 'success' || res.status === 'empty')) {
      fillMedical(res.records || []);
    } else console.warn('Unexpected medical response', res);
  }).catch(err=>{ console.error('Medical fetch error', err); });

  postJson('/backend/fetch-notes.php', {PetID: petID}).then(res => {
    if (res && (res.status === 'success' || res.status === 'empty')) {
      fillNotes(res.records || []);
    } else console.warn('Unexpected notes response', res);
  }).catch(err=>{ console.error('Notes fetch error', err); });

});
