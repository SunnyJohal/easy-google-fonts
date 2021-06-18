import { SelectControl } from '@wordpress/components';

import FontLanguageControl from './components/FontLanguageControl';
import FontFamilyControl from './components/FontFamilyControl';

const FontSettings = ({ control }) => {
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
