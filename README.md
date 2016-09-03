# phpDashboard <br> <p>For testing purposes, you can find example of this project in http://sdl-profile.com</p>
phpDashboard is project built into pure object oriented php. Before everything, I need to mention one note. Front-end part of applicaton is written in Serbian language because it will be used for Serbian market. Completelly back-end part and code comments are written in English. Everything that you need to do if you plan to use this application is to change html text into files and set up your database settings.
The idea of creating phpDashboard is to build unique place where companies can open public account and get personal website with a lot of editing options. That means dashboard is something like network. Appart from the mentioned, every network member has more interesting and usefull tools available inside into Admin panel.<br><br>
Dashboard is PHP project which involve 3 important parts.
<b>The first part</b> consists front-end pages where visitors can find companies and dashboard users can register and login into profile. <b>The Second part</b> is Admin area. When user register and login into account, dashboard will appear. <b>The third part</b> is Master Admin part. Master Admin part serve for managing with a network. There you can find all info about users. Also, you can block (deactivate) or allow (activate) approach to the network for some users. <br><br>
<b>Admin area</b> involve two important parts. First part is related with editing website display and the second admin part represents dashboard functionality. <br><br>
<b><i>Display Options</i></b>
<ol>
  <li> <i>User can create own website, in a similar way like profile in facebook, </i></li>
  <li> <i>User has available five pages for editing, </i></li>
  <li> <i>User can insert own images and files</i></li>
  <li> <i>User can change font color, background color, font size, font type for each page and each page part in a really simple way, </i> </li>
  <li> <i>User can change background image and show/hide some page part, </i></li>
  <li> <i>All options for editing page are available ON RIGHT CLICK on page part where user want to execute one or more options, </i></li>
  <li> <i>Comments are included into front-end part of this application. </i></li>
</ol>
<br>
<b><i>Dashboard options -involve 7 submenus:</i></b><br>
<ol>
  <li>Basic Info - user can insert and update information about own account and manage with specific functionalitites,</li>
  <li>Graphic display about all important aspects of account,</li>
  <li>Managing with inserted images and files,</li>
  <li>Managing with comments - block, approve or delete,</li>
  <li>Managing with messages - delete, answer,</li>
  <li>Calendar events functionality - create schedule,</li>
  <li>Phonebook - insert contacts manually or update contact from other users in network</li>
</ol>
<b>Database and SQL</b><br>
You can find SQL file inside root of this application. There are defined all relations, foreign keys and indexes for this project. Take note that you need update database information and path. You can do it into two files: <b>admin/inc/classes/connection.php</b> and <b>admin/inc/init.php</b><br>
When you insert SQL file into your database, user with role "master_admin" will be inserted automatically. That is account of the Major Admin. When you login (username: admin and pasword: admin123) you will see the third part of phpDashboard - master admin panel. You can change username or password for master admin only into database. Note: you need to use md5 to hash password. All new registred users will have role "admin".
