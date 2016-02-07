# Fibonacci
The following following code generates and displays Fibonacci numbers. To find more information about Fibonacci numbers go to: https://en.wikipedia.org/wiki/Fibonacci_number

## Setting up the project
The project has been build within a Vagrant box which will make it installation easy. It will be required to download and install Virtualbox(https://www.virtualbox.org/wiki/Downloads) and Vagrant(https://www.vagrantup.com/downloads.html)

In order to spin up the Vagrant machine run:
```
vagrant up --provision
```
The first time this command is run it will take a while since it has to download all the required pacakges. Following times it will take less time.

Now less download all the composer packages required. From the folder of the project run:
```
vagrant ssh
```
This command will ssh you into the virtual machine. Go to
```
cd /var/www/app/
```
And then run the composer install command:
```
php composer.phar install
```
Once it is finished, you will be able to go to on your browser: http://alex-vm-host/

It should not show any value as the DB is empty.

## Generating some fibonacci numbers
The following script will generate 30 fibonacci numbers. To do that, ssh into the VM and go to the folder of the project. Once there run:
```
php src/Acme/fibonacciGenerator.php
```

## Tests suite
The project comes with a number of tests which will assure the integrity of the code. In order to run this suite. SSH into te VM and go to the folder of the project(/var/www/app/). The tests used are done in phpSpec. Run them with the following command:
```
bin/phpspec run
```
You should get a green bar :D

## About the application
### DB Layer
It has been used the adapter pattern in order to decopuple the DB used from the APP. The application comes with two different DB Layers by default
1. Redis (Default one)
2. File system

The file system isn't efficent but it has been added in order to prove the benefit of using the Adaptor pattern. If you want to see the app running using the File system go to the class App and within the start method uncomment out the following line:
```
//Uncomment the next line out for using the file system as DB
// self::$_db = new FileSystemDB();
```
### Output
Again, to make the output of the appication the easiet possible the App class allows to print all the fibonaci numbers. It is required to specify which kind of printable we want to use:
1. HTML
2. Plain text

Both implement the Printable interface. By doing this the app looses the control of how the output should be parsed since it's not the main purporse of it.

### Exceptions
It has been generated a few custom Exceptions. Right now they don't add too much extra suggar to the system but in order to escalate the application they are required to be able to catch the exception you're looking for rather than catch for the generic Exception. This approach also avoid the bad practise of return either null,-1 or false as a result of an error during a method. Based on OOP you should tell the object do this and if it can't be done, it show complain by throwing an exception rather than return a abstract value which can be miss understood

### Other
In general I have tried to make every single method easy as well as descriptive enough of what it does rather than having to add comments which lead to problem on the future.

I have used TDD approach for generating almost the whole application.

Apart of this. I could add more sugar to the frontend to load the table in batches using JAVA and by that method reduce the load generated. I didn't eventually do it because I thought that was out of the scope.

## Redis
Redis is installed by default with the Vagrant VM. In order to see the values stored on it, you need to ssh and run:
```
redis-cli
keys *
```

For more information about redis commands, go to: http://redis.io/commands




