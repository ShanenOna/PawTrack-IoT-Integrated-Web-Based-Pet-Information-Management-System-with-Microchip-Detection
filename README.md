
# PawTrack — IoT-Integrated Web-Based Pet Information Management System

This repository contains PawTrack, a web-based pet information management system integrated with microchip detection. The application is built with PHP for the backend, MySQL for data storage, and HTML/CSS/JavaScript for the frontend. It is intended to run on a local XAMPP stack and can receive data from an IoT microchip reader (for example an Arduino/ESP-based reader that posts microchip scans to the server).

---

## Quick Overview / About
PawTrack stores pet profiles, microchip scan events, and user accounts. It supports three user roles (detailed below) and is designed for small shelters, clinics, or pet registries. The repository includes a SQL dump (pawtrack.sql) to create the required database schema.

---

## System architecture (high level)
- Presentation layer: HTML/CSS/JavaScript (client-side pages, forms, dashboards).
- Application layer: PHP scripts (business logic, authentication, form handling, IoT post endpoints).
- Data layer: MySQL (database for users, pets, microchip records, logs).
- IoT integration: Microchip reader devices can POST scan payloads (microchip ID) to a designated PHP endpoint which validates and stores the scan in the database and optionally notifies relevant users.
- Deployment target: Local development with XAMPP (Apache + MySQL + PHP). The same architecture can be deployed to any LAMP hosting environment with the required PHP/MySQL support.

Security notes:
- Use secure credentials and avoid running production systems with default XAMPP credentials.
- Sanitize and validate all incoming IoT and web inputs.
- For production, serve over HTTPS and harden PHP/MySQL configuration.

---

## Dependencies
Minimum suggestions for local development:
- XAMPP (includes Apache, MySQL/MariaDB, PHP) — tested with common recent XAMPP releases
- PHP with mysqli (or PDO) extension enabled
- MySQL / MariaDB (access via phpMyAdmin in XAMPP)
- A modern browser for the frontend
Optional (for convenience):
- VS Code (or your preferred editor)
- PHP extension for VS Code, Code Runner (optional)

If your environment uses different versions of PHP or MySQL, ensure compatibility with procedural mysqli or PDO usage in the codebase.

---

## HOW TO INSTALL
1. Install the latest XAMPP software.
2. After setting up the XAMPP software, go to C:/xampp/htdocs
3. Extract and paste this folder to C:/xampp/htdocs (ensure the folder is named `pawtrack` or update URLs accordingly)
4. Open XAMPP, start APACHE and MYSQL
5. Click the "Admin" on the MYSQL field — it will redirect you to phpMyAdmin
6. On phpMyAdmin, find the "Import" on the top navigation bar
7. Choose the `pawtrack.sql` file as the file then click the "Import" button at the bottom of the page
8. After importing the database data, open VS Code
9. Open the `pawtrack` folder on VS Code from C:/xampp/htdocs
10. Press F5 to start the program (or load the application in your browser via http://localhost/pawtrack)

Important configuration step:
- Open `db.php` (or the database connection file in the project) and set the host, username, password, and database name to match your local setup. Typical defaults on XAMPP:
  - host: 127.0.0.1 or localhost
  - username: root
  - password: (empty string) ""
  - database: pawtrack (or whatever the SQL import created)

File/folder permissions:
- Ensure any upload directories (e.g., for pet photos) are writable by the webserver (on Windows typically not an issue; on Linux set proper ownership and permissions).

---

## HOW TO FIX

### Database Related Error
1. After starting the web application, check the login functionalities.
2. If the login returns an alert stating "unable to connect to network", this might be related to a database error.
3. First, check if the XAMPP APACHE and MYSQL are running.
4. If step 3 is done and it is still not working, go to phpMyAdmin.
5. Click the house icon on the upper-left.
6. After clicking, it will redirect you to a new page. Check the Database Server information and look for these:
   - Server (something like 127.0.0.1)
   - User (something like root@localhost)
7. Use those information and edit `db.php`:
   - For the host, use 127.0.0.1 or localhost
   - For the username, use `root` (or the user shown in phpMyAdmin)
   - For the password, usually it is just `""` (an empty string) on default XAMPP
8. Save `db.php` and reload the application.

Additional troubleshooting:
- Verify the database name imported is the same name referenced in `db.php`.
- Check phpMyAdmin to ensure the tables from `pawtrack.sql` are present.
- Enable PHP error reporting in development to surface connection errors: in PHP config or at the top of scripts set error_reporting(E_ALL); ini_set('display_errors', 1);

### VSCode Running Issue
1. If VSCode cannot run .php extension files, open the Extensions view (the square blocks icon).
2. Search "PHP" and install the official PHP language support extension or a popular alternative.
Optional:
3. Install Code Runner and PHP Extension Pack to add run/debug conveniences.
4. You can also run the app directly in a browser at http://localhost/pawtrack if you prefer not to run from VS Code.

---

## Configuration tips
- To change the application base URL or database credentials, edit the configuration file (commonly `db.php` or a central config file).
- If you add IoT devices, set the device endpoints and shared keys (if used) in the server code that handles incoming microchip scan POSTs.
- For production deployments, replace default XAMPP credentials, disable phpMyAdmin remote access, and enable HTTPS.

---

## User roles implemented
PawTrack implements three primary user roles with different access levels:

1. Administrator
   - Full access to the system and all modules.
   - Can manage users and roles.

2. Veterinarian
   - Can create and update pet profiles.
   - Can view microchip scan events and link scans to pet profiles.
   - Can perform day-to-day operations (check-in/out, status updates).

3. Pet Owner
   - Can view and update their own pet profile(s).
   - Can view microchip registration details and receive notifications if their pet is matched by a microchip scan.
   - Limited access — cannot access system-wide settings or other users' data.

---

## IoT integration notes
- Typical workflow: microchip reader detects a microchip and sends an HTTP POST to a server endpoint (e.g., /iot/scan.php) with the chip ID and optional metadata. The endpoint validates the payload, looks up the pet, and records the scan.
- Ensure the endpoint is accessible from your IoT device network. For local testing, you may need to run the device and server on the same LAN or use tools like ngrok to expose a local endpoint for remote devices.

---

## Maintenance & Next steps
- Review and secure all database credentials before deploying beyond development.
- Add logging for incoming IoT events and user actions.
- Consider adding automated backups for the MySQL database.
- If you plan to deploy publicly, migrate to a proper LAMP server with HTTPS, enforce strong passwords, and consider role-based access control improvements.
