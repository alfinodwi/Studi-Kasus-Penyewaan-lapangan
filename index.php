<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>evaluasi</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
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
                <th>Aksi</th>
            </tr>
            <?php
            require_once "koneksi.php";

            $query = "SELECT * FROM t_penyewaan";
            $result = mysqli_query($koneksi, $query);

            $no = 1;
            while ($res = mysqli_fetch_array($result)) {
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
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $res["nama_penyewa"] ?></td>
                    <td><?php echo $res["jam_sewa"] ?></td>
                    <td><?php echo $res["hari"] ?></td>
                    <td><?php echo $res["status"] ?></td>
                    <td>Rp. <?php echo number_format($harga_sewa) ?></td>
                    <td>Rp. <?php echo number_format($diskon * $harga_sewa) ?></td>
                    <td>Rp. <?php echo number_format($total_biaya) ?></td>
                    <td>
                        <div>
                            <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $res['id'] ?>"><i class="fa fa-edit"></i></a>
                            <a href="function.php?id=<?php echo $res['id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </div>
                        <!-- modal edit -->
                        <div class="modal fade" id="modal<?= $res['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="function.php" method="POST">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                                                    <label for="nama_penyewa">Nama Penyewa:</label>
                                                    <input type="text" name="nama_penyewa" class="form-control" value="<?php echo $res["nama_penyewa"] ?>" required><br>

                                                    <label for="jam_sewa">Jam Sewa:</label>
                                                    <input type="text" name="jam_sewa" class="form-control" value="<?php echo $res['jam_sewa'] ?>" required><br>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="hari">Hari:</label>
                                                    <input type="text" name="hari" class="form-control" value="<?php echo $res['hari'] ?>" required><br>

                                                    <label for="status">Status:</label><br>
                                                    <select name="status" class="form-control">
                                                        <option value="">Pilih Status...</option>
                                                        <option value="Biasa" <?php if($res['status'] == 'Biasa') echo 'selected'; ?> >Biasa</option>
                                                        <option value="Member" <?php if($res['status'] == 'Member') echo 'selected'; ?>>Member</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="action" value="edit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php
            }
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>