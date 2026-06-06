# Legal Document Management System

A Laravel-based web application developed to help a small law firm manage clients, legal cases, case assignments, and case-related documents in a structured and secure way.

This project is currently in development and is being built as a portfolio/final project to demonstrate practical web application development using Laravel, PHP, MySQL, role-based access control, and document management features.

---

## Project Status

## Project Status

**Status:** Active Development (Demo Preparation Phase)

Current progress includes:

- User authentication and role-based access control
- Role-based dashboards
- User management
- Client management
- Case management
- Lawyer and staff assignment
- Client account linking
- Quick case progress updates
- Case closure workflow
- Document upload and download
- Document soft delete
- Restricted search functionality
- Audit logging
- Audit log filtering and pagination
- Pagination for users, clients, and cases
- Case-based access control

Remaining work focuses on testing, UI refinement, and demo preparation.

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

- View assigned cases
- Update case progress
- Close assigned cases
- Upload documents for active cases
- Download documents
- Soft delete documents for active assigned cases

### Staff Features

Staff users can:

- View assigned cases
- View case details
- Upload documents for active assigned cases
- Download documents

Staff users operate in a restricted role and cannot update case progress, close cases, or delete documents.

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
```
Documents are linked to specific legal cases. The database stores document information and file paths, while the actual uploaded files are stored using Laravel storage.

---

## Access Control Overview

The system includes both role-based and case-based access control.
- Admin can access all users, clients, cases, and documents.
- Lawyers can only access cases assigned to them.
- Staff can only access cases assigned to them.
- Clients can only view limited progress for their own cases.

Case-based access is handled through logic that checks whether the logged-in user is allowed to access a specific case.

---

## Current Modules

### Completed Features

- Authentication system
- Public registration disabled
- Role middleware
- Role-based dashboards
- User management
- Client management
- Case management
- Lawyer and staff assignment
- Client account linking
- Shared case access for assigned lawyer and staff
- Quick case progress updates
- Case closure workflow
- Document upload
- Document download
- Document soft delete
- Restricted search
- Audit logging
- Audit log filtering
- Pagination
- Case-based access control
- Unauthorized access protection

## Planned / Future Improvements

- Report and export functionality
- Notification system
- Secure remote client portal
- Document template management
- AI-assisted document search and summarization
- Restore deleted documents module
- Advanced reporting dashboard

---

## Case Progress Tracking

Authorized users can quickly update case progress through a dedicated progress update module.

The following information can be updated:

- Case status
- Next important date
- Client update
- Internal notes

Progress updates are recorded in the audit log for accountability and traceability.

---

## Document Management

The system supports:

- Document upload
- Document download
- Document soft delete
- Case-based document access control

Soft delete allows documents to be removed from normal views while preserving records for future recovery and auditing purposes.

---

## Audit Logging

The system records important activities performed by users.

Tracked activities include:

- User updates
- Client creation
- Case creation
- Case updates
- Case progress updates
- Case closure
- Document uploads
- Document downloads
- Document deletions
- Search activities

Audit logs can be filtered by module and are paginated for easier monitoring.

---

## Case Lifecycle Rules

When a case is marked as Closed:

- Progress updates are disabled
- Document uploads are disabled
- Document deletion is disabled
- Existing documents remain downloadable

These restrictions help preserve case records and prevent unintended modifications after case completion.

---

## Security Features

The system incorporates several security and access-control mechanisms:

- Role-based access control
- Case-based authorization
- Restricted search visibility
- Audit trail logging
- Document soft delete
- Closed-case modification restrictions
- Unauthorized access protection

These controls help ensure that users only access information relevant to their assigned responsibilities.

---

## Installation Notes

This project is currently developed locally using XAMPP and Laravel.

Basic setup steps:
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```
Database configuration should be updated inside the .env file before running migrations.

---

## Disclaimer

This project is developed for educational and portfolio purposes. It is not yet production-ready and would require further security review, testing, deployment configuration, backup planning, and legal data protection measures before being used in a real law firm environment.