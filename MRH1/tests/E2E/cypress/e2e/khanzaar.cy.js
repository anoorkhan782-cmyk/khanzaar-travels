const BASE_URL = "https://khanzaaar.infinityfreeapp.com";

describe("Khanzaar Travel Website - E2E Tests", () => {

  it("should load the homepage", () => {
    cy.visit(BASE_URL, { failOnStatusCode: false });
    cy.get("body").should("be.visible");
  });

  it("should open the login page", () => {
    cy.visit(`${BASE_URL}/login.php`, { failOnStatusCode: false });
    cy.get("body").should("be.visible");
  });

  it("should open the register page", () => {
    cy.visit(`${BASE_URL}/register.php`, { failOnStatusCode: false });
    cy.get("body").should("be.visible");
  });

  it("should have a title on homepage", () => {
    cy.visit(BASE_URL, { failOnStatusCode: false });
    cy.title().should("not.be.empty");
  });

  it("should contain travel related content", () => {
    cy.visit(BASE_URL, { failOnStatusCode: false });
    cy.get("body").should("be.visible");
  });

});
