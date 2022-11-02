/**
 * Get site details
 * @type {any}
 */
export const site = Cypress.env("wp_site");
export const { url, user, pass } = site;

/**
 * Typical element selectors
 */
export const CF_form_element =
  "#caldera-forms-admin-page-left .form-panel-wrap table tbody tr.form_entry_row:first-child ";
export const converter_span = ".export-to-nf ";
export const converter_button = ".cf-converter-modal-action ";
export const converter_modal = ".cf-converter-modal ";
export const converter_action_buttons = ".cf-converter-buttons ";

/**
 * Login to the site
 *
 * @since unknown
 */
export const login = () => {
  cy.visit(url + "/wp-login.php");
  cy.wait(250);
  cy.get("#user_login").clear().type(user);
  cy.get("#user_pass").clear().type(pass);
  cy.get("#wp-submit").click();
};

/**
 * Activate a plugin
 * @param {string} pluginSlug
 */
export const activatePlugin = (pluginSlug) => {
  cy.visit(url + "/wp-admin/plugins.php");
  const selector = 'tr[data-slug="' + pluginSlug + '"] .activate a';
  if (Cypress.$(selector).length > 0) {
    cy.get(selector).click();
  }
  cy.log("Activating " + pluginSlug);
};

/**
 * Edit a form given a form Id
 *
 * @param {int} formId
 */
export const editFormById = (formId) => {
  cy.visit(`${url}/wp-admin/admin.php?page=ninja-forms&form_id=` + formId);
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
 * Got to the Licenses tab
 */
export const goToLicensesTab = () => {
  visitAdminPageBySlug('nf-settings&tab=licenses');
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

export const publishFormWithVerify = () => {
  buttonClickByTitle("Publish");

  // Verfication button for adding submit field
  cy.get("a.nf-button.primary.nf-close-drawer.publish").click();
  cy.wait(500);
};

/**
 * Type new textbox value into input of given Id
 *
 * @param {string} elementId
 * @param {string} newTextboxValue
 */
export const textboxValueById = (elementId, newTextboxValue) => {
  cy.get("input#" + elementId)
    .clear()
    .type(newTextboxValue);
};
/**
 * Type new textbox value into input of given name
 *
 * @param {string} elementName
 * @param {string} newTextboxValue
 */
export const textboxValueByName = (elementName, newTextboxValue) => {
  cy.get("input[name='" + elementName+"']")
    .clear()
    .type(newTextboxValue);
};

/**
 * Activates a license
 * 
 * @param {string} licenseSlug 
 * @param {string} licenseKey 
 */
export const activateLicense = (licenseSlug, licenseKey)=>{
  goToLicensesTab();
  cy.get("input[value='"+licenseSlug+"'] + input").clear().type(licenseKey);
  cy.get("input[value='"+licenseSlug+"'] ~ button").click();
};
/**
 * Click a button with a given title
 *
 * @param {string} buttonTitle
 */
export const buttonClickByTitle = (buttonTitle) => {
  cy.get('a[title="' + buttonTitle + '"]').click();
};



/**
 * Click a button with a given data type
 *
 * Used on Emails and Actions tab, perhaps elsewhere also
 * @param {string} buttonDataType
 */
export const buttonClickByDataType = (buttonDataType) => {
  cy.get('a[data-type="' + buttonDataType + '"]').click();
};

/**
 * Visit a page slug
 *
 * @param {string} pageSlug
 */
export const visitPageBySlug = (pageSlug) => {
  cy.visit(`${url}/${pageSlug}`);
};

/**
 * Visit an admin page of a given slug
 *
 * @param {string} pageSlug
 */
export const visitAdminPageBySlug = (pageSlug) => {
  cy.visit(adminPageUrl(pageSlug));
};

/**
 * Save settings when on NF Settings page
 */
export const saveNfSettings = () => {
  cy.get("input[value = 'Save Settings']").click();
};

/**
 * Return full WP URL for a given admin page
 * @param {string} pluginSlug
 * @returns
 */
export function adminPageUrl(pluginSlug) {
  return `${url}/wp-admin/admin.php?page=${pluginSlug}`;
}
