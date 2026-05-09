# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Stack

Laravel 12 / PHP 8.2+, Blade + Alpine.js 3, Tailwind CSS 3, Vite 7. Database: SQLite (local) / MySQL (production). Queue driver: database. Cache driver: database. Payment: PayPhone API.

## Commands

```bash
# First-time setup
composer run setup       # install deps, generate key, migrate, build assets

# Development (concurrent artisan + queue + pail + vite)
composer run dev

# Run tests
composer run test        # clears config cache, then runs PHPUnit

# Code style
php artisan pint         # PSR-12 enforcement

# Link storage (required on fresh deploy)
php artisan storage:link
```

Individual PHPUnit: `php artisan test --filter TestClassName`.

## Architecture

### Routing & Controllers

All public routes are in `routes/web.php`. Admin routes are grouped under `/admin` with `auth` + `verified` middleware — no roles, single admin user.

- `HomeController` — assembles homepage from multiple models (products, categories, gallery, page content)
- `StoreController` — catalog + product detail
- `CartController` — session-only cart (no DB table); cart stored as `session('cart')` array
- `CheckoutController` — captures customer details into session
- `PaymentController` — PayPhone integration: `prepare()` calls `/Prepare` API, `response()` handles success callback (creates Order + OrderItems + queues emails), `cancelled()` handles cancellation
- `Admin/*` controllers — resource CRUD for products, categories, gallery, orders, SEO, page content, theme

### CMS & Cache Pattern

`SeoSetting` and `PageContent` are key-value models for all homepage copy and SEO metadata. Both use a `Cache::rememberForever("key:{$key}", ...)` read with immediate `Cache::forget` on write. This means zero DB hits for repeated reads of static config and no TTL-related staleness.

```php
SeoSetting::get('meta_title');          // cached read
SeoSetting::set('meta_title', $value);  // writes DB + clears cache key
```

Never bypass this pattern by querying these models directly with `where('key', ...)`.

### Product Model

Products store gallery images, kit contents, and SKU variants as JSON columns (`gallery`, `includes`, `variants` cast to `array`). Avoid adding pivot tables for these — JSON is intentional for ordered lists with no relational query requirements.

Image URL resolution lives entirely in `getImageUrlAttribute()`. WhatsApp deep-link generation also uses model accessors. Keep views logic-free by extending accessors rather than assembling URLs in Blade.

### Order Flow

Order numbers are auto-generated: `ORD-YYYY-NNNN`. Order items snapshot product name + price at creation time (denormalized). Status enum: `pending → paid → processing → shipped → delivered / cancelled`. Spanish labels via `statusLabel()`.

### File Uploads

Use the `StoresUniqueUploads` trait in any controller that handles uploads. It generates collision-safe filenames (`YmdHis_<24-char-random>.<ext>`) and stores to `public` disk.

### Emails

`OrderConfirmation`, `NewOrderNotification`, `OrderStatusUpdated`, and `PaymentFailed` all implement `ShouldQueue`. The dev command runs a queue worker; in production ensure a persistent queue worker or scheduler.

### Frontend

Tailwind config uses a custom warm cream / gold / olive palette defined in `resources/css/app.css`. Alpine.js handles modals, cart quantity sync, and dropdowns — no Vue/React. Pre-compiled assets in `public/build/` are committed for shared-hosting compatibility.

Blade layouts:
- `layouts.public` — storefront
- `layouts.admin` — admin dashboard
- `layouts.guest` — auth forms

## Key Environment Variables

```
PAYPHONE_TOKEN=
PAYPHONE_STORE_ID=
MAIL_MAILER=log          # use 'log' locally
APP_PUBLIC_ROOT=         # override public/ path for shared hosting (optional)
```

## Seeded Admin Credentials

`admin@untesoroparamama.com` / `admin123456` (created by `php artisan db:seed`).
