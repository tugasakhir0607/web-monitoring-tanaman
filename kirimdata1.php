<?php
$host = "localhost";
$user = "root";
$pass = "";
$name ="db_monitoring_tanaman";

$idtanaman = $_GET["idtanaman"];
$kelembapan = $_GET["kelembapan"];
$pompa = $_GET["pompa"];
$keterangan = $_GET["keterangan"];

$conn = new mysqli($host, $user, $pass, $name);

if ($conn->connect_error){
	die("Keneksi gagal: " . $conn->connect_error);

}

$sql = "INSERT INTO tb_sensor (id_tb_tanaman,kelembapan, pompa, keterangan) VALUES ('$idtanaman','$kelembapan','$pompa','$keterangan')";

if ($conn->query($sql) === TRUE){
	$result = $conn->query("SELECT * FROM tb_tanaman WHERE id_tb_tanaman=$idtanaman");
	while($user_data = mysqli_fetch_array($result))
	{
		$stt_siram = $user_data['stt_siram'];
	}
	
	echo $stt_siram;
} else {
	echo "error: ".$conn->error;
}
$conn->close();
?>