<?php
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

if(count($_POST)>0){
	$con1 = $_POST['cont1'];
	$con2 = $_POST['cont2'];
	$con3 = $_POST['cont3'];
	$con4 = $_POST['cont4'];
	$con5 = $_POST['cont5'];
	$com = $_POST['comm'];
	mail("info@zavodkranov.ru","Запрос с сайта","
	Имя и фамилия: $con1<br>
	Компания: $con2<br>
	Телефон: $con3<br>
	Факс: $con4<br>
	E-mail: $con5<br><br>
	Запрос: $com<br>",$headers);
	echo'<META HTTP-EQUIV=Refresh Content="0;URL=/accepted">'; 
	}
?>