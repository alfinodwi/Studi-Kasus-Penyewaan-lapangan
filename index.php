<!DOCTYPE html>
<html>

<head>
    <title>evaluasi</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="div-kiri">
        <h2>Evaluasi <br> <b>Pemrograman</b> </h2>
        <p>
            <marquee><b>Materi Pembuatan Sistem Aplikasi dengan Studi Kasus</b></marquee>
        </p>
        <form action="tambah_data.php" method="get">
            <input type="submit" value="Tambah Data">
        </form>
        <br>
        <h4>Data Penyewaan Lapangan Badminton "Super Badminton"</h4>
        <table border="1" width="700" height="100">
            <tr style="background-color:lime">
                <th>No</th>
                <th>Nama Penyewa</th>
                <th>Jam Sewa</th>
                <th>Hari</th>
                <th>Status</th>
                <th>Harga Sewa</th>
                <th>Diskon</th>
                <th>Total Biaya</th>
            </tr>
            <?php
            require_once "koneksi.php";

            $query = "SELECT * FROM t_penyewaan";
            $result = mysqli_query($koneksi, $query);

            while ($res = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $res["no"] . "</td>";
                echo "<td>" . $res["nama_penyewa"] . "</td>";
                echo "<td>" . $res["jam_sewa"] . "</td>";
                echo "<td>" . $res["hari"] . "</td>";
                echo "<td>" . $res["status"] . "</td>";


                switch ($res["hari"]) {
                    case "Sabtu":
                    case "Minggu":
                        if ($res["jam_sewa"] >= ("08:00") && $res["jam_sewa"] <= ("12:00")) {
                            $harga_sewa = 75000 * 1.05;
                        } elseif ($res["jam_sewa"] > ("12:01") && $res["jam_sewa"] <= ("18:00")) {
                            $harga_sewa = 100000 * 1.05;
                        } elseif ($res["jam_sewa"] > ("18:01") && $res["jam_sewa"] <= ("23:00")) {
                            $harga_sewa = 125000 * 1.05;
                        }
                        break;
                    default:
                        if ($res["jam_sewa"] >= ("08:00") && $res["jam_sewa"] <= ("12:00")) {
                            $harga_sewa = 75000;
                        } elseif ($res["jam_sewa"] > ("12:01") && $res["jam_sewa"] <= ("18:00")) {
                            $harga_sewa = 100000;
                        } elseif ($res["jam_sewa"] > ("18:01") && $res["jam_sewa"] <= ("23:00")) {
                            $harga_sewa = 125000;
                        }
                }

                $diskon = 0;
                if ($res["status"] === "Member") {
                    if ($res["jam_sewa"] >= ("08:00") && $res["jam_sewa"] <= ("12:00")) {
                        $diskon = 0.08;
                    } elseif ($res["jam_sewa"] > ("12:01") && $res["jam_sewa"] <= ("18:00")) {
                        $diskon = 0.09;
                    } elseif ($res["jam_sewa"] > ("18:01") && $res["jam_sewa"] <= ("23:00")) {
                        $diskon = 0.10;
                    }
                }

                $total_biaya = $harga_sewa - ($harga_sewa * $diskon);

                echo "<td>Rp. " . number_format($harga_sewa) . "</td>";
                echo "<td>Rp. " . number_format($diskon * $harga_sewa) . "</td>";
                echo "<td>Rp. " . number_format($total_biaya) . "</td>";
                echo "</tr>";
            }
            mysqli_close($koneksi);
            ?>
        </table>
    </div>
    <div class="div-kanan">
        <h4>Ketentuan :</h4>
        <ul>
            <li><b>Waktu Sewa</b>
                <ol>
                    <li>Pagi : 08.00 - 12.00</li>
                    <li>Siang : 12.01 - 18.00</li>
                    <li>Malam : 18.01 - 23.00</li>
                </ol>
            </li>
            <li><b>Harga Sewa/jam </b>
                <ol>
                    <li>Pagi : Rp. 75.000</li>
                    <li>Siang : Rp. 100.000</li>
                    <li>Malam : Rp. 125.000</li>
                </ol>
            </li>
            <li><b>Untuk Hari Sabtu dan Minggu, Harga Sewa Naik Menjadi 5% dari Harga Sewa Biasanya.</b></li>
            <li><b>Jika Status Penyewa adalah "Member" , dan bermain Pada :</b>
                <ol>
                    <li>Pagi Hari : Maka diskon 8% dari harga Sewa.</li>
                    <li>Siang Hari : Maka diskon 9% dari harga Sewa.</li>
                    <li>Malam Hari : Maka diskon 10% dari harga Sewa.</li>
                </ol>
            </li>
    </div>
</body>

</html>