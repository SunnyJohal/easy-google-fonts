import { _x } from '@wordpress/i18n';
import { SelectControl } from '@wordpress/components';

const FontLanguageControl = props => {
  const { className, control } = props;
  const { updateSettingProps, setting } = control;
  const { subset } = setting();

  const languageOptions = [
    { value: 'latin,all', label: 'All Languages' },
    ...window.egfGoogleFontLanguages.map(language => ({ value: language, label: language }))
  ];

  return (
    <div className={`egf-font-language-control ${className}`}>
      <SelectControl
        label={_x('Language', 'Language field label for the customizer font control.', 'easy-google-fonts')}
        value={subset}
        options={languageOptions}
        onChange={language =>
          updateSettingProps({
            props: {
              subset: language
            },
            renderAfterUpdate: true
          })
        }
      />
    </div>
  );
};

export default FontLanguageControl;
