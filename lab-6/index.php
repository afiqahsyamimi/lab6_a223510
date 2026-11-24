<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Guestbook</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body text-center">
                <h1>My Guestbook</h1>

                <p>
                    Date: <?=  date("d-m-Y"); ?>
                </p>

                <p>
                    Time: <?= date("h:i:s A") ?>
                </p>

                <a href="form.php" class="btn btn-primary">Add</a>
                <a href="list.php" class="btn btn-success">List</a>
            </div>
        </div>
    </div>