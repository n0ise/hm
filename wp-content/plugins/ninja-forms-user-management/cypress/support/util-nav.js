import {
    url
  } from "../support/util";
/*
 * NAVIGATE TO PAGES
 **********/

export const goToMainDashboard = ()=>{
  cy.visit(`${url}/wp-admin/index.php`);
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
 * Return full WP URL for a given admin page
 * @param {string} pluginSlug
 * @returns
 */
function adminPageUrl(pluginSlug) {
  return `${url}/wp-admin/admin.php?page=${pluginSlug}`;
}
