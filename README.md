**Requirements:**
- Docker installed



**Before building docker project:**  
- Go to .docker folder and open docker-compose.yml with any text editor  
`Edit MYSQL_ROOT_PASSWORD=<set DB password here>`  
`Edit bellcom.backend: -> ports: 7000:80 to <preffered port>:80`  
`Edit bellcom.pma: -> ports: 7010:80 to <preffered port>:80`
- Go to root directory and copy .env.example => .env
- Open .env with any text editor 
`Edit DB_PASSWORD=<set DB password here same as in docker-compose.yml>`
- Put XML Files for parse in <root>/storage/app/public/xml folder.

**Building docker project**
- Open CMD (if using windows)
- Go to <project_root>/.docker folder
- Run `docker-compose up -d`
- Wait until build will be completed

**After docker project has been built:**
- Open docker and enter to bellcom.backend container  
`Or run command from project root folder: docker exec -it bellcom.backend sh`
- Execute commands:  
`php artisan migrate`  
`php artisan db:seed`

**Link to XML Parser**
- Replace 7000 port in provided link if you changed it before in docker-compose.yml
`http://localhost:7000/xml/view`
