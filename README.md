# Caching Proxy - PHP
A simple implemented API for caching request to some APIs and web applications. \
You can pass any type of request from your base url to it and it will cache the request and response using predis package. You can learn more about predis/predis [here](https://github.com/predis/predis/wiki). \

Note: This project is not complete yet and it will be done for next month. 

## Installation instruction
1. Clone the repo or download the zip file and go to the root directory of project.
2. Install all required packages (first make sure you have php and composer installed).
```bash
composer install
```
3. Create your `.env` file based on `.env.example` and add your database informations in it.
4. Run your redis server. (If you want to use docker, you can run this command in root directory of project).
```bash
sudo docker run --rm -it -v ./data:/data --name redis redis redis-server --appendonly yes
```
5. Run it in your localhost and now you can use API. You can choose whichever port you want (default 8000).
```bash
php -S localhost:<port> -t public/
```

## Usage
This project is only customized for practical usage and training projects.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.