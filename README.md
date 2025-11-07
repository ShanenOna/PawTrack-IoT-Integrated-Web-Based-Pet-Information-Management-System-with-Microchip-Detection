---
# HOW TO INSTALL
---
1. Install the latest XAMPP software.
2. After setting up the XAMPP software,
   go to C:/xampp/htdocs
3. Extract and paste this folder to C:/xampp/htdocs
4. Open XAMPP, start APACHE and MYSQL
5. click the "Admin" on the MYSQL field, it will
   redirect you to PHPMYADMIN
6. On PHPMYADMIN, find the "Import" on the top 
   navigation bar
7. Choose the "pawtrack.sql" as the file then click    "Import" button on the very bottom of the page.
8. After importing the database data, open VSCode
9. Open the "pawtrack" folder on VSCode from C:/xampp/ htdocs
10. Press F5 to start the program.

---
# HOW TO FIX
---
# Database Related Error
1. After starting the web application, check the login functionalities
2. If the login returns an alert stating unable to connect to network, this might be related to database error.
3. First, check if the Xampp APACHE and MYSQL are open
4. If step 3 is done and it is still not working, go to PHPMYADMIN
5. click the house icon on the upper-left.
6. After clicking, it will redirect you to a new page. Check the Database Server information and look for these:
6.a Server (something like 127.0.0.1)
6.b User (something like root@localhost)
7. Use those information and edit the db.php
7.a For the host, it is something like 127.0.0.1
7.b For the username, it is "root"
7.c For the password, usually it is just "" (an empty string)

# VSCode Running Issue
1. If the error is inside the VSCode, such as unable to run .php extension files. You just need to click on extension (The blocks like logo)
2. Search PHP, and install the PHP extension
Optional:
3. You can also install code runner and PHP Extension Pack