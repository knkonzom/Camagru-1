## Camagru Documentation ##

Camagru is the first Web Project at WeThinkCode. It is an image editing and sharing platform similar to Instagram.

# The requirements for the project:
* HTML, CSS
* PHP
* MAMP/XAMPP
* MySQL
  
# To begin:

Download project source code from repository:
Use Git to clone repository to desktop.

Download MAMP/XAMPP from the Bitnami page.
Once downloaded, install software.
Begin servers in the app interface if servers aren't running.
Copy cloned Camagru repository to the apache2\htdocs folder, which is located in the installation path of MAMP/XAMPP.

Open browser and go to URL http://localhost/Camagru
The website should be up and running.

To check that the site is running well, navigate to phpMyAdmin folder http://localhost/phpmyadmin. Once logged into the management system, go to databases and verify the creation of a Camagru database.
File Structure & Code Breakdown

# Database Management Systems (DBMS):
* MySQL
* phpMyAdmin

Server:
* PHP

Client:
* HTML & CSS
* JavaScript

# File Structure:

    config:
    * activate.inc.php
    * database.php
    * login.inc.php
    * logout.inc.php
    * setup.php
    * signup.php

    uploads/default:
    * image.png
    * sticker2.png
    * sticker3.png

    includes:
    * comment.inc.php
    * commentlike.inc.php
    * gallery-upload.inc.php
    * Get_photo_id.php
    * imagelike.inc.php
    * likes.inc.php
    * public_id.inc.php
    * reset-password.inc.php
    * send_resetlink.inc.php


   root folder files:

    * author
    * create-new-password.php
    * delete.php
    * footer.php
    * function.php
    * gallery.php
    * guest-account.php
    * header.php
    * HomePage.php
    * index.php
    * pagination.php
    * Profilepage.php
    * public.php
    * README.md
    * resetpassword.php
    * savecam.php
    * signup.php
    * style.css
    * text.php
    * update.php
    * webcam.php


# Running Camagru

# Start Web Server:
* Launch MAMP/XAMPP, start all servers.
* Open browser & navigate to http://localhost/Camagru. You will find the landing page.
Create, verify and login to account:
* Enter your credentials here, wait for verification email once complete. Once received verification email, click on the link and verify your account. Once verified, navigate to Login page.
Upload, capture & edit images:
* Once logged in, you should be able to access the editor page where you will be able to either capture an image using the webcam or upload an image from the desktop.
* Once an image is captured you are then able to add stickers to it and preview the image before saving it. You are also able to add stickers to an image you upload yourself.
* In the gallery you can view your images or the images of other users. You can remove your images in your personal gallery if you wish to do so, under the profile section.
* In the gallery you can also like and comment other users' images. This is only reserved for someone who is registered.
Change user credentials:
	* In the profile menu, users are able to modify their name, email address and passwords.
Compatibility:
	* App is compatible with Firefox & Chrome.
Administration:
	* Admin users can access the backend of the site by visiting http://localhost/phpmyadmin. There, users can enter the security credentials to gain access to the databases. Users are able to view all the databases, and in the Camagru database users will be able to see all active accounts on the site. The password is encrypted for security.
