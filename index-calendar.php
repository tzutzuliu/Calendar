<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h2>
        G.E.M.*線上萬年曆
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
  $birthday="08-16";
  echo "G.E.M.鄧紫棋生日是:".$birthday."<br>";

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

  echo"<br>";  
  echo "現在月份:".$month."月份";
  echo "<br>";
  echo " 現在日期是: " .$today;
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

