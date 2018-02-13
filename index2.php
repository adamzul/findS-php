<!DOCTYPE html>
<html>
<head>
	<title>findS</title>
</head>
<body>
<?php
$dataLearnings = array(
	array('umur' => 'muda', 'kegemukan' => 'gemuk', 'hipertensi' => 'tidak'), 
	array('umur' => 'muda', 'kegemukan' => 'sangat gemuk', 'hipertensi' => 'tidak'), 
	array('umur' => 'paruh baya', 'kegemukan' => 'gemuk', 'hipertensi' => 'tidak'),
	array('umur' => 'paruh baya', 'kegemukan' => 'terlalu gemuk', 'hipertensi' => 'ya'), 
	array('umur' => 'tua', 'kegemukan' => 'terlalu gemuk', 'hipertensi' => 'ya'));
echo "data learning:<br>";
cetakDataLearning($dataLearnings);
echo "<br><br>";
$tidak = finds($dataLearnings,'tidak');
$ya = finds($dataLearnings, 'ya');
echo "hipotesa tidak : (".$tidak['umur'].", ".$tidak['kegemukan'].")<br>";

echo "hipotesa ya : (".$ya['umur'].", ".$ya['kegemukan'].")<br>";

?>

<form method="post" >
  umur:<br>
  <input type="text" name="umur" >
  <br>
  kegemukan:<br>
  <input type="text" name="kegemukan" >
  <br><br>
  <input type="submit" name="submit" value="submit">
</form>

<?php
if(isset($_POST['submit']))
{
	setDataInput();
	echo "<br>data input: (".$dataInput['umur'].", ".$dataInput['kegemukan'].")<br><br>";
	$answer1 = cekDataInput($tidak, $dataInput);
	cetakHasil($answer1, 'tidak');
	echo "<br>";
	$answer2 = cekDataInput($ya, $dataInput);
	cetakHasil($answer2, 'ya');
}

function setDataInput()
{
	//set data  input from form
	global $dataInput;
	$dataInput['umur'] = $_POST['umur'];
	$dataInput['kegemukan'] = $_POST['kegemukan'];
	if($dataInput['umur'] == '')
		$dataInput['umur'] = '?';
	if($dataInput['kegemukan'] == '')
		$dataInput['kegemukan'] = '?';
}
function cetakDataLearning($dataLearnings)
{
	foreach ($dataLearnings as $dataLearning) {
	# code...
	echo $dataLearning['umur'] . ", " . $dataLearning['kegemukan'] . ", " . $dataLearning['hipertensi']."<br>";
	}
}
function cetakHasil($answer, $hipertensi)
{
	if($answer == 'benar')
		echo "data input termasuk " . $hipertensi." hipertensi";
	elseif($answer == 'salah')
		echo "data input bukan termasuk " . $hipertensi." hipertensi";
	elseif($answer == 'gagal')
		echo "tidak dapat dilakukan pengecekkan apakah $hipertensi hipertensi karena hipotesa tidak ada";

}
function cekDataInput($hipertensi,$dataInput)
{
	//cek input data
	if($hipertensi['success'] ==  false)
		return 'gagal';
	if($hipertensi['umur'] != "?")
		if($dataInput['umur'] != $hipertensi['umur'])
			return 'salah';
	if($hipertensi['kegemukan'] != "?")
		if($dataInput['kegemukan'] != $hipertensi['kegemukan'])
			return 'salah';
	return 'benar';
}

function findS($dataLearnings,$hipertensi)
{
	//get first data
	foreach ($dataLearnings as $dataLearning) {
		# code...
		if($dataLearning['hipertensi'] == $hipertensi)
		{
			$hipotesa = $dataLearning;
			break;	
		}
		
	}
	//run findS algorithm
	$hipotesa['success'] = true;
	foreach ($dataLearnings as $dataLearning) {
		# code...
		if($dataLearning['hipertensi'] == $hipertensi)
		{
			if($hipotesa['umur'] != $dataLearning['umur'])
			{
				$hipotesa['umur'] = "?";
			}
			if($hipotesa['kegemukan'] != $dataLearning['kegemukan'])
			{
				$hipotesa['kegemukan'] = "?";
			}
		}
	}
	if($hipotesa['umur'] == "?" && $hipotesa['kegemukan'] == "?")
		$hipotesa['success'] = false;
	return $hipotesa;

}
?>
</body>
</html>

