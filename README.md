# BRACU Event Management System

A web-based university event management project developed using **HTML, CSS, JavaScript, PHP, and MySQL**. It provides separate interfaces for event organizers, university authorities, and general users to help coordinate event submissions, approvals, and discovery.

> **Project status:** Academic/demo project. This repository documents the supplied source files; additional login pages, database setup, and security improvements may be required for a fully working deployment.

## Project overview

The system is designed to organize university events through an approval workflow:

1. An **Organizer** submits an event's name, organizer, date, and time.
2. The request is stored in MySQL with a **Pending** status.
3. An **Authority** reviews pending requests and **approves** or **rejects** them.
4. Approved events become visible to **Basic Users**, and are displayed on a calendar.

The approval logic limits approvals to **two events per date**.

## Key features

### Organizer
- Submit event requests containing event name, organizer, date, and time.
- View submitted event records and their approval status.
- View approved events in a dedicated table.
- Navigate through an organizer dashboard.

### Authority
- View pending event submissions.
- Approve or reject requests using dashboard actions.
- Enforce a maximum of **two approved events per calendar date**.
- View a report-style table of event requests and statuses.
- Browse a monthly calendar populated with approved event details.

### Basic User
- Discover approved university events presented as cards.
- See each approved event's name, date, and time.

### General
- Separate dashboard interfaces for three user roles.
- Responsive page elements, cards, tables, and calendar interactions.
- PHP/MySQL backend and JSON endpoints for frontend updates.

## Tech stack

| Layer | Technologies |
| --- | --- |
| Frontend | HTML5, CSS3, JavaScript |
| Backend | PHP (MySQLi) |
| Database | MySQL |
| Local development | XAMPP, MAMP, or an equivalent PHP/MySQL setup |
| UI resources | Font Awesome CDN; external fonts and images on some pages |

## Project files

```text
BRACU-Event-Management-System/
├── homepage_dashboard.html
├── authority_dashboard.html
├── authority_approve_events.html
├── authority_approve_events.php
├── authority_view_reports.php
├── organizer_dashboard.html
├── event_submisson_form.html
├── submit_event.php
├── view_event_status.php
├── view_approved_events.php
├── basic_user_dashboard.html
├── get_events.php
├── get_approved_events.php
├── db_connection.php
├── generate_hash_password.php
└── README.md
```

**Important:** The filename `event_submisson_form.html` is spelled this way in the source code. Keep the spelling consistent with existing links, or rename it and update all references.

The supplied pages also link to login files under `authority_login/`, `organizer_login/`, and `Basic_user/`. Those files were **not included** in the reviewed upload; add them if available or update the navigation links.

## Getting started

### 1. Requirements
- PHP with the `mysqli` extension
- MySQL or MariaDB
- A local web server (for example, XAMPP or MAMP)
- A modern browser

### 2. Add the project to the web server

For XAMPP, place the project folder inside `htdocs`. For MAMP, use the configured document root (commonly `htdocs`).

### 3. Create the database

In phpMyAdmin or your MySQL client, create the database and the event requests table. This is a **minimal schema inferred from the supplied PHP queries**, not an original database export:

```sql
CREATE DATABASE IF NOT EXISTS Uni_Event_Management_System;
USE Uni_Event_Management_System;

CREATE TABLE IF NOT EXISTS event_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    organizer VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'Pending'
);
```

If your complete project includes login, registration, or other tables, import their original database schema separately.

### 4. Configure MySQL

Update `db_connection.php` to use your local database host, username, password, and database name. **Never commit a production password or a private database configuration to a public repository.** Consider loading credentials from environment variables and committing only an example configuration.

### 5. Start and open the website

Start **Apache** and **MySQL** in XAMPP/MAMP, then visit:

```text
http://localhost/BRACU-Event-Management-System/homepage_dashboard.html
```

Adjust the URL to match your document root and folder name. **PHP pages must run through a PHP-enabled server**; opening them directly as `file://` documents will not execute PHP.

If the login pages are unavailable, you can open the included role dashboards directly during local development, but this is **not an authentication substitute**.

## How the event workflow works

| Step | Component | Behavior |
| --- | --- | --- |
| Submit | `event_submisson_form.html` → `submit_event.php` | Inserts a new event as `Pending` |
| Review | `authority_approve_events.html` | Fetches pending events |
| Decide | `authority_approve_events.php` | Approves/rejects an event; approval checks the per-date limit |
| Track | `view_event_status.php` | Displays event statuses |
| Discover | `get_approved_events.php` → `basic_user_dashboard.html` | Displays approved events |
| Calendar | `get_events.php` → `authority_dashboard.html` | Supplies approved events for the calendar |
| Report | `authority_view_reports.php` | Displays an overview of recorded requests |

## Important limitations and future improvements

- **Authentication/authorization:** The reviewed PHP endpoints do not verify user roles or sessions before accepting approval and other requests. Add server-side authentication and permission checks before deployment.
- **Database safety:** Replace manually constructed SQL statements with prepared statements; escape untrusted values when rendering into HTML, and add CSRF protection where appropriate.
- **Configuration:** Remove any hard-coded sample passwords and keep private configuration out of version control. `generate_hash_password.php` currently contains a hard-coded sample password and should not be publicly deployed as-is.
- **Approval concurrency:** The two-events-per-day rule is checked in application code. Use a transaction or other database-level concurrency control to prevent simultaneous approvals from bypassing the limit.
- **Event ownership:** The organizer status page currently displays **all** event requests rather than filtering by the signed-in organizer.
- **Validation:** Add stronger server-side input validation and error handling.
- **Completeness:** Include any missing login pages and database exports, and test all links and workflows.

## Suggested repository description

> A university event management system built with HTML, CSS, JavaScript, PHP, and MySQL, featuring role-based dashboards, event submission, approval workflows, status tracking, and an event calendar.

## Notes

This README describes functionality visible in the supplied code. It does not claim that the full system has been end-to-end tested or is ready for production use.
