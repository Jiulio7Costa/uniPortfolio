# UniPortfolio

## 🛠 Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Jiulio7Costa/uniPortfolio.git
   cd "Uni Project/portfolio"
Install PHP Dependencies

bash
Copy
Edit
composer install
Copy and Configure the Environment File

bash
Copy
Edit
cp .env.example .env
php artisan key:generate
Set Your Stripe API Key

Open the .env file and replace the value of STRIPE_KEY:

env
Copy
Edit
STRIPE_KEY="your_actual_stripe_key_here"
Set Up the Database

bash
Copy
Edit
php artisan migrate
php artisan db:seed
php artisan db:seed --class=AdminSeeder
Install Node Modules and Compile Assets

bash
Copy
Edit
npm install
npm run dev
Start the Laravel Development Server

bash
Copy
Edit
php artisan serve
🔐 Admin Access
Register a new user via the frontend.

Open your database and go to the users table.

Locate your user and set the isAdmin field to 1.

Refresh the app—admin features will now be visible.

✅ Test Cases
Here are sample test cases to guide functionality checking:

🛍️ User-side Functional Tests
1. Add to Cart from Home Page
Action: Hover over a preferred product.

Click: Blue cart icon.

Then: Click the black cart icon in the top-right.

Expected Result: Cart page opens with the selected item.

2. Adjust Cart Quantities
Action: In the cart, increase or decrease product quantity.

Expected Result: Subtotal updates accordingly.

3. Remove Product from Cart
Action: Click the remove (X) button.

Expected Result: Product is removed and the cart updates.

4. Checkout Process
Action: Fill in the address fields (only needed for the first checkout).

Click: "Checkout" button.

Expected Result: Order confirmation screen appears.

5. View Product Details
Action: Hover over a product and click the eye icon.

Expected Result: Redirect to the product detail page.

Click: Use image slider arrows to view multiple images.

Click: Add to cart and proceed to checkout as above.

🧑‍💼 Admin Dashboard Tests
1. Add Product
Action: In the admin panel, go to the "Products" page.

Click: "Add Product" button.

Fill Form: Enter product details and submit.

Expected Result: Success alert appears, product added to list.

2. Edit Product
Action: Click the "Edit" button next to a product.

Update: Change product details and save.

Expected Result: Success message; product list updates with new info.

3. Delete Product
Action: Click the "Delete" icon.

Expected Result: Confirmation alert; product is removed from list.

