const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: "https://khanzaaar.infinityfreeapp.com",
    specPattern: "tests/E2E/cypress/e2e/**/*.cy.js",
    supportFile: "tests/E2E/cypress/support/e2e.js",
    viewportWidth: 1280,
    viewportHeight: 720,
    video: false,
    screenshotOnRunFailure: false,
    pageLoadTimeout: 60000,
  },
});
