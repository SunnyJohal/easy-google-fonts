/**
 * Font Control Selectors
 * @param {*} name
 */
export const getFontControls = state => {
  return state.fontControls || {};
};

export const getFontControl = (state, id) => {
  return state.fontControls[id] || {};
};
