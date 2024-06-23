<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Khodam Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffcc33, #ff6699, #33ccff);
            background-size: 300% 300%;
            animation: gradient 10s ease infinite;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            margin-top: 50px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .result {
            margin-top: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #ff6699;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 1.2em;
        }

        .btn-primary:hover {
            background-color: #ffcc33;
        }

        footer {
            text-align: center;
            padding: 10px;
            /* background-color: rgba(255, 255, 255, 0.9); */
            border-top: 1px solid #ddd;
            color: #333;
        }

        .text-transparent {
            color: rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h1 class="mb-4" style="font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Cek Khodam Online</h1>
        <form method="POST" action="index.php" class="text-center">
            <div class="mb-3">
                <label for="name" class="form-label">Masukkan Nama Anda</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Cek Khodam</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'config.php';
            $name = $_POST['name'];
            $result = $conn->query("SELECT khodam FROM khodam ORDER BY RAND() LIMIT 1");

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $khodam = $row['khodam'];

                // Simpan nama user dan khodam ke tabel users
                $stmt = $conn->prepare("INSERT INTO users (name, khodam) VALUES (?, ?)");
                $stmt->bind_param("ss", $name, $khodam);
                $stmt->execute();

                echo "<div class='result text-center'><h2>Hmm, nama anda <strong>$name</strong></h2><p>Khodam anda berupa: <strong>$khodam</strong></p></div>";
            } else {
                echo "<div class='result text-center'><p>Khodam tidak ditemukan.</p></div>";
            }

            $conn->close();
        }
        ?>
    </div>
    <footer>
        <p>Dibuat hanya untuk hiburan, <span class="text-transparent">@kholiqqqqq</span>❤️</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>