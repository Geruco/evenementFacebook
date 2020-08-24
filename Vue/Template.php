<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../CSS/bootstrap.min.css"/>
        <link rel="stylesheet" href="../CSS/main.css" />
        <?php if(isset($header)){
            echo $header;
        } ?>
        <script src="../Script/jquery-3.5.1.min.js"></script>
        <script src="../Script/bootstrap.min.js"></script>
        <title>Soirees</title>
    </head>
    <body>
        <div id="global">
            <header>
                
                <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="../index.php">Test<img src="" class="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="../index.php">Accueil <span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                            if(isset($_SESSION['connected'])){
                                if($_SESSION['connected']==true){ ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profil</a>
                                <div class="dropdown-menu" aria-labelledby="profil">
                                    <a class="dropdown-item" href="../index.php?profil=<?php echo $_SESSION['id']; ?>">Mon Profil</a>
                                    <a class="dropdown-item" href="../index.php?direction=MesSoirees">Mes soirées</a>
                                    <a class="dropdown-item" href="../index.php?direction=MesDemandes">Mes demandes</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Tchat</a>
                            </li>
                            <?php }
                            } ?>
                            <li class="nav-item">
                                <?php
                                if(isset($_SESSION['connected'])){
                                    if($_SESSION['connected']==true){ ?>
                                        <a class="nav-link" href="Controleur/logout.php?logout=true">Se déconnecter</a>
                                    <?php }
                                }
                                else{ ?>
                                <a class="nav-link dropdown-toggle" href="#" id="log" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Se connecter</a>
                                <div id="logForm" class="dropdown-menu" aria-labelledby="log">
                                    <form action="../Controleur/Connection.php" method="post">
                                        <div class="form-group">
                                            <label>Nom d'utilisateur</label>
                                            <input type="text" placeholder="Nom d'utilisateur" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Mot de passe</label>
                                            <input type="password" placeholder="Mot de passe" name="password" required>
                                        </div>
                                        <button type="submit" id='submit' class="btn btn-primary" value="LOGIN">Envoyer</button>
                                        <a href="../Vue/VueRegister.php">S'inscrire</a>
                                    <?php
                                     if(isset($_GET['erreur'])){
                                         $err = $_GET['erreur'];
                                         if($err==1 || $err==2)
                                             echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                                     } ?>
                                    </form>
                                </div>
                                <?php } ?>
                            </li>
                            <li class="nav-item">
                                <?php
                                if(isset($_SESSION['connected'])){
                                    if($_SESSION['connected']==true){ ?>
                                <p style="color:white;">Bienvenue <?php echo $_SESSION['username']; ?> !</p>
                                    <?php }
                                }?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <?php echo $contenu; ?>
        </div> <!-- #global -->
    </body>
</html>
