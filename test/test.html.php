<?php require __DIR__."/../vendor/autoload.php";


use LuhnAlgo\Card;
use LuhnAlgo\Test\Test;

$test_directory = __DIR__.'/testdata/';
$test = new Test($test_directory);
$card = new Card();
$result = $test->execute($card);?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Testing Luhn Algorithm">
    <meta name="author" content="stoufa">
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->

    <title>Testing Luhn Algorithm</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="mt-3">
        <h1>Testing Luhn Algorithm</h1>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Issuing Network</th>
              <th scope="col">Card Number</th>
              <th scope="col">Is Valid Card Number</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($result as $card):?>
            <tr >
              <th scope="row"><?php echo $card['cardName']?></th>
              <td><?php echo $card['cardNumber']?></td>
              <td><?php echo ($card['isValidNumber']    ? 'yes' : 'No')?></td>
              <td class="table-<?php echo ($card['status'] == 'Success'? 'success' : 'danger' )?>"><?php echo $card['status']?></td>
            </tr>
           <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--<script>window.jQuery || document.write('<script src="../../js/jquery-slim.min.js"><\/script>')</script>-->
    <!-- <script src="../../../../assets/js/vendor/popper.min.js"></script> -->
	<script src="bootstrap/js/bootstrap.min.js"></script> 
  </body>
</html>
