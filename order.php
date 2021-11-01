<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
                   <a class="navbar-brand" href="index.php">Bookstore</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <li><a href="books.php">&nbsp; Books</a></li>
              <li><a href="#">&nbsp; Contact</a></li>
              <li><a href="#">&nbsp; Cart</a></li>
            </ul>
        </div>
      </div>
    </nav>
    <?php
    session_start();
    $count = 0;
    // connecto database
    require("mysqli_connect.php");
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $country = $_POST['country'];
    $query = "INSERT INTO customers VALUES 
			('null', '" . $fname . "', '" . $lname . "' , '" . $address . "', '" . $city . "', '" . $zip_code . "', '" . $country . "')";

		$result = mysqli_query($dbc, $query);
		if(!$result){
			echo "insert false !" . mysqli_error($dbc);
			exit;
		}
        $customerid = mysqli_insert_id($dbc);
        $total_price = $_SESSION['total_price'];
        $date = date("Y-m-d H:i:s");
        $query1 = "INSERT INTO orders VALUES 
		('null', '" . $customerid . "', '" . $total_price . "', '" . $date . "', '" . $fname . "', '" . $address . "', '" . $city . "', '" . $zip_code . "', '" . $country . "')";
		$result1 = mysqli_query($dbc, $query1);
		if(!$result1){
			echo "Insert orders failed " . mysqli_error($dbc);
			exit;
		}

        $isbn = $_SESSION['isbn'];
        $bookprice = $_SESSION['book_price'] ;
        $qty = $_SESSION['qty'];
        $query2 = "INSERT INTO order_items VALUES 
		('null', '$isbn', '$bookprice', '$qty')";
		$result2 = mysqli_query($dbc, $query2);
		if(!$result2){
			echo "Insert value false!" . mysqli_error($dbc);
			exit;
		}

        $query3 = "select book_qty from books where book_isbn = '".$isbn."' ";
        $result3 = mysqli_query($dbc, $query3);
        $row = mysqli_fetch_array($result3);
        
        $quantity = $row['book_qty'] - $qty;
        $query4 = "update books set book_qty = '".$quantity."' where book_isbn = '".$isbn."'";
        $result4 = mysqli_query($dbc, $query4);
        
        echo "Thank you for your order";
    ?>