Please answer the following questions in a markdown file called Answers to technical questions.md.

1\. How long did you spend on the code challenge? What would you add to your solution if you had more time? If you didn\'t spend much time on the code challenge then use this as an opportunity to explain what you would add.

**I spent 14 hours to work on the challenge. I wasn't able to perform an automated testing since I don't have any experience with PHP unit or other testing framework. **

**Nice to have features:**

**- Use angular web client -- I do some know with AngularJS but never used the framework for the past year and I had second thoughts on completing the challenge over the weekend using the doing the framework **

**- Give users the ability to update the starters/substitute for each team**

**- Additional criteria in creating teams -- application will generate the roster based on those criteria**

**- Add reference data/parameters to assign attribute scores for each player**

**- Starter recommendation to users - solution will identify the which starter will complement each other based attribute scores**

2\. What was the most useful feature that was added to the latest version of a language you used? Please include a snippet of code that shows how you\'ve used it.

**Here are some useful features that were added to PHP **

-   **Null coalescing -- dealing with null values is considers as one major pain points in system development. Adding the update will reduce the lines of code needed to check null values**

    **i.e. \$var = \$varx ?? \$vary; **

**Without using an if else statement, developer can now set \$var to \$varx if \$varx is not null. Otherwise, \$var will be set to \$vary; **

**- Return type declaration -- this is useful since the you'll instantly know what's the return type of a PHP function without using a good editor or running the code to determine the return type**

**i.e function add(\$a,\$b) :int { return \$a + b;}**

3\. How would you track down a performance issue in production? Have you ever had to do this?

**There are several factors that impacts performance in production. I always check the network traffic, application and database server statistics and even the disk/storage information. I also review the list of changes/deployments prior to the performance issue to isolate the root cause of the problem. I also get additional information from the end users to get an idea if the issue a application wide or if it only affects some functionalities of the application. My rule of thumb is to check each item from list and rule out those factors one by one to get to the root cause. I have doing these types of activities for the past 7 years, work with end users, DBA's, network engineers and even 3^rd^ party application developers to try to get the actual root cause and resolve the issue.**

4\. Please describe yourself using JSON.

**I have been using JSON extensively for the past 2 years. I updated on of our client's reporting site to store JSON data to their database to make backend more scalable without affecting the application's performance. After re-engineering the code and the backend to use JSON the reporting application helps the client to change the report display and add additional fields/data points to their report without updating the code and database schema. **

**I'm currently working on a FileMaker company which extensively use JSON to integrate FileMaker and PHP. I have worked on several projects that creates data warehouse objects from JSON. I build and consumed API using JSON as a medium to exchange data. **
