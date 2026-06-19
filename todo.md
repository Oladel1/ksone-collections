# Dynamic Categories Feature - TODO

## Database
- [x] Create `categories` migration (id, slug, name, subtitle, description, icon_image, sort_order, is_active, timestamps)
- [x] Add `category_id` foreign key to products table
- [x] Create Category model
- [x] Create CategorySeeder (seed Footwear as default)
- [x] Update RolePermissionSeeder with category permissions

## Admin Dashboard
- [x] Create Admin\CategoryController (CRUD + toggle)
- [x] Create admin views: categories/index, create, edit, _form
- [x] Create admin icon: categories.blade.php
- [x] Update admin sidebar nav with Categories entry
- [x] Update "View Website" link to point to intro page
- [x] Update product form: add category_id dropdown, rename old field to "Type"
- [x] Update ProductController to handle category_id

## Frontend
- [x] Update PageController::intro() → fetch categories from DB
- [x] Create generic category page route: /c/{category:slug}
- [x] Create category.blade.php (reuse footwear template structure)
- [x] Update intro.blade.php to work with dynamic categories (use uploaded icons)
- [x] Keep /footwear route as redirect to /c/footwear for backward compat

## Git
- [x] Commit and push
