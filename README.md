## Price Monitor Service

### Project description

The Price Monitor is a Laravel 12-based web service allowing users to subscribe to OLX listing price changes by submitting a URL and email, accessible via an HTTP method without requiring login or authentication. 
New users are registered and subscribed instantly but remain unverified until email confirmation. Price monitoring and email notifications are processed only for verified users. 
The dashboard and subscription management available for verified authenticated users.

### Price Update 
Scheduled HOURLY or Run Manually
   ```bash
      ./vendor/bin/sail artisan subscriptions:process
   ```

**Notice: All initial listing prices have been increased by 100 UAH for testing purposes.**

### Supported sources
 - OLX.ua listing page

### HTTP method to subscribe    
   **POST** http://127.0.0.1:8001/api/subscription

   Creates a subscription to track price changes for an OLX listing.

   Parameters:  
   email — User’s email address to receive price update notifications.  
   url — URL of the OLX listing to monitor.

### Steps to Run the Service

1. **Clone the project**
   ```bash
   git clone https://github.com/kapver/price-monitor.git
   ```

2. **Navigate to the project directory**
   ```bash
   cd price-monitor && cp .env.example .env
   ```

3. **Install dependencies and start the service**
   ```bash
   docker compose up
   ```
   or
   ```bash
   ./vendor/bin/sail up
   ```

4. **Preview the application**  
   Open your browser and navigate to:  
   [http://127.0.0.1:8001](http://127.0.0.1:8001)


5. **Subscribe Page**
   For unauthorized users
   [http://127.0.0.1:8001/subscribe](http://127.0.0.1:8001/subscribe)
   ![Settings Screenshot](public/images/subscribe-landing.png)


6. **Manage Subscriptions**  
   You can configure your preferred weather conditions and notification settings by navigating to:  
   [http://127.0.0.1:8001/subscriptions](http://127.0.0.1:8001/subscriptions)
   ![Settings Screenshot](public/images/subscriptions.png)

7. **Check Emails Sent with Mailpit**  
   You can view any emails sent by the service by navigating to:  
   [http://localhost:8025/](http://localhost:8025/)


8. **Test User Account:**  
    Default password for new subscription flow users is "password"


### Service flowchart diagram

![Settings Screenshot](public/images/diagram.png)

---

Tested on **macOS 15.3.2**