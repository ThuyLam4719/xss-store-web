# introduction
- This is a simulation social networking website, similar to Facebook, used to simulate the XSS-stored vulnerability.
- This website allows users to comment on posts without requiring moderation, and directly adds their comments to the database. Taking advantage of this vulnerability, the attacker posts a malicious script that redirects users to their own page. This script is then saved directly to the database, triggering a mass attack and causing the official website to crash.
# installation
Before you begin, ensure you have installed **XAMPP** (supporting PHP 8.x)
### Step 1: 
- Clone this repository
- Move the project folder to your XAMPP `htdocs` directory:
   - Default path: `C:\xampp\htdocs\your-project-folder`
### Step 2: Database setup
- Open **XAMPP Control Panel**.
- Click **Start** for both **Apache** and **MySQL**.
- Go to **phpMyAdmin** in your browser: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Create a new database
- Click on the **Import** tab --> Choose the `.sql` file provided in this project --> Go to execute the SQL command
### Step 4: run the project
- Navigate the following URL on your browser: http://localhost/project-folder
  <img width="1914" height="1025" alt="image" src="https://github.com/user-attachments/assets/0a7cb501-229b-4478-a8b7-f81a02e08350" />
## Default Credentials (for demo)
username: mike | max | dustin | lucas | el
password: 12121212

## Demo
- Use the script in **_script.txt_** to comment, then log out and return to the login page.
- When you log in again, the website will automatically redirect to a fake login page.
  <img width="1915" height="1022" alt="image" src="https://github.com/user-attachments/assets/956bd691-70a5-4443-bce7-7aedb13fc4aa" />
- Input username/passwd again and open another page in your browser: http://localhost/thucung/stolen.php to see the stolen data. 
<img width="471" height="208" alt="image" src="https://github.com/user-attachments/assets/746a4f1a-44e0-4dd4-be3b-688985e00c76" />
