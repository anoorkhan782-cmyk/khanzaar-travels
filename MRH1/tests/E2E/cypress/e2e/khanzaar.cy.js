// ═══════════════════════════════════════════════════════════
// Khanzaar Travel Website — E2E Test (Cypress)
// Tests: Homepage, Login, Admin Dashboard
// ═══════════════════════════════════════════════════════════

// 🔁 Change this to your InfinityFree live URL
const BASE_URL = "http://khanzaar.infinityfreeapp.com";

describe("Khanzaar Travel Website - E2E Tests", () => {

  // ───────────────────────────────────────────
  // TEST 1: Homepage loads successfully
  // ───────────────────────────────────────────
  it("should load the homepage", () => {
    cy.visit(BASE_URL);
    cy.get("body").should("be.visible");
    // Check that page title or main heading exists
    cy.title().should("not.be.empty");
  });

  // ───────────────────────────────────────────
  // TEST 2: Login page is accessible
  // ───────────────────────────────────────────
  it("should open the login page", () => {
    cy.visit(`${BASE_URL}/login.php`);
    cy.get("input[type='email'], input[name='email'], input[name='username']")
      .should("be.visible");
    cy.get("input[type='password']").should("be.visible");
  });

  // ───────────────────────────────────────────
  // TEST 3: Login with wrong credentials shows error
  // ───────────────────────────────────────────
  it("should show error on invalid login", () => {
    cy.visit(`${BASE_URL}/login.php`);

    // Type wrong credentials
    cy.get("input[name='email'], input[name='username']")
      .first()
      .type("wronguser@test.com");
    cy.get("input[type='password']").type("wrongpassword");

    // Submit form
    cy.get("button[type='submit'], input[type='submit']").click();

    // Should show some error (not redirect to dashboard)
    cy.url().should("include", "login");
  });

  // ───────────────────────────────────────────
  // TEST 4: Register page is accessible
  // ───────────────────────────────────────────
  it("should open the register page", () => {
    cy.visit(`${BASE_URL}/register.php`);
    cy.get("input[type='email'], input[name='email']").should("be.visible");
    cy.get("input[type='password']").should("be.visible");
    cy.get("button[type='submit'], input[type='submit']").should("exist");
  });

  // ───────────────────────────────────────────
  // TEST 5: Travel packages visible on homepage
  // ───────────────────────────────────────────
  it("should display travel packages on homepage", () => {
    cy.visit(BASE_URL);
    // Adjust selector to match your actual package cards/section
    cy.get("body").should("contain.text", "Package")
      .or("contain.text", "Tour")
      .or("contain.text", "Travel")
      .or("contain.text", "Destination");
  });

});
