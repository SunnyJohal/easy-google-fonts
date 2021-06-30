console.log('preview.js loaded', egfCustomizePreview);

// Things to test.
// 1. Does the preview recieve the setting without the control having to rerender?

wp.customize('tt_font_theme_options[tt_default_body][subset]', value => {
  value.bind(to => console.log('got the data this side without forcing a rerender it is', to));
});

wp.customize('tt_font_theme_options[tt_default_body][font_color]', value => {
  value.bind(to => console.log('got the data this side without forcing a rerender it is', to));
});
