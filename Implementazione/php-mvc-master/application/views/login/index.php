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

    <!-- JQuery -->
    <script type="text/javascript" src="/assets/mdb/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/assets/mdb/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/assets/mdb/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/assets/mdb/js/mdb.min.js"></script>
    <!-- Notify.js -->
    <script type="text/javascript" src="/assets/mdb/js/notify.js"></script>

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
                        echo isset($_SESSION['loginError'])?"<script> $.notify(\"Login error\", \"error\")</script>": "";
                        ?>
                        <!-- Error alerts -->

                        <!-- Default form login -->
                        <form class="text-center border border-light p-5 rounded mb-0 form-bg" action="<?php echo URL; ?>login/login" method="POST">

                            <p class="h4 mb-4 font-weight-bold text-light">Log in</p>

                            <!-- Email -->
                            <input type="email" name="email" class="form-control mb-4"
                            background-color: rgba(158, 158, 158, 0.3); placeholder="E-mail">

                            <!-- Password -->
                            <input type="password" name="password" class="form-control mb-4"
                            placeholder="Password">

                            <!-- Sign in button -->
                            <button class="btn btn-info btn-block my-4" type="submit" value="Login" name="login">Log in</button>

                            <!-- Register -->
                            <p class="text-light">Non sei registrato?
                                <a class="font-weight-bold text-light" href="<?php echo URL.'register/index'; ?>">Registrati</a>
                            </p>

                        </form>
                        <!-- Default form login -->

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