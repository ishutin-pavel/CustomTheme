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
	$com = $_POST['comm'];
	mail("info@zavodkranov.ru","�������� ���� � �����","
	��� � �������: $con1<br>
	��������: $con2<br>
	�������: $con3<br>
	����: $con4<br>
	E-mail: $con5<br><br>
	����������, ��.: $pa1<br>
	��� ������: $pa2<br>
	����� ���������: $pa3<br>
	���� � ������: $pa4<br>
	���� � ������: $pa5<br>
	��������: $pa6<br>
	������ ����������: $pa7<br>
	��� ������: $pa8<br>
	��� ������ ������ ��������: $pa9<br>
	������ �������: $pa10<br>
	������������: $pa11<br>
	�����������: $pa12<br>
	���� �����: $pa13<br>
	��������� � �������������� ����������: $com<br>",$headers);

	echo'<META HTTP-EQUIV=Refresh Content="0;URL=/accepted">';
	}
?>