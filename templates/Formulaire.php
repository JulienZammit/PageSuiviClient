<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=Formulaire");
    die("");
}
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";
include_once "libs/maLibForms.php";
?>
<link rel="stylesheet" href="css/login.css">
<style>
    h1{
        text-align: center;
    }
    #corps {
        border:solid 1px white;
        border-radius: 20px;
        padding: 20px;
        width:40%;
        text-align: left;
        margin: 0 auto;
        background-color: white;
    }
    body{
        background: #54c4cf;
    }
    #cercle{
        margin-left : 70px;
    }
</style>

    <!--<div id="corps" style="margin-top: 40px;">
        <h1>Lien Courant Naturel</h1>
        <div id="cercle">
            <a href="https://www.courantnaturel.com/" title="Courant Naturel" rel="home" class="logo">
                <img src="https://www.courantnaturel.com/wp-content/uploads/2020/11/logo-2-e1605687964575.png"  class="logo"  alt="Courant Naturel Logo"  />
            </a>
        </div>
    </div>-->

    <div>
        <div id="corps" style="margin-top: 40px;">
            <h1>Rentrez la clé de suivie de votre projet</h1></br>
            <div id="formLogin">
                <?php
                mkForm("controleur.php", "POST");
                echo "Clé de suivie : "; mkInput("text","idProjet","","form-control");
                echo "</br>";
                mkInput('submit',"action","Suivi","btn","background-color:#325eab; color:white; width:100px");
                echo "</br></br>";
                endForm();
                ?>
            </div>
        </div>
    </div>
