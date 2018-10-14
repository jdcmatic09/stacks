Installing

Copy files included in the site folder to the machine's virtual host site directory

Run the mytest.sql file in MySQL. This will create a database schema and tables for the application. Script will also create the database username and password used by the application

Update resources.db.params.host parameter in located in application -\> config -\> application.ini if the MySQL server is not hosted locally

Install Zend framework (1.12) if framework is not yet installed

-   Windows <http://www.zend.com/en/company/community/framework/downloads#Windows>

-   Mac

    <http://www.zend.com/en/company/community/framework/downloads#Mac%20OS>

-   Linux

    <http://www.zend.com/en/company/community/framework/downloads#Linux>

Make sure to add the Zend Framework library directory to your PHP \`include\_path\`

Mod rewrite/URL rewrite should be enabled in web server for the application to execute all its functions

Instructions

Team List page

-   Add Row button -- this will add a new html row in the team table for data entry. Note that you can add row at a time. User needs to finish the team data entry and click trigger the Add Team button

-   Add Team -- button will trigger an AJAX request to push the data to the database. This process will notify the user if the request failed or completed successfully

-   Edit icon/button -- Name field in the team table is editable. User can edit the specified record and should click the Edit icon located on that row to push the update to the backend

-   Delete icon button -- Each row has a delete button. This will send a request to the backend to delete the team record

-   Roster icon -- this will navigate the user to the Roster page. The next page will display the list of player bots for the selected team

Roster List Page

-   \<\< Teams -- This is a hyperlink to navigate the user back to the Team list page

-   User will be able to update the following fields in the UI

    -   First Name

    -   Last Name

    -   Rating

-   Edit icon for each row will trigger the application to push the updates to the backend. This process will notify the user if the request failed or completed
