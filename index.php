<html>
<head>
    <title>test calendrier</title>
    <meta charset ="UTF-8">
    <link rel= "stylesheet" href = "styles/style.css">
    <script type="text/javascript" src="app.js"></script>

</head>
<body id="body">
    <?php 
        include 'Calendar.php';
    ?>
    
    <!-- MAIN HTML CONTENT -->

    <div class="calendar-container flex-h solid inline">
        <div class="left-date date-part padding-h">
            <!-- CALENDAR -->
            <div class="calendar">
                <div class="nav-calendar">
                    <h3>Calendar</h3>
                    <!-- START MOUNTH NAV -->
                    <div class="mpunth-nav center">
                        <button onclick="loadCalendar(<?=$get_link_previous?>)" class="bnt-nav" id="btn-previous"><</button>
                        <?=$m[$mounth]?>
                        <button onclick="loadCalendar(<?=$get_link_next?>)" class="btn-nav" id="btn-next">></button>
                        <!-- alternative link without using ajax
                        <a href="<?=$full_link_previous?>"></a>
                        <a href=<?=$full_link_next?>">></a>
                        -->
                    </div>
                    
                    <div class="year center">
                        <?=$year?>
                    </div>
                </div>
            
                <!-- FORMAT CALENDAR GRID-->
                <?php
                    $width = 7;
                    $height = 6;
                    $counter = $last_day_previous_mounth - ($first_day_mounth-2); //begin with previous mounth
                ?>

                <div class="table">
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
                        
                        <?php for($i=1;$i<=$height;$i++){
                            echo '<tr>';
                            for($j=1;$j<=$width;$j++){
                                $tr_class = "is-mounth-day";

                                if(($counter>21&&$i<3)||($counter<15&&$i>3))
                                    $tr_class = "not-mounth-day";

                                if($counter>$last_day_previous_mounth&&$i<3){
                                    $counter = 1;
                                    $tr_class = "is-mounth-day";
                                    echo '<td class ="'.$tr_class.'">'.$counter.'</td>';
                                }
                                else if($counter>$mounth_end&&$i>4){
                                    $counter = 1;
                                    $tr_class = "not-mounth-day";
                                    echo '<td class ="'.$tr_class.'">'.$counter.'</td>';
                                }

                                else
                                    echo '<td class ="'.$tr_class.'">'.$counter.'</td>';
                                
                                $counter++;
                            }
                            echo '</tr>';
                        }?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="right-date date-part padding-h">
                <!-- START SHOW TODAY -->
                <div class="date" id="today">
                    <h3>Aujourd'hui</h3>
                    <p>On est le : <?=$actual_day?> - <?=$str_actual_mounth?> - <?=$actual_year?></p>
                </div>
                <!-- END SHOW TODAY-->
            
                <hr>

                <!--ADVANCE DATE START-->
                
                <div class="find-date">
                    <h3>Trouver une date</h3>
                    <form action="index.php" method="get">
                        <input type="text" name="mounth" placeholder="moi" id="input-mounth">
                        <input type="text" name="year" placeholder="année" id="input-year">
                        <br>
                        <input type="submit" value="Aller à" id="submit">
                    </form>
                </div>
                
                <!--ADVANCE DATE END-->
                <hr>
                <div class="this-mounth center">
                    <a href="http://localhost/test_calendrier_php/index.php">Reset</a>
                </div>
            </div>
        </div>
    </div>
    
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