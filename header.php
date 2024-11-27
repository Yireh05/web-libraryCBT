
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
    <script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
    <style>
        .navbar-user-top ul {
            display: flex;
            align-items: center;
            justify-content: flex-end; /* Alinear a la derecha */
            width: 100%;
        }
        .navbar-user-top ul li {
            margin-left: 15px; /* Espacio entre los iconos */
        }
        .navbar-user-top ul li a {
            text-decoration: none;
            color: #000;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .navbar-user-top ul li a:hover {
            background-color: #B9E681; /* Color al pasar el ratón */
        }
    </style>
</head>
<body>
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
                Biblioteca Dr. Gustavo Baz Prada
            </div>
            <div class="full-reset" style="background-color:#B9E861; padding: 10px 0; color:#000000;">
                <figure>
                    <img src="assets/img/logo_cbt.png" alt="Biblioteca" class="img-responsive center-box" style="width:55%;">
                </figure>
                <p class="text-center" style="background-color:#B9E861; padding: 15px;">Biblioteca Digital</p>
            </div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <li><a href="home.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a></li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp; >Libros y catálogo <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="login.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp; Agregar o editar libro</a></li>
                        </ul>
                        <li><a href="searchbook.php"><i class="zmdi zmdi-search"></i>&nbsp;&nbsp; Buscar libro</a></li>
                        <li><a href="catalog.php"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Catálogo</a></li>
                    </li>                    
                    <li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset" style="display: flex; align-items: center; width: 100%;">
                <li style="color:#000000; cursor:default; margin-right: 10px; flex-grow: 1; text-align: left;">
                    <span class="all-tittles">CBT DR. MAXIMILIANO RUIZ CASTAÑEDA, JOCOTITLÁN</span>
                </li>
                <li class="tooltips-general exit-system-button" data-href="index.html" data-placement="bottom" title="Salir del sistema">
                    <a href="index.html"><i class="zmdi zmdi-power"></i> Salir</a>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>
