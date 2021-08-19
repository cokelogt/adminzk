# adminzk
Web app for zk devices

This project was developed using html, jquery, php and postgresql.

Additional packages included:

1. Blocks Dashboard Template
2. ZKLibrary (sdk for for ZK Time & Attendance Devices)
3. SweetAlert 2 Plugin
4. Dropzone.js Plugin
5. Toastr.js Plugin
6. Charts.js

INSTALL PROCEDURE

* create a new database in postgresql and restore the content with the adminzk.backup file.

* Edit the config / datapg.php file to configure the connection to the database

        $connect = pg_connect("host='localhost' 
                               port=port_number 
                               dbname='db_name' 
                               user='your_user' 
                               password='your_pass' 
                               options='--client_encoding=UTF8'");
                               
* Loguin whith username: admin
               password: admin 
