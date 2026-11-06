
<?php
    echo "<h1>Pendaftaran Konsultasi</h1>";
    echo '<form method="POST" action="">
        <p>Nama : <br /><input type="text" name="nama" /></p>
        <p>Penyakit : <br /><input type="text" name="penyakit" /></p>
        <p>Sesi : <br />
            <select name="sesi">
                <option value="Sesi 1">Sesi 1</option>
                <option value="Sesi 2">Sesi 2</option>
            </select>
        </p>
        <button type="submit">Daftar</button>
    </form>';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nama = $_POST['nama'];
        $penyakit = $_POST['penyakit'];
        $sesi = $_POST['sesi'];
        $tempat;

        $message = array();
        $message2 = "";

        if(empty($nama) || empty($penyakit) || empty($sesi)){
            $message[] = "Harap lengkapi semua data.";
        }

        if(!preg_match("/^[a-zA-Z ]+$/", $nama)){
            $message[] = "Nama hanya boleh mengandung huruf dan spasi";
        }

        if($sesi == "Sesi 1"){
            $tempat = "Ruang dr. Jung di Lantai 3";
        }else if($sesi == "Sesi 2"){
            $tempat = "Online Meeting (Zoom)";
        }

        if(!empty($message)){
            foreach($message as $msg){
                echo "<p style='color:red;'>!! " . htmlspecialchars($msg) . " !!</p>";
            }
        }else{
            echo "<h2>Informasi Pendaftaran</h2>";
            echo "<p>Nama : " . htmlspecialchars($nama) . "</p><p>Penyakit : " . htmlspecialchars($penyakit) . 
            "</p><p>Sesi : " . htmlspecialchars($sesi) . "</p><p>Tempat Konsultasi : " . htmlspecialchars($tempat) . 
            "</p><p>Anda mendaftar pada " . htmlspecialchars($sesi) . " di " . htmlspecialchars($tempat) . ". Silahkan hadir tepat waktu.</p>";
        }
    }else{
        echo "Silahkan lengkapi formulir diatas.";
    }
?>
