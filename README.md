# Un Tesoro Para Mamá — Breastmilk Jewelry E-Commerce Platform

A full-stack e-commerce platform built for a niche artisanal business selling DIY breastmilk jewelry kits. The system pairs a conversion-optimized public storefront with a complete content management layer — covering products, categories, a curated gallery, page copy, and SEO metadata — all manageable through a dedicated admin dashboard without touching code.

---

## Overview

**Un Tesoro Para Mamá** sells handcrafted DIY kits that allow mothers to preserve a piece of their breastfeeding journey in the form of wearable jewelry. The business operates in Ecuador and uses WhatsApp as its primary sales channel, so the platform is built around a direct-to-customer funnel: emotionally resonant product pages with contextual WhatsApp CTAs that pre-fill a message, reducing friction before the first conversation happens.

Every headline, paragraph, and image on the homepage can be updated through the admin without a deployment. SEO configuration — meta tags, Open Graph, JSON-LD schema, robots.txt, and sitemap — is also managed through the dashboard, making the platform self-sufficient for a small team operating without a developer on-call.

---

## Key Features

- **Admin CMS**: Manage products, categories, gallery items, homepage copy, and SEO settings through a dedicated dashboard — no code changes required for content updates
- **WhatsApp Commerce**: Each product generates a pre-filled WhatsApp deep link, enabling direct customer contact without a traditional checkout or payment gateway
- **SEO Management Panel**: Full control over meta titles, descriptions, Open Graph, Twitter Cards, JSON-LD schema (LocalBusiness), Google Analytics / GTM / Meta Pixel IDs, and robots.txt from a single settings screen
- **Dynamic Sitemap**: Auto-generated XML sitemap served at `/sitemap.xml`, built from active product records
- **Cache-First Settings**: `SeoSetting` and `PageContent` use `Cache::rememberForever` with targeted invalidation on write, keeping database queries off the hot path for static content
- **Flexible Product Modeling**: Badges, discount pricing with computed percentage, per-product WhatsApp messages, and multiple gallery images stored as JSON fields on the product record
- **Responsive Design**: Mobile-first layout built with Tailwind CSS using a custom cream/gold/olive palette and Cormorant Garamond typography, crafted to match the brand's premium, artisanal positioning

---

## Tech Stack

### Frontend
- **Alpine.js** 3 — lightweight reactivity for modals, dropdowns, and interactive UI state
- **Axios** — HTTP client for async requests

### Backend
- **Laravel** 12 — routing, Eloquent ORM, file storage, caching, queue
- **Laravel Breeze** — minimal authentication scaffolding (login, register, email verification)
- **PHP** 8.2+

### Database
- **MySQL** (production) / **SQLite** (local development)
- Tables: `products`, `categories`, `gallery_items`, `seo_settings`, `page_contents`

### Styling / UI
- **Tailwind CSS** 3 with `@tailwindcss/forms`
- Custom design tokens: warm cream palette (50–200), gold accents (300–600), olive text (700–900)
- Typography: Cormorant Garamond (display/headings) + Inter (body)

### Tooling / Other
- **Vite** 7 with `laravel-vite-plugin` — asset bundling and HMR in development
- **Laravel Pint** — PSR-12 code style enforcement
- **Laravel Sail** — Docker environment for local development
- **WhatsApp Business** deep links — pre-filled message URLs generated per product

---

## My Role

I designed and built this platform end-to-end as a solo full-stack project. Key responsibilities included:

- **Architecture**: Chose a key-value CMS model (`SeoSetting`, `PageContent`) over rigid table schemas to allow flexible content updates without schema migrations. Implemented cache-first reads with targeted invalidation to eliminate repeated DB hits on static configuration.
- **Product domain**: Designed the `Product` model with JSON fields for `gallery` and `includes` arrays, Eloquent accessors for image URL resolution and WhatsApp deep link generation, and computed discount percentage logic.
- **Admin dashboard**: Built CRUD interfaces for all content types with image uploads, auto-generated slugs, active/inactive toggling, and integer-based ordering.
- **SEO system**: Designed a fully configurable SEO layer — from meta tags and Open Graph to JSON-LD schema, analytics tag injection, sitemap generation, and robots.txt — all stored in the database and served from cache.
- **Frontend**: Implemented the homepage (hero, brand story, product showcase, gallery, CTA) using Tailwind CSS and Alpine.js, with a custom design system reflecting the brand's aesthetic.
- **Deployment**: Pre-compiled assets committed to the repository and configured storage linking for straightforward deployment to shared/VPS hosting.

---

## Screenshots

> _Screenshots coming soon. The admin dashboard, homepage hero, product cards, and WhatsApp CTA flow will be documented here._

| View | Preview |
|------|---------|
| Homepage Hero | `docs/screenshots/homepage-hero.png` |
| Product Catalog | `docs/screenshots/products.png` |
| Admin — Products | `docs/screenshots/admin-products.png` |
| Admin — SEO Settings | `docs/screenshots/admin-seo.png` |

---

## Local Setup

1. **Clone and install PHP dependencies**
   ```bash
   git clone https://github.com/YOUR_USERNAME/untesoroparamama.git
   cd untesoroparamama
   composer install
   ```

2. **Configure the environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update `.env` with your database credentials and `WHATSAPP_NUMBER`.

3. **Run migrations**
   ```bash
   php artisan migrate
   ```

4. **Install frontend dependencies and build assets**
   ```bash
   npm install
   npm run build
   ```

5. **Link public storage**
   ```bash
   php artisan storage:link
   ```

6. **Create an admin account**
   ```bash
   php artisan tinker
   # >>> \App\Models\User::factory()->create(['email' => 'admin@example.com', 'password' => bcrypt('password')]);
   ```

7. **Start the development server**
   ```bash
   composer run dev   # runs artisan serve + vite concurrently
   ```
   Admin panel: `http://localhost:8000/admin`

---

## Technical Highlights

- **Cache-First CMS Layer**: `SeoSetting` and `PageContent` models read from `Cache::rememberForever` on every request. Writes call `Cache::forget` on the affected key immediately — no TTL drift, no stale data, no database hits on the hot path for settings that change infrequently.

- **WhatsApp Commerce Pattern**: The platform generates `https://wa.me/{phone}?text={encoded_message}` deep links per product instead of building a traditional cart. Each product record can define a custom message template. For a small artisanal business in Latin America, this approach removes payment processing complexity and leverages a channel with high existing trust and engagement.

- **Accessor-Driven URL Resolution**: The `Product` model centralizes all URL logic. `image_url` returns either the stored file path or a Picsum placeholder; `whatsapp_url` URL-encodes the product message automatically. Views never assemble URLs manually, keeping templates clean and logic testable.

- **JSON Fields for Flexible Lists**: `products.gallery` and `products.includes` are stored as JSON and cast to arrays via Eloquent. This avoids pivot tables for small, ordered lists that have no relational querying requirements — a deliberate trade-off for simplicity over normalization.

- **SEO-First Public Layout**: The public layout template renders `<meta>`, Open Graph, Twitter Card, and `<script type="application/ld+json">` blocks on every page, hydrated from the database-backed `SeoSetting` model. Google Analytics, GTM, and Meta Pixel tags are injected conditionally only when their IDs are configured, keeping pages clean by default.

---

## Future Improvements

- **Order tracking**: Lightweight order board to track WhatsApp-initiated orders through a status flow (pending → confirmed → shipped)
- **Image optimization**: Automatic WebP conversion and responsive `srcset` generation on upload
- **Automated tests**: Feature tests for admin CRUD flows and homepage rendering; no test coverage currently
- **Role-based access**: Granular permissions (content editor vs. full admin) with Spatie Laravel Permission
- **CDN integration**: Offload product and gallery images to S3 or Cloudflare R2 for scalable media delivery
- **Internationalization**: Extract hardcoded Spanish strings into Laravel lang files to support additional locales

---

## Notes

This project was built for a real operating business, which shaped every trade-off: the CMS-first approach, the WhatsApp-driven conversion strategy, and the minimal dependency footprint all reflect practical constraints rather than theoretical ideals. The codebase is intentionally lean — no speculative abstractions, no unused features.
