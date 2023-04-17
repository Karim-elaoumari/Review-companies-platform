# Review-companies-platform(charika)
Review-companies-palatform:
  
<h6> Charika is a platform where job searchers can find reviews about thear interested companies to join, they can find reviews, suggestions, and they can also make reviews , view comments and make comments on reviews of people to ask them question related to this company, this review platform enable transparency and give full info about companies and their quality</h6>

<h3>User Stories:</h3>
<ul>
  <li> As a visitor I can see the home page and view some reviews about companies</li>
  <li> As a user I can register in order to have an account on the platform</li>
  <li> As a user I  have to verify my Email before login to the platform </li>
  <li> As a user I can log in to see all the reviews about Companies </li>
  <li> As a user I can search by company name,filter by category,location,or the most having good reviews</li>
  <li> As a user I can view reviews  about a company </li>
  <li> As a user I can comment on reviews</li>
  <li> As a user I can edit my account </li>
  <li> As a user I can delete my account </li>
  <li> As a user I can logout </li>
  <li> As a user I can reset my password </li>
  <li> As a user I can follow a company to have notifications </li>
  <li> As a manager i can login</li>
  <li> As a manager i can logout</li>
  <li> As a manager i can add companies edit delete</li>
  <li> As a manager i can view and delete reviews of my companies</li>
  <li> As an admin i can have the same roles of manager</li>
  <li> As an admin i can add manager,edit,delete</li>
</ul>

<h3>Technologies:</h3>
<ul>
  <li> Html Css Bootstrap</li>
  <li> javascript vue js</li>
  <li> mysql php laravel Rest api jwt</li>
</ul>
<h3>Outils of Dev:</h3>
<ul>
  <li> Xampp   : database</li>
  <li> Postman : test api </li>
  <li> Figma   : prototype => you will find the prototype folder in this repo <a href=""> Click here</a></li>
  <li> Chrome  : lunch website</li>
</ul>
<h3>Outils of Planification:</h3>
<ul>
  <li> Jira   : planification of the project link public <a href="https://karimelaoumari.atlassian.net/jira/software/projects/CP/boards/6">click here </a>it can be an error in access will be fixed soon</li>
</ul>
<h3>Conception:</h3>
<ul>
  <li> Diagramms.net UML   : <a href="https://drive.google.com/file/d/1qgAIeORy4EC5D6TUzFE_Lbt2eXvxpo7u/view?usp=sharing"> click here</a></li>
</ul>
<h3>project structure:</h3>
<h5>Laravel Backend Repo : <a href="https://github.com/Karim-elaoumari/Review-companies-platform.git">https://github.com/Karim-elaoumari/Review-companies-platform.git</a></h5>
<h5>Vue js frontend Repo : <a href="https://github.com/Karim-elaoumari/charika_platform.git">https://github.com/Karim-elaoumari/charika_platform.git</a></h5>
this separation is due to hosting method i what to implement using  Heroku CLI and it's more safe to separate backend with frontend.


<h3>Steps to clone the project and Lunch it:</h3>
<ul>
  <li> 1) clone the backend and frontend Repo</li>
  <li> 2) Aceess the laravel Repo lunck the Terminal and run this commands:
     <li> - composer install <li>
     <li> - npm install <li>
     <li> - cp .env.example .env <li>
     <li> - php artisan key:generate <li>
     <li> - php artisan jwt:secret <li>
     <li> - php artisan migrate   create the database <li>
     <li> - php artisan db:seed to create a testing data <li>
     <li> - php artisan serve  to run the server   in the http://localhost:8000<li>
  </li>
   <li> 3) Aceess the Vue js  Repo lunck the Terminal and run this commands:
     <li> - npm install <li>
     <li> - npm run dev        to run the server  in the http://localhost:3000 <li>
   </li>
  <li>  now you can Explore the Platform</li>
</ul> 
Note that the Platform Still on the Dev Mode mybe Errors be there !






