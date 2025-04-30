# School Portal Access & Registration Suite

A comprehensive WordPress plugin for managing school portal access, student registration, renewals, portfolios, transcripts, and payments. Designed for schools, parents, and administrators, it provides a secure, user-friendly, and feature-rich experience.

## Features
- **Secure Login & Registration:** Multi-step forms for parents and students, with AJAX validation and role-based access.
- **Parent & Admin Dashboards:** Manage students, view portfolios, transcripts, and handle renewals.
- **Student Portfolio:** Upload, preview, and download academic documents (PDF, DOC, DOCX, JPG, PNG).
- **Transcript Management:** Generate, view, and download official transcripts as PDF, with GPA calculations and course weighting (Honors, AP, IB, DE).
- **Course & Class Management:** Add notes, attach files, and manage student classes.
- **Emergency Contact & Address Management:** Collect and update parent and student contact details.
- **Payment Integration:** PayPal PHP SDK integration for secure online payments and coupon support.
- **Notifications:** Email notifications for registration, password reset, and graduation events.
- **Responsive UI:** Built with Bootstrap for modern, mobile-friendly design.

## Folder Structure
- `admin/` — Admin dashboard, student/class/portfolio management
- `ajax/` — JavaScript AJAX handlers for all dynamic UI features
- `css/` — Stylesheets (Bootstrap, custom forms, transcripts, etc.)
- `img/` — Images and icons
- `js/` — Common JS utilities, dropdowns, jQuery
- `parent/` — Parent dashboard, registration, portfolio, transcript pages
- `paypal/` — PayPal SDK and payment integration
- Main PHP files — Plugin logic, page templates, AJAX endpoints

## Requirements
- WordPress (plugin-based)
- PHP 5.3 or above
- MySQL database
- PHP extensions: curl, json, openssl
- PayPal developer account (for payment features)

## Installation
1. Copy the plugin folder to your WordPress `wp-content/plugins/` directory.
2. Activate the plugin from the WordPress admin dashboard.
3. Configure plugin settings and PayPal credentials as needed.
4. Use provided shortcodes to embed forms on custom pages.

## Usage
- **Parents:** Register students, upload documents, manage portfolios, renew accounts, and download transcripts.
- **Admins:** Manage users, students, classes, portfolios, and transactions from the admin dashboard.
- **All forms** use AJAX for validation and submission for a seamless experience.

## Payment Integration
- Uses the PayPal PHP SDK for payment processing.
- Ensure your server meets SDK requirements and configure your PayPal API credentials in the plugin settings.

## License
- Main plugin: GPL2
- PayPal SDK: See `paypal/vendor/paypal/rest-api-sdk-php/LICENSE`

## Support
For questions or support, contact:
- **Email:** admin@graduatesacademy.com
- **Phone:** (865) 564-4810

---
*This plugin is developed and maintained by Subham Akhuli*
