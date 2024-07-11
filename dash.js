
        function editRow(tableId, id) {
            // Fetch row data from table and fill the form
            let table = document.getElementById(tableId);
            let row;
            for (let i = 1; i < table.rows.length; i++) {
                if (table.rows[i].cells[4].getElementsByTagName('button')[0].getAttribute('onclick').includes(id)) {
                    row = table.rows[i];
                    break;
                }
            }
            document.getElementById('editRowId').value = id;
            document.getElementById('editFirstName').value = row.cells[1].innerText;
            document.getElementById('editLastName').value = row.cells[2].innerText;
            document.getElementById('editEmail').value = row.cells[3].innerText;

            // Show the modal
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }

        function saveEdit() {
            // Submit the form
            document.getElementById('editForm').submit();
        }

        function deleteRow(tableId, id) {
            if (confirm('Are you sure you want to delete this entry?')) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = '<input type="hidden" name="id" value="' + id + '">' +
                                 '<input type="hidden" name="action" value="delete">';
                document.body.appendChild(form);
                form.submit();
            }
        }

        function showSection(sectionId) {
            let sections = document.getElementsByClassName('content-section');
            for (let i = 0; i < sections.length; i++) {
                sections[i].classList.remove('active');
            }
            document.getElementById(sectionId).classList.add('active');
        }
  