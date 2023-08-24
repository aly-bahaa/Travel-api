# Travel-API

This is an API for a travelling agency. The requirements are taken from a real job description on a freelancing website. 
The full job description is available here  [Here](https://docs.google.com/document/d/1IqsnOB6sjoSEcgmjqHPhb58Ym-82x5jKDDxvTWeQsL0/edit#heading=h.mljj16q3s3zm)  .
## ENDPOINTS
 * A private (admin) endpoint to create new users. If you want, this could also be an artisan command, as you like. It will mainly be used to generate users for this exercise;
 * A private (admin) endpoint to create new travels;
 * A private (admin) endpoint to create new tours for a travel;
 * A private (editor) endpoint to update a travel;
 * A public (no auth) endpoint to get a list of paginated travels. It must return only public travels;
 * A public (no auth) endpoint to get a list of paginated tours by the travel slug (e.g. all the tours of the travel foo-bar). Users can filter (search) the results by priceFrom, priceTo, dateFrom (from that startingDate) and dateTo (until that startingDate). User can sort the list by price asc and desc. They will always be sorted, after every additional user-provided filter, by startingDate asc.

## Getting Started

Follow these steps to set up the project and see the demonstration:

### Prerequisites

- Composer
- PHP
- Laravel

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/aly-bahaa/Travel-api.git
2. Navigate to the project directory:
   ```bash
     cd travel-api
3. Run 
    ```bash
      composer install
4. Run 
    ```bash
      php artisan serve
## Usage

1. Open your preferred API client (e.g., Postman).
2. Make a `GET` request to the `/travels` route (e.g., `http://localhost:8000/api/send`).
3. You should get a response with the available travels
4. You can also navigate to the documentation from the browser
5. Open your favorite browser and navigate to `http://localhost:8000/docs`
