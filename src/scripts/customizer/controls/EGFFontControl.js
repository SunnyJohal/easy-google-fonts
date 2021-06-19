import React from 'react';

import { __ } from '@wordpress/i18n';
import { Button, Panel, PanelBody, PanelRow, TabPanel } from '@wordpress/components';
import { useState } from '@wordpress/element';

import FontSettings from './FontSettings';
import StyleSettings from './StyleSettings';
import PositionSettings from './PositionSettings';

const EGFFontControl = props => {
  const { control, resetSetting } = props;
  const { params } = control;
  const { label, description } = params;
  const [isOpen, setIsOpen] = useState(false);

  return (
    <div>
      <Panel>
        <PanelBody title={label} icon="more" initialOpen={false} opened={isOpen} onToggle={() => setIsOpen(!isOpen)}>
          {/* Description */}
          {description && <p className="description customize-control-description">{description}</p>}

          {/* Settings */}
          <TabPanel
            className="egf-font-control__tabs"
            tabs={[
              {
                name: 'tab1',
                title: 'Font',
                isActive: true,
                className: 'egf-font-control__tab',
                component: <FontSettings control={control} />
              },
              {
                name: 'tab2',
                title: 'Style',
                className: 'egf-font-control__tab',
                component: <StyleSettings control={control} />
              },
              {
                name: 'tab3',
                title: 'Position',
                className: 'egf-font-control__tab',
                component: <PositionSettings control={control} />
              }
            ]}
          >
            {tab => tab.component}
          </TabPanel>

          {/* Actions */}
          <PanelRow className="egf-font-control__actions">
            <Button isTertiary onClick={() => setIsOpen(!isOpen)}>
              {__('Close', 'easy-google-fonts')}
            </Button>

            <Button isDestructive onClick={() => resetSetting({ renderAfterUpdate: true })}>
              {egfCustomize.translations.controls.common.reset_label}
            </Button>
          </PanelRow>
        </PanelBody>
      </Panel>
    </div>
  );
};

export default EGFFontControl;
