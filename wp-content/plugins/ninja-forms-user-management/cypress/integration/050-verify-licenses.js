import { login, activatePlugin, activateLicense } from "../support/util";


/**
 * Before tests, login
 *
 * This is an anti-pattern
 * @todo Use wp-cli or basic authentication headers
 */
before(() => {});

/**
 * Tests ensuring Ninja Forms is properly loaded
 */
describe("Ensure that Active Campaign licensing is functional", () => {
  it("logs into the site and activates Ninja Forms", () => {
    login();
    activatePlugin("ninja-forms");
  });

  it("adds license", () => {
    activateLicense("user-management", Cypress.env('userManagementLicenseKey'));
    cy.contains("De-activate");
  });
});
