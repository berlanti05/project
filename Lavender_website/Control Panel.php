
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Control Panel - Chocolate Shop</title>
    <link rel="stylesheet" href="Control Panel.css">
</head>
<body>

<h1>Control Panel - Chocolate Shop 💜</h1>

<!-- ======================== -->
<!-- Products Section -->
<!-- ======================== -->
<h2>Products</h2>
<a href="add_product.php" class="button">Add New Product</a>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Image</th>
        <th>Description</th><th>Flavor</th><th>Type</th><th>Actions</th>
    </tr>
    <?php while($p = $products->fetch_assoc()): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['name'] ?></td>
        <td><?= $p['price'] ?> $</td>
        <td><img src="<?= $p['img'] ?>" width="50"></td>
        

        <!-- to string-->

        <td><?= substr($p['description'],0,30).'...' ?></td>
        <td><?= $p['flavor'] ?></td>
        <td><?= $p['type'] ?></td>
        <td>
            <a href="edit_product.php?id=<?= $p['id'] ?>" class="button edit">Edit</a>
            <a href="delete_product.php?id=<?= $p['id'] ?>" class="button delete">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- ======================== -->
<!-- Orders Section -->
<!-- ======================== -->
<h2>Orders</h2>
<table>
    <tr>
        <th>Order ID</th>
        <th>User Name</th>
        <th>Total Price</th>
        <th>Payment Status</th>
        <th>Order Status</th>
        <th>Actions</th>
    </tr>
    <?php while($o = $orders->fetch_assoc()): ?>
    <tr>
        <td><?= $o['order_id'] ?></td>
        <td><?= $o['user_name'] ?></td>
        <td><?= $o['total_price'] ?> $</td>
        <td><?= $o['payment_status'] ?></td>
        <td>


            <!-- Dropdown to change order status -->



            <!--to store the order number within the dropdown list-->
            <select class="status-dropdown" data-order-id="<?= $o['order_id'] ?>">
                <option value="Pending"   <?= $o['order_status']=='Pending'?'selected':'' ?>>Pending</option>
                <option value="Completed" <?= $o['order_status']=='Completed'?'selected':'' ?>>Completed</option>
                <option value="Shipped"   <?= $o['order_status']=='Shipped'?'selected':'' ?>>Shipped</option>
            </select>
            <span class="status-msg"></span>


        </td>
        <td>
            <form action="view_order.php" method="get" style="display:inline;">
                <input type="hidden" name="id" value="<?= $o['order_id'] ?>">
                <button type="submit" class="button view">View</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>


      <a href="http://localhost/mywebsite">  <img src="logo1.jpeg" alt="Lavender Sweet Logo" class="footer-logo"><a/>
</body>
</html>