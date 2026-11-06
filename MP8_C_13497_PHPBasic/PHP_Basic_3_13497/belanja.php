
<?php
    echo "<h1>Belanja</h1>";
    echo "<h2>Daftar Stok</h2>";
    echo '<form method="POST" action="">
        <p>Obat : <br />
            <select name="obat">
                <option value="pil">Pil</option>
                <option value="tablet">Tablet</option>
                <option value="sirup">Sirup</option>
            </select>
        </p>
        <p>Penyakit : <br />
            <select name="penyakit">
                <option value="demam">Demam</option>
                <option value="flu">Flu</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </p>
        <button type="submit">Daftar</button>
    </form>';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $obat = $_POST['obat'];
        $penyakit = $_POST['penyakit'];

        $message = array();
        $message2 = "";

        if(empty($obat) || empty($penyakit)){
            $message[] = "Harap lengkapi semua data.";
        }

        if($obat == "pil"){
            $harga = 30000;
        }else if($obat == "tablet"){
            $harga = 20000;
        }else if($obat == "sirup"){
            $harga = 10000;
        }

        if($penyakit == "demam"){
            $harga2 = 40000;
        }else if($penyakit == "flu"){
            $harga2 = 30000;
        }else if($penyakit == "lainnya"){
            $harga2 = 0;
        }

        if(!empty($message)){
            foreach($message as $msg){
                echo "<p style='color:red;'>!! " . htmlspecialchars($msg) . " !!</p>";
            }
        }else{
            if($penyakit == "lainnya"){
                echo "<p>Maaf, untuk penyakit lainnya silahkan konsultasikan dengan dokter.</p>";
            }else{
                function dapatDiskon($totalBayar){
                    if($totalBayar >= 60000){
                        return 0.2;
                    }

                    return 0;
                }

                function totalHarga($diskon, $totalBayar){
                    return $totalBayar - ($totalBayar * $diskon);
                }

                $totalBayar = $harga + $harga2;
                $diskon = dapatDiskon($totalBayar);
                $hargaAkhir = totalHarga($diskon, $totalBayar);

                echo "<h2>Informasi Belanja</h2>";
                echo "<p>Penyakit : " . htmlspecialchars($penyakit) . "</p>";
                echo "<p>Obat : " . htmlspecialchars($obat) . "</p>";
                echo "<p>Total Harga : Rp" . htmlspecialchars($hargaAkhir) . "</p>";
                echo "<p>Diskon : " . htmlspecialchars($diskon) . "</p>";

                if($diskon == 0){
                    echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
                }else{
                    echo "<p>Selamat! Anda mendapatkan diskon " . htmlspecialchars($diskon * 100) . "%.</p>";
                }
            }
        }
    }else{
        echo "Silahkan lengkapi formulir di atas";
    }
?>
