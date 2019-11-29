
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap core CSS -->
    <link href="/gestioneparcheggi2019/assets/mdb/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="/gestioneparcheggi2019/assets/mdb/css/mdb.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Personal style file -->
    <link href="/gestioneparcheggi2019/assets/mdb/css/style.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/mdb.min.js"></script>
    <!-- Notify.js -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/notify.js"></script>

</head>

<body>

<!--Main Navigation-->
<header>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark black fixed-top">

        <!-- Navbar brand -->
        <span class="navbar-brand h4-responsive"><strong>Gestione Parcheggi</strong></span>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL.'home/index'; ?>"><strong>Home</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL.'offer/index'; ?>"><strong>Offerta</strong></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo URL.'research/index'; ?>"><strong>Ricerca</strong>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php
                use models\Users as Users;

                echo Users::checkRuolo() ?
                    '<li class="nav-item"> 
                        <a class="nav-link" href="'.URL.'home/index'.'"><strong>Admin Dashboard</strong></a>
                    </li>' : "";
                ?>
            </ul>
            <!-- Links -->
        </div>
        <!-- Collapsible content -->

        <!-- Links -->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i>
                    <span class="clearfix d-none d-sm-inline-block"><?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : "Account" ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <?php
                    use libs\Auth as Auth;

                    echo Auth::isAuthenticated() ?
                        '<a class="dropdown-item" href="'.URL.'login/logout'.'">Logout</a>' :
                        '<a class="dropdown-item" href="'.URL.'login/index'.'">Login</a>';
                    ?>
                </div>
            </li>
        </ul>

    </nav>
    <!--/.Navbar-->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main>

    <div id="intro" class="view img">

        <!-- Full Page Intro -->
        <div class="mask rgba-black-strong">

            <div class="container-fluid align-items-center justify-content-center h-100">

                <div class="row d-flex justify-content-center text-center">

                    <!-- Heading -->
                    <h2 class="display-4 font-weight-bold white-text pt-5 mb-3 mt-5">Prenota questo posteggio!</h2>

                </div>

                <div class="row d-flex justify-content-center text-center">

                    <!-- Default form register -->
                    <form class="text-center border border-light p-5 rounded mb-0 form-bg" action="<?php echo URL; ?>reserve/prenota" method="POST">
                        <div class="form-row mb-4">
                            <div class="col">
                                <!-- Default input -->
                                <label class="white-text font-weight-bold">Nome</label>
                                <input type="text" class="form-control mb-4" placeholder="Nome"
                                       value="<?php echo $parcheggio['nome'] ?>" disabled>
                            </div>
                            <div class="col">
                                <!-- Default input -->
                                <label class="white-text font-weight-bold">Cognome</label>
                                <input type="text" class="form-control mb-4" placeholder="Cognome"
                                       value="<?php echo $parcheggio['cognome'] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <!-- Default input -->
                                <label class="white-text font-weight-bold">Numero di telefono</label>
                                <input type="text" class="form-control mb-4" placeholder="Numero di telefono"
                                       value="<?php echo $parcheggio['tel'] ?>" disabled>
                            </div>
                            <div class="col">
                                <!-- Default input -->
                                <label class="white-text font-weight-bold">Disponibilità</label>
                                <input type="text" class="form-control mb-4" placeholder="Disponibilità"
                                       value="<?php echo $parcheggio['disponibilita'] ?>" disabled>
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="col">
                                <!-- Default input -->
                                <label class="white-text font-weight-bold">Data disponibilità</label>
                                <input type="text" class="form-control mb-4" placeholder="Data disponibilità"
                                       value="<?php echo $parcheggio['data_disp'] ?>" disabled>
                            </div>
                            <div class="col">
                                <!-- Default input -->
                                <label class="white-text font-weight-bold">Numero di targa</label>
                                <input type="text" class="form-control mb-4" placeholder="Numero di targa"
                                       value="<?php echo $parcheggio['n_targa'] ?>" disabled>
                            </div>
                            <div class="col">
                                <!-- Default input -->
                                <label class="white-text font-weight-bold">Costo</label>
                                <input type="text" class="form-control mb-4" placeholder="Costo"
                                       value="<?php echo $parcheggio['costo'] ?>" disabled>
                            </div>
                        </div>
                        <!-- Sign up button -->
                        <button class="btn btn-info my-4 btn-block" type="submit">Prenota</button>
                    </form>
                    <!-- Default form register -->

                </div>

            </div>

        </div>

    </div>

</main>
<!--Main layout-->

<!-- Footer -->
<footer>

</footer>

</body>

</html>