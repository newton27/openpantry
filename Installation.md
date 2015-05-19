# Install Instructions #

The following is a tutorial on installing the latest version of the open source food pantry software solution to manage clients, inventory, bagging, and reporting.


## Installing XAMPP ##

XAMPP is an easy to install Apache distribution containing MySQL, PHP and Perl. XAMPP is really very easy to install and to use - just download, extract and start. XAMPP has versions available for Windows, Mac OS X, and Linux.

Download Here: [Official XAMPP Webpage](http://www.apachefriends.org/en/xampp.html)

## Get the latest Open Pantry software ##

Download the latest OpenPantry software from the repository by using an SVN client such as [Tortoise SVN](http://tortoisesvn.tigris.org/)

Checkout the repo at http://openpantry.googlecode.com/svn/trunk/ into c:\xampp\htdocs\pantry

## Importing OpenPantry Database ##

**First run xampp-control.exe from c:\xampp\ and Start Apache and MYSQL.**

**Navigate to http://localhost/phpmyadmin and create a new database called 'pantry'**

**Select the 'pantry' database, click the Import tab, and browse and select the pantry.sql file.**

## Logging Into Open Pantry ##

Now that everything is installed simply make sure that Apache and MySQL is running in the XAMPP Control Panel (c:\xampp\xampp-control.exe)

Now navigate to http://localhost/pantry in Mozilla Firefox and login.

Note:
You may have to execute this SQL Query on the DB in order to create the admin user with username=root and password=root

`insert into user values('', 'root', '65ed971264288c2945c3db534fe55659', 'hZ/J9dr4iNpybGoXnlTeU/JHZc5hyjI/', 'Pantry', 'Admin', 'email@domain.com','1073741824');`