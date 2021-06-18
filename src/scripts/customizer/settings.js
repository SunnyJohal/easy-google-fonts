/**
 * Register Settings
 *
 * Registers the static settings we have defined
 * solely in the customizer and the setting is
 * dynamically saved upon submission.
 *
 * wp.customize.Setting() represents the Model in
 * the customizer.
 */
const { customize } = wp;
const { settings } = egfCustomize;

export const registerSettings = () => {
  customize.bind('ready', () => {
    registerBaseSettings();
    registerSubsettings();
  });
};

const registerBaseSettings = () => {
  const { config, setting_key, saved } = settings;
  for (const id in config) {
    const { default: default_value, transport } = config[id];
    wp.customize.add(
      new customize.Setting(`${setting_key}[${id}]`, saved[id], { transport, default: default_value, type: 'option' })
    );
  }
};

const registerSubsettings = () => {
  const { config, setting_key, saved } = settings;

  for (const id in config) {
    if (config[id].type === 'font') {
      const props = [
        'subset',
        'font_id',
        'font_name',
        'font_color',
        'font_weight',
        'font_style',
        'font_weight_style',
        'background_color',
        'stylesheet_url',
        'text_decoration',
        'text_transform',
        'line_height',
        'display',
        'font_size',
        'letter_spacing',
        'margin-top',
        'margin-right',
        'margin-bottom',
        'margin_left',
        'padding-top',
        'padding-right',
        'padding-bottom',
        'padding_left',
        'border_radius_top_left',
        'border_radius_top_right',
        'border_radius_bottom_left',
        'border_radius_bottom_right',
        'border-top-color',
        'border-top-style',
        'border-top-width',
        'border-bottom-color',
        'border-bottom-style',
        'border-bottom-width',
        'border-left-color',
        'border-left-style',
        'border-left-width',
        'border-right-color',
        'border-right-style',
        'border-right-width'
      ];

      const { default: default_value, transport } = config[id];

      props.forEach(prop => {
        customize.add(
          new customize.Setting(`${setting_key}[${id}][${prop}]`, saved[id][prop], {
            transport,
            default: default_value[prop],
            type: 'option'
          })
        );
      });
    }
  }
};
