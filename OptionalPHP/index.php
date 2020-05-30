<!DOCTYPE html>
<!-- Mohammad Aris Saputra
     18051204041
     TI2018 B-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP_CRUD</title>
    <script src="js/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once 'proses.php'; ?>

    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <form action="proses.php" method="post">
                <input type="hidden" name="id" value = "<?php echo $id; ?>">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" placeholder="Masukkan nama anda">
                </div>

                <div class="form-group">
                    <label>Asal Kota</label>
                    <input type="text" name="asal_kota" class="form-control" value="<?php echo $asal_kota; ?>" placeholder="Masukkan asal kota anda">
                </div>
                
                <div class="form-group">
                <?php if ($update == true): ?>
                    <button type="sumbit" class="btn btn-info" name="update">Update</button>
                
                <?php else: ?>
                    <button type="sumbit" class="btn btn-primary" name="simpan">Simpan</button>
                <?php endif; ?>
                </div>
            </form>
        </div>

        <?php 
            $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
            //pre_r($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Asal Kota</th>
                        <th colspan="2">Tindakan</th>
                    </tr>
                </thead>

                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['asal_kota']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-info">Edit</a>
                            <a href="proses.php?hapus=<?php echo $row['id']; ?>"
                                class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php  
            function pre_r($array){
                echo '<pre>';
                print_r($array);
                echo'</pre>';
            }
        ?>
    </div>
</body>
</html>