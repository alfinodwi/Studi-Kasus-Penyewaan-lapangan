<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data</title>
    <style>
        form {
            display: grid;
            padding: 1em;
            background: #f9f9f9;
            border: 1px solid #c1c1c1;
            margin: 2rem auto 0 auto;
            max-width: 600px;
            padding: 1em;
        }

        form input {
            background: #fff;
            border: 1px solid #9c9c9c;
        }

        form button {
            background: lightgrey;
            padding: 0.7em;
            width: 100%;
            border: 0;
        }

        form button:hover {
            background: gold;
        }

        label {
            padding: 0.5em 0.5em 0.5em 0;
        }

        input {
            padding: 0.7em;
            margin-bottom: 0.5rem;
        }

        input:focus {
            outline: 3px solid gold;
        }

        @media (min-width: 400px) {
            form {
                grid-template-columns: 200px 1fr;
                grid-gap: 16px;
            }

            label {
                text-align: right;
                grid-column: 1 / 2;
            }

            input,
            button {
                grid-column: 2 / 3;
            }
        }
    </style>
</head>

<body>
    <input type='button'value='<<KEMBALI<<'onClick='top.location="index.php"'>
    <center>
        <h1>Tambah Data</h1>
    </center>
    <form action="tambah_data.php" method="post">
        <label for="no">No:</label>
        <input type="text" id="no" name="no" required><br>

        <label for="nama_penyewa">Nama Penyewa:</label>
        <input type="text" id="nama_penyewa" name="nama_penyewa" required><br>

        <label for="jam_sewa">Jam Sewa:</label>
        <input type="text" id="jam_sewa" name="jam_sewa" required><br>

        <label for="hari">Hari:</label>
        <input type="text" id="hari" name="hari" required><br>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="Member">Member</option>
            <option value="Biasa">Biasa</option>
        </select>
        <br>
        <input type="submit" value="Tambah Data">
    </form>

    <?php
    require_once "koneksi.php";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $no = $_POST["no"];
        $nama_penyewa = $_POST["nama_penyewa"];
        $jam_sewa = $_POST["jam_sewa"];
        $hari = $_POST["hari"];
        $status = $_POST["status"];

        if (mysqli_query($koneksi, "INSERT INTO t_penyewaan (no, nama_penyewa, jam_sewa, hari, status) VALUES ('$no', '$nama_penyewa', '$jam_sewa', '$hari', '$status')")) {
            header("location: index.php");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        mysqli_close($koneksi);
    }
    ?>
</body>

</html>