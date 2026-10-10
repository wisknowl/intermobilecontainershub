# Intermobile Containers Hub: WordPress Development Plan

A build specification written for an AI developer to follow step by step. Scope: a responsive WooCommerce store selling 20ft and 40ft shipping containers, on a custom raw-code theme.

## 1. Business constants (single source of truth)

Store these once in `inc/config.php` and in a Theme Options page. Never hard-code them in templates.

- Site name: Intermobile Containers Hub
- Domain: intermobilecontainershub.com
- Public email: info@intermobilecontainershub.com
- Phone: +1 (757) 906-8036 (tel link: `tel:+17579068036`)
- Address: 11500 Metric Blvd, North Burnett, Austin, TX
- Service area: United States
- Support hours: set by owner in Theme Options (no default copied from any other site)
- Currency: USD

## 2. Scope

### In scope

- Home, Shop (archive), Single Product, Cart, Checkout, My Account, About, Contact, Privacy Policy, Terms of Service, Search results, 404
- Products limited to 20ft and 40ft containers (standard, high cube, one-trip, used, cargo-worthy, wind and watertight, open side, flat rack, refrigerated)
- Fully responsive, mobile-first layout
- Quote/inquiry form per product

### Explicitly out of scope

- Wishlist (no icon, no page, no plugin)
- Elementor or any page builder (all templates are hand-written PHP, CSS, JS)
- The "Shipping Containers" mega/dropdown menu (navigation is flat; see section 7)
- Reliance on the reference site's category pages (they do not list all 20ft/40ft units, so we build our own attribute-based filtering)
- Privacy Policy and Terms of Service pages are left out of this build at the owner's request. Note: WooCommerce payment gateways, Google Merchant Center and most card processors require both, and US state privacy laws may apply to a store collecting customer data. Add them before launch or expect gateway or ad-account rejection. The theme should reserve the footer slots so they can be added in minutes.

## 3. Brand identity (original)

The look is original to this business and must not copy another company's name styling, logo, palette or text.

### Palette (CSS custom properties)

```css
:root {
  --c-navy-900: #0B1F33;   /* header, footer, primary dark */
  --c-navy-700: #14385A;
  --c-steel-500: #5B7083;  /* secondary text */
  --c-steel-200: #D5DDE5;  /* borders, dividers */
  --c-steel-50:  #F3F6F9;  /* section backgrounds */
  --c-orange-600: #E8610C; /* primary CTA, accents */
  --c-orange-700: #C24F06; /* CTA hover */
  --c-green-600: #1E8E5A;  /* success, in stock */
  --c-red-600: #C0392B;    /* errors, sale badge */
  --c-white: #FFFFFF;
  --c-text: #17212B;
}
```

All text/background pairs must meet WCAG AA contrast (4.5:1 body, 3:1 large text). White on `--c-orange-600` passes for 18px+ bold buttons; verify any other pairing.

### Typography

- Headings: Barlow Condensed 600/700 (industrial feel)
- Body/UI: Inter 400/500/600
- Self-host WOFF2 files in `/assets/fonts/`, `font-display: swap`, preload the two critical weights
- Fluid scale: `--fs-h1: clamp(2rem, 1.4rem + 3vw, 3.5rem)`, `--fs-h2: clamp(1.5rem, 1.2rem + 1.5vw, 2.25rem)`, body `1rem/1.6`

### Logo and imagery direction

- Wordmark plus a simple container-silhouette mark in SVG (navy and orange). Provide `logo.svg`, `logo-mono.svg`, `favicon.svg`, `favicon-512.png`.
- Corner radius 6px on cards and buttons, 1px steel borders, soft shadow `0 2px 8px rgba(11,31,51,.08)`.

## 4. Technical stack

- WordPress latest stable, PHP 8.2+, MySQL 8 / MariaDB 10.6+
- WooCommerce (latest stable), HPOS enabled
- Theme: `imch-theme` (classic PHP theme, no block theme, no page builder)
- CSS: hand-written, mobile-first, custom properties, BEM naming, no framework. Compile nothing; optionally split files and concatenate at build.
- JS: vanilla ES2020, no jQuery in theme code (WooCommerce core may load it; do not depend on it). Load with `defer`.
- Plugins allowed (keep the list short): WooCommerce, a payment gateway (Stripe and/or PayPal, owner's choice), an SMTP plugin, an SEO plugin or the theme's own schema module (pick one, not both), a caching plugin, a backup plugin. Nothing else without a stated reason.

## 5. Theme file structure

```
imch-theme/
  style.css                 (theme header only + tiny reset import)
  functions.php             (bootstrap, requires inc/*)
  header.php  footer.php  index.php  front-page.php
  page.php  page-contact.php  page-about.php  page-buyers-guide.php
  search.php  404.php  sidebar-shop.php
  inc/
    config.php              (business constants)
    setup.php               (theme supports, menus, image sizes)
    enqueue.php             (styles/scripts, conditional loading)
    woo-hooks.php           (all WooCommerce customizations)
    taxonomies.php          (product attributes registration)
    filters.php             (shop filter query logic + AJAX endpoint)
    schema.php              (JSON-LD output)
    options.php             (Theme Options page)
    forms.php               (inquiry + contact handlers, nonce, honeypot)
  woocommerce/
    archive-product.php  content-product.php  single-product.php
    cart/cart.php  checkout/form-checkout.php  myaccount/*.php
  template-parts/
    header-topbar.php  header-main.php  nav-drawer.php
    hero.php  trust-badges.php  how-it-works.php
    product-grid.php  why-choose-us.php  cta-band.php  footer-cols.php
    inquiry-form.php  spec-table.php  breadcrumbs.php
  assets/
    css/ base.css  layout.css  components.css  woo.css  pages.css
    js/  nav.js  filters.js  gallery.js  inquiry.js  quickview.js
    img/  fonts/  icons/ (SVG sprite)
```

## 6. Responsive system (critical requirement)

### Rules

- Mobile-first: base styles target 360px; enhance upward with `min-width` media queries only.
- Viewport tag must be exactly `<meta name="viewport" content="width=device-width, initial-scale=1">`. Do not disable zoom (the reference site does, which is an accessibility failure).
- Breakpoints: 480, 768, 1024, 1280, 1536 px.
- No horizontal scroll at any width from 320px to 2560px. Tables scroll inside `overflow-x:auto` wrappers.
- Touch targets at least 44x44px. Sticky mobile "Call / Get Quote" bar on product pages.
- Container max-width 1280px, side padding `clamp(16px, 4vw, 32px)`.
- Images: always `width`/`height` attributes (no layout shift), `loading="lazy"` below the fold, `srcset`/`sizes`, WebP with JPEG fallback.
- Use `aspect-ratio` for product images (4:3).

### Layout grid

- Product grid: 1 column under 480px (cards in a horizontal compact layout optional), 2 columns 480-1023px, 3 columns 1024-1279px, 4 columns 1280px+
- Shop page: filters become an off-canvas drawer under 1024px, sticky sidebar at 1024px+
- Footer: stacked accordion under 768px, 4 columns at 1024px+

### Test matrix (must pass before launch)

320, 360, 390, 414, 768, 820, 1024, 1280, 1440, 1920 px; Chrome, Safari iOS, Firefox, Edge; one landscape phone check.

## 7. Global components

### Top bar

Phone (click-to-call), email, support hours. On mobile, collapse to a single phone link.

### Header

- Logo left; desktop nav center; search, account, cart icons right. No wishlist icon.
- Flat menu items (no dropdowns): Home, Shop, 20ft Containers, 40ft Containers, Buyers Guide, About, Contact
- "20ft Containers" links to `/shop/?length=20ft`, "40ft Containers" to `/shop/?length=40ft`. These are filter URLs on the main shop, not category pages.
- Mobile: hamburger opens a full-height drawer (focus trap, Esc to close, `aria-expanded`), search field at top, big tap rows.
- Sticky header that shrinks on scroll; cart count updates via Woo fragments or a small fetch call.

### Footer

Columns: About blurb, Information (About, Contact, Shipping & Delivery, Refund & Returns, Payment Terms, Sales Tax Policy), Shop (20ft, 40ft, Buyers Guide, My Account), Contact info. Reserved empty slots for Privacy and Terms links (see scope note). Copyright line pulls the current year and site name.

## 8. Product data model

### Taxonomies (WooCommerce global attributes, registered in `taxonomies.php`)

| Attribute | Slug | Values |
| --- | --- | --- |
| Length | pa\_length | 20ft, 40ft |
| Height | pa\_height | Standard (8ft 6in), High Cube (9ft 6in) |
| Condition | pa\_condition | New (one-trip), Used - Cargo Worthy, Used - Wind & Watertight, As-Is |
| Type | pa\_type | Dry Storage, Open Side, Flat Rack, Refrigerated, Other |
| Grade | pa\_grade | A, B, C (owner-defined) |
| Color | pa\_color | owner-defined |

Product categories are used only for broad merchandising (for example "Featured"); all filtering uses attributes. This is how the 20ft/40ft set is guaranteed complete: every product must carry `pa_length`, enforced by a validation hook that blocks publishing without it.

### Product fields

Title, slug, short description, long description, regular price, optional sale price, SKU, stock status, weight, gallery (1 featured + up to 8), attributes above, plus custom meta shown in a spec table: external dimensions, internal dimensions, door opening, tare weight, max payload, cubic capacity, floor type, location of unit (city/state for delivery quoting).

### Catalog build

- Build the catalog from the owner's actual inventory. Provide a CSV import template (`products-template.csv`) with columns: name, sku, price, sale\_price, length, height, condition, type, grade, color, stock, ext\_dims, int\_dims, door\_opening, tare\_kg, payload\_kg, cubic\_m3, location, short\_desc, long\_desc, image\_filenames.
- Use the WooCommerce CSV importer; images are matched by filename from `/wp-content/uploads/import/`.
- Seed 8-12 launch products across both sizes and several conditions.

### Images: sourcing and pipeline

Product photos must be images the business has the right to use: own photographs, photos supplied by the container depot or supplier (get written permission), or licensed stock. Do not scrape or hot-link photos from intermobilecontainer.com or any other seller. They are that company's copyrighted work, and reusing them on a near-identical storefront is the single biggest legal and payment-processor risk in this project. If the owner wants a research crawl for page-structure or spec-field ideas only, limit it to reading public text and layout for reference and discard it afterward.

Image pipeline:

- Required shots per unit: front, door end, side, interior, door seal/floor detail, ID plate or CSC plate, corner casting
- Export sizes: 1600px long edge master, plus theme sizes `imch-card` 640x480, `imch-gallery` 1200x900, `imch-thumb` 150x112
- Convert to WebP at quality 78-82, keep JPEG fallback
- Naming: `20ft-high-cube-one-trip-front.jpg` (lowercase, hyphens)
- Alt text pattern: "20ft high cube one-trip shipping container, front view"
- Generic placeholder `placeholder-container.svg` while photos are pending

## 9. Pages

### Home (`front-page.php`)

1. Hero: headline, one-line promise, two CTAs (Shop 20ft, Shop 40ft), background image with dark navy overlay for text contrast, fully responsive crop
2. Trust strip: four badges (secure checkout, delivery information up front, condition clearly graded, direct phone support)
3. Size selector: two large cards, 20ft and 40ft, each linking to the filtered shop
4. Featured products grid (8 items, mixed sizes)
5. How ordering works (5 steps): browse, add to cart or request a quote, review delivery cost, pay, delivery scheduling
6. Condition guide teaser: short explainer of one-trip, cargo-worthy, wind and watertight with link to Buyers Guide
7. Why choose us: four original, specific points (no generic filler)
8. FAQ accordion (6-8 questions, outputs FAQ schema)
9. CTA band: phone number and quote button

All copy is original and written for this business.

### Shop (`archive-product.php`)

- Header with result count, sort dropdown (price asc/desc, newest, size)
- Filters: Length, Height, Condition, Type, Price range. AJAX update with URL state (`?length=20ft&condition=one-trip`), graceful no-JS fallback via normal GET.
- Active filter chips with clear-all
- Pagination (12 per page) with numbered links
- Card contents: image, title, key spec line (length, height, condition), price (sale price with original struck through and percentage badge), Add to Cart, Request Quote
- Quick view modal (phase 2)

### Single product

- Gallery with thumbnails and swipe on touch, lightbox zoom
- Title, price, stock, condition badge, spec summary
- Add to cart, Request Quote (opens inquiry form), click-to-call
- Delivery estimate box: ZIP field that shows the flat delivery rate or "we will confirm" message depending on shipping zone rules
- Tabs/accordions: Description, Specifications table, Delivery & Returns, FAQ
- Related products (same length, different condition)
- Sticky bottom bar on mobile with price and primary CTA

### Cart and checkout

- Cart: line items, quantity, remove, delivery line, tax line, coupon field, proceed button; stacked cards on mobile
- Checkout: single page, billing/shipping, a required "Delivery site details" block (site type, surface, access width, truck access yes/no, contact on site), order notes, payment gateway, policy acknowledgment checkbox linking to Shipping, Refund and Payment Terms pages
- Guest checkout enabled, account creation optional
- Order emails styled with brand colors

### My Account

Dashboard, orders, addresses, account details, lost password, register. Fully styled, responsive.

### Content pages

About, Contact (form + map link + contact block + hours), Buyers Guide (container sizes, conditions, what to check, site prep, delivery process, permits note), Shipping & Delivery, Refund & Returns, Payment Terms, Sales Tax Policy. Write policy text with the owner's real terms; mark every unresolved policy value clearly as `[OWNER TO CONFIRM]` rather than inventing terms.

## 10. Commerce configuration

- Shipping: zone "United States" with a configurable flat rate per container (default value set by owner), plus a rule that flags remote or restricted-access addresses as "quote required". The flat rate and wording are Theme Options values, never hard-coded.
- Tax: use WooCommerce tax settings with state rates; configure Texas first and let the owner add others.
- Payments: owner chooses gateways. Provide test-mode instructions and a go-live checklist.
- Inquiry forms: fields name, email, phone, delivery ZIP, product (auto-filled), message. Nonce, honeypot, rate limit, server-side validation, email to info@intermobilecontainershub.com, store as a private custom post type, auto-reply to the sender.

## 11. SEO and structured data

- Unique title/meta description per page via theme functions, canonical tags, clean permalinks (`/product/%postname%/`)
- JSON-LD: Organization, LocalBusiness (using the Austin address), WebSite with SearchAction, BreadcrumbList, Product with Offer and availability, FAQPage
- XML sitemap and robots.txt (disallow cart, checkout, my-account, filter query strings)
- `noindex` on filter-parameter URLs, canonical to the clean shop
- Open Graph and Twitter card tags with brand image
- Heading hierarchy: one H1 per page

## 12. Performance targets

- Mobile Lighthouse: Performance 85+, Accessibility 95+, Best Practices 95+, SEO 95+
- LCP under 2.5s, CLS under 0.1, INP under 200ms
- Total CSS under 60KB gzipped, theme JS under 40KB gzipped
- Critical CSS inlined for the home hero, remaining CSS deferred
- Load WooCommerce scripts and styles only on shop, product, cart, checkout and account pages
- Disable emoji script, embeds, and unused block styles

## 13. Security and accessibility

- Escape all output, sanitize all input, nonces on every form, capability checks on admin actions
- Limit login attempts, hide wp-login from obvious bots, disable XML-RPC, file editing off
- Force HTTPS, HSTS, security headers
- Keyboard-navigable everything, visible focus ring, skip link, ARIA labels on icon buttons, `prefers-reduced-motion` respected, form errors announced with `aria-live`

## 14. Build phases

1. Foundation: theme skeleton, config, CSS variables, base styles, header/footer, mobile drawer
2. Commerce core: attributes, product template, archive with filters, single product, cart, checkout
3. Content: home sections, About, Contact, Buyers Guide, policy pages
4. Forms and email: inquiry, contact, auto-replies, order emails
5. SEO and schema, performance pass, accessibility pass
6. QA on the device matrix, test orders in gateway test mode, launch checklist

## 15. Acceptance checklist

- Every product has a length attribute and appears under the correct 20ft or 40ft filter
- No wishlist, no Elementor, no dropdown menu anywhere in markup or CSS
- No horizontal scroll at 320px; zoom enabled
- All business details come from the config, and a single edit updates the whole site
- Test order completes end to end, emails arrive, tax and delivery lines are correct
- Lighthouse targets met on mobile
- All images are owned or licensed, with alt text
- Policy pages contain no unconfirmed placeholder text at launch
- Privacy and Terms pages added or the owner has signed off on launching without them

## 16. Rules for the AI building this

- Follow the file structure exactly; do not add plugins not listed
- Write original copy; never paste text from another seller's website
- Ask the owner for any missing business value (hours, delivery rate, policy terms) instead of inventing it
- Commit work in the phase order above and run the responsive test matrix after each phase
- Prefer simple, readable code over clever abstractions
