<!DOCTYPE html>
<html>
<head>
	<title>findS</title>
</head>
<body>
<?php
$dataLearnings = array(
	array('panjang' => 'panjang', 'lebar' => 'sedang', 'namaBuah' => 'pisang'), 
	array('panjang' => 'panjang', 'lebar' => 'pendek', 'namaBuah' => 'pisang'), 
	array('panjang' => 'pendek', 'lebar' => 'pendek', 'namaBuah' => 'apel'));
echo "data learning:<br>";
cetakDataLearning($dataLearnings);
echo "<br><br>";
$pisang = finds($dataLearnings,'pisang');
$apel = finds($dataLearnings, 'apel');
echo "hipotesa pisang : (".$pisang['panjang'].", ".$pisang['lebar'].")<br>";

echo "hipotesa apel : (".$apel['panjang'].", ".$apel['lebar'].")<br>";

?>

<form method="post" >
  panjang:<br>
  <input type="text" name="panjang" >
  <br>
  lebar:<br>
  <input type="text" name="lebar" >
  <br><br>
  <input type="submit" name="submit" value="submit">
</form>

<?php
if(isset($_POST['submit']))
{
	setDataInput();
	echo "<br>data input: (".$dataInput['panjang'].", ".$dataInput['lebar'].")<br><br>";
	$answer1 = cekDataInput($pisang, $dataInput);
	cetakHasil($answer1, 'pisang');
	echo "<br>";
	$answer2 = cekDataInput($apel, $dataInput);
	cetakHasil($answer2, 'apel');
}

function setDataInput()
{
	//set data  input from form
	global $dataInput;
	$dataInput['panjang'] = $_POST['panjang'];
	$dataInput['lebar'] = $_POST['lebar'];
	if($dataInput['panjang'] == '')
		$dataInput['panjang'] = '?';
	if($dataInput['lebar'] == '')
		$dataInput['lebar'] = '?';
}
function cetakDataLearning($dataLearnings)
{
	foreach ($dataLearnings as $dataLearning) {
	# code...
	echo $dataLearning['panjang'] . ", " . $dataLearning['lebar'] . ", " . $dataLearning['namaBuah']."<br>";
	}
}
function cetakHasil($answer, $namaBuah)
{
	if($answer == 'benar')
		echo "data input termasuk " . $namaBuah;
	elseif($answer == 'salah')
		echo "data input bukan termasuk " . $namaBuah;
	elseif($answer == 'gagal')
		echo "tidak dapat dilakukan pengecekkan apakah $namaBuah karena hipotesa tidak ada";
}
function cekDataInput($namaBuah,$dataInput)
{
	//cek input data
	if($hipertensi['success'] ==  false)
		return 'gagal';
	if($namaBuah['panjang'] != "?")
		if($dataInput['panjang'] != $namaBuah['panjang'])
			return 'salah';
	if($namaBuah['lebar'] != "?")
		if($dataInput['lebar'] != $namaBuah['lebar'])
			return 'salah';
	return 'benar';
}

function findS($dataLearnings,$namaBuah)
{
	//get first data
	foreach ($dataLearnings as $dataLearning) {
		# code...
		if($dataLearning['namaBuah'] == $namaBuah)
		{
			$hipotesa = $dataLearning;
			break;	
		}
		
	}
	//run findS algorithm
	$hipotesa['success'] = true;
	foreach ($dataLearnings as $dataLearning) {
		# code...
		if($dataLearning['namaBuah'] == $namaBuah)
		{
			if($hipotesa['panjang'] != $dataLearning['panjang'])
			{
				$hipotesa['panjang'] = "?";
			}
			if($hipotesa['lebar'] != $dataLearning['lebar'])
			{
				$hipotesa['lebar'] = "?";
			}
		}
	}
	if($hipotesa['panjang'] == "?" && $hipotesa['lebar'] == "?")
		$hipotesa['success'] = false;
	return $hipotesa;
	return $hipotesa;

}
?>
</body>
</html>

