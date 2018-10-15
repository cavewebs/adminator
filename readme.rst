###################
What is Adminator
###################

A simple codeigniter3 application that allows management of users and thier group subscriptions

*******************
API Usage
*******************

Can be accessed by visiting base_url()/api
Available endpoints

 all_users: method: GET
   List all users
    
    ##returns false if not found
     user_details: method: GET
    Parameter: id

    returns the user details. Id is the id of the user

    ##Returns  true on success
     new_user: method: POST
    Parameters: name, gender
    Name (varchar lenght 255) gender = (char lenght 10)
    
    ##delete user from group
    ##will return true on success
    remove_user: method: GET
    Parameter: id
    id = id returned from user_groups

    

    ##delete user from db
    ##Returns True on success
    delete_user: method: GET 
    Parameter: id
    id = user id


    ##delete group from db
    delete_group: method: GET 
    Parameter: id
    id = group id

    ##Adds user to user_groups table
    add_user: method: POST 
    Parameters: uid, gid
    uid = user id
    gid = group id

        
    ## Get all GROUPS
    ##returns false if no groups
      all_groups: method: GET
        

    ##Add new Group
      new_group: method: POST
      Parameters: g_name, g_about
      g_name = Name of group (varchar lenght 255)
      g_about = Basic info abt group (text)
      

    ##View users  in a group  
        view_user_groups: method: GET 
        Parameter: id
        id = Group Id


    ## Returns success on successful login
     login: method: POST 
     Parameters, email, password


**************************
Test Admin Login Details
**************************

User/email: admin@adminator.com
Password: ttsmuj
*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Clone the repo
Create/Migrate DB file adminator.sql
Open Congif/database.php and change to your server config 
*******
License
*******
