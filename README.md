# EMERALD

**Emerald** is a modular, lightweight, and dependency-free design system that structures reusable components using pure PHP, JavaScript (jQuery), and CSS. Inspired by the Carbon Design System and Atomic Design methodology, Emerald is built for projects that require clarity, visual consistency, and scalability without heavy frameworks.

---

## 🧠 What is Emerald?

Emerald is a design and interface-building system based on the principles of Atomic Design, fully framework-agnostic and centered on pure PHP, native CSS, and jQuery-style JavaScript. It offers a robust, minimalist, and accessible alternative to large design systems like IBM Carbon, Material, or Lightning, without requiring React, Vue, or Angular.

Emerald is ideal for environments where the priority is:

* Pure performance without unnecessary framework load
* Full control over HTML and semantics
* High code readability and long-term maintainability
* Perfect backend integration (especially PHP-based legacy/custom systems)

---

## 🎯 Core Philosophy

**"Make it readable. Make it kodalized. Make it scalable."**

Emerald follows a development philosophy called **kodalización**, which emphasizes clarity, structure, and independence from modern frameworks. It doesn't chase trends it focuses on solid, maintainable engineering.

### ✳️ Kodalization Principles

1. Self-contained and reusable components in `.php`, `.css`, and `.js` files.
2. Clear, hierarchical naming with `em-` prefixes and consistent structures.
3. Full separation of structure, style, and behavior.
4. Pure CSS styling with variables in `vars.css`, no preprocessors.
5. Clean JavaScript (jQuery or native), no external dependencies.
6. Templates use `k_mask_row()`, never confusing concatenations.
7. Built-in accessibility: ARIA roles, keyboard navigation, semantic HTML.

---

## 🧩 How Emerald Works

Each component consists of:

* `component.php` → structure and logic
* `component.css` → specific, scoped styles
* `component.js` → optional interactivity (jQuery/native)

Components range from atomic elements like `Button`, `Input`, `Badge` to larger patterns like `SideNav`, `FilterBar`, or `Table`. They’re rendered via PHP like this:

```php
echo ( new Button( 'Save', 'submit', 'k-button-blue', 'check', 'left', 'btn_save' ) )->render();
```

---

## 🧱 Component Architecture

Emerald follows an Atomic Design structure:

* **Atoms:** Button, Tag, Checkbox, Input, Badge
* **Molecules:** FilterBar, Breadcrumb, Modal
* **Patterns:** SideNav, DataTable, Form…

Each component uses a PHP class, template strings with `{{ placeholders }}`, and is highly configurable through props. It supports:

* Subcomponents with declared dependencies in PHPDoc
* Layout composition with conditional logic
* SideNav modes like Rail or Fixed
* Controlled rendering and dynamic menu expansion
* Semantic integration with Material Icons

---

## 🔁 File Structure

```
Emerald/
├── src/
│   ├── global/
│   │   ├── vars.css       # Global tokens
│   │   ├── emerald.css    # Base styles
│   │   ├── emerald.js     # JS bootstrap loader
│   ├── components/
│   │   ├── Atoms/
│   │   ├── Molecules/
│   │   └── Patterns/
```

Each component resides in its own folder and is auto-loaded via `bootstrap.php`.

---

## 🧩 Component Composition

You can build complete interfaces using simple PHP calls:

```php
$sidenav_items = [
  new SideNavLink(
      'Dashboard'
    , '/dashboard'
    , 'home'
  ),

  new SideNavMenu(
      'Account'
    , [
        new SideNavLink( 'Profile', '/account/profile', 'person' )
      , new SideNavLink( 'Billing', '/account/billing', 'credit_card' )
      ]
    , false
    , 'account_circle'
  )
];

$sidenav_footer = ( new SideNavFooter(
    'John'
  , 'johndoe@example.com'
  , '/avatar.jpg'
) )->render();

$sidenav = new SideNav(
    $sidenav_items
  , class: ''
  , id: 'main_sidenav'
  , expanded: true
  , is_rail: false
  , is_fixed_nav: false
  , is_persistent: true
  , is_child_of_header: true
  , footer: $sidenav_footer
);

echo $sidenav->render();
```

---

## 💡 Use Cases

Emerald is ideal for:

* Business dashboards with clear structure and navigation
* PHP legacy applications needing UI upgrades without JS frameworks
* SaaS products that require performance and design consistency
* Public or institutional interfaces with accessibility requirements

---

## 🧰 Utilities and Tools

* `k_mask_row( $data, $mask )`: native template system
* `bootstrap.js`: auto-imports all JS modules
* `bootstrap.php`: auto-imports all PHP components

---

## 🛠 Current Status & Roadmap

### ✅ Already available:

* SideNav (with Rail, Footer, Titles, Submenus)
* FilterBar
* Table
* Inputs, Buttons, Tags, Badges, Selects
* Breadcrumb, Spinner, Modal
* ARIA support, native JS/jQuery behavior

### 🟡 In progress:

* Interactive DataTable
* Universal Header
* Responsive Layout Grid support

### 🔜 Coming next:

* TabBar, Card, Pagination
* Theme Switcher (Light/Dark)
* Emerald Form System with validations

---

## 🧬 GPT Integration and Synergy with DeepWiki

Emerald is designed to be generated, extended, and maintained by GPT-based agents like ChatGPT. Its workflow is optimized for conversational programming: the developer describes the desired component, and the GPT generates the full Emerald version using all kodalization principles automatically.

To retrieve component definitions from other design systems (such as Carbon or Material), Emerald is compatible with a secondary agent called Devin. Devin is not part of Emerald, but it works in synergy through external data sources like DeepWiki, which provide the specifications needed for the translation.

The process works as follows:
1. The developer requests a component (e.g. “SideNav from Carbon”).
2. GPT generates a JSON query that Devin uses to collect relevant data: structure, styles, props, states, accessibility, etc.
3. Once the raw specs are available (via DeepWiki or similar), GPT applies Emerald’s kodalization rules and creates three output files: `component.php`, `component.css`, and optionally `component.js`.

This separation between exploration (Devin/DeepWiki) and transformation (Emerald Builder/GPT) makes the system flexible and scalable. Emerald components always maintain internal consistency, even when sourced from third-party systems.

The next planned step is a bi-directional connection with Figma, allowing visual components to be parsed and translated automatically into Emerald code — bringing visual design and coded implementation into the same loop.

Emerald is not just a design system; it is a bridge between modern design ecosystems and legacy-free, readable code. Its architecture is designed from the ground up to support intelligent, rule-based generation by AI systems.

---

## 📌 Conclusion

Emerald is a minimalist, robust, and readable design system that prioritizes clarity, long-term maintainability, and full control over code structure. Built for developers and AI agents to work together, it transforms component creation into a structured and scalable process — without the overhead of modern frontend frameworks.

By focusing on clean syntax, modular architecture, and real accessibility, Emerald offers a solid foundation for building interfaces that are easy to understand, extend, and maintain.