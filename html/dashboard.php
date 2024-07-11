<?php
// Database connection
$servername = "localhost";
$username = "root";
$db_password = "Agaba@859"; // Replace with your database password
$dbname = "agriculturedatabase";
$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch data from the database based on the category
function fetchData($conn, $category) {
    $sql = "SELECT id, firstname, lastname, email FROM signup WHERE categories = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = $_POST['id'];
    if ($_POST['action'] === 'edit') {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $sql = "UPDATE signup SET firstname=?, lastname=?, email=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $firstname, $lastname, $email, $id);
        $stmt->execute();
    } elseif ($_POST['action'] === 'delete') {
        $sql = "DELETE FROM signup WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/css/dashboard.css">
</head>
<body>
    <!-- Navbar starts here -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container-fluid">
            <img src="/images/log.jpg" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
            <a class="navbar-brand" href="#">God's WillMedia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar starts from here -->
    <div class="sidebar">
        <a class="nav-link" href="#" onclick="showSection('section1')">Dashboard</a>
        <a class="nav-link" href="#" onclick="showSection('section2')">Farmers</a>
        <a class="nav-link" href="#" onclick="showSection('section3')">Collectors</a>
        <a class="nav-link" href="#" onclick="showSection('section4')">Agents</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div id="section1" class="content-section active">
            <h1>Dashboard</h1>
            <p>Overview and metrics of our customers.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Farmers</h5>
                            <p class="card-text">Total number of farmers registered are: <?php echo count(fetchData($conn, 'farmer')); ?>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Collectors</h5>
                            <p class="card-text">Total number of collectors registered are: <?php echo count(fetchData($conn, 'collector')); ?>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Agents</h5>
                            <p class="card-text">Total number of agents registered are: <?php echo count(fetchData($conn, 'agent')); ?>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart for General Users -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>

        <div id="section2" class="content-section">
            <h1>Farmers</h1>
            <p>Number of registered farmers.</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="farmersTable">
                    <?php
                    $farmers = fetchData($conn, 'farmer');
                    foreach ($farmers as $index => $farmer) {
                        echo "<tr>";
                        echo "<th scope='row'>" . ($index + 1) . "</th>";
                        echo "<td>" . $farmer['firstname'] . "</td>";
                        echo "<td>" . $farmer['lastname'] . "</td>";
                        echo "<td>" . $farmer['email'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-sm btn-warning' onclick=\"editRow('farmersTable', " . $farmer['id'] . ")\">";
                        echo "<i class='bi bi-pencil'></i>";
                        echo "</button>";
                        echo "<button class='btn btn-sm btn-danger' onclick=\"deleteRow('farmersTable', " . $farmer['id'] . ")\">";
                        echo "<i class='bi bi-trash'></i>";
                        echo "</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="section3" class="content-section">
            <h1>Collectors</h1>
            <p>Number of registered Collectors.</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="collectorsTable">
                    <?php
                    $collectors = fetchData($conn, 'collector');
                    foreach ($collectors as $index => $collector) {
                        echo "<tr>";
                        echo "<th scope='row'>" . ($index + 1) . "</th>";
                        echo "<td>" . $collector['firstname'] . "</td>";
                        echo "<td>" . $collector['lastname'] . "</td>";
                        echo "<td>" . $collector['email'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-sm btn-warning' onclick=\"editRow('collectorsTable', " . $collector['id'] . ")\">";
                        echo "<i class='bi bi-pencil'></i>";
                        echo "</button>";
                        echo "<button class='btn btn-sm btn-danger' onclick=\"deleteRow('collectorsTable', " . $collector['id'] . ")\">";
                        echo "<i class='bi bi-trash'></i>";
                        echo "</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="section4" class="content-section">
            <h1>Agents</h1>
            <p>Number of registered agents.</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="agentsTable">
                    <?php
                    $agents = fetchData($conn, 'agent');
                    foreach ($agents as $index => $agent) {
                        echo "<tr>";
                        echo "<th scope='row'>" . ($index + 1) . "</th>";
                        echo "<td>" . $agent['firstname'] . "</td>";
                        echo "<td>" . $agent['lastname'] . "</td>";
                        echo "<td>" . $agent['email'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-sm btn-warning' onclick=\"editRow('agentsTable', " . $agent['id'] . ")\">";
                        echo "<i class='bi bi-pencil'></i>";
                        echo "</button>";
                        echo "<button class='btn btn-sm btn-danger' onclick=\"deleteRow('agentsTable', " . $agent['id'] . ")\">";
                        echo "<i class='bi bi-trash'></i>";
                        echo "</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Editing -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        <input type="hidden" id="editRowId" name="id">
                        <input type="hidden" name="action" value="edit">
                        <div class="mb-3">
                            <label for="editFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFirstName" name="firstname">
                        </div>
                        <div class="mb-3">
                            <label for="editLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLastName" name="lastname">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveEdit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to handle chart and actions

        // Fetch data for the chart
        document.addEventListener('DOMContentLoaded', function() {
            // Data for the chart
            const ctx = document.getElementById('userChart').getContext('2d');
            const userChart = new Chart(ctx, {
                type: 'bar', // You can choose 'line', 'bar', 'pie', etc.
                data: {
                    labels: ['Farmers', 'Collectors', 'Agents'],
                    datasets: [{
                        label: 'Number of Users',
                        data: [
                            <?php echo count(fetchData($conn, 'farmer')); ?>,
                            <?php echo count(fetchData($conn, 'collector')); ?>,
                            <?php echo count(fetchData($conn, 'agent')); ?>
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

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
    </script>
</body>
</html>
