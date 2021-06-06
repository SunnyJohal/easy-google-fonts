// WordPress dependencies.
import { __, sprintf } from '@wordpress/i18n';
import { apiFetch } from '@wordpress/data-controls';
import { addQueryArgs } from '@wordpress/url';

import { hydrateFontControls } from './actions';

/**
 * Font Control Retrieval Resolvers
 */
export function* getFontControls() {
  const path = addQueryArgs('/wp/v2/easy-google-fonts', {
    per_page: -1,
    order: 'asc',
    orderby: 'title',
    _fields: ['id', 'title', 'meta']
  });

  const fontControls = yield apiFetch({ path });

  if (fontControls) {
    let allFontControls = {};
    for (let fontControl of fontControls) {
      allFontControls[fontControl.id] = fontControl;
    }

    return hydrateFontControls(allFontControls);
  }

  return;
}
