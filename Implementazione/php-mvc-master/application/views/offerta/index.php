<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap core CSS -->
    <link href="/assets/mdb/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="/assets/mdb/css/mdb.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- Personal style file -->
    <link href="/assets/mdb/css/style.css" rel="stylesheet">

</head>

<body>

    <!--Main Navigation-->
    <header>
        
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark rgba-grey-light fixed-top">
    
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
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo URL.'offerta/index'; ?>"><strong>Offerta</strong>
                          <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL.'home/ricerca'; ?>"><strong>Ricerca</strong></a>
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
            <div class="mask rgba-stylish-strong">

                <div class="container-fluid align-items-center justify-content-center h-100">
                
                    <div class="row d-flex justify-content-center text-center">

                        <!-- Heading -->
                        <h2 class="display-4 font-weight-bold white-text pt-5 mb-3 mt-5">Offri il tuo posteggio!</h2>

                    </div>

                    <div class="row d-flex justify-content-center text-center">

                        <div class="col-md-5">
                            
                            <!-- Divider -->
                            <hr class="hr-light">

                            <!-- Error alert -->
                            <?php
                                echo isset($_SESSION['dateError'])?'
                                <div class="alert alert-danger" role="alert">
                                    '.$_SESSION['dateError'].'
                                </div>': "";

                                echo isset($_SESSION['carPlateError'])?'
                                <div class="alert alert-danger" role="alert">
                                    '.$_SESSION['carPlateError'].'
                                </div>': "";
                            ?>
                            <!-- Error alert -->

                            <!-- Default form offer -->
                            <form class="text-center border border-light p-5 rounded mb-0 login-form-bg" action="<?php echo URL; ?>offerta/offri" method="POST">

                                <label class="font-weight-bold text-light">Seleziona la disponibilità:</label>
                                <select class="browser-default custom-select mb-4" name="select_disp" required>
                                    <option value="Tutto il giorno">Tutto il giorno</option>
                                    <option value="Mattina">Mattina</option>
                                    <option value="Pomeriggio">Pomeriggio</option>
                                </select>

                                <label class="font-weight-bold text-light">Seleziona una data:</label>
                                <input type="date" name="datepicker" class="form-control mb-4" value="<?php echo isset($_SESSION['selectedDate']) ? $_SESSION['selectedDate'] : ""; ?>" required>

                                <label class="font-weight-bold text-light">Inserisci una targa:</label>
                                <input type="text" name="car_plate" placeholder="AA-NNNNNN" class="form-control mb-4" maxlength="9" value="<?php echo isset($_SESSION['carPlate']) ? $_SESSION['carPlate'] : ""; ?>">

                                <!-- Offer button -->
                                <button class="btn btn-success my-4" type="submit" value="Offri" name="offri" pattern="^(AG|AI|AR|BE|BL|BS|FR|GE|GL|GR|JU|LU|NE|NW|OW|SG|SH|SO|SZ|TG|TI|UR|VD|VS|ZG|ZH)-[0-9]{1,6}$">Offri</button>

                            </form>
                            <!-- Default form offer -->

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

    <!-- JQuery -->
    <script type="text/javascript" src="/assets/mdb/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/assets/mdb/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/assets/mdb/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/assets/mdb/js/mdb.min.js"></script>
</body>

</html>