//email validation
document.querySelector('form').addEventListener('submit', function(e) {
    const emailInput = document.getElementById('email');
    const email = emailInput.value;
    const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;

    if (!emailPattern.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address basig on the example.');
        emailInput.focus();
    }
});


//Phone number validation 

document.getElementById('phonenumber').addEventListener('input', function(e) {
    const phoneInput = e.target;
    phoneInput.value = phoneInput.value.replace(/[^\d]/g, ''); 

    if (phoneInput.value.length > 10) {
        phoneInput.value = phoneInput.value.slice(0, 10); 
    }
});

document.querySelector('form').addEventListener('submit', function(e) {
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phonenumber');
    const passwordInput = document.getElementById('password');
    const passwordError = document.getElementById('password-error');
    const email = emailInput.value;
    const phone = phoneInput.value;
    const password = passwordInput.value;

    const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
    const phonePattern = /^\d{10}$/;
    const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#]).{5,}$/;

    let valid = true;

    if (!emailPattern.test(email)) {
        e.preventDefault(); 
        alert('Please enter a valid email address.');
        emailInput.focus();
        valid = false;
    } else if (!phonePattern.test(phone)) {
        e.preventDefault(); 
        alert('Phone number must be exactly 10 digits.');
        phoneInput.focus();
        valid = false;
    } else if (!passwordPattern.test(password)) {
        e.preventDefault(); 
        passwordError.style.display = 'block';
        passwordError.textContent = 'Password must be more than 4 characters, and include at least one letter, one number, and one symbol.';
        passwordInput.focus();
        valid = false;
    } else {
        passwordError.style.display = 'none';
    }

    return valid;
});


// password validation

document.querySelector('form').addEventListener('submit', function(e) {
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phonenumber');
    const passwordInput = document.getElementById('password');
    const passwordError = document.getElementById('password-error');
    const email = emailInput.value;
    const phone = phoneInput.value;
    const password = passwordInput.value;

    const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
    const phonePattern = /^\d{10}$/;
    const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#]).{5,}$/;

    let valid = true;

    if (!emailPattern.test(email)) {
        e.preventDefault(); 
        alert('Please enter a valid email address.');
        emailInput.focus();
        valid = false;
    } else if (!phonePattern.test(phone)) {
        e.preventDefault(); 
        alert('Phone number must be exactly 10 digits.');
        phoneInput.focus();
        valid = false;
    } else if (!passwordPattern.test(password)) {
        e.preventDefault(); 
        passwordError.style.display = 'block';
        passwordError.textContent = 'Password must be more than 4 characters, and include at least one letter, one number, and one symbol.';
        passwordInput.focus();
        valid = false;
    } else {
        passwordError.style.display = 'none';
    }

    return valid;
});
//validating dashboard

function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });

    // Show the selected section
    document.getElementById(sectionId).classList.add('active');
}

function editRow(tableId, rowId) {
    // Get table and row
    const table = document.getElementById(tableId);
    const row = table.rows[rowId];

    // Fill form with current row data
    document.getElementById('editRowId').value = rowId;
    document.getElementById('editFirstName').value = row.cells[1].innerText;
    document.getElementById('editLastName').value = row.cells[2].innerText;
    document.getElementById('editEmail').value = row.cells[3].innerText;

    // Show modal
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

function saveEdit() {
    // Get the row ID and updated data
    const rowId = document.getElementById('editRowId').value;
    const tableId = getActiveTableId();
    const table = document.getElementById(tableId);
    const row = table.rows[rowId];

    // Update the table row with new data
    row.cells[1].innerText = document.getElementById('editFirstName').value;
    row.cells[2].innerText = document.getElementById('editLastName').value;
    row.cells[3].innerText = document.getElementById('editEmail').value;

    // Hide the modal
    const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
    editModal.hide();
}

function deleteRow(tableId, rowId) {
    // Get table and row
    const table = document.getElementById(tableId);
    table.deleteRow(rowId);
}

function getActiveTableId() {
    const activeSection = document.querySelector('.content-section.active');
    if (activeSection.id === 'section2') return 'farmersTable';
    if (activeSection.id === 'section3') return 'collectorsTable';
    if (activeSection.id === 'section4') return 'agentsTable';
    return null;
}
