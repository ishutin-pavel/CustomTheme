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
	$com = $_POST['comm'];
	mail("info@zavodkranov.ru","Опросный лист с сайта","
	Имя и фамилия: $con1<br>
	Компания: $con2<br>
	Телефон: $con3<br>
	Факс: $con4<br>
	E-mail: $con5<br><br>
	Тип крана: $pa10<br>
	Стрела (мм): $pa1<br>
	Грузоподъемность ( кг): $pa2<br>
	Высота подъема (мм): $pa3<br>
	Габаритная высота помещения (мм): $pa4<br>
	Высота нижней грани стрелы: $pa5<br>
	Место установки крана: $pa6<br>
	Угол поворота стрелы: $pa7<br>
	Вид поворота стрелы: $pa8<br>
	Вид привода передвижной тележки: $pa9<br>
	Замечания и дополнительные требования: $com<br>",$headers);
	echo'<META HTTP-EQUIV=Refresh Content="0;URL=/accepted">'; 
	}

?>