import Select from 'react-select';

const FontFamilyControl = props => {
  const { className, control } = props;
  const { updateSettingProps, setting } = control;
  const { subset } = setting();

  const groupedOptions = Object.keys(window.egfGoogleFontsByCategory).map(category => {
    return {
      label: category,
      options: window.egfGoogleFontsByCategory[category].filter(font => {
        // Backwards compatibility.
        if ('all' === subset || 'latin,all' === subset || !subset) {
          return true;
        }

        return font.subsets.includes(subset);
      })
    };
  });

  // TODO: Merge in the default websafe fonts.
  // TODO: Polish off the translations.
  // TODO: Look at selection on keyboard arrow.
  // TODO: Determine settings to update and wire it all up.
  // TODO: Accessibility for label.

  return (
    <div className={`egf-font-family-control ${className}`}>
      <div className="components-base-control">
        <label className="components-input-control__label">Font Family</label>
        <Select
          closeMenuOnSelect={false}
          isSearchable={true}
          isClearable={true}
          options={groupedOptions}
          onChange={font => {
            const { family } = font;

            updateSettingProps({
              props: {
                font_id: `${family.toLowerCase().replace(' ', '_')}`,
                font_name: family,
                font_style: '',
                font_weight: '',
                font_weight_style: '',
                stylesheet_url: ''
              },
              renderAfterUpdate: true
            });
          }}
        />
      </div>
    </div>
  );
};

export default FontFamilyControl;
