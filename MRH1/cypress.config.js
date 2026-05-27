const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    // 🔁 Change this to your InfinityFree live URL
    baseUrl: "https://khanzaaar.infinityfreeapp.com",
    specPattern: "tests/E2E/cypress/e2e/**/*.cy.js",
    supportFile: "tests/E2E/cypress/support/e2e.js",
    viewportWidth: 1280,
    viewportHeight: 720,
    video: false,
    screenshotOnRunFailure: true,
  },
});
