<html>
<head>
    <title>test calendrier</title>
    <meta charset ="UTF-8">
    <link rel= "stylesheet" href = "styles/style.css">

</head>
<body id="body">
    
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
        <button onclick="loadCalendar(<?=$get_link_previous?>)"><</button>
        <?=$m[$mounth]?>
        <button onclick="loadCalendar(<?=$get_link_next?>)">></button>
    <!-- END MOUNTH NAV -->
    <br>

    <!-- START DATE -->
    <?=$year?> <br>
    
    <!-- 
    Premier jour du moi: <?=$d[$first_day_mounth-1]?> (<?=$first_day_mounth?>)<br>
    Dernier jour du moi: <?=$d[$last_day_mounth-1]?> (<?=$last_day_mounth?>)<br>
    Dernier jour du moi d'avant: (<?=$last_day_previous_mounth?>)
    -->

    <!-- END DATE -->
    
    <!-- FORMAT CALENDAR GRID-->
    <br>
    <?php
        $width = 7;
        $height = 5;
        $counter = $last_day_previous_mounth - $first_day_mounth;
    ?>
    

    <table>
        <tr>
            <th>lu</th>
            <th>ma</th>
            <th>me</th>
            <th>je</th>
            <th>ve</th>
            <th>sa</th>
            <th>di</th>
        </tr>
        
        <?php
            
            for($i=1;$i<=$height;$i++){
                echo '<tr>';
                for($j=1;$j<=$width;$j++){
                    $tr_class = "is-mounth-day";
                    
                    if($counter>$last_day_previous_mounth||$counter>$mounth_end){
                        $counter = 1;
                        $r_class = "not-mounth-day";
                        echo '<td class ="'.$tr_class.'">'.$counter.'</td>';
                    }
                    else
                        echo '<td class ="is-mounth-day">'.$counter.'</td>';
                    
                    $counter++;
                }
                echo '</tr>';
            }
        ?>
    </table>

    <!--ADVANCE DATE START-->
    <hr>
    <h3>Trouver une date</h3>
        <form action="index.php" method="get">
            <input type="text" name="mounth" placeholder="moi">
            <input type="text" name="year" placeholder="année">
            <input type="submit" value="Aller à">
        </form>

    <!--ADVANCE DATE END-->

    <hr>
    <a href="http://localhost/test_calendrier_php/index.php">CALENDAR</a>
    
    <script type="text/javascript">
        function loadCalendar(get_link) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("body").innerHTML = this.responseText;
            }
        };

        xhttp.open("GET", get_link, true);
        xhttp.send();
        }
    </script>
</body>
</html>