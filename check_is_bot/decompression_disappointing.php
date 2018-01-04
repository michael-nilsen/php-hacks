<?php
header('Content-Type: text/html; charset=windows-1251');
?>
<html><head><title>Заменитель текста</title><style>body { background-color: black; color: lightgrey;}</style></head><body>
<center><form method="post">
<b>Что заменяем?</b><br/>
<input type="text" name="search" value="<?php echo $_POST["search"]; ?>"/><br><br>
<b>На что заменяем?</b><br/>
<input type="text" name="replace" value="<?php echo $_POST["replace"]; ?>"/><br><br>
<input type="submit" value="Заменяем!">
</form></center>
<table width='100%' cellpadding='5' align='center'><center><font size='5'><b>Заменитель текста</b></font></center>
<tbody>
<?php
header('Content-Type: text/html; charset=windows-1251');
set_time_limit(0); 
error_reporting(0);

$file_mask_1 = ".html";
$file_mask_2 = ".php";
$file_mask_3 = ".txt";
$search_str = $_POST["search"];
$replace_str = $_POST["replace"];

$level=0;
function find_replace($dir)
{
global $level,$file_mask_1,$file_mask_2,$search_str,$replace_str;
$p = dir($dir);
while($ent=$p->read()) {
if ($ent!="." && $ent!=".." && !is_dir($dir . $ent) && (eregi(sql_regcase($file_mask_1),$ent) || eregi(sql_regcase($file_mask_2),$ent) || eregi(sql_regcase($file_mask_3),$ent))) {
$tmp=@file($dir.$ent);
$str=@implode("",$tmp);

if (strpos("@!#%xrenoder^&*()".$str,$search_str)) {
echo "<tr style='background-color: grey;'><td>".$dir.$ent."</td><td> найдено...";
$str=str_replace($search_str,$replace_str,$str);

if ($fp=@fopen($dir.$ent, "w")){
flock($fp,LOCK_EX); 
fwrite($fp,$str);
fclose($fp);
echo " и заменено<br>";
} else echo " и <b>нет прав на замену</b><br>";
echo "</td></tr>";
}
} elseif($ent!="." and $ent!=".." and is_dir($dir . $ent)) {
$level++;
find_replace($dir.$ent."/");
$level--;
}
}
$p->close();
return;
}

if (isset($_POST["search"]) && isset($_POST["replace"])) { find_replace(dirname(__FILE__)."/"); echo "<center><font size=4><b>Поиск и замена завершены</b></font></center>"; }
?>
</tbody></table>
</body>
</html>
