<?php
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
if(count($_POST)>0){
	$con1 = $_POST['cont1'];
	$con2 = $_POST['cont2'];
	$con3 = $_POST['cont3'];
	$con4 = $_POST['cont4'];
	$con5 = $_POST['cont5'];
	$cran = $_POST['crane'];
	$pa1 = $_POST['par1'];
	$pa2 = $_POST['par2'];
	$pa3 = $_POST['par3'];
	$pa4 = $_POST['par4'];
	$pa5 = $_POST['par5'];
	$mod = $_POST['mode'];
	$categ = $_POST['category'];
	$temp = $_POST['temp'];
	$pa6 = $_POST['par6'];
	$exec = $_POST['execution'];
	$pa7 = $_POST['par7'];
	$speed = $_POST['speed'];
	$pa8 = $_POST['par8'];
	$pa9 = $_POST['par9'];
	$pa10 = $_POST['par10'];
	$chpr = $_POST['chpr'];
	$contr = $_POST['control'];
	$com = $_POST['comm'];
	mail("zk0503565@yandex.ru","Опросный лист с сайта","
	Имя и фамилия: $con1<br>
	Компания: $con2<br>
	Телефон: $con3<br>
	Факс: $con4<br>
	E-mail: $con5<br><br>
	Тип крана: $cran<br>
	Грузоподъемность (тн): $pa1<br>
	Высота подъема (мм): $pa2<br>
	Пролет (мм): $pa3<br>
	Общая длина (мм): $pa4<br>
	Длина консолей (мм): $pa5<br>
	Режим работы крана: $mod<br>
	Категория размещения: $categ<br>
	Температура окружающей среды, С: $temp<br>
	Тип подкранового рельса: $pa6<br>
	Исполнение крана: $exec<br>
	Общ/Пож/Взрывобез пояснения: $pa7<br>
	Скорость рабочих движений: $speed<br>
	Подъем срд: $pa8<br>
	Передвижение тали срд: $pa9<br>
	Передвижение крана: $pa10<br>
	Частотный преобразователь: $chpr<br>
	Вид управления: $contr<br>
	Замечания и дополнительные требования: $com<br>",$headers);
	echo'<META HTTP-EQUIV=Refresh Content="0;URL=/accepted">';
	}
?>