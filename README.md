# Legal Document Management System

A Laravel-based web application developed to help a small law firm manage clients, legal cases, case assignments, and case-related documents in a structured and secure way.

This project is currently in development and is being built as a portfolio/final project to demonstrate practical web application development using Laravel, PHP, MySQL, role-based access control, and document management features.

---

## Project Status

**Status:** In Development

Current progress includes:

- User authentication
- Role-based dashboards
- Admin user management
- Client management
- Case management
- Lawyer and staff assignment
- Case-based access control
- Document upload and download
- Basic admin search

Upcoming features include:

- Audit logs
- Dashboard improvements
- Restricted search for lawyer and staff
- UI polish
- Testing and demo preparation

---

## Main Features

### Authentication and Roles

The system supports multiple user roles:

- Admin
- Lawyer
- Staff
- Client

Each role has different access permissions.

### Admin Features

Admin users can:

- Manage users
- Create user accounts manually
- Assign user roles
- Manage client profiles
- Manage legal cases
- Assign lawyers and staff to cases
- Upload and download case documents
- Search clients, cases, and documents

### Lawyer Features

Lawyer users can:

- View cases assigned to them
- View case details
- Upload and download documents for assigned cases

### Staff Features

Staff users can:

- View cases assigned to them
- View case details
- Upload and download documents for assigned cases

### Client Features

Client users can:

- View limited case progress
- See case status, assigned lawyer, next important date, and latest update

Client access is intentionally limited and does not include internal notes, staff details, or document downloads.

---

## Technologies Used

- Laravel
- PHP
- MySQL
- Blade
- Tailwind CSS
- Laravel Breeze
- Eloquent ORM
- Vite
- Composer
- Node.js / npm
- XAMPP
- Git / GitHub

---

## System Structure

The system follows this main structure:

```text
Client
 └── Case
      ├── Assigned Lawyer
      ├── Assigned Staff
      └── Documents

Documents are linked to specific legal cases. The database stores document information and file paths, while the actual uploaded files are stored using Laravel storage.

---

**Access Control Overview**

The system includes both role-based and case-based access control.
- Admin can access all users, clients, cases, and documents.
- Lawyers can only access cases assigned to them.
- Staff can only access cases assigned to them.
- Clients can only view limited progress for their own cases.

Case-based access is handled through logic that checks whether the logged-in user is allowed to access a specific case.


**Current Modules**
- Completed / Working
- Authentication system
- Public registration disabled
- Role middleware
- Role-based dashboards
- Admin user management
- Client management
- Case management
- Staff assignment to cases
- Client account linking
- Case details page
- Document upload
- Document download
- Shared case access for assigned lawyer and staff
- Unauthorized access testing
- Basic admin search

**Planned / Future Improvements**
- Audit logging
- Restricted lawyer/staff search
- Better dashboard organization
- UI improvements
- Report/export features
- Notification system
- Secure remote client portal
- Document template management
- AI-assisted document search or summarization


**Future Improvement: Document Templates**

A future improvement is to add a reusable document template module.

This would allow the firm to store commonly used templates such as contracts, agreements, letters, and forms. Admin users would manage templates, while lawyers and staff could download them when needed.

This feature is not part of the current core demo scope.


**Installation Notes**

This project is currently developed locally using XAMPP and Laravel.

Basic setup steps:

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve

Database configuration should be updated inside the .env file before running migrations.


**Disclaimer**

This project is developed for educational and portfolio purposes. It is not yet production-ready and would require further security review, testing, deployment configuration, backup planning, and legal data protection measures before being used in a real law firm environment.