
# WK CSS Framework

A lightweight CSS utility framework to generate reset styles, utility classes, and component classes for rapid front-end development.

---

## **Features**

- **Base CSS**: Includes comprehensive reset and global styles (`base.css`) for consistent cross-browser styling.
- **Utility Classes**: Provides spacing, colors, typography, and flex/grid utilities (`utilities.css`).
- **Component Classes**: Includes pre-defined reusable components like grids and flex utilities (`components.css`).
- **CLI Tool**: Generate CSS files with a single command for seamless integration into any project.
- **Laravel Mix Support**: Easy integration into Laravel projects for streamlined development.

---

## **Installation**

1. **Add the Package**:
   Install the package using Composer:
   ```bash
   composer require yourname/wk-css-framework
   ```

2. **Generate CSS Files**:
   Run the command to generate CSS files:
   ```bash
   vendor/bin/wkcss
   ```

3. **Output Directory**:
   The generated CSS files will be located in the `output/` directory:
   - `base.css`: Reset styles
   - `utilities.css`: Utility classes
   - `components.css`: Component classes

---

## **Integration in Frontend Using Laravel Mix**

### **Step 1: Install Laravel Mix**

If Laravel Mix is not already set up in your project, install it with NPM:

```bash
npm install laravel-mix --save-dev
```

---

### **Step 2: Configure `webpack.mix.js`**

Update your `webpack.mix.js` file to include the generated CSS files:

```javascript
const mix = require('laravel-mix');

mix.setPublicPath('public'); // Output directory for compiled assets

mix.styles([
    'vendor/yourname/wk-css-framework/output/base.css',
    'vendor/yourname/wk-css-framework/output/utilities.css',
    'vendor/yourname/wk-css-framework/output/components.css',
    'resources/css/app.css', // Your custom CSS
], 'public/css/app.css'); // Output file
```

---

### **Step 3: Compile Assets**

1. Run Laravel Mix to compile and concatenate the CSS files:

   ```bash
   npx mix
   ```

2. For production, add optimizations:
   ```bash
   npx mix --production
   ```

---

### **Step 4: Include in Your Application**

Add the compiled `app.css` file to your HTML or Blade templates:

```html
<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
```

---

## **Example Output**

### **Base CSS (`base.css`)**
Contains browser reset styles:
```css
body, h1, h2, h3, p, ul, ol, a {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
```

### **Utilities CSS (`utilities.css`)**
Provides utility classes for common styling needs:

#### **Spacing:**
```css
.m-0 { margin: 0px; }
.m-1 { margin: 4px; }
.p-0 { padding: 0px; }
.p-1 { padding: 4px; }
```

#### **Colors:**
```css
.text-red { color: #ff0000; }
.bg-blue-500 { background-color: #0000ff; }
```

#### **Typography:**
```css
.text-sm { font-size: 0.875rem; }
.text-lg { font-size: 1.125rem; }
```

### **Component Classes (`components.css`)**
Includes reusable classes like flex and grid systems:

#### **Flexbox Utilities:**
```css
.flex { display: flex; }
.flex-col { flex-direction: column; }
.items-center { align-items: center; }
```

#### **Grid Utilities:**
```css
.grid { display: grid; }
.grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
```

---

## **Customization**

1. **Change Spacing Multipliers**:
   Update the multiplier in `CSSGenerator.php` to control spacing:
   ```php
   private const SPACING_MULTIPLIER = 8; // Changes spacing from 4px to 8px increments
   ```

2. **Add Custom Colors**:
   Modify the `ColorHelper` class to define additional colors:
   ```php
   public static function getBasicColors(): array
   {
       return [
           'custom' => '#123456',
           'primary' => '#007bff',
           'secondary' => '#6c757d',
       ];
   }
   ```

---

## **Future Enhancements**

- **Responsive Utilities**:
  Add support for responsive breakpoints (e.g., `sm:m-1`, `lg:p-2`).
- **Custom Configuration**:
  Allow user-defined configurations for spacing, colors, and utilities.

---

## **License**

Licensed under the [MIT License](LICENSE).
