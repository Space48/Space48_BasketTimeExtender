Space48_BasketTimeExtender
=====================

Description
-----------
Persistent basket for guest users.
The module allows non logged in users to have their basket restored during the time specified in the cookie life; this allows the basket to be restored beyond the time of the session cookie. The difference between this and the persistent cart, is that for this module the user does not have to log in. When the user does login the cart contents will be automatically merged with any previous cart cart contents they have.

Requirements
------------
- PHP >= 5.2.0
- Mage_Core


Compatibility
-------------
- Magento >= 1.4

Installation Instructions
-------------------------

To install this module add the app folder to the web root. 
To activate the module log into the admin and go to System > Configuration > Space 48 > Basket Time Extender -> Settings.
Set Enabled to Yes and enter the cookie life in seconds.


Uninstallation
--------------



Copyright
---------
(c) 2015 Space48
