/*
 * INTERACT WITH INPUTS
 * includes textboxes and buttons
 **********/
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
  cy.get("input[name='" + elementName + "']")
    .clear()
    .type(newTextboxValue);
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
 * Click a button with a given name
 * 
 * @param {string} buttonName
 */
export const clickInputByName = (buttonName) => {
  cy.get('input[name="' + buttonName + '"]').click();
};

/**
 * Click any element with the given text
 * 
 * @param {string} buttonText 
 */
export const clickByButtonText = (buttonText)=>{
  cy.contains(buttonText).click();
};