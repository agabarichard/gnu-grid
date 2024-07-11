<?php
    include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Farmer's-Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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
        <a class="nav-link" href="#" onclick="showSection('section2')">Upload a product</a>
        <a class="nav-link" href="#" onclick="showSection('section3')">uploaded products</a>
        <a class="nav-link" href="#" onclick="showSection('section4')">Market Analysis</a>
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
                            <h5 class="card-title">Total uploaded products</h5>
                            <p class="card-text">Total of uploadede productes in all categories are: 50.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Expected Income in all products</h5>
                            <p class="card-text">Total income in all products = ugs 12,000,000.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Products sold and total amount collected</h5>
                            <p class="card-text">Products sold = 10. Total amount: ugx 500,000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="section2" class="content-section">
            <h1>Upload a product</h1>
            <p>Please fill the form to upload the product to the market.</p>
            <div class="container">
                <div class="form-container">
                    <h2>Welcome to our upload page </h2>
                    <form action="config.php" method="post">
                    
                        <div class="mb-3">
                            <label for="nameoftheproduct" class="form-label">Name of the Product:</label>
                        
                            <input type="text" class="form-control" id="nameoftheproduct" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <input type="text" class="form-control" id="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="catergory" class="form-label">Category:</label>
                        <select class="form-select" aria-label="selectcategory">
                            <option selected>select of the product</option>
                            <option value="poutry">Poutry</option>
                            <option value="perishable">Perishable</option>
                            <option value="livestock">Livestock</option>
                          </select>
                        </div>
                        <div class="mb-3">
                            <label for="sellingprice" class="form-label">Selling price:</label>
                        
                            <input type="text" class="form-control" id="sellingprice" required>
                        </div>
                        <div class="mb-3">
                            <label for="numberoftheproductsinstock" class="form-label">Number of products in the stock:</label>
                            <input type="number" class="form-control" id="numberofproductsinthestock" required>
                        </div>
                        <div class="mb-3">
                            <label for="imageoftheproduct" class="form-label">Image of the Product:</label>
                        
                            <input type="file" class="form-control" id="imageoftheproduct" required>
                        </div>
                        <div class="mb-3">
                            <label for="locationtopicktheproduct" class="form-label">Location to pick the product:</label>
                        
                            <input type="text" class="form-control" id="locationtopicktheproduct" required>
                        </div>
                        <button type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="section3" class="content-section">
            <h1>Uploaded Products</h1>
            <p>Number of total proucts Uploaded.</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="uploadTable">
                    <tr>
                        <th scope="row">1</th>
                        <td>Tomatos</td>
                        <td>Perishable</td>
                        <td>10 Basins</td>
                        <td><img src="/images/tomato.jfif" style="height: 50px; border-radius: 10px;"></td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editRow('uploadTable', 1)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRow('uploadTable', 1)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Hens</td>
                        <td>Poutry</td>
                        <th>100</th>
                        <td><img src="/images/hen.jfif" style="height: 50px; border-radius: 10px;"></td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editRow('uploadTable', 2)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRow('uploadTable', 2)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>

        <div id="section4" class="content-section">
            <h1>Market Analysis</h1>
            <p>Makert transactions.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Transations carried in the  last 24hrs</h5>
                            <p class="card-text">Total amount collected : ugx 50,000.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Transations carried in the  last  7 Days</h5>
                            <p class="card-text">Total anount collected = ugs 120,000.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Transations carried in the  last  month</h5>
                            <p class="card-text">Total amount collected: ugx 500,000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editRowId">
                        <div class="mb-3">
                            <label for="nameoftheproduct" class="form-label">Name of the product</label>
                            <input type="text" class="form-control" id="editnameoftheproduct">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">category</label>
                            <input type="text" class="form-control" id="editcategory">
                        </div>
                        <div class="mb-3">
                            <label for="sellingprice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editsellingprice">
                        </div>
                        <div class="mb-3">
                            <label for="imageoftheproduct" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editimageoftheproduct">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveEdit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>
</body>

</html>
