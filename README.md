# CSS Utility Class Generator in PHP

This project generates utility CSS classes for spacing and background colors using PHP. It produces a single CSS file containing classes like `.p-1`, `.m-2`, `.bg-primary`, etc., which can be used in your projects for consistent styling.

## Features

- **Spacing Classes**: Generates padding (`p-*`) and margin (`m-*`) classes for different sizes (e.g., `.p-1 { padding: 4px; }`).
- **Background Color Classes**: Includes predefined background color classes like `.bg-primary` and `.bg-success`.
- **File Output**: Saves the generated CSS to a file named `generated-classes.css`.

## Project Structure

```
project/
├── src/
│   ├── classes/
│   │   ├── CSSGenerator.php   # Main class for CSS generation
│   ├── output/
│   │   ├── generated-classes.css # Generated CSS file
├── index.php                 # Entry point for executing the generator
├── composer.json             # Composer configuration for autoloading
├── README.md                 # Documentation file
```

### Key Files

1. **`src/classes/CSSGenerator.php`**:
   - Contains the logic for generating CSS classes for spacing and background colors.

2. **`index.php`**:
   - Entry point for running the CSS generator and saving the output to a file.

3. **`src/output/generated-classes.css`**:
   - The generated CSS file.

---

## Requirements

- PHP 7.4 or higher
- Composer for dependency management

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/css-generator-php.git
   cd css-generator-php
   ```

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

---

## Usage

1. Run the generator:
   ```bash
   php index.php
   ```

2. Check the output:
   - The generated CSS file will be located at `src/output/generated-classes.css`.

3. Include the generated CSS in your HTML project:
   ```html
   <link rel="stylesheet" href="path/to/generated-classes.css">
   ```

4. Use the utility classes in your HTML:
   ```html
   <div class="bg-primary p-3 m-2">
       Example with background and spacing utilities
   </div>
   ```

---

## Example Output

### Spacing Classes

```css
.p-0 { padding: 0px; }
.pt-1 { padding-top: 4px; }
.mb-2 { margin-bottom: 8px; }
```

### Background Color Classes

```css
.bg-primary { background-color: #007bff; }
.bg-success { background-color: #28a745; }
.bg-danger { background-color: #dc3545; }
```

---

## Customization

### Add More Colors

To add more colors, update the `COLORS` array in `CSSGenerator.php`:

```php
private const COLORS = [
    'primary' => '#007bff',
    'success' => '#28a745',
    'danger' => '#dc3545',
    'warning' => '#ffc107',
    'info' => '#17a2b8',
    'custom' => '#123456' // Add your custom color here
];
```

### Adjust Spacing Multipliers

To change the spacing multiplier (default: `4px`), update the constant in `CSSGenerator.php`:

```php
private const SPACING_MULTIPLIER = 8; // Change to 8px multiplier
```

---

## Future Enhancements

1. **Dynamic Colors**:
   - Fetch color schemes dynamically from APIs like The Color API or Adobe Color.

2. **Responsive Utilities**:
   - Extend the generator to include responsive classes for different screen sizes (e.g., `.sm:p-1`, `.lg:bg-primary`).

3. **Command-Line Tool**:
   - Convert this project into a CLI tool for more flexible usage.

---

## License

This project is licensed under the [MIT License](LICENSE).

---

Feel free to contribute or suggest improvements! 🎉
