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
    <!-- MDBootstrap Datatables  -->
    <link href="/gestioneparcheggi2019/assets/mdb/css/addons/datatables.min.css" rel="stylesheet">
    <!-- Bootstrap-datepicker.css -->
    <link href="/gestioneparcheggi2019/assets/mdb/bootstrap-datepicker-1.9.0/css/bootstrap-datepicker.standalone.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/mdb.min.js"></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/addons/datatables.min.js"></script>
    <!-- Bootstrap-datepicker.js -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/bootstrap-datepicker-1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="/gestioneparcheggi2019/assets/mdb/bootstrap-datepicker-1.9.0/locales/bootstrap-datepicker.it.min.js" charset="UTF-8"></script>
    <!-- Notify.js -->
    <script type="text/javascript" src="/gestioneparcheggi2019/assets/mdb/js/notify.js"></script>
    <!-- Script -->
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                weekStart: 1,
                todayBtn: "linked",
                clearBtn: true,
                language: "it",
                todayHighlight: true
            });
        });

        $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                "info": false,
                "ordering": true,
                "searching": false,
                "paging": false
            });
            $('.dataTables_length').addClass('bs-select');
        });

        function filterDate() {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;
            window.location.href = "/gestioneparcheggi2019/research/index/?startDate=" + startDate + "&endDate=" + endDate;
        }

        function filterDisp(disp) {
            window.location.href = "/gestioneparcheggi2019/research/index/?filter_disp=" + disp;
        }
    </script>
</head>

<body class="img h-100">

<!-- Full Page Intro -->
<div class="mask rgba-black-strong h-100">
    <!--Main Navigation-->
    <header>

        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark black fixed-top ">

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
                <ul class="navbar-nav mr-auto smooth-scroll">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL . 'home/index'; ?>"><strong>Home</strong>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL . 'offer/index'; ?>"><strong>Offerta</strong></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo URL . 'research/index'; ?>"><strong>Ricerca</strong>
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php

                    use models\Users as Users;

                    echo Users::checkRuolo() ?
                        '<li class="nav-item"> 
                        <a class="nav-link" href="' . URL . 'home/index' . '"><strong>Admin Dashboard</strong></a>
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
                            '<a class="dropdown-item" href="' . URL . 'login/logout' . '">Logout</a>' :
                            '<a class="dropdown-item" href="' . URL . 'login/index' . '">Login</a>';
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

        <!-- Error alerts -->
        <?php
        echo isset($_SESSION['minDateError'])?"<script> $.notify(\"".$_SESSION['minDateError']."\", \"error\")</script>": "";
        echo isset($prenotazioneOK)?"<script> $.notify(\"".$prenotazioneOK."\", \"success\")</script>": "";
        ?>
        <!-- Error alerts -->

        <div id="intro" class="pt-personal">

            <div class="container-fluid align-items-center justify-content-center bg-transparent">

                <div class="row justify-content-center align-items-center text-center mb-4">

                    <div class="col-6">

                        <p class="text-white font-weight-bold">Inserisci le date da cercare:</p>

                        <div class="input-group justify-content-center">

                            <p class="text-white font-weight-bold ml-3 mr-3">Dal </p>

                            <input type="text" id="startDate" name="startDate" class="datepicker">

                            <p class="text-white font-weight-bold ml-3 mr-3"> al </p>

                            <input type="text" id="endDate" name="endDate" class="datepicker">

                            <input type="submit" value="Cerca" class="button btn-primary ml-3" onclick="filterDate()">

                        </div>

                    </div>

                    <div class="col-6">

                        <p class="text-white font-weight-bold">Inserisci la disponibilità:</p>

                        <form method="post">

                            <select class="browser-default custom-select w-50" name="select_disp" onchange="filterDisp(this.value)" >
                                <option value="Tutto il giorno" <?php echo ($selected == 'Tutto il giorno')?'selected':''?>>Tutto il giorno</option>
                                <option value="Mattina" <?php echo ($selected == 'Mattina')?'selected':''?> >Mattina</option>
                                <option value="Pomeriggio" <?php echo ($selected == 'Pomeriggio')?'selected':''?>>Pomeriggio</option>
                            </select>

                        </form>

                    </div>

                </div>

                <div class="row justify-content-center text-center mb-3">

                    <table id="dtBasicExample" class="table table-striped table-bordered table-responsive text-color font">

                        <thead class="head-dark">

                            <tr>
                                <th class="th-sm font-weight-bold">Disponibilità</th>
                                <th class="th-sm font-weight-bold">Data disponibilità</th>
                                <th class="th-sm font-weight-bold">Numero di targa</th>
                                <th class="th-sm font-weight-bold">Prenota</th>
                            </tr>

                        </thead>

                        <tbody>
                            <?php foreach ($parcheggi as $row): ?>
                            <tr">
                                <td><?php echo $row['disponibilita'] ?></td>
                                <td><?php echo $row['data_disp'] ?></td>
                                <td><?php echo $row['n_targa'] ?></td>
                                <td>
                                    <form action="<?php echo URL.'reserve/index'; ?>" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <button type="submit" class="button btn-primary">Prenota</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>

                        <tfoot class="head-dark">

                            <tr>
                                <th class="th-sm font-weight-bold">Proprietario</th>
                                <th class="th-sm font-weight-bold">Disponibilità</th>
                                <th class="th-sm font-weight-bold">Data disponibilità</th>
                                <th class="th-sm font-weight-bold" >Prenota</th>
                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>

    </main>
    <!--Main layout-->

    <!-- Footer -->
    <footer>

    </footer>

</div>
</body>

</html>