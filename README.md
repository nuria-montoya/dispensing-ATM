dispensing-ATM
==============

Backend Developer Test ATM Simulation

- The Simulator works from UNIX systems such as Linux or Mac
- The Simulator, when it can, should get the amount in notes of $50.
- This simulation will not require any authentication or PIN to access the ATM.
- The Simulator is to be focused on keeping track of the current cash of the ATM, and dispensing only the notes available. It is not focused on the customer's balance.
- It doesn't have View Layer. It just has an UI Tester file that can be run from the command line.
- There is a .sh file to run the application in sequential way

How to build and run my application

There are two ways, always from the command line:
1 - With php command
$ cd your-path/dispensing-ATM 
$ php index.php arg1 arg2 arg3
Where:
arg1 = the amount of $20 notes that you want to insert on the simulator
arg2 = the amount of $50 notes that you want to insert on the simulator
arg3 = the amount of money that the customer wants to withdraw

2 - With sh script (you could add new commands with other arguments)
$ cd your-path/dispensing-ATM 
-> $ sh exec-ATM.sh //from Mac command line 
-> $ ./exec-ATM.sh //from Linux
