Take screenshot of a whole website
(the website requries a xml sitemap)

Install selenium2 server
http://selenium.googlecode.com/files/selenium-server-standalone-2.30.0.jar

make a bash file named selenium2 and put into /usr/bin and make it executeable

the selenium2 file should contain

    java -jar /path/to/selenium-server-standalone-2.14.0.jar

Then install PHPUnit_Selenium with the following code

    pear install phpunit/PHPUnit_Selenium

make sure the following commands can be run

    selenium2
    phpunit _BASE.php (will generate error, but just to see if its runable)

Now you can run the run.sh on the following ways

    run.sh

Or

    run.sh http://www.google.com/sitemap.xml

Now it will begin to take screenshots of all pages in sitemap.xml, the screenshots will be located in the screenshots folder