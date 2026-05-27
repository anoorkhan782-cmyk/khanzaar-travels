# 🧪 Khanzaar Travel Website — Test Suite

## 📁 Folder Structure

```
tests/
├── Unit/
│   ├── AuthTest.php        ← Login/Register validation tests (6 tests)
│   └── TravelTest.php      ← Booking/Package validation tests (8 tests)
└── E2E/
    └── cypress/
        └── e2e/
            └── khanzaar.cy.js  ← E2E browser tests (5 tests)
```

---

## ✅ Unit Tests (PHPUnit) — 14 Tests Total

### How to Run Locally:

```bash
# Step 1: Install PHPUnit
composer install

# Step 2: Run tests
composer test
```

### What is tested:
| Test | Description |
|------|-------------|
| Valid email format | Checks correct email passes |
| Invalid email format | Checks wrong email is rejected |
| Password min length | Password must be 6+ chars |
| Short password fails | Short password is rejected |
| Empty username | Empty username is caught |
| Username trimming | Spaces removed from username |
| Package price positive | Price must be > 0 |
| Zero price invalid | Price = 0 is rejected |
| Destination not empty | Destination name required |
| Travellers count | At least 1 traveller needed |
| Total price calc | price × travellers = total |
| Phone number length | Pakistani number = 11 digits |
| Admin role check | Admin role identified |
| User role check | User ≠ admin |

---

## 🌐 E2E Tests (Cypress) — 5 Tests Total

### Setup:

```bash
# Step 1: Install Cypress
npm install

# Step 2: Run tests (headless)
npm run test:e2e

# Step 3: Open Cypress UI (visual)
npm run test:e2e:open
```

### ⚠️ Important — Update your URL:
In `cypress.config.js`, change:
```js
baseUrl: "http://khanzaar.infinityfreeapp.com"
```
to your actual InfinityFree URL.

### What is tested:
| Test | Description |
|------|-------------|
| Homepage loads | Site opens successfully |
| Login page accessible | Login form is visible |
| Wrong login shows error | Invalid credentials rejected |
| Register page accessible | Register form is visible |
| Packages visible | Travel packages shown on homepage |

---

## 🔄 CI/CD — GitHub Actions

The file `.github/workflows/ci.yml` automatically runs:
- ✅ PHPUnit tests on every `git push`
- ✅ Cypress E2E tests on every `git push`

This earns you the **5 bonus marks**!
