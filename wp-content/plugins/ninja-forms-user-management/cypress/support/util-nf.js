import {
  adminPageUrl,
  visitAdminPageBySlug,
  buttonClickByTitle,
} from "../support/util";
/*
 * FORM EDITING COMMANDS
 **********/
/**
 * Create a new form
 */
export const createNewForm = () => {
  visitAdminPageBySlug("ninja-forms&form_id=new");
  cy.wait(1000);
  buttonClickByTitle("Done");
};

/**
 * Edit a form given a form Id
 *
 * @param {int} formId
 */
export const editFormById = (formId) => {
  visitAdminPageBySlug( "ninja-forms&form_id=" + formId);
};

/**
 * In form editor, go to Display Settings on Advanced tab
 */
export const goToDisplaySettings = () => {
  goToAdvancedTab();
  cy.get(".nf-setting-wrap.display").click();
};

/**
 * In form editor, click Advanced tab
 */
export const goToAdvancedTab = () => {
  cy.get('.nf-app-menu a[title="Advanced"]').click();
};

/**
 * In form editor, click Emails & Actions tab
 */
export const goToEmailsActionsTab = () => {
  cy.get('.nf-app-menu a[title="Emails & Actions"]').click();
};

/**
 * Click to add an action to a form
 *
 * Used on Emails and Actions tab, perhaps elsewhere also
 * @param {string} buttonDataType
 */
export const buttonClickAddAction = (buttonDataType) => {
  cy.get('div[data-type="' + buttonDataType + '"]').click();
};

/**
 * Click to add an action
 *
 * Used on Emails and Actions tab, perhaps elsewhere also
 * @param {string} buttonDataType
 */
export const buttonClickByActionType = (buttonDataType) => {
  cy.get('div[data-type="' + buttonDataType + '"]').click();
};

/**
 * Set the form title
 * @param {string} formTitle
 */
export const setFormTitle = (formTitle) => {
  goToDisplaySettings();
  textboxValueById("title", formTitle);
  buttonClickByTitle("Done");
};

/**
 * Publish form, with 'add submit button?' verification
 */
export const publishFormWithVerify = () => {
  buttonClickByTitle("Publish");

  // Verfication button for adding submit field
  cy.get("a.nf-button.primary.nf-close-drawer.publish").click();
  cy.wait(500);
};

/*
 * FORM SETTINGS PAGE COMMANDS
 **********/
/**
 * Go to the NF Settings page
 */
export const goToNfSettingsPage = () => {
  cy.visit(adminPageUrl("nf-settings"));
};

/**
 * Got to the Licenses tab
 */
export const goToLicensesTab = () => {
  visitAdminPageBySlug("nf-settings&tab=licenses");
};

/**
 * Enable `Developer Mode`
 */
export const enableDevMode = () => {
  goToNfSettingsPage();
  cy.wait(500);
  cy.get(
    "input[type = 'checkbox'][name='ninja_forms[builder_dev_mode]']"
  ).check();
  saveNfSettings();
};

/**
 * Activates a license
 *
 * @param {string} licenseSlug
 * @param {string} licenseKey
 */
export const activateLicense = (licenseSlug, licenseKey) => {
  goToLicensesTab();
  cy.get("input[value='" + licenseSlug + "'] + input")
    .clear()
    .type(licenseKey);
  cy.get("input[value='" + licenseSlug + "'] ~ button").click();
};

/**
 * Save settings when on NF Settings page
 */
export const saveNfSettings = () => {
  cy.get("input[value = 'Save Settings']").click();
};
