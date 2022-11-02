import {
  login,
  activatePlugin,
} from "../support/util";

import {
  textboxValueByName,
} from "../support/util-inputs";

import {
  goToNfSettingsPage,
  saveNfSettings,
} from "../support/util-nf";

/**
 * Tests for retrieving Active Campaign fields
 */
describe("Ensure NF Settings page displays correctly", () => {
  it("logs in and activates the Active Campaign plugin and Ninja Forms", () => {
    login();
    activatePlugin("ninja-forms");
    activatePlugin("ninja-forms-user-management");
  });

  it("visits the NF Settings page", () => {
    goToNfSettingsPage();
  });
});

