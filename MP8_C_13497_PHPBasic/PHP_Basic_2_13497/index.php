
<?php

    if($_POST){
        $bayaran = $_POST['bayaran'] ?? '';
        $jenis = $_POST['jenis'] ?? '';
        $harga = 600000;
        $message = array();
        $message2 = "";

        if(empty($bayaran) || empty($jenis)){
            $message[] = "Harap lengkapi semua data.";
        }

        if(!is_numeric($bayaran) || $bayaran < 0){
            $message[] = "Jumlah pembayaran harus berupa angka.";
        }

        if(!preg_match("/^[a-dA-D]$/", $jenis)){
            $message[] = "Jenis pembayaran hanya boleh A, B, C, atau D.";
        }

        if(!empty($message)){
            foreach($message as $msg){
                echo "<p style='color:red;'>!! ". htmlspecialchars($msg) . " !!</p>";
            }
        }else{
            function jenisPembayaran($jenis){
                switch(strtolower($jenis)){
                    case 'a':
                        $potongan = 0.75;
                        break;

                    case 'b':
                        $potongan = 0.50;
                        break;

                    case 'c':
                        $potongan = 0.25;
                        break;

                    case 'd':
                        $potongan = 0;
                        break;

                    default:
                        $potongan = 0;
                }
                return $potongan;
            }

            function infoJenisPembayaran($jenis){
                switch(strtolower($jenis)){
                    case 'a':
                        $info = "Cicilan 25%";
                        break;

                    case 'b':
                        $info = "Cicilan 50%";
                        break;

                    case 'c':
                        $info = "Cicilan 75%";
                        break;

                    case 'd':
                        $info = "Lunas";
                        break;

                    default:
                        $info = "Jenis Pembayaran tidak valid.";
                }
                return $info;
            }

            function totalBayar($harga, $potongan){
                return $harga - ($harga * $potongan);
            }

            function pembayaran($bayaran, $totalBayar){
                if($bayaran < $totalBayar){
                    return null;
                }else{
                    $bayaranKembali = $bayaran - $totalBayar;
                    return $bayaranKembali;
                }
            }

            $potongan = jenisPembayaran($jenis);
            $infoJenis = infoJenisPembayaran($jenis);

            $totalBayar = totalBayar($harga, $potongan);

            $bayaranKembali = pembayaran($bayaran, $totalBayar);

            if($bayaranKembali === null){
                $message2 = "Jumlah yang dibayar kurang dari total pembayaran. Silahkan bayar sesuai jumlah yang ditentukan.";
                $bayaranKembali = 0;
            }

            if(!empty($message2)){
                echo "<p style ='color:red;'>!! " . htmlspecialchars($message2) . " !!</p>";
            }else{
                echo "<h2>Informasi Pembayaran</h2>";
                echo "<p><strong>Jumlah yang dibayar: </strong> Rp" . htmlspecialchars($bayaran) . "</p>";
                echo "<p><strong>Jenis Pembayaran: </strong> " . htmlspecialchars($infoJenis) . "</p>";

                if($potongan == 0){
                    if(strtolower($jenis) == 'd'){
                        echo "<p>Pembayaran Lunas.</p>";
                    }else{
                        echo "<p>Maaf jenis pembayaran tidak valid. Tidak ada potongan yang diberikan.</p>";
                    }
                }else{
                    echo "<p>Anda mendapatkan potongan " . htmlspecialchars($potongan * 100) . "% untuk pembayaran SPP anda.</p>";
                }

                echo '<p style="font-weight: bold; font-size: 18px;">Total Pembayaran : Rp' . htmlspecialchars($totalBayar) . '</p>';
                echo '<p style="font-weight: bold; font-size: 18px;">Kembalian : Rp' . htmlspecialchars($bayaranKembali) . '</p>';
            }

        }

    }else{
        echo "Silahkan isi formulir untuk melakukan pembayaran.";
    }

?>
