import {
  Button,
  ColorIndicator,
  ColorPalette,
  ColorPicker,
  PanelRow,
  RangeControl,
  __experimentalUnitControl as UnitControl
} from '@wordpress/components';
import { useState } from '@wordpress/element';

const customTooltipContent = value => `${value}`;

const { theme_colors } = egfCustomize;

const StyleSettings = () => {
  const [value, setValue] = useState('10px');
  const [color, setColor] = useState('');
  return (
    <div className="egf-font-control__settings" style={{ paddingTop: 16, paddingBottom: 8 }}>
      {/* Font Color */}
      <PanelRow>
        <label>Font Color</label>
        <Button isSecondary isSmall>
          Reset
        </Button>
      </PanelRow>
      <ColorPalette color={color} colors={theme_colors} onChange={setColor} clearable={false} disableAlpha={true} />

      <hr style={{ marginTop: 16, marginBottom: 24 }} />

      {/* Background Color */}
      <PanelRow>
        <div>
          <label>Background Color</label>
          <ColorIndicator color={color} />
        </div>
        <Button isSecondary isSmall>
          Reset
        </Button>
      </PanelRow>
      <ColorPalette color={color} colors={theme_colors} onChange={setColor} clearable={false} disableAlpha={true} />

      <hr style={{ marginTop: 16, marginBottom: 24 }} />

      {/* Font Size */}
      <RangeControl
        label={'Font Size'}
        value={value}
        onChange={setValue}
        renderTooltipContent={customTooltipContent}
        withInputField={false}
      />
      <PanelRow>
        <UnitControl onChange={setValue} value={value} />
        <Button isSecondary isSmall>
          Reset
        </Button>
      </PanelRow>

      <hr style={{ marginTop: 16, marginBottom: 24 }} />

      {/* Line Height */}
      <RangeControl
        label={'Line Height'}
        value={value}
        onChange={setValue}
        renderTooltipContent={customTooltipContent}
        withInputField={false}
      />
      <PanelRow>
        <UnitControl onChange={setValue} value={value} />
        <Button isSecondary isSmall>
          Reset
        </Button>
      </PanelRow>

      <hr style={{ marginTop: 16, marginBottom: 24 }} />

      {/* Letter Spacing */}
      <RangeControl
        label={'Letter Spacing'}
        value={value}
        onChange={setValue}
        renderTooltipContent={customTooltipContent}
        withInputField={false}
      />
      <PanelRow>
        <UnitControl onChange={setValue} value={value} />
        <Button isSecondary isSmall>
          Reset
        </Button>
      </PanelRow>
    </div>
  );
};

export default StyleSettings;
