<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Document</title>
</head>
<body>
    <?php
  include_once"user-main-dashboard.php";

  ?>
    <form>
        <fieldset class="paymentfield">
            <h1 class="h1pay">Confirm Your Payment</h1>
            <br>
            <br>
            <div>
                <label>Vehicle Type:</label>
                <input type="text" name="name">
                <br>
                <br>
                <label>Vehicle Id:</label>
                <input type="text" name="name">
                <br>
                <br>
                <label>Total price:</label>
                <input type="text" name="name">
                <br>
                <br>
                <h2>Select Payment Option</h2>
                <label>
                    <input type="radio" name="payment" value="cash-on-delivery" onclick="disableOnlinePayment()"> Cash on delivery
                </label>
                <label>
                    <input type="radio" name="payment" value="online-payment" onclick="enableOnlinePayment()"> Online
                </label>
                <br>
                <br>
                <div id="online-payment-method" style="display: none;">
                    <button><a href="https://www.esewa.com.np" target="_blank">Pay with eSewa</a></button>
                    <button><a href="https://www.khalti.com" target="_blank">Pay with Khalti</a></button>
                </div>
                <br>
            </div>
            <button>Submit</button>
        </fieldset>
    </form>

    <script>
        function disableOnlinePayment() {
            document.getElementById('online-payment-method').style.display = 'none';
        }

        function enableOnlinePayment() {
            document.getElementById('online-payment-method').style.display = 'block';
        }
    </script>
</body>
</html>