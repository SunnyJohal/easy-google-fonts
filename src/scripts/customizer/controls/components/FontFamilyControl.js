import Select from 'react-select';
import { createRef } from '@wordpress/element';
import { _x } from '@wordpress/i18n';
import { sanitizeFontKey } from '../../utils/sanitizeFontKey';
import { getFontById } from '../../utils/getFontById';

/**
 * Get Local Font Options
 */
const getLocalFontOptions = subset => {
  const { default_fonts } = window.egfCustomize;

  return [
    {
      label: 'local-fonts',
      options: Object.keys(default_fonts)
        .map(font => {
          const fontProps = default_fonts[font];
          return {
            ...fontProps,
            label: fontProps.family,
            value: sanitizeFontKey(fontProps.family)
          };
        })
        .filter(font => {
          // Backwards compatibility.
          if ('all' === subset || 'latin,all' === subset || !subset) {
            return true;
          }

          return font.subsets.includes(subset);
        })
    }
  ];
};

/**
 * Get Google Font Options
 */
const getGoogleFontOptions = subset => {
  const { egfGoogleFontsByCategory } = window;
  return Object.keys(egfGoogleFontsByCategory).map(category => {
    return {
      label: category,
      options: egfGoogleFontsByCategory[category].filter(font => {
        // Backwards compatibility.
        if ('all' === subset || 'latin,all' === subset || !subset) {
          return true;
        }

        return font.subsets.includes(subset);
      })
    };
  });
};

/**
 * Font Family Control
 */
const FontFamilyControl = props => {
  const { className, control } = props;
  const { updateSettingProps, setting } = control;
  const { subset, font_id } = setting();

  const localFonts = getLocalFontOptions(subset);
  const googleFonts = getGoogleFontOptions(subset);
  const groupedOptions = [...localFonts, ...googleFonts];

  /**
   * Set Font Callback
   */
  const setFont = font => {
    const { family, variants = [] } = font;

    const hasRegularFontWeight = variants.includes('regular');
    const fontWeightStyle = hasRegularFontWeight ? 'regular' : variants[0];
    const fontWeight = Number.isNaN(parseInt(fontWeightStyle, 10)) ? 400 : parseInt(fontWeightStyle, 10);
    const fontStyle = fontWeightStyle.includes('italic') ? 'italic' : 'normal';

    updateSettingProps({
      props: {
        font_id: `${sanitizeFontKey(family)}`,
        font_name: family,
        font_weight_style: fontWeightStyle,
        font_weight: fontWeight,
        font_style: fontStyle,
        stylesheet_url: ''
      },
      renderAfterUpdate: false
    });
  };

  /**
   * Reset Font Callback
   */
  const resetDefaultFont = () => {
    const { font_id, font_name, font_weight_style, font_weight, font_style, stylesheet_url } =
      control.settings.default.default;

    updateSettingProps({
      props: {
        font_id,
        font_name,
        font_weight_style,
        font_weight,
        font_style,
        stylesheet_url
      },
      renderAfterUpdate: true
    });
  };

  // TODO: Polish off the translations.
  // TODO: Look at selection on keyboard arrow.

  const ref = createRef();

  return (
    <div className={`egf-font-family-control ${className}`}>
      <div className="components-base-control">
        <label className="components-input-control__label" onClick={() => ref.current.focus()}>
          {_x('Font Family', 'Font family field label for the customizer font control.', 'easy-google-fonts')}
        </label>
        <Select
          ref={ref}
          value={getFontById(font_id)}
          options={groupedOptions}
          openMenuOnFocus={true}
          closeMenuOnSelect={false}
          isSearchable={true}
          isClearable={font_id !== control.settings.default.default.font_id}
          theme={theme => ({
            ...theme,
            colors: {
              ...theme.colors,
              primary: '#007cba',
              primary75: '#589dcc',
              primary50: '#91bedd',
              primary25: '#c8deed'
            }
          })}
          onChange={font => {
            if (font) {
              setFont(font);
            } else {
              resetDefaultFont();
            }
          }}
        />
      </div>
    </div>
  );
};

export default FontFamilyControl;
