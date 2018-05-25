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
	$grtel = $_POST['grtel'];
	$pa3 = $_POST['par3'];
	$pa4 = $_POST['par4'];
	$pa5 = $_POST['par5'];
	$pa6 = $_POST['par6'];
	$pa7 = $_POST['par7'];
	$pa8 = $_POST['par8'];
	$mod = $_POST['mode'];
	$categ = $_POST['category'];
	$temp = $_POST['temp'];
	$pa9 = $_POST['par9'];
	$exec = $_POST['execution'];
	$pa10 = $_POST['par10'];
	$pa11 = $_POST['par11'];
	$pa12 = $_POST['par12'];
	$pa13 = $_POST['par13'];
	$standart = $_POST['standart'];
    $pa14 = $_POST['par14'];
	$pa15 = $_POST['par15'];
	$pa16 = $_POST['par16'];
	$pa17 = $_POST['par17'];
	$pa18 = $_POST['par18'];
	$pa19 = $_POST['par19'];
	$chpr = $_POST['chpr'];
	$contr = $_POST['control'];
	$com = $_POST['comm'];
	mail("info@zavodkranov.ru","Опросный лист с сайта","
	Имя и фамилия: $con1<br>
	Компания: $con2<br>
	Телефон: $con3<br>
	Факс: $con4<br>
	E-mail: $con5<br><br>
	Г/п основного подъема (тн): $pa1<br>
	Г/п вспомогательного подъема (мм): $pa2<br>
	Количество грузовых тележек (шт): $grtel<br>
	Необходимость синхронной работы тележек: $pa3<br>
	Высота основного подъема (мм): $pa4<br>
	Высота вспомогательного подъема (мм): $pa5<br>
	Пролет (мм): $pa6<br>
	Общая длина (мм): $pa7<br>
	Длина консолей: $pa8<br>
	Режим работы крана: $mod<br>
	Категория размещения: $categ<br>
	Температура окружающей среды, С: $temp<br>
	Тип кранового рельса, пути: $pa9<br>
	Исполнение крана: $exec<br>
	Категория ПО: $pa10<br>
	Класс ВЗИ: $pa11<br>
	Категория смеси: $pa12<br>
	Группа смеси: $pa13<br>
	Скорость движений: $standart<br>
	Скорость подъема произвольная основная: $pa14<br>
	Скорость подъема произвольная вспомогательная: $pa15<br>
	Скорость передвижения грузовой тележки произвольная основная: $pa16<br>
	Скорость передвижения грузовой тележки произвольная вспомогательная: $pa17<br>
	Скорость передвижения крана произвольная основная: $pa18<br>
	Скорость передвижения крана произвольная вспомогательная: $pa19<br>
	Частотный преобразователь: $chpr<br>
	Вид управления: $contr<br>
	Замечания и дополнительные требования: $com<br>",$headers);
	echo'<META HTTP-EQUIV=Refresh Content="0;URL=/accepted">';
	}
?>