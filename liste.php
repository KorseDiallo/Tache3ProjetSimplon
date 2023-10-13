<?php 
    session_start();

    if(isset($_SESSION["nouveauProjet"])){
        $nouveauTableau= $_SESSION["nouveauProjet"];
    }else{
        $nouveauTableau=null;
    }


    if($nouveauTableau==null){
        echo "Aucun projet envoyer";
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
<table border="1">
        <tr>
            <td>Projet</td>
            <td>Activité</td>
        </tr>
      
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
                            <td><?php echo $nouveauTableau["nom"]; ?></td>
                            <td><?php echo $nouveauTableau["description"]; ?></td>
                            <td><?php echo count($nouveauTableau["activites"]); ?></td>
                            <td></td>  
                        </tr>  
                </table>
             </td>
               
                <td>
                    <table>
                        <tr>
                            <th>Nom Activité</th>
                            <th>Description</th>
                            <th>date Activité</th>
                            <th>Partenaire</th>
                        </tr>
                        <?php foreach($nouveauTableau["activites"] as $activite){?>
                        <tr>
                            <td><?php echo $activite["nom"]; ?></td>
                            <td><?php echo $activite["description"]; ?></td>
                            <td><?php echo $activite["date"]; ?></td>

                            <td>
                                <?php foreach ($nouveauTableau["partenaire"] as  $partenaire): ?>
                                   <ul>
                                        <li><?= $partenaire["nom"]; ?></li>
                                   </ul>
                                <?php endforeach; ?>
                            </td>
                            
                        </tr>
                        <?php } ?> 
                           
                    </table>
                </td>
                
        </tr>
  

    </table>
</body>
</html>