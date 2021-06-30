import { __experimentalBoxControl as BoxControl } from '@wordpress/components';
import { useState } from '@wordpress/element';

import MarginControl from './position/MarginControl';
import DisplayControl from './position/DisplayControl';

const PositionSettings = ({
  control,
  marginBottom,
  setMarginBottom,
  marginLeft,
  setMarginLeft,
  marginRight,
  setMarginRight,
  marginTop,
  setMarginTop,
  paddingBottom,
  setPaddingBottom,
  paddingLeft,
  setPaddingLeft,
  paddingRight,
  setPaddingRight,
  paddingTop,
  setPaddingTop,
  borderTopColor,
  setBorderTopColor,
  borderTopStyle,
  setBorderTopStyle,
  borderTopWidth,
  setBorderTopWidth,
  borderBottomColor,
  setBorderBottomColor,
  borderBottomStyle,
  setBorderBottomStyle,
  borderBottomWidth,
  setBorderBottomWidth,
  borderLeftColor,
  setBorderLeftColor,
  borderLeftStyle,
  setBorderLeftStyle,
  borderLeftWidth,
  setBorderLeftWidth,
  borderRightColor,
  setBorderRightColor,
  borderRightStyle,
  setBorderRightStyle,
  borderRightWidth,
  setBorderRightWidth,
  borderRadiusBottomLeft,
  setBorderRadiusBottomLeft,
  borderRadiusBottomRight,
  setBorderRadiusBottomRight,
  borderRadiusTopLeft,
  setBorderRadiusTopLeft,
  borderRadiusTopRight,
  setBorderRadiusTopRight,
  display,
  setDisplay
}) => {
  const [values, setValues] = useState({
    top: '50px',
    left: '10%',
    right: '10%',
    bottom: '50px'
  });

  return (
    <div className="egf-position-settings__settings">
      <MarginControl
        className="mb-2"
        control={control}
        marginBottom={marginBottom}
        setMarginBottom={setMarginBottom}
        marginLeft={marginLeft}
        setMarginLeft={setMarginLeft}
        marginRight={marginRight}
        setMarginRight={setMarginRight}
        marginTop={marginTop}
        setMarginTop={setMarginTop}
      />

      {/* Padding: Top | Bottom | Left | Right */}
      {/* Border (Style/Width/Color): Top | Bottom | Left | Right */}
      {/* Border Radius: Top | Bottom | Left | Right */}
      {/* Display: Block inline*/}

      <DisplayControl className="mb-3" display={display} setDisplay={setDisplay} />
    </div>
  );
};

export default PositionSettings;
