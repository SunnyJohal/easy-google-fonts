import { useState } from '@wordpress/element';
import { SelectControl } from '@wordpress/components';

import FontLanguageControl from './components/FontLanguageControl';
import FontFamilyControl from './components/FontFamilyControl';

const FontSettings = ({ control }) => {
  const { className, control } = props;
  const { updateSettingProps, setting } = control;
  const { subset: fontSubset, font_id } = setting();

  const [fontId, setFontId] = useState(font_id);
  const [subset, setSubset] = useState(fontSubset);

  // font_id: `${sanitizeFontKey(family)}`,
  // font_name: family,
  // font_weight_style: fontWeightStyle,
  // font_weight: fontWeight,
  // font_style: fontStyle,
  // stylesheet_url: ''

  return (
    <div className="egf-font-settings__settings">
      <FontLanguageControl control={control} className="mb-3" />
      <FontFamilyControl control={control} className="mb-3" />

      {/* Font Weight/Style */}
      <div className="egf-font-settings__font-weight-setting mb-3">
        <SelectControl label={'Font Weight/Style'} options={[{ value: '', label: 'Theme Default' }]} />
      </div>

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
