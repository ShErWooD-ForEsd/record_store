    1.In your own words, explain what require_login() does in index.php. When does it run, and what does it enforce?

    - require-login() makes it that the only way a user can shop for records or insert records if they have registered as an offical user in the database. When it runs, it enforces the login, redirecting everytime to the login page.


    2. Describe the login process step-by-step: from clicking the “Login” button on the form to the moment the user is redirected. Which file and which case handles the logic? What session variables are set after a successful login?

    -The user either clicks on the login in page, or they have been redirected to the page. Once they put in their username and password, clicking login, their information is checked for accuracy in the database. If they didn't put in anything before clicking login, an error will prompt them for the correct information. Login-form.php as a partial displays the page, but the login will be handled by index.php switch case 'login'. The switch case goes into a loop to determine if the login was accurate or inaccurate. If accurate, a session starts and the user goes to the view list. If not accurate, the loops prompts for the correct information and remains on the login page.
    
    
    3. When you click “Add to Cart,” what exactly gets stored in $_SESSION['cart']? Which action adds items to the cart, and what type of data is being stored?

    -The record_id is what is stored with the cart when you "add to cart".
    
    
    4. On the cart page, you use $records_in_cart. Where does that variable come from, and why do we need records_by_ids() instead of just using the raw IDs in the session?
    
    
    5. Explain what happens when you click “Complete Purchase.” Which action in index.php runs, what loop is executed, which function writes each record to the database, and which table is updated?
