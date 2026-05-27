// Cypress support file for Khanzaar Travel Website
// Add custom commands here if needed

Cypress.on("uncaught:exception", (err) => {
  // Prevent Cypress from failing on unhandled JS errors on the page
  return false;
});
