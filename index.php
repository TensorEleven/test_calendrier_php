<html>
<head>
    <title>test calendrier</title>
    <meta charset ="UTF_8">

</head>
<body>
    <?php

    /* MOUNTH OF THE YEAR FR*/
    $m = ['e',"Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre", "Novembre", "Décembre"];

    /* DAY OF THE WEEK FR*/
    $d = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

    /*
     *   TODAY DAY, Mounth, YEAR
     */

    //$actual_year = intVal(date("Y")); //YEAR y-> 21, Y-> 2021
    
    $actual_mounth = intVal(date("m"));
    $str_actual_mounth = $m[($actual_mounth)];
    $actual_day = intVal(date("d"));

    /*
     *    GET YEAR
     *
     */

    function get_actual_year(){
        return intVal(date("Y"));
    }

    function get_year($new_year){
        $y;

        if(!isset($new_year)||$new_year===""){//year set to 2020 by default
            $y = get_actual_year(); //set default year
        }

        else
            $y = $new_year;
        return $y;
    }

    $year = get_year($_GET['year']);
    $actual_year = get_actual_year();
    
    /*
     *    GET MOUNTH 
     *
     */

    if(!isset($_GET['mounth'])||$_GET['mounth']===""||$_GET['mounth']<1||$_GET['mounth']>12){
        $mounth = $actual_mounth ; //set a default mounth
    }

    else{
        $mounth = $_GET["mounth"];
    }

    function get_previous_mounth($new_mounth){
        $prev_mounth = $new_mounth - 1;
        if ($prev_mounth<1)
            $prev_mounth = 12;
        return $prev_mounth;
    }
    
    /*
    $previous_mounth = get_previous_mounth($mounth);
    echo $previous_mounth;
    */

    /*
     *  CHANGE CHECK
     *
     */

    if($_GET["mounth_change"]==-1){
        $mounth = $_GET["mounth"]-1;    //go to last week
        
        if($mounth < 1){                //get previous year
            $mounth = 12;
            $year = $_GET['year'] - 1;  //decrement year
        }

        $_GET["mounth_change"] = null;
    }
    
    else if($_GET["mounth_change"]==1){ 
        $mounth = $_GET["mounth"]+1;        //go to next week
        if ($mounth>12){                    //if december exceeded 
            $mounth = 1;
            $year = $year+1;                //increment year
        }
    }

    /*
     *   Get first and last day of mounth
     */
        $date_first = $year."-".$mounth."-"."01";             // timestamp first day of the mounth
        $first_day_mounth = date("N",strtotime($date_first)); // N is the integer value of the week day   
        
        $date = $year."-".$mounth."-"."01";                   // timestamp first day of the mounth
        $date_last = date("Y-m-t",strtotime($date));          // Get the last day of mounth date 
        $last_day_mounth = date("N",strtotime($date_last));

        $previous_mounth = get_previous_mounth($mounth);
        $date_prev_mounth_last = $year."-".$previous_mounth."-"."01"; 
        $last_day_previous_mounth = date("t",strtotime($date_prev_mounth_last));

    /*  
     *   Formating to string and GET method for HTML
     *
     */

    $mounth = (string) $mounth;
    $year  = (string) $year;
    ?>

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
        <a href="http://localhost/code_test_php/index.php?mounth=<?=$mounth?>&mounth_change=-1&year=<?=$year?>"><</a>
        <?=$m[$mounth]?>
        <a href="http://localhost/code_test_php/index.php?mounth=<?=$mounth?>&mounth_change=1&year=<?=$year?>">></a>
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
        
    <a href="http://localhost/code_test_php/index.php">CALENDAR</a>

    
</body>
</html>