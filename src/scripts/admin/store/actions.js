// WordPress dependencies.
import { apiFetch } from '@wordpress/data-controls';

/**
 * Font Control Actions
 */

// Hydrate
export const hydrateFontControls = fontControls => {
  return {
    type: 'HYDRATE_FONT_CONTROLS',
    payload: { fontControls }
  };
};

/**
 * Create Font Control
 *
 * @param {string} name Name of font control.
 * @param {array} selectors CSS selectors.
 * @param {boolean} forceStyles Force the !important css rule.
 * @param {string} description Description used in the customizer interface.
 */
export function* createFontControl({ name, selectors, forceStyles, description }) {
  const path = '/wp/v2/easy-google-fonts';
  const fontControl = yield apiFetch({
    path,
    method: 'POST',
    data: {
      title: name,
      status: 'publish',
      meta: {
        control_selectors: selectors,
        control_description: description,
        force_styles: forceStyles
      }
    }
  });

  return {
    type: 'CREATE_FONT_CONTROL',
    payload: {
      id: fontControl.id,
      fontControl
    }
  };
}

/**
 * Update Font Control
 *
 * @param {string} name Name of font control.
 * @param {array} selectors CSS selectors.
 * @param {boolean} forceStyles Force the !important css rule.
 * @param {string} description Description used in the customizer interface.
 */
export function* updateFontControl({ id, name, selectors, forceStyles, description }) {
  const path = `/wp/v2/easy-google-fonts/${id}`;
  const fontControl = yield apiFetch({
    path,
    method: 'POST',
    data: {
      title: name,
      meta: {
        control_selectors: selectors,
        control_description: description,
        force_styles: forceStyles
      }
    }
  });

  return {
    type: 'UPDATE_FONT_CONTROL',
    payload: {
      id: fontControl.id,
      fontControl
    }
  };
}

/**
 * Update Font Controls Force Styles
 * @param {*} id
 */
export function* updateFontControlForceStyles({ id, forceStyles }) {
  const path = `/wp/v2/easy-google-fonts/${id}`;

  const fontControl = yield apiFetch({
    path,
    method: 'POST',
    data: {
      meta: {
        force_styles: forceStyles
      }
    }
  });

  return {
    type: 'UPDATE_FONT_CONTROL_FORCE_STYLES',
    payload: { id, fontControl }
  };
}

/**
 * Delete Font Control
 * @param {int} id Post ID of the font control to delete.
 */
export function* deleteFontControl(id) {
  const path = `/wp/v2/easy-google-fonts/${id}`;
  const deleteFontControl = yield apiFetch({ path, method: 'DELETE' });

  return {
    type: 'DELETE_FONT_CONTROL',
    payload: { id, deleteFontControl }
  };
}

/**
 * Delete All Font Controls
 */
export function* deleteAllFontControls() {
  const path = '/easy-google-fonts/v1/font_controls';
  const completed = yield apiFetch({ path, method: 'DELETE' });

  return {
    type: 'DELETE_ALL_FONT_CONTROLS',
    payload: { completed }
  };
}
