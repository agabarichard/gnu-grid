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

// Function to edit a row
function editRow(tableId, rowId) {
    // Get the table and row
    const table = document.getElementById(tableId);
    const row = table.rows[rowId];

    // Get current values
    const firstName = row.cells[1].innerText;
    const lastName = row.cells[2].innerText;
    const email = row.cells[3].innerText;

    //For farmers Dashboard
     

    // Populate modal with current values
    document.getElementById('editRowId').value = rowId;
    document.getElementById('editFirstName').value = firstName;
    document.getElementById('editLastName').value = lastName;
    document.getElementById('editEmail').value = email;
    

    // Show the modal
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

// Function to save edits
function saveEdit() {
    // Get updated values from the form
    const rowId = document.getElementById('editRowId').value;
    const firstName = document.getElementById('editFirstName').value;
    const lastName = document.getElementById('editLastName').value;
    const email = document.getElementById('editEmail').value;

    // Find the table based on the active section
    const activeSection = document.querySelector('.content-section.active');
    const tableId = activeSection.querySelector('table').id;
    const table = document.getElementById(tableId);

    // Update the row with new values
    const row = table.rows[rowId];
    row.cells[1].innerText = firstName;
    row.cells[2].innerText = lastName;
    row.cells[3].innerText = email;

    // Hide the modal
    const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
    editModal.hide();
}

// Function to delete a row
function deleteRow(tableId, rowId) {
    const table = document.getElementById(tableId);
    table.deleteRow(rowId);
}

// Function to switch sections
function showSection(sectionId) {
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.remove('active');
        if (section.id === sectionId) {
            section.classList.add('active');
        }
    });
}

//Farmers dashboard

// Function to edit a row
function editRow(tableId, rowId) {
    // Get the table and row
    const table = document.getElementById(tableId);
    const row = table.rows[rowId];

    // Get current values
    const nameoftheproduct = row.cells[1].innerText;
    const category = row.cells[2].innerText;
    const sellingPrice = row.cells[3].innerText;
    const imageoftheprodect = row.cles[4].innerText

    //For farmers Dashboard
     

    // Populate modal with current values
    document.getElementById('editRowId').value = rowId;
    document.getElementById('editnameoftheproduct').value = nameoftheproduct;
    document.getElementById('editcategory').value = category;
    document.getElementById('editsellingprice').value = sellingPrice;
    document.getElementById('editimageoftheproduct').value = imageoftheprodect;
    

    // Show the modal
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

// Function to save edits
function saveEdit() {
    // Get updated values from the form
    const rowId = document.getElementById('editRowId').value;
    const nameoftheproduct = document.getElementById('editnameoftheproduct').value;
    const category = document.getElementById('editcategory').value;
    const sellingPrice = document.getElementById('editsellingprice').value;
    const imageoftheprodect = document.getElementById('editimageoftheproduct').value;

    // Find the table based on the active section
    const activeSection = document.querySelector('.content-section.active');
    const tableId = activeSection.querySelector('table').id;
    const table = document.getElementById(tableId);

    // Update the row with new values
    const row = table.rows[rowId];
    row.cells[1].innerText = nameoftheproduct;
    row.cells[2].innerText = category;
    row.cells[3].innerText = sellingPrice;
    row.cell [4].innerText = imageoftheprodect

    // Hide the modal
    const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
    editModal.hide();
}

// Function to delete a row
function deleteRow(tableId, rowId) {
    const table = document.getElementById(tableId);
    table.deleteRow(rowId);
}

// Function to switch sections
function showSection(sectionId) {
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.remove('active');
        if (section.id === sectionId) {
            section.classList.add('active');
        }
    });
}



