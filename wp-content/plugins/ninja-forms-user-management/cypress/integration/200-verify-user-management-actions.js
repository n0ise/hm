import {
  login,
  activatePlugin,
  publishFormWithVerify,
  setFormTitle,
} from "../support/util";

import {
  buttonClickByTitle,
  textboxValueById,
  textboxValueByName
} from "../support/util-inputs";

import {
  buttonClickByActionType,
  createNewForm,
  goToEmailsActionsTab,
  goToNfSettingsPage,
  saveNfSettings
} from "../support/util-nf";


/**
 * Tests for adding User Management actions
 */
describe("Ensure Login User action can be created and published", () => {
  it("logs in and activates the User Management plugin and Ninja Forms", () => {
    login();
    activatePlugin("ninja-forms");
    activatePlugin("ninja-forms-user-management");
  });

  /**
   * Edit contact form to add action
   */
  it("creates a new form", () => {
    createNewForm();
    setFormTitle("Verify adding User Management Actions");
  });

  it("adds a new Login User action", () => {
    goToEmailsActionsTab();
    buttonClickByTitle("Add new action");
    buttonClickByActionType("login-user");

    const newTextboxValue = "My first Login User action";
    cy.wait(500);

    textboxValueById("label", newTextboxValue);

    buttonClickByTitle("Done");

    publishFormWithVerify();
  });

  it("adds a new Register User action", () => {
    goToEmailsActionsTab();
    buttonClickByTitle("Add new action");
    buttonClickByActionType("register-user");

    const newTextboxValue = "My first Register User action";
    cy.wait(500);

    textboxValueById("label", newTextboxValue);

    buttonClickByTitle("Done");

  });

  it("adds a new Update Profile action", () => {
    goToEmailsActionsTab();
    buttonClickByTitle("Add new action");
    buttonClickByActionType("update-profile");

    const newTextboxValue = "My first Update Profile action";
    cy.wait(500);

    textboxValueById("label", newTextboxValue);

    buttonClickByTitle("Done");

  });

  it("publishes the form",()=>{

    buttonClickByTitle("Publish");
  });
});

