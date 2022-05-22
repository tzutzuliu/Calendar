<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!--CSS部份開始-->
    <style>
        /*整體*/
        *{
        color: burlywood;
        text-align: center;
        text-shadow: 1px 1px black;
        font-size: 25px;
        font-weight: bolder;

        }

        /* 視窗背景設定 */ 
        body {
            background-image: url('gemdesk04.jpg');
            background-attachment: fixed;
            height: fit-content;
            width: fit-content;
            background-size: cover;
        }


        /*標題*/
        h1 {
            font-size: 40px;
            text-align: center;
            margin-bottom: 50px auto;
            color: burlywood;
            text-shadow: 5px 5px 5px black;
        }
    
        /*表格*/
        .table,th, td {
            border: 3px solid whitesmoke;
            border-radius: 10px;
            background-color: white;
            color: black;
        }

        table{
            flex-wrap: nowrap;
            margin-left:auto; 
            margin-right:auto;
            height: 70vh;
            width: 70vh;
        }

        table div{
            display: flex;
        }

        .table td{
            text-align: center;
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

        /* wrapper */ 
        .wrapper {
            width: 800px;
            margin: auto;
            margin-top: 50px;
        }

        /*我的導覽標籤--按鈕*/
        .nav { 
            display: flex;
            justify-content: space-around;
        }

        /*我的按鈕*/ 
        .button1 { 
            background-color: paleturquoise;
            border: none;
            color: black;
            text-align: center;
            text-decoration: none;
            font-weight: bolder;
            display: inline-block;
            font-size: 25px;
            padding: 10px;
            margin-right: 15px;
            margin-left: 15px;
            cursor: pointer;
            justify-content: center;
        }

        /*button hover*/
        .button1:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }
    </style>
    <!--CSS部份結束-->
</head>

<body>
<div class="wrapper">
    <!--萬年曆title star-->
    <h1 class="fas fa-heart" style="font-size:35px;">線上萬年曆</h1>
    <!--萬年曆title end-->  
    
    <!--萬年曆傳值get-->
    <?php       
        if(isset($_GET['month']))  //如果GET回傳的位置是有變數的，則回傳GET位置的變數
        {
            $month=$_GET['month'];
            $year=$_GET['year'];
        }
        else
        {
             $month=date('n');  //取得當前月
             $year=date("Y");   //取得當前年
        }

        switch($month)
        {
            case 1:
                $previousMonth=12;     
                $previousYear=$year-1;  
                $nextMonth=$month+1;     
                $nextYear=$year;             
            break;
            case 12:
                $previousMonth=$month-1;     
                $previousYear=$year;  
                $nextMonth=1;     
                $nextYear=$year+1;
            break;
            default:                           //如果是在2-11月的話，在這裡需要算好值帶到下一個月連結去
                $previousMonth=$month-1;     
                $previousYear=$year;  
                $nextMonth=$month+1;     
                $nextYear=$year;        
        }
        echo "<br>";
        echo "西元".$year."年".$month."月";

    ?>
    
    <!-- 萬年曆切換按鈕的部份 先給他一個nav標籤 -->
    <div class='nav'>
        <span>
            <a href='index-calendarhw2.php?year=<?=$previousYear;?>&month=<?=$previousMonth;?>' class="button1">Prev</a>
        </span>

        <span>
            <button>
                G.E.M. Calendar
            </button>
        </span>

        <span>
            <a href='index-calendarhw2.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>' class="button1">Next</a>
        </span>

    </div>

<!-- 萬年曆內容開始 -->
<?php
  
  $firstDay=$year."-".$month."-1";
  $firstWeekday=date("w",strtotime($firstDay));
  $monthDays=date("t",strtotime($firstDay));
  $firstWeekDays=7-$firstWeekday;
  $weeks=ceil(($firstWeekday+$monthDays)/7);
  $lastDay=$year."-".$month."-".$monthDays;
  $lastWeekdays=($firstWeekday+$monthDays)%7;
  $lastWeekWhiteDays=7-$lastWeekdays;
  $allcells=$weeks*7;
  $today=date("Y-m-d");
  $lastWeekday=date("w",strtotime($lastDay));
  $dateHouse=[];

  date_default_timezone_set('Asia/Taipei');    
  $DateAndTime = date('Y-m-d h:i a', time());  
  echo "$DateAndTime.";

    for($i=0;$i<$firstWeekday;$i++)
    {
        $td[]="";
    }

    for($i=0;$i<$monthDays;$i++)
    {
        $td[]=($i+1);
        $date=date("Y-m-d",strtotime("+$i days",strtotime($firstDay)));
        $dateHouse[]=$date;
    }

    for($i=0;$i<$lastWeekWhiteDays;$i++)
    {
        $dateHouse[]="";
    }
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
    for($i=0;$i<6;$i++)  //印出一個月有幾週，最多到六週
    {
      if($date==$monthDays) //如果date=本月的天數
      {
        break;      //就會停止執行,break強制跳出
      }
      echo "<tr>"; //不然就印出這列

      for($j=0;$j<7;$j++)
        {
          $d=$i*7+($j+1)-$firstWeekday-1;
          
          if($d>=0 && $d<$monthDays)
            {
                $fs=strtotime($firstDay);
                $shiftd=strtotime("+$d days",$fs);
                $date=date("d",$shiftd);
                $w=date("w",$shiftd);
                $chktoday="";
                if(date("Y-m-d",$shiftd)==$today)
                {
                    $chktoday='today';
                }

                //$date=date("Y-m-d",strtotime("+$d days",strtotime($firstDay)));

                if($w==0 || $w==6)
                {
                    echo "<td class='weekend $chktoday' >";
                }
                else
                {
                    echo "<td class='workday $chktoday'>";
                }
                echo $date;
                echo "</td>";  
            }
            else
            {
                echo "<td></td>";
            }            
        }
    }
?> 
<!-- 萬年曆內容結束 -->
</div>
</body>
<html>