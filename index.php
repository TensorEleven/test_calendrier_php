<html>
<head>
    <title>test calendrier</title>
    <meta charset ="UTF_8">
    
</head>
<body>
    
    <?php include 'Calendar.php';?>
    
    <!----------------- MAIN HTML CONTENT -------------------->
    
    <!-- START SHOW TODAY -->
    <div class="time now">
        <h3>Aujourd'hui</h3>
            On est le : <?= $actual_day ?> - <?= $str_actual_mounth ?> - <?= $actual_year ?> 
    </div>
    <!-- END SHOW TODAY-->
    <hr>
    
    <!------------------ CALENDAR ---------------------------->
    <h3>Calendar</h3>
    <!-- START MOUNTH NAV -->
        <a href="http://localhost/test_calendrier_php/index.php?mounth=<?=$mounth?>&mounth_change=-1&year=<?=$year?>"><</a>
        <?=$m[$mounth]?>
        <a href="http://localhost/test_calendrier_php/index.php?mounth=<?=$mounth?>&mounth_change=1&year=<?=$year?>">></a>
    <!-- END MOUNTH NAV -->
    <br>

    <!-- START DATE -->
    Moi: <?=$mounth?> <br>
    Année: <?=$year?> <br>
    Premier jour du moi: <?=$d[$first_day_mounth-1]?> (<?=$first_day_mounth?>)<br>
    Dernier jour du moi: <?=$d[$last_day_mounth-1]?> (<?=$last_day_mounth?>)<br>
    Dernier jour du moi d'avant: (<?=$last_day_previous_mounth?>)
    <!-- END DATE -->
    <hr>

    <!--ADVANCE DATE START-->
    <h3>Trouver une date</h3>
        <form action="index.php" method="get">
            <input type="text" name="mounth" placeholder="moi">
            <input type="text" name="year" placeholder="année">
            <input type="submit" value="Aller à">
        </form>

    <!--ADVANCE DATE END-->
        
    <a href="http://localhost/test_calendrier_php/index.php">CALENDAR</a>

    <!-- FORMAT CALENDAR GRID-->
    <hr>
    <h3>Grid</h3>
    <br>
    <?php
        $width = 7;
        $height = 5;
        $counter = $last_day_previous_mounth - $first_day_mounth;
    ?>
    <table>
        <tr>
            <th>lundi</th>
            <th>mardi</th>
            <th>mercredi</th>
            <th>jeudi</th>
            <th>vendredi</th>
            <th>samedi</th>
            <th>dimanche</th>
        </tr>
        <?php
            
            for($i=1;$i<=$height;$i++){
                echo '<tr>';
                for($j=1;$j<=$width;$j++){

                    if($counter>$last_day_previous_mounth||$counter>$mounth_end){
                        $counter = 1;
                        echo '<td class ="not-mounth-day">'.$counter.'</td>';
                    }
                    else
                        echo '<td class ="is-mounth-day">'.$counter.'</td>';
                    
                    $counter++;
                }
                echo '</tr>';
            }
        ?>
    </table>
</body>
</html>