/**
 * Theme JS building
 */

// Require 3rd party libraries
require('babel-polyfill');
require('milligram');

// Run the theme scripts.
let Theme = require( __dirname + '/theme.js' );

// Export the theme controller for global usage.
window.Theme = Theme;

// Require global scripts
let globalControllers = [
    require(__dirname + '/common.js'),
];

// Require template-specific scripts.
let templateControllers = [
    require(__dirname + '/index.js'),
];

// Pass the required scripts and construct the global ones first.
Theme.setGlobalControllers(globalControllers);
Theme.setTemplateControllers(templateControllers);

// Require main style file here for concatenation.
require(__dirname + '/../styles/main.scss');
