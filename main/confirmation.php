
<?php  
session_start();  
include '../web/db_connection.php';  
include '../classes/Cart.php'; // Include the Cart class  
  
// Redirect to login if not authenticated  
if (!isset($_SESSION['user_id'])) {  
   header("Location: login.php");  
   exit;  
}  
  
$userId = $_SESSION['user_id']; // Get the logged-in user ID  
  
// Create Cart object  
$cart = new Cart($conn, $userId);  
  
// Fetch cart items for the user  
$cartItems = $cart->getCartItems();  
  
// Calculate the totals for the cart  
$checkoutDetails = $cart->calculateTotals($cartItems);  
  
// Fetch checkout info and payment details  
$checkoutInfo = $cart->getCheckoutInfo();  
$paymentDetails = $cart->getPaymentDetails();  
  
// Clear the cart after confirmation  
$cart->clearCart();  
  
// Function to format the card number to show only the last 4 digits  
function formatCardNumber($cardNumber) {  
   return '**** **** **** ' . substr($cardNumber, -4);  
}  
?>  
  
<!DOCTYPE html>  
<html lang="en">  
<head>  
   <meta charset="UTF-8">  
   <meta name="viewport" content="width=device-width, initial-scale=1.0">  
   <title>Order Confirmation</title>  
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">  
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">  
   <link rel="stylesheet" href="/tech_web/styles/cart.css">  
   <script>  
      // Function to trigger the print dialog  
      function printPage() {  
        window.print();  
      }  
   </script>  
</head>  
<body>  
  
<?php include 'header.php'; ?>  
  
<main class="container my-5">  
   <div class="confirmation-container">  
      <div class="text-center mb-4">  
        <h2>Thank you for your order!</h2>  
        <p class="lead">Your order has been successfully processed.</p>  
      </div>  
  
      <!-- Order Summary -->  
      <section class="order-summary mb-4 p-4 border rounded shadow-sm">  
        <h5 class="mb-3">Order Summary</h5>  
        <div class="row">  
           <div class="col-md-6">  
              <p><strong>Subtotal:</strong> $<?= number_format($checkoutDetails['subtotal'], 2) ?></p>  
              <p><strong>Taxes:</strong> $<?= number_format($checkoutDetails['taxes'], 2) ?></p>  
           </div>  
           <div class="col-md-6">  
              <div class="total-box mt-3">  
                <p class="h5"><strong>Total:</strong> $<?= number_format($checkoutDetails['total'], 2) ?></p>  
              </div>  
           </div>  
        </div>  
      </section>  
  
      <!-- Cart Items -->  
      <section class="cart-items mb-4 p-4 border rounded shadow-sm">  
        <h5 class="mb-3">Items Purchased</h5>  
        <table class="table table-striped">  
           <thead>  
              <tr>  
                <th>Product Name</th>  
                <th>Quantity</th>  
                <th>Price</th>  
                <th>Total</th>  
              </tr>  
           </thead>  
           <tbody>  
              <?php foreach ($cartItems as $item): ?>  
                <tr>  
                   <td><?= htmlspecialchars($item['name']) ?></td>  
                   <td><?= $item['quantity'] ?></td>  
                   <td>$<?= number_format($item['price'], 2) ?></td>  
                   <td>$<?= number_format($item['total'], 2) ?></td>  
                </tr>  
              <?php endforeach; ?>  
           </tbody>  
        </table>  
      </section>  
  
      <!-- Payment Summary -->  
      <section class="payment-summary mb-4 p-4 border rounded shadow-sm">  
        <h5 class="mb-3">Payment Information</h5>  
        <div class="row">  
           <div class="col-md-6">  
              <p><strong>Card Type:</strong> <?= htmlspecialchars($paymentDetails['card_type']) ?></p>  
              <p><strong>Card Number:</strong> <?= formatCardNumber($paymentDetails['card_number']) ?></p>  
           </div>  
           <div class="col-md-6">  
              <p><strong>Expiration Date:</strong> <?= htmlspecialchars($paymentDetails['expiration_date']) ?></p>  
           </div>  
        </div>  
      </section>  
  
      <!-- Action Buttons -->  
      <div class="button-container d-flex justify-content-between">  
        <a href="category_page.php" class="btn btn-danger">Continue Shopping</a>  
        <button class="btn btn-danger" onclick="printPage()">Print Confirmation</button>  
      </div>  
  
   </div>  
</main>  
  
<?php include 'footer.php'; ?>  
  
</body>  
</html>