<?php 
session_start();

// Initialisation des projets s'ils ne sont pas déjà en session
 if (!isset($_SESSION['projets'])) {
    $_SESSION['projets'] = [
        [
            "nom" => "Projet A",
            "description" => "Description Du Projet A",
            "activites" => [
                ["nom" => "Activite 1", "description" => "Description de l'Activite 1","date"=>"2023-10-06"],
                ["nom" => "Activite 2", "description" => "Description de l'Activite 2","date"=>"2023-10-06"],
                ["nom" => "Activite 3", "description" => "Description de l'Activite 3","date"=>"2023-10-06"]
            ],
            "partenaire"=>[
                ["nom"=>"Total Energy"],
                ["nom"=>"Orange Senegal"]
            ],
        ],
        [
            "nom" => "Projet B",
            "description" => "Description Du Projet B",
            "activites" => [
                ["nom" => "Activite 4", "description" => "Description de l'Activite 4","date"=>"2023-10-06"],
                ["nom" => "Activite 5", "description" => "Description de l'Activite 5","date"=>"2023-11-06"]
            ],
            "partenaire"=>[
                ["nom"=>"Total Energy"],
                ["nom"=>"Orange Senegal"]
            ],
        ],
        [
            "nom" => "Projet C",
            "description" => "Description Du Projet C",
            "activites" => [
                ["nom" => "Activite 6", "description" => "Description de l'Activite 6","date"=>"2023-10-06"]
            ],
            "partenaire"=>[
                ["nom"=>"Total Energy"],
                ["nom"=>"Orange Senegal"]
            ],
        ],
    ];
 }

$nom = $description = $activite_date = "";

if(isset($_POST["choix"])) {
    $choix = $_POST["choix"];
    
    foreach ($_SESSION['projets'] as &$projet) {
        if ($projet["nom"] == $choix) {
            if (isset($_POST["ajouter"])) {
                $nom = $_POST["nom"];
                $description = $_POST["description"];
                $activite_date = $_POST["activite_date"];
                // Ajouter la nouvelle activité au projet
                $nouvelle_activite = [
                    "nom" => $nom,
                    "description" => $description,
                    "date" => $activite_date
                ];
                $projet["activites"][] = $nouvelle_activite;

               
            }
        }
    }
}

    if(isset($_POST["voir"])){
        $cle= $_POST["index_projet"];
        // echo "<pre>";
        // print_r($_SESSION["projets"][$cle]);
        // echo "</pre>";
        $_SESSION["nouveauProjet"]=$_SESSION["projets"][$cle];
        header("Location: liste.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <select name="choix" id=""> 
           <?php 
                foreach ($_SESSION['projets'] as $projet) {
                  echo '<option value="'.$projet['nom'].'">'.$projet['nom'].'</option>';
                }
           ?>
        </select><br>
        <input type="text" name="nom" placeholder="Nom de l'activité"><br>
        <input type="text" name="description" placeholder="Description de l'activité"><br>
        <input type="date" name="activite_date" placeholder="Date"><br>
        <input type="submit" name="ajouter" value="Ajouter"><br>
    </form>

<!-- 
    <?php 
        foreach ($_SESSION["projets"] as $projet) {
            echo "Projet : " . $projet['nom'] . "<br>";
            echo "Description : " . $projet['description'] . "<br>";
            echo "Activités : <br>";
            
            foreach ($projet['activites'] as $activite) {
                echo "- Nom : " . $activite['nom'] . "<br>";
                echo "  Description : " . $activite['description'] . "<br>";
            }
            
            echo "Nombre d'activités : " . count($projet['activites']) . "<br><br>";
        }
        
    
    ?> -->

<table border="1">
        <tr>
            <td>Projet</td>
            <td>Activité</td>
        </tr>
        <?php foreach($_SESSION["projets"] as $key =>&$projet){?>
        <tr>
             <td>
                 <table>
                        <tr>
                            <th>Nom Projet</th>
                            <th>Description</th>
                            <th>Nombre Activité</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td><?php echo $projet["nom"]; ?></td>
                            <td><?php echo $projet["description"]; ?></td>
                            <td><?php echo count($projet["activites"]); ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="text" name="index_projet" value="<?= $key ?>">
                                    <input type="submit" name="voir" value="voir plus">
                                </form>
                            </td>  
                        </tr>  
                </table>
             </td>
               
                <td>
                    <table>
                        <tr>
                            <th>Nom Activité</th>
                            <th>Description</th>
                            <th>date Activité</th>
                        </tr>
                        <?php foreach($projet["activites"] as $activite){?>
                        <tr>
                            <td><?php echo $activite["nom"]; ?></td>
                            <td><?php echo $activite["description"]; ?></td>
                            <td><?php echo $activite["date"]; ?></td>
                            
                        </tr>
                        <?php } ?> 
                           
                    </table>
                </td>
                
        </tr>
        <?php } ?>

    </table>
</body>
</html>
