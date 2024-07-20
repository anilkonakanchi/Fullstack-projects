<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if ($booking_id <= 0) {
    echo 'Invalid booking ID.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Payment Method</title>
    <style>
        /* Add your styling here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .payment-container {
            width: 100%;
            max-width: 600px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        
        h2 {
            color: #4A148C;
            margin-bottom: 20px;
        }
        
        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        button {
            width: 48%;
            padding: 12px;
            background-color: #E91E63;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            margin: 5px;
        }
        
        button:hover {
            background-color: #D81B60;
        }
    </style>
    <script>
        function confirmPayment(bookingId, method) {
            if (confirm('Do you want to proceed with payment?')) {
                // Construct URL based on method
                window.location.href = method + '_payment.php?booking_id=' + bookingId;
            }
        }
    </script>
    <script>
    function confirmPayment(bookingId, method) {
        if (confirm('Do you want to proceed with payment?')) {
            if (method === 'card') {
                window.location.href = 'card_payment.php?booking_id=' + bookingId;
            } else {
                window.location.href = method + '_payment.php?booking_id=' + bookingId;
            }
        }
    }
</script>
</head>

<body>
    <div class="payment-container">
        <h2>Select Payment Method</h2>
        <div class="button-group">
            <button onclick="confirmPayment(<?php echo $booking_id; ?>, 'upi')">UPI Payment</button>
            <button onclick="confirmPayment(<?php echo $booking_id; ?>, 'card')">Debit/Credit Card</button>
        </div>
    </div>
</body>

</html>
