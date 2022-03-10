<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Spyingers, Secret Agency</title>
    <meta name="description" content="Découvrez toutes nos missions secrètes qui ne sont en fait plus du tout secrètes...">
    <link rel="shortcut icon" href="./img/spyingers-logo-black.svg" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container-fluid d-flex flex-column justify-content-between">
        <header class="row align-items-center p-2 d-flex justify-content-between ">
            <div class="col col-lg-3 p-0 ps-3">
                <a href="./index.php"><img class="img-fluid p-2" src="./img/spyingers-logo.svg" alt="logo"></a>
            </div>
            <h1 class="text-white text-center d-none d-lg-block col">The Spyingers -- Secret Agency</h1>
        <!-- NAVBAR -->
            <nav class="navbar  navbar-light bg-transparent col col-lg-3 ">
                <div class="container-fluid d-flex justify-content-end p-0">
                    <button class="navbar-toggler border-none p-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span ><img class="burger" src="./img/burger.svg" alt="menu"></span>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">The Spyingers</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="../administration.php">Espace d'administration</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Les missions</a>
                                    <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="../index.php">Consulter les missions</a></li>
                                        <li><a class="dropdown-item" href="../add-mission.php">Ajouter des missions</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Les cibles</a>
                                    <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="../targets.php">Consulter les cibles</a></li>
                                        <li><a class="dropdown-item" href="../add-target.php">Ajouter des cibles</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Les agents</a>
                                    <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="../agents.php">Consulter les agents</a></li>
                                        <li><a class="dropdown-item" href="../add-agent.php">Ajouter des agents</a></li>
                                    </ul>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Les contacts</a>
                                    <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="../contacts.php">Consulter les contacts</a></li>
                                        <li><a class="dropdown-item" href="../add-contact.php">Ajouter des contacts</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Les planques</a>
                                    <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="../safehouses.php">Consulter les planques</a></li>
                                        <li><a class="dropdown-item" href="../add-safehouse.php">Ajouter des planques</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="../logout.php">Se déconnecter</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>