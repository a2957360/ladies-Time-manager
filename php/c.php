<?php 

$time = explode('-', '11-12-2011');
	
  $mon = getdate(mktime(0,0,0,3,-5,2017))["mon"];
  $year = getdate(mktime(0,0,0,3,-5,2017))["year"];
  echo $mon;
$mday = $time[0];
$mon = $time[1];
$year = $time[2];

//判断一下一年中各个月份有几天的情况
if($mon==4||$mon==6||$mon==9||$mon==11){
$day = 30;
}elseif($mon==2){
if(($year%4==0&&$year%100!=0)||$year%400==0){
$day = 29;
}else{
$day = 28;
}
}else{
$day = 31;
}
//取到这个月的1号是第几天，
$w = getdate(mktime(0,0,0,$mon,1,$year))["wday"];
//制作日历的大框架。用for遍历数组，打印出一个日历的格式。
$date = function($day,$w){
echo "<table border='1'>";
echo "<tr><th>星期日</th><th>星期一</th><th>星期二</th><th>星期三</th><th>星期四</th><th>星期五</th><th>星期六</th></tr>";
$arr = array();
for($i=1;$i<=$day;$i++){
array_push($arr,$i);
}
if($w>=1&&$w<=6){
for($m=1;$m<=$w;$m++){
array_unshift($arr,"");
}
}
$n=0;
for($j=1;$j<=count($arr);$j++){
$n++;
if($n==1) echo "<tr>";
global $mday;
if($mday==$arr[$j-1]){

//把今天的这一天加一个颜色
echo "<td width='80px' style='background-color: greenyellow;'>".$arr[$j-1]."</td>";
}else{
echo "<td width='80px'>".$arr[$j-1]."</td>";
}

if($n==7){
echo "</tr>";
$n=0;
}
}
if($n!=7)echo "</tr>";

echo "</table>";
};
$date($day,$w);
?>
<?= $mday - 1 ?>