# RoyalApps PHP Test Assignment

This is a Symfony-based PHP project created as part of the RoyalApps coding skill assessment. The project interacts with the Candidate Testing API to manage authors and books. Below are the instructions to set up and run the project.

---

## Initial Steps

1. **Install Required Dependencies:**:

   - composer require symfony/http-client
   - composer require symfony/form
   - composer require symfony/validator
   - composer require symfony/twig-bundle
   - composer require symfony/console

## Features

1. **Login Page**:
   - Authenticate using the Candidate Testing API.
   - Store the access token in the session.

2. **Authors Management**:
   - Fetch and display a list of authors.
   - Delete an author if they have no related books.

3. **Books Management**:
   - View books associated with a specific author.
   - Delete books one by one.

4. **Profile**:
   - Display the logged-in user's first and last name.
   - Logout functionality.

5. **Bonus**:
   - Symfony CLI command to add a new author.

---



## Prerequisites

- PHP 8.0 or higher.
- Composer (for dependency management).
- Symfony CLI (optional but recommended).

---

## Setup Instructions

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd royalapps-test