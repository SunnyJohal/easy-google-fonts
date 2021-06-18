import { __experimentalBoxControl as BoxControl } from '@wordpress/components';
import { useState } from '@wordpress/element';

const { Visualizer } = BoxControl;

const PositionSettings = () => {
  const [values, setValues] = useState({
    top: '50px',
    left: '10%',
    right: '10%',
    bottom: '50px'
  });

  return (
    <div className="egf-font-control__settings" style={{ paddingTop: 16, paddingBottom: 8 }}>
      <div>
        <BoxControl label={'Margin'} values={values} onChange={nextValues => setValues(nextValues)} />
      </div>

      <hr style={{ marginTop: 16, marginBottom: 24 }} />

      <div>
        <BoxControl label={'Padding'} values={values} onChange={nextValues => setValues(nextValues)} />
      </div>

      <hr style={{ marginTop: 16, marginBottom: 24 }} />

      <div>
        <BoxControl label={'Border Radius'} values={values} onChange={nextValues => setValues(nextValues)} />
      </div>
    </div>
  );
};

export default PositionSettings;
