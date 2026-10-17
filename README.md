# Vehicle API

**Partners: Espiritu, Ferdinand,   Ruar, Avie Clier**
**Section: IT2E**
**Resource:** Vehicle (make, model, color, year, price)

## Setup

1. Clone the project and enter the folder:

   git clone [your-repo-url]
   cd vehicle-api

2. Install dependencies:

   composer install

3. Create the environment file and app key:

   copy .env.example .env
   php artisan key:generate

4. Create the SQLite database file:

   type nul > database\database.sqlite

5. Create the tables:

   php artisan migrate

6. Start the server:

   php artisan serve

   The API runs at `http://127.0.0.1:8000/api`.

## Routes

| Verb | Path | What it does | Token needed? |
|------|------|--------------|---------------|
| POST | /api/register | Create an account and return a token | No |
| POST | /api/login | Log in and return a token | No |
| POST | /api/logout | Revoke the current token | Yes |
| GET | /api/me | Show the logged-in user | Yes |
| GET | /api/vehicles | List vehicles (filter with `?make=` `?color=` `?year=`) | Yes |
| POST | /api/vehicles | Create a vehicle | Yes |
| GET | /api/vehicles/{vehicle} | Show one vehicle | Yes |
| PUT | /api/vehicles/{vehicle} | Update a vehicle | Yes |
| DELETE | /api/vehicles/{vehicle} | Delete a vehicle | Yes |

## Screenshots

### 1. Register (201)
![Register](1ScreenShots/1%20Register.png)

### 2. Login (200)
![Login](1ScreenShots/2%20Login.png)

### 3. List without token (401)
![List without token](1ScreenShots/3%20List%20no%20Token.png)

### 4. List with token (200)
![List with token](1ScreenShots/4%20List%20with%20Token.png)

### 5. Create vehicle (201)
![Create vehicle](1ScreenShots/5%20Create%20Vehicle.png)

### 6. Create with missing field (422)
![Create invalid](1ScreenShots/6%20Missing%20Field.png)

### 7. Show one vehicle (200)
![Show one](1ScreenShots/7%20Show%20One.png)

### 8. Show missing vehicle (404)
![Show missing](1ScreenShots/8%20Show%20Missing.png)

### 9. Update vehicle (200)
![Update](1ScreenShots/9%20Update.png)

### 10. Delete vehicle (204)
![Delete](1ScreenShots/10%20Delete.png)

## Why does DELETE return 204 and not 200?

The DELETE request will ask the server to remove the vehicle. Once it's removed, there is nothing left to send back, so the server replies with 204, which means No Content. A 200 response normally carries a body, like the vehicls data, but the deleted vehicle no longer exhist. The 204 status alone tells the client that the request worked and the emty body keeps the response short and clear.