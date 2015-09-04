<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Domain Availability Tool</title>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        .table thead .tld {
            width: 150px;
            text-align: center;
        }

        .table td.result {
            text-align: center;
        }

        .table td span.expires {
            display: block;
            font-size: 0.8em;
        }

        .table .glyphicon-ok {
            color: green;
        }

        .table .glyphicon-remove {
            color: red;
        }

        .table .glyphicon-warning-sign {
            color: orange;
        }
    </style>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                <th>Domain</th>
                <?php foreach($cols as $col) echo '<th class="tld">.' . $col . "</th>"; ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach($rows as $row) echo $row . "\n"; ?>
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </body>
</html>
