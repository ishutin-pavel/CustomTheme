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
	$pa6 = $_POST['par6'];
	$pa8 = $_POST['par8'];
	$pa9 = $_POST['par9'];
	$pa10 = $_POST['par10'];
	$pa11 = $_POST['par11'];
	$pa12 = $_POST['par12'];
	$pa13 = $_POST['par13'];
	$com = $_POST['comm'];
	mail("info@zavodkranov.ru","Опросный лист с сайта","
	Имя и фамилия: $con1<br>
	Компания: $con2<br>
	Телефон: $con3<br>
	Факс: $con4<br>
	E-mail: $con5<br><br>
	Количество, шт.: $pa1<br>
	Тип кабины: $pa2<br>
	Место установки: $pa3<br>
	Лестница: $pa6<br>
	Кресло крановщика и/или тип кресла: $pa8<br>
	Тип кресла другое описание: $pa9<br>
	Кресло стажера: $pa10<br>
	Обогреватель: $pa11<br>
	Кондиционер: $pa12<br>
	Шкаф ввода: $pa13<br>
	Замечания и дополнительные требования: $com<br>",$headers);

	echo'<META HTTP-EQUIV=Refresh Content="0;URL=/accepted">';
	}
?>