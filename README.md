School Service
This is a Laravel project that provides a RESTful API for managing school data, such as students, teachers, courses, grades, and attendance. The project uses the Laravel Passport package for authentication and authorization, and the Laravel Excel package for importing and exporting data in Excel format.
Installation
You can install this project by following these steps:
●	Clone the repository from GitHub:
git clone https://github.com/akshyaraait/school-service.git

●	Install the dependencies using Composer:
cd school-service
composer install
●	Copy the .env.example file to .env and fill in the database and mail credentials:
cp .env.example .env
●	Generate the application key and the encryption keys for Passport:
php artisan key:generate
php artisan passport:keys
●	Run the database migrations and seeders:
php artisan migrate --seed
●	Create a symbolic link for the storage folder:
php artisan storage:link
●	Start the local development server:
php artisan serve

## Installation via Composer

You can also install this project using Composer from Packagist. To do that, you can use the following command:

```bash
composer require akshyaraait/school-service

Usage
To use the API, you need to register a user account and obtain an access token. You can use the following endpoints for authentication:
●	POST /api/register: Register a new user with the following parameters: name, email, password, and password_confirmation.
●	POST /api/login: Login with an existing user account with the following parameters: email and password. You will receive an access token in the response.
●	POST /api/logout: Logout from the current user account and revoke the access token. You need to send the Authorization header with the value Bearer {token}.
You can use the following endpoints for managing school data:
●	GET /api/students: Get a list of all students. You can use the q parameter to search by name, email, or phone number. You can also use the sort parameter to sort by any column, and the page and per_page parameters to paginate the results. You need to send the Authorization header with the value Bearer {token}.
●	GET /api/students/{id}: Get a single student by id. You need to send the Authorization header with the value Bearer {token}.
●	POST /api/students: Create a new student with the following parameters: name, email, phone, gender, dob, address, photo, and course_id. You need to send the Authorization header with the value Bearer {token} and the Content-Type header with the value multipart/form-data.
●	PUT /api/students/{id}: Update an existing student by id with the following parameters: name, email, phone, gender, dob, address, photo, and course_id. You need to send the Authorization header with the value Bearer {token} and the Content-Type header with the value multipart/form-data.
●	DELETE /api/students/{id}: Delete an existing student by id. You need to send the Authorization header with the value Bearer {token}.
The other endpoints for teachers, courses, grades, and attendance follow the same pattern as the students endpoint. You can check the routes file (routes/api.php) for more details.
You can also use the following endpoints for importing and exporting data in Excel format:
●	POST /api/import/students: Import students data from an Excel file with the following columns: name, email, phone, gender, dob, address, and course_id. You need to send the Authorization header with the value Bearer {token} and the Content-Type header with the value multipart/form-data. You also need to send the file parameter with the Excel file.
●	GET /api/export/students: Export students data to an Excel file. You need to send the Authorization header with the value Bearer {token}. You will receive a download link in the response.
The other endpoints for importing and exporting teachers, courses, grades, and attendance follow the same pattern as the students endpoint. You can check the routes file (routes/api.php) for more details.
Testing
You can run the tests for this project using the following command:
php artisan test
License
This project is licensed under the MIT License. See the LICENSE file for details.
I hope this helps you with your project. 😊.
Source(s)
1. Service to School
2. Service in Schools - New York City Public Schools
3. An Overview of Public School Services
4. School Service - Purchase school forms
5. About ISS | International Schools Services

![image](https://github.com/akshyaraait/school-service/assets/155069657/c8b3153d-112b-4029-b023-6bf427c0dac3)
