# KS One Collections

Premium handcrafted products showcase website — proudly made in Nigeria.

Built with **Laravel 11**, **Tailwind CSS 3**, and **Vite**.

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+ & npm (or Bun)

### Setup

```bash
# 1. Clone the repo
git clone https://github.com/Oladel1/ksone-collections.git
cd ksone-collections

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Environment setup
cp .env.example .env
php artisan key:generate

# 5. Build assets (Tailwind CSS)
npm run build

# 6. Start the dev server
php artisan serve
```

Visit `http://localhost:8000` to see the intro page.

### Development

```bash
# Run Vite dev server (auto-reloads CSS/JS changes)
npm run dev

# In a separate terminal, run Laravel
php artisan serve
```

---

## 📁 Project Structure

```
ksone-collections/
├── app/Http/Controllers/
│   └── PageController.php          # Page controllers
├── resources/
│   ├── css/app.css                 # Tailwind imports & custom styles
│   ├── js/app.js                   # JavaScript entry
│   └── views/
│       ├── layouts/app.blade.php   # Base layout
│       ├── intro.blade.php         # Phase 1: Intro page
│       └── components/icons/       # SVG icon components
├── routes/web.php                  # Route definitions
├── tailwind.config.js              # Tailwind configuration
└── vite.config.js                  # Vite build config
```

---

## 🎯 Roadmap

- **Phase 1** ✅ Intro page with collection icons
- **Phase 2** 🔜 One-page footwear showcase website

---

## 🎨 Design

- **Colors:** Gold (#d4952b) accent on dark charcoal (#0d0d0d) background
- **Typography:** Playfair Display (headings) + Inter (body)
- **Style:** Premium, elegant, minimal with subtle animations

---

## 🚢 Deployment (Shared Hosting / cPanel)

```bash
# Build production assets
npm run build

# Upload the entire project to your hosting
# Point the domain's document root to the /public directory

# Set permissions
chmod -R 775 storage bootstrap/cache
```

Make sure to configure `.env` with your production settings and run `php artisan key:generate`.
