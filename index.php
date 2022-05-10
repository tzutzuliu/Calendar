<html>
  <title>萬年曆作業</title>
  <head>
    <style>
          .table{
              border-collapse: collapse;
              width: 600px;
              height: 600px;
              border: 1px solid pink;
              flex-wrap: wrap;
          }
          .table div{
              display: inline-block;
          }

          .table td{
              padding-top: 10px;
              text-align: center;
              border:1px solid #aaa;
          }
          .weekend{
              background: palevioletred;
          }
          .workday{
              background: white;
          }
          .today{
              background: orange;
          }
      </style>
  </head>

<body>

<h1>萬年曆</h1>

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

  echo "月份".$month;
  echo "<br>";
  echo "第一天是".$firstDay;
  echo "<br>";
  echo "第一天是星期".$firstWeekday;
  echo "<br>";
  echo "最後一天是".$lastDay;
  echo "<br>";
  echo "當月天數共".$monthDays;
  echo "<br>";
  for($i=0;$i<6;$i++){
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

      echo "</tr>";
  }

  ?>

  </table>
  
</body>
<html>
