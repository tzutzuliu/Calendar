<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>

    <style>
        *{
            color: black;
            text-align: center;
            font-size: 20px;
            font-weight: bolder;
        }

        /* 視窗背景色彩設定 */ 
        body {
            background-image: url('./gemdesk04.jpg');
            background-attachment: scroll;
            height: fit-content;
            width: fit-content;

        }

        h2 {
            font-size: 40px;
        }

        /* header 標題*/
        header {
            text-align: start;
            margin-bottom: 50px auto;
        }
                
        .table,th, td {
            border: 2px solid black;

        }

        table{
            flex-wrap: nowrap;
            margin-left:auto; 
            margin-right:auto;
            height: 50vh;
            width: 50vh;
        }

        table div{
            display: flex;
        }

        .table td{
            padding-top: 5px;
            text-align: center;
            border: 100px;
        }

        .weekend{
            background: tan;
        }

        .workday{
            background: white;
        }

        .today{
            background: palegreen;
        }

    </style>

</head>

<body>
    <h2>
        G.E.M*線上萬年曆
    </h2>


<?php
$month=5;
?>
  <table>
      <tr>
          <td>日</td>
          <td>一</td>
          <td>二</td>
          <td>三</td>
          <td>四</td>
          <td>五</td>
          <td>六</td>
      </tr>

<?php
  
  $firstDay=date("Y-").$month."-1";
  $firstWeekday=date("w",strtotime($firstDay));
  $monthDays=date("t",strtotime($firstDay));
  $lastDay=date("Y-").$month."-".$monthDays;
  $today=date("Y-m-d");
  $lastWeekday=date("w",strtotime($lastDay));
  $dateHouse=[];

    for($i=0;$i<$firstWeekday;$i++){
        $dateHouse[]="";
    }

    for($i=0;$i<$monthDays;$i++){
        $date=date("Y-m-d",strtotime("+$i days",strtotime($firstDay)));
        $dateHouse[]=$date;
    }

    for($i=0;$i<(6-$lastWeekday);$i++){
        $dateHouse[]="";
    }

  echo " Month : ".$month;
  echo "<br>";
  echo " Today is : " .$today;
  echo "<br>";
  echo "<br>";

  for($i=0;$i<5;$i++){
      echo "<tr>";
      
      for($j=0;$j<7;$j++){
          $d=$i*7+($j+1)-$firstWeekday-1;
          
          if($d>=0 && $d<$monthDays){
              $fs=strtotime($firstDay);
              $shiftd=strtotime("+$d days",$fs);
              $date=date("d",$shiftd);
              $w=date("w",$shiftd);
              $chktoday="";
              if(date("Y-m-d",$shiftd)==$today){
                  $chktoday='today';
              }

              //$date=date("Y-m-d",strtotime("+$d days",strtotime($firstDay)));

              if($w==0 || $w==6){
                  echo "<td class='weekend $chktoday' >";
              }else{
                  echo "<td class='workday $chktoday'>";
              }

              echo $date;
              echo "</td>";
              
            }else{
                echo "<td></td>";
            }            
      }
  }

  ?>
  </table>
  
</body>
<html>

