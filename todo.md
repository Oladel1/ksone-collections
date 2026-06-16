# Phase 3: Backend & Admin Dashboard - TODO

## Database & Models
- [ ] Create migrations (roles, permissions, users, products, sizes, variants, orders, site_settings)
- [ ] Create Models (Role, Permission, User, Product, ProductSize, ProductVariant, Order, SiteSetting)
- [ ] Create Seeders (roles/permissions, admin user, products, site settings)

## Authentication & Middleware
- [ ] Admin login/logout
- [ ] AdminAuth middleware
- [ ] CheckPermission middleware
- [ ] Register middleware in bootstrap/app.php

## Admin Controllers
- [ ] DashboardController
- [ ] ProductController (CRUD)
- [ ] OrderController (index, show, update status)
- [ ] SettingController (edit all site settings by group)
- [ ] UserController (CRUD, assign roles)
- [ ] RoleController (CRUD, assign permissions)

## Admin Views
- [ ] layouts/admin.blade.php (sidebar, topbar)
- [ ] auth/login.blade.php
- [ ] dashboard.blade.php
- [ ] products/ (index, create, edit)
- [ ] orders/ (index, show)
- [ ] settings/index.blade.php
- [ ] users/ (index, create, edit)
- [ ] roles/ (index, create, edit)

## Frontend Updates
- [ ] Update PageController to use DB
- [ ] Update footwear.blade.php for site settings
- [ ] Update PaystackController to save orders to DB

## Assets
- [ ] admin.css + admin.js
- [ ] Update vite.config.js + tailwind.config.js
- [ ] Build assets

## Git
- [ ] Commit and push
