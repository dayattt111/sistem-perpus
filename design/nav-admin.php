<html lang="en">
    <head>
    </head>
    <style>
        .warna{
            background-image: linear-gradient(90deg,  #0056B3,#00A1FF);
            color: aliceblue;
        
        }
    </style>
<body>
<nav class="navbar warna bg-secondary navbar-expand-lg fixed-top shadow-sm">
    <div class="container-fluid p-3">
        <a class="navbar-brand" href="#">
            <img src="../assets/logoNav.png" alt="logo" width="70px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light pr-5" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Contact</a>
                </li>
            </ul>
            <div class="dropdown ms-3">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../assets/adminLogo.png" alt="adminLogo" width="40px">
                </button>
                <ul class="dropdown-menu dropdown-menu-end mt-2 p-2">
                    <li>
                        <a class="dropdown-item text-center" href="#">
                            <img src="../assets/adminLogo.png" alt="adminLogo" width="30px">
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-center text-secondary" href="#">
                            <span class="text-capitalize"><?php echo $_SESSION['admin']['nama_admin']; ?></span>
                        </a>
                    </li>
                    <hr>
                    <li>
                        <a class ="dropdown-item text-center mb-2" href="#">
                            Akun Terverifikasi <span class="text-primary"><i class="fa-solid fa-circle-check"></i></span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="./signOut.php">
                            Sign Out <i class="fa-solid fa-right-to-bracket"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
    
</body>
    </html>