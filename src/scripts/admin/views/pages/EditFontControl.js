// External dependencies.
import { Prompt, withRouter } from 'react-router-dom';
import { useBeforeunload } from 'react-beforeunload';
import { useToasts } from 'react-toast-notifications';

// WordPress dependencies.
import { __, _x, sprintf } from '@wordpress/i18n';
import { useState, useEffect } from '@wordpress/element';
import { useSelect, useDispatch } from '@wordpress/data';
import {
  Button,
  Card,
  CardBody,
  CardDivider,
  CardHeader,
  CardFooter,
  FormTokenField,
  TextControl,
  TextareaControl,
  CheckboxControl,
  Notice
} from '@wordpress/components';

// Internal dependencies.
import { STORE_KEY } from '../../store';
import getQueryFromUrl from '../../utils/getQueryFromUrl';
import getScreenLink from '../../utils/getScreenLink';
import FontControlSelector from '../components/FontControlSelector';
import EditFontControlLoader from '../components/loaders/EditFontControlLoader';

const sortFontControlsByTitle = fontControls => {
  return Object.keys(fontControls).sort((a, b) => {
    const firstTitle = fontControls[a].title.rendered.toUpperCase();
    const secondTitle = fontControls[b].title.rendered.toUpperCase();

    if (firstTitle < secondTitle) {
      return -1;
    }

    if (firstTitle > secondTitle) {
      return 1;
    }

    return 0;
  });
};

const EditFontControl = props => {
  const { addToast } = useToasts();
  const dataLoaded = useSelect(select => {
    select(STORE_KEY).getFontControls();
    return [select(STORE_KEY).hasFinishedResolution('getFontControls')].every(loaded => loaded);
  });

  const allFontControls = useSelect(select => select(STORE_KEY).getFontControls());
  let fontControlToEdit = getQueryFromUrl('fontControl');

  if (!fontControlToEdit && dataLoaded) {
    const [firstFontControl] = sortFontControlsByTitle(allFontControls);
    fontControlToEdit = firstFontControl;
  }

  useEffect(() => {
    let isMounted = true;
    if (dataLoaded && Object.keys(allFontControls).length === 0) {
      props.history.push(getScreenLink('create'));
    }

    return () => {
      isMounted = false;
    };
  }, [allFontControls]);

  const fontControl = useSelect(select => select(STORE_KEY).getFontControl(fontControlToEdit));
  const [isSaving, setIsSaving] = useState(false);
  const [changesMade, setChangesMade] = useState(false);
  const [fontControlName, setFontControlName] = useState('');
  const [fontControlNameError, setFontControlNameError] = useState(false);
  const [description, setDescription] = useState('');
  const [forceStyles, setForceStyles] = useState(false);
  const [selectors, setSelectors] = useState([]);
  const hasSelectors = selectors.length > 0;

  // Sync state with the saved font control.
  useEffect(() => {
    setIsSaving(false);
    setChangesMade(false);

    if (Object.keys(fontControl).length > 0) {
      setFontControlName(fontControl.title.rendered);
      setSelectors(fontControl.meta.control_selectors);
      setForceStyles(fontControl.meta.force_styles);
      setDescription(fontControl.meta.control_description);
    }
  }, [fontControl]);

  /**
   * Update Font Control
   */
  const { updateFontControl } = useDispatch(STORE_KEY);
  const updateFontControlAndRedirect = async () => {
    if (isSaving) {
      return;
    }

    if (!fontControlName) {
      setFontControlNameError(true);
    }

    if (fontControlName) {
      try {
        setIsSaving(true);
        await updateFontControl({
          id: fontControlToEdit,
          name: fontControlName,
          selectors,
          forceStyles,
          description
        });

        addToast(sprintf(__('%s has been updated.', 'easy-google-fonts'), fontControlName), {
          appearance: 'success',
          autoDismiss: true,
          placement: 'bottom-right'
        });
      } catch (err) {
        addToast(sprintf(__('Unable to save changes to %s. Please try again.', 'easy-google-fonts'), fontControlName), {
          appearance: 'error',
          autoDismiss: true,
          placement: 'bottom-right'
        });
        setIsSaving(false);
      }
    }
  };

  /**
   * Delete Font Control
   */
  const { deleteFontControl } = useDispatch(STORE_KEY);
  const deleteFontControlAndRedirect = async () => {
    if (isSaving) {
      return;
    }

    try {
      setIsSaving(true);
      await deleteFontControl(fontControlToEdit);
      props.history.push(getScreenLink('edit'));
      addToast(sprintf(__('%s has been deleted.', 'easy-google-fonts'), fontControlName), {
        appearance: 'info',
        autoDismiss: true,
        placement: 'bottom-right'
      });
    } catch (err) {
      addToast(sprintf(__('Unable to delete %s. Please try again.', 'easy-google-fonts'), fontControlName), {
        appearance: 'error',
        autoDismiss: true,
        placement: 'bottom-right'
      });
      setIsSaving(false);
    }
  };

  /**
   * Prompt for unsaved changes.
   */
  useBeforeunload(() => {
    if (changesMade) {
      return __(
        'You have made changes to this font control that are not saved. Are you sure you want to leave this page?',
        'easy-google-fonts'
      );
    }
  });

  return dataLoaded ? (
    <div>
      <div className="container-fluid p-0">
        <div className="row">
          {/* Font control selector */}
          <div className="col-12 mb-3">
            <FontControlSelector selectedFontControlId={fontControlToEdit} />
          </div>

          {/* Notices */}
          {fontControlNameError && (
            <div className="col-12 mb-3">
              <Notice className="m-0" status="error" isDismissible={false}>
                {__('Please enter a valid name for your font control.', 'easy-google-fonts')}
              </Notice>
            </div>
          )}

          {/* Font Control Settings. */}
          <div className="col">
            <Card className="egf-settings">
              {/* Font control name and save action. */}
              <CardHeader className="d-block">
                <div className="row justify-content-between align-items-center">
                  <div className="col-6">
                    <TextControl
                      className="egf-settings__font-control-name"
                      label={__('Font Control Name', 'easy-google-fonts')}
                      value={fontControlName}
                      onChange={value => {
                        setFontControlName(value);
                        setChangesMade(true);
                      }}
                    />
                  </div>
                  <div className="col-auto px-0">
                    <Button isBusy={isSaving} isPrimary onClick={updateFontControlAndRedirect}>
                      {__('Save Font Control', 'easy-google-fonts')}
                    </Button>
                  </div>
                </div>
              </CardHeader>

              {/* Font Control Settings */}
              <CardBody>
                <h3>{__('Font Control CSS Selectors', 'easy-google-fonts')}</h3>
                <FormTokenField
                  label={__('Add your CSS selectors below', 'easy-google-fonts')}
                  // label="this is the label"
                  value={selectors}
                  placeholder="Enter CSS selector"
                  tokenizeOnSpace={false}
                  onChange={selectors => {
                    setSelectors(selectors);
                    setChangesMade(true);
                  }}
                />

                {hasSelectors && (
                  <Button isDestructive onClick={() => setSelectors([])}>
                    {__('Remove all selectors', 'easy-google-fonts')}
                  </Button>
                )}

                <CardDivider className="my-4" />

                <h3>{__('Font Control Properties', 'easy-google-fonts')}</h3>

                <CheckboxControl
                  className="egf-settings__force-style egf-font-control-property"
                  checked={forceStyles}
                  label={__('Force Styles (Optional)', 'easy-google-fonts')}
                  help={__(
                    'This will enable the important rule for any of the CSS styles generated for the selectors defined above. It is used to add more importance to a property/value than normal.',
                    'easy-google-fonts'
                  )}
                  onChange={forceStyles => {
                    setForceStyles(forceStyles);
                    setChangesMade(true);
                  }}
                />

                <TextareaControl
                  label={__('Customizer Description', 'easy-google-fonts')}
                  className="egf-settings__description egf-font-control-property"
                  help={__(
                    'Description of the font control, displayed in the customizer interface.',
                    'easy-google-fonts'
                  )}
                  value={description}
                  onChange={description => {
                    setDescription(description);
                    setChangesMade(true);
                  }}
                />
              </CardBody>

              {/* Footer Actions */}
              <CardFooter className="d-block">
                <div className="row justify-content-between">
                  <div className="col-auto">
                    <Button
                      isDestructive
                      onClick={() => {
                        const confirmDelete = confirm(
                          _x(
                            `Warning! You are about to permanently delete this font control. 'Cancel' to stop, 'OK' to delete.`,
                            'User confirmation message to delete a font control.',
                            'easy-google-fonts'
                          )
                        );

                        if (confirmDelete) {
                          deleteFontControlAndRedirect();
                        }
                      }}
                    >
                      {__('Delete Font Control', 'easy-google-fonts')}
                    </Button>
                  </div>
                  <div className="col-auto px-0">
                    <Button isBusy={isSaving} isPrimary onClick={updateFontControlAndRedirect}>
                      {__('Save Font Control', 'easy-google-fonts')}
                    </Button>
                  </div>
                </div>
              </CardFooter>
            </Card>
          </div>
        </div>
      </div>
      <Prompt
        when={changesMade}
        message={__(
          'You have made changes to this font control that are not saved. Are you sure you want to leave this page?',
          'easy-google-fonts'
        )}
        beforeUnload={true}
      />
    </div>
  ) : (
    <EditFontControlLoader />
  );
};

export default withRouter(EditFontControl);
