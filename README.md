# UniPortfolio

## 🛠 Installation Steps

### **1. Clone the Repository**
   ```sh
   git clone https://github.com/Jiulio7Costa/uniPortfolio.git
   cd "Uni Project/portfolio"
```
   
### **2. Install PHP Dependencies**
```sh
composer install
```

### **3. Copy and Configure the Environment File**
```sh
cp .env.example .env
php artisan key:generate
```

### **4. Set Your Stripe API Key**
Open the .env file and replace the value of STRIPE_KEY:
```sh
STRIPE_KEY="your_actual_stripe_key_here"
```

### **5. Set Up the Database**
```sh
php artisan migrate
php artisan db:seed
php artisan db:seed --class=AdminSeeder
```

### **6. Install Node Modules and Compile Assets**
```sh
npm install
npm run dev
```

### **7. Start the Laravel Development Server**
```sh
php artisan serve
```

### **🔐 Admin Access**
Register a new user via the frontend.

Open your database and go to the users table.

Locate your user and set the isAdmin field to 1.

Refresh the app—admin features will now be visible.

### ✅ Test Cases
Here are sample test cases to guide functionality checking:

### **🛍️ User-side Functional Tests**

### **1. Add to Cart from Home Page**
Action: Hover over a preferred product.

Click: Blue cart icon.

Then: Click the black cart icon in the top-right.

Expected Result: Cart page opens with the selected item.

### **2. Adjust Cart Quantities**
Action: In the cart, increase or decrease product quantity.

Expected Result: Subtotal updates accordingly.

### **3. Remove Product from Cart**
Action: Click the remove in the cart page next to quantity modifications.

Expected Result: Product is removed and the cart updates.

### **4. Checkout Process**
Action: Fill in the address fields (only needed for the first checkout).

Click: "Checkout" button.

Expected Result: In the dashboard order transactions details updates.

### **5. View Product Details**
Action: Hover over a product and click the eye icon.

Expected Result: Redirect to the product detail page.

Click: Use image slider arrows to view multiple images.

Click: Add to cart and proceed to checkout as above.

### **🧑‍💼 Admin Dashboard Tests**

### **1. Add Product**
Action: In the admin panel, go to the "Products" page.

Click: "Add Product" button.

Fill Form: Enter product details and submit.

Expected Result: Success alert appears, product added to list.

### **2. Edit Product**
Action: In prodcut page, in the list of products go to the right corner where 3 dots appear,click the 3 dots and click the "Edit" button .

Update: Change product details and save.

Expected Result: Success message; product list updates with new info.

### **3. Delete Product**
Action: In prodcut page, in the list of products go to the right corner where 3 dots appear,click the 3 dots and click the "Delete" icon.

Expected Result: Confirmation alert; product is removed from list.

