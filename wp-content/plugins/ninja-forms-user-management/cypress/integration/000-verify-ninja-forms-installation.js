import {
  login,
  activatePlugin,
  visitAdminPageBySlug,
} from "../support/util";

import {
  buttonClickByTitle,
  textboxValueById,
} from "../support/util-inputs";

import {
  editFormById,
  goToDisplaySettings,
  enableDevMode,
} from "../support/util-nf";
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
describe("Ensure that Ninja Forms is operational", () => {
  it("logs into the site and activates Ninja Forms", () => {
    login();
    activatePlugin("ninja-forms");
  });
  
  it("enables Developer Mode",()=>{
    enableDevMode();
  });
  /**
   * Edit contact form to add action
   */
  it("opens the default Ninja Forms form for editing", () => {
    editFormById(1);
  });

  it("changes the form name", () => {
    goToDisplaySettings();
    textboxValueById("title", "This is the modified form title");
    buttonClickByTitle("Done");
    buttonClickByTitle("Publish");
  });

  it("returns to the Ninja Forms dashboard", () => {
    visitAdminPageBySlug("ninja-forms");
  });
});
