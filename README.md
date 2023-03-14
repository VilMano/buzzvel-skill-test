# Buzzvel code challenge
The challenge was developed in Laravel with the help of endroid/qrcode dependency.

## This code example is extremely simple:
- The welcome page presents a form where the user inputs their data:
	- [If the user doesn't exist] This data is stored in a database in case it should be used for later management;
	- [If the user exists] The user will be fetched from the database;
- After the data is inserted a QrCode is generated, saved inside the **public** folder and then fetched to be displayed on the same page with a link that redirects the user to their personal page.
---
I have created two **models**:
- User 
- QrCodeGenerator 
The **User** model was created so we could have access to a permanent page instead of using new data every time, therefore increasing the performance of the server.

The **QrCodeGenerator** model was made with the purpose of re-utilizing code dynamically.

