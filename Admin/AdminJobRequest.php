<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws and Tails | Get a Dog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://kit.fontawesome.com/2c558ff8c9.js" crossorigin="anonymous"></script>

    <style>
        .wrap {
            display: grid;
            grid-template-columns: repeat(2, 2fr);
            column-gap: 20%;
            row-gap: 20px;
            /* grid-auto-rows: minmax(100, auto); */
        }
    </style>
</head>

<body>
    <i class="bi bi-x text-secondary pt-2" style="font-size:40px; cursor:pointer; float: right; text-shadow:none;" onclick="history.go(-1);"></i>
    <h3 class="card-header p-4">Job Requests</h3>
    <?php
    session_start();
    if (!empty($_SESSION['admin'])) {
        $reqsql = "select * from `job_req` order by jreq_id DESC ";
        include('../DataBase/connection.php');
        $result = mysqli_query($conn, $reqsql);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {


    ?>
            <div class="wrap container-md">
                <?php

                while ($row = mysqli_fetch_assoc($result)) {

                    $type = $row['type'];
                    $image = !empty($row['photo']) ? "../assets/requests/" . $row['type'] . "/" . $row['photo'] : "https://via.placeholder.com/50.png/09f/666";
                ?>
                    <div class="card mb-3" style="width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="row g-0 m-3">
                                    <img src="<?php echo $image; ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="row g-0 m-4">
                                    <a class="btn btn-success" href='<?php echo 'AdminAcceptProfessional.php?id=' . $row['jreq_id'] . '&type=' . $type ?>'>Accept</a>
                                    <a class="btn btn-danger" href='<?php echo 'AdminRejectProfessional.php?id=' . $row['jreq_id'] ?>' onclick="return confirm('Are you sure you want to reject this request?')" ;>Reject</a>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Name: <?php echo $row['name'] ?></h5>
                                    <p class="card-text">Age: <?php echo $row['age'] ?></p>
                                    <p class="card-text">Experience: <?php echo $row['experience'] ?></p>
                                    <p class="card-text">Gender: <?php echo $row['gender'] ?></p>
                                    <p class="card-text">Fee: <?php echo $row['fees'] ?></p>
                                    <p class="card-text">Profession: <?php echo $row['type'] ?></p>
                                    <p class="card-text">Description: <?php echo $row['description'] ?></p>
                                    <p class="card-text"><small class="text-muted">posted by: <?php echo $row['postedby'] . ' , ' . $row['postedemail'] ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php
                }
                ?>
            </div>
    <?php
        }
    }
    ?>
</body>

</html>