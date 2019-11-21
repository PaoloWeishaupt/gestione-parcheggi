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
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo URL.'home/index'; ?>"><strong>Home</strong>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL.'offerta/index'; ?>"><strong>Offerta</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL.'ricerca/index'; ?>"><strong>Ricerca</strong></a>
                </li>
            </ul>
            <!-- Links -->
        </div>
        <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main>

    <!-- Background img -->
    <div id="intro" class="view img">

        <!-- Full Page Intro -->
        <div class="mask rgba-black-strong">

            <div class="container-fluid d-flex align-items-center justify-content-center h-100">

                <div class="row d-flex justify-content-center text-center">

                    <div class="col-md-10">

                        <!-- Error alerts -->
                        <?php
                        echo isset($_SESSION['CAPerror'])?"<script> $.notify(\"".$_SESSION['CAPerror']."\", \"error\")</script>": "";
                        echo isset($_SESSION['CharAndSpaceError'])?"<script> $.notify(\"".$_SESSION['CharAndSpaceError']."\", \"error\")</script>": "";
                        echo isset($_SESSION['viaError'])?"<script> $.notify(\"".$_SESSION['viaError']."\", \"error\")</script>": "";
                        echo isset($_SESSION['phoneError'])?"<script> $.notify(\"".$_SESSION['phoneError']."\", \"error\")</script>": "";
                        ?>
                        <!-- Error alerts -->

                        <!-- Default form register -->
                        <form class="text-center border border-light p-5 rounded mb-0 form-bg" action="<?php echo URL; ?>register/register" method="POST">

                            <p class="h4 mb-4 font-weight-bold text-light">Registrazione</p>

                            <div class="form-row mb-4">
                                <div class="col">
                                    <!-- First name -->
                                    <input type="text" name="registrationName" class="form-control" placeholder="Nome" required>
                                </div>
                                <div class="col">
                                    <!-- Last name -->
                                    <input type="text" name="registrationSurname" class="form-control" placeholder="Cognome" required>
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="col">
                                    <!-- E-mail -->
                                    <input type="email" name="registrationMail" class="form-control" placeholder="E-mail" required>
                                </div>
                                <div class="col">
                                    <!-- Phone number -->
                                    <input type="text" name="registrationNumber" class="form-control" placeholder="Numero di telefono" aria-describedby="defaultRegisterFormPhoneHelpBlock" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <input type="password" name="registrationPassword" class="form-control mb-4" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" required>

                            <div class="form-row mb-4">
                                <div class="col-5">
                                    <!-- Street -->
                                    <input type="text" name="registrationStreet" class="form-control" placeholder="Via" aria-describedby="defaultRegisterFormPhoneHelpBlock">
                                </div>
                                <div class="col-2">
                                    <!-- CAP -->
                                    <input type="text" name="registrationCAP" class="form-control" placeholder="CAP" aria-describedby="defaultRegisterFormPhoneHelpBlock">
                                </div>
                                <div class="col-5">
                                    <!-- City -->
                                    <input type="text" name="registrationCity" class="form-control mb-4" placeholder="Città" aria-describedby="defaultRegisterFormPhoneHelpBlock">
                                </div>
                            </div>


                            <!-- Sign up button -->
                            <button class="btn btn-info my-4 btn-block" type="submit">Registrati</button>

                        </form>
                        <!-- Default form register -->

                    </div>

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