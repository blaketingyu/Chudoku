# Chudoku

![Preview](https://github.com/blaketingyu/chudoku-webapp-php/blob/main/chudoku.com/Home%20page.jpg)

Chudoku is a ECommerce web interface that allows users to purchase Japanese related items such as Figurines, Cards & Apparels built using vanilla PHP, HTML, CSS and JavaScript.

Some of the features include:

- Built with Vanilla PHP, HTML, CSS and JavaScript

## Product Scope

### Register Feature
- The Registering feature allows guests to become members of the website. As we have mentioned earlier, to successfully purchase an item, one has to first be a member thus, becoming a member grants more privileges. Being a guest allows you to browse through the store’s catalog only, anything more requires the guest to register and become a member.  

![Preview](https://github.com/blaketingyu/chudoku-webapp-php/blob/main/chudoku.com/images/login.png)

### Login Feature
- The login feature makes sure that the user’s session is secured and all information that the customer stored such as personal details, billing information and address book. To make sure that bots are unable to hack the website, we will also implement recaptcha and at the same time, encrypt important information such as passwords, credit card information and etc to prevent important information from being retrieved. Also, the login process will ensure that admin is directed to the admin page and the customer is directed to the customer page. Making sure that no customers can access the admin page. 

### Making Purchases
- After logging in, the customer can make a choice to make purchases by going to either the store or cart tab where they can choose which products they would like to purchase by adding it into the cart. When adding products to the cart, users can also empty the cart, removing all the products. 

- After confirming the products we want to add into our cart, we can checkout, confirming our order. Before checking out and making the transaction, the user will have to key in their credit card information, doing a check with the database. If the information entered matches the records in the database, the transaction will be successful and they should be directed to a page that indicates that the transaction is successful. 

![Preview](https://github.com/blaketingyu/chudoku-webapp-php/blob/main/chudoku.com/images/checkout.png)

### Security Features
- Our website has implemented a number of security features to help facilitate the way data can be accessed and how the website works as a whole in order to prevent attacks from hackers that wish to access the website’s database through other means possible. By doing so, we have also ensured the user’s confidentiality by making the data within the database difficult to access without proper verification. This will in turn also improve the integrity of the data within the database as well as the availability of the information.The security features implemented can be seen below.

- Regular Expression to prevent XSS scripting

- Data encryption to ensure that sensitive information in the database is kept confidential

- Session Management helps to prevent attackers from attacking other pages without going through the harsh security at the main login page

- Recaptcha to prevent the page from spam attacks from a bot

- Preventing SQL Injection via Regular Expression and sql_escape_string() which removes any special characters from the user input to make sure a SQL statement is not able to go through



