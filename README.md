# 🛍️ BV Cheadcenter Production Setup

A complete Dockerized solution for the Laravel E-commerce platform.

---

## 🚀 Quick Setup (New Server)

Follow these steps to deploy on a fresh server.

### 1. Prerequisites

Ensure you have **Docker** and **Docker Compose** installed on your host machine.

### 2. Prepare Environment

Clone the repository and create your production `.env` file (since it is ignored by Git for security):

```bash
git clone <your-repo-url>
cd bvcheadcenter
nano .env  # Paste your production values here
```

### 3. Build & Install

Run the main installation target. This will build the Apache/PHP image, start the containers, and install composer dependencies:

```bash
make install
```

### 4. Restore Database

The database starts empty. Move your `bvcheadcenter_db.sql` to the project root and run:

```bash
make db-restore
make db-fix-slugs # Ensures all shop links are safe and working
```

---

## 🛠️ Management Commands (Makefile)

Use these commands for daily maintenance:

| Command          | Description                                                |
| :--------------- | :--------------------------------------------------------- |
| `make install`   | **Safe** - Updates code & containers without wiping data.  |
| `make db-backup` | Creates a timestamped `.sql` dump of your live data.       |
| `make db-sql`    | Opens an interactive MySQL prompt (as root).               |
| `make db-bash`   | Opens a terminal inside the Database container.            |
| `make bash`      | Opens a terminal inside the App container.                 |
| `make logs`      | Shows real-time logs from all containers.                  |
| `make down`      | Stops and removes the containers.                          |
| `make fresh`     | ⚠️ **WIPE DATA** - Deletes all databases and starts clean. |

---

## 🔗 Reverse Proxy Configuration (Apache2)

To run without port `:8080`, enable the proxy modules on your **Host** server:

```bash
sudo a2enmod proxy proxy_http
sudo systemctl restart apache2
```

Create a virtual host at `/etc/apache2/sites-available/cleartoo.site.conf`:

```apache
<VirtualHost *:80>
    ServerName cleartoo.site
    ProxyPreserveHost On
    ProxyPass / http://127.0.0.1:8080/
    ProxyPassReverse / http://127.0.0.1:8080/
</VirtualHost>
```

---

## 🕒 Automated Tasks (Cron)

To run the Laravel Scheduler inside the container, add this to your **Host's** crontab (`crontab -e`):

```bash
* * * * * docker exec cleartoo-app php artisan schedule:run >> /dev/null 2>&1
```
