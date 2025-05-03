# EMERALD

**Emerald** is a modular, lightweight, and dependency-free design system that structures reusable components using pure PHP, JavaScript (jQuery), and CSS. Inspired by the Carbon Design System and Atomic Design methodology, Emerald is built for projects that require clarity, visual consistency, and scalability without heavy frameworks.

## Architecture

Emerald organizes its components by levels of atomicity:

```
src/
├── components/
│   ├── Atomic/           → Basic elements like buttons, inputs, icons
│   ├── Molecules/        → Simple reusable combinations of atoms
│
├── global/
│   ├── emerald.css       → Central file to load global styles and utilities
│   └── vars.css          → Design tokens: colors, typography, spacing
```

Each component has its own folder with the necessary files:

```
/Button/
├── Button.php     → HTML structure (without complex logic)
├── Button.css     → Scoped and reusable styles
├── Button.js      → (Optional) Specific interactivity using jQuery or plain JS
```

## Design Tokens (global/vars.css)

Emerald defines a complete set of custom CSS variables for colors, which are used in utility classes such as:

```css
.text-gray-700 { color: var(--gray-700); }
.bg-blue-100   { background-color: var(--blue-100); }
```

These variables ensure visual consistency and allow the entire color palette to be managed from a single source.

## Benefits of Emerald

* Clean, clear design system without coupling to any frameworks
* Architecture inspired by Carbon and Atomic Design
* Fully independent and reusable components
* Centralized variables for complete style control
* Built to scale without losing structure or maintainability
