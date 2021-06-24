import { useState } from '@wordpress/element';
import { SelectControl } from '@wordpress/components';

import FontLanguageControl from './components/FontLanguageControl';
import FontFamilyControl from './components/FontFamilyControl';
import FontWeightControl from './components/FontWeightControl';

const FontSettings = ({
  control,
  fontId,
  setFontId,
  fontName,
  setFontName,
  fontWeightStyle,
  setFontWeightStyle,
  fontWeight,
  setFontWeight,
  fontStyle,
  setFontStyle,
  stylesheetUrl,
  setStylesheetUrl,
  subset,
  setSubset,
  textDecoration,
  setTextDecoration,
  textTransform,
  setTextTransform
}) => {
  return (
    <div className="egf-font-settings__settings">
      <FontLanguageControl control={control} subset={subset} setSubset={setSubset} className="mb-3" />
      <FontFamilyControl
        control={control}
        subset={subset}
        fontId={fontId}
        setFontId={setFontId}
        fontName={fontName}
        setFontName={setFontName}
        fontWeight={fontWeight}
        setFontWeight={setFontWeight}
        fontStyle={fontStyle}
        setFontStyle={setFontStyle}
        fontWeightStyle={fontWeightStyle}
        setFontWeightStyle={setFontWeightStyle}
        stylesheetUrl={stylesheetUrl}
        setStylesheetUrl={setStylesheetUrl}
        className="mb-3"
      />

      {/* Font Weight/Style */}
      <FontWeightControl
        control={control}
        fontId={fontId}
        setFontWeight={setFontWeight}
        setFontStyle={setFontStyle}
        fontWeightStyle={fontWeightStyle}
        setFontWeightStyle={setFontWeightStyle}
        className="mb-3"
      />

      {/* Text Decoration */}
      <div className="egf-font-settings__text-decoration-setting mb-3">
        <SelectControl
          label={'Text Decoration'}
          options={[
            { value: '', label: 'Theme Default' },
            { value: 'none', label: 'None' },
            { value: 'underline', label: 'Underline' },
            { value: 'line-through', label: 'Line-through' },
            { value: 'overline', label: 'Overline' }
          ]}
        />
      </div>

      {/* Text Transform */}
      <div className="egf-font-settings__text-transform-setting mb-3">
        <SelectControl
          label={'Text Transform'}
          options={[
            { value: '', label: 'Theme Default' },
            { value: 'none', label: 'None' },
            { value: 'uppercase', label: 'Uppercase' },
            { value: 'lowercase', label: 'Lowercase' },
            { value: 'capitalize', label: 'Capitalize' }
          ]}
        />
      </div>
    </div>
  );
};

export default FontSettings;
