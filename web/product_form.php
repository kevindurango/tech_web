<!-- HTML Form -->
<form action="create_product.php" method="post" enctype="multipart/form-data">
    <label for="name">Product Name:</label>
    <input type="text" name="name" required><br>

    <label for="category">Category:</label>
    <input type="text" name="category" required placeholder="e.g. Electronics, Home Appliances"><br>

    <label for="sku">SKU:</label>
    <input type="text" name="sku" required><br>

    <label for="short_description">Short Description:</label>
    <textarea name="short_description" required></textarea><br>

    <label for="price">Price:</label>
    <input type="text" name="price" required><br>

    <label for="discounted_price">Discounted Price:</label>
    <input type="text" name="discounted_price" required><br>

    <label for="original_price">Original Price:</label>
    <input type="text" name="original_price" required><br>

    <label for="discount">Discount (%):</label>
    <input type="number" name="discount" min="0" max="100" required><br>

    <label for="rating">Average Rating:</label>
    <input type="number" name="rating" min="0" max="5" step="0.1" required><br>

    <label for="review_count">Number of Reviews:</label>
    <input type="number" name="review_count" min="0" required><br>

    <label for="storage_options">Storage Options (comma separated):</label>
    <input type="text" name="storage_options" placeholder="e.g. 128 GB, 256 GB" required><br>

    <label for="color_options">Color Options (comma separated):</label>
    <input type="text" name="color_options" placeholder="e.g. Red, Blue, Green" required><br>

    <label for="special_offer">Special Offer:</label>
    <textarea name="special_offer" placeholder="e.g. Get a free accessory with purchase"></textarea><br>

    <label for="bank_offer">Bank Offer:</label>
    <textarea name="bank_offer" placeholder="e.g. 5% cashback on credit card"></textarea><br>

    <label for="membership_offer">Membership Offer:</label>
    <textarea name="membership_offer" placeholder="e.g. Prime members get extra 10% off"></textarea><br>

    <label for="featured">Feature Product:</label>
    <input type="checkbox" name="featured"><br>

    <label for="image">Product Image:</label>
    <input type="file" name="image" accept="image/*"><br>

    <input type="submit" value="Add Product">
</form>
