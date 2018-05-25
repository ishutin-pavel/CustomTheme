<?php

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";



if(count($_POST)>0){

	$con1 = $_POST['cont1'];

	$con2 = $_POST['cont2'];

	$con3 = $_POST['cont3'];

	$con4 = $_POST['cont4'];

	$con5 = $_POST['cont5'];

	$pa1 = $_POST['par1'];

	$pa2 = $_POST['par2'];

	$pa3 = $_POST['par3'];

	$pa4 = $_POST['par4'];

	$pa5 = $_POST['par5'];

	$pa6 = $_POST['par6'];

	$pa7 = $_POST['par7'];

	$pa8 = $_POST['par8'];

	$pa9 = $_POST['par9'];

	$pa10 = $_POST['par10'];

	$pa11 = $_POST['par11'];

	$pa12 = $_POST['par12'];

	$pa13 = $_POST['par13'];

	$pa14 = $_POST['par14'];

	$pa15 = $_POST['par15'];

	$pa16 = $_POST['par16'];

	$pa17 = $_POST['par17'];

	$pa18 = $_POST['par18'];

	$pa19 = $_POST['par19'];

	$pa20 = $_POST['par20'];

	$com = $_POST['comm'];

	mail("info@zavodkranov.ru","Опросный лист с сайта","

	Имя и фамилия: $con1<br>

	Компания: $con2<br>

	Телефон: $con3<br>

	Факс: $con4<br>

	E-mail: $con5<br><br>
	Тип привода: $pa1<br>

	Тип подъемного устройства: $pa2<br>

	Перемещение: $pa3<br>

	Способ крепления к крану: $pa4<br>

	Грузоподъемность, тн.: $pa5<br>

	Высота подъема, мм: $pa6<br>

	Приводная тележка: $pa7<br>

	Строительная высота, мм: $pa8<br>
	Полиспаст: $pa9<br>
	Высота до низа консоли H1, мм: $pa10<br>
	Режим работы тали: $pa11<br>
	Категория размещения: $pa12<br>
	Температура окружающей среды, С: $pa13<br>
	Полная длина пути: $pa14<br>
	Исполнение тали: $pa15<br>
	Скорости рабочих движений, м/мин.: $pa16<br>
	Скорость подъема: $pa17<br>
	Скорость передвижения тали: $pa18<br>
	Скорость передвижения крана: $pa19<br>
	Вид управления: $pa20<br>
	Замечания и дополнительные требования: $com<br>",$headers);

	echo'<META HTTP-EQUIV=Refresh Content="0;URL=/accepted">';

	}

?>