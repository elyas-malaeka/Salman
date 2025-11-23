/**
 * ModularFormManager - Multi-step Multilingual Form Management
 * 
 * A modular class for handling multi-step form functionality with:
 * - Validation
 * - File uploads
 * - Conditional fields
 * - Multilingual support
 * - Local storage for form state persistence
 * 
 * @version 3.1.0
 */
class ModularFormManager {
    /**
     * Class constructor
     */
    constructor() {
        // Core properties
        this.currentStep = 1;
        this.totalSteps = 5;
        this.form = document.getElementById('registrationForm');
        this.stepElements = document.querySelectorAll('.registration-step');
        this.progressSteps = document.querySelectorAll('.progress-step');
        this.progressLine = document.getElementById('progressLine');
        this.loadingSpinner = document.getElementById('loadingSpinner');
        
        // Initialize language settings
        this.initLanguageSettings();
        
        // Initialize file fields
        this.initFileFields();
        
        // Test DOM structure
        this.testDOMElements();
        
        // Setup event listeners and initial state
        this.setupEventListeners();
        this.setupButtonDirections();
        this.updateProgressLine();
        this.restoreFormData();
        this.setupConditionalFields();
        
        // Add cosmic animations
        this.createVisualEffects();
        
        console.log(this.getTranslatedText('initializing_complete', 'ModularFormManager initialized successfully'));
    }
    
    /**
     * Initialize language settings
     */
    initLanguageSettings() {
        // Check for translations
        if (typeof translations === 'undefined') {
            console.warn('Translations object is not defined, using default texts.');
            this.translations = {};
        } else {
            this.translations = translations;
            console.log('Translations loaded successfully');
        }
        
        // Set current language
        this.currentLang = typeof currentLang !== 'undefined' ? currentLang : 'fa';
        console.log('Using language:', this.currentLang);
        
        // Set field labels
        if (typeof fieldLabels === 'undefined') {
            console.warn('fieldLabels object is not defined, using empty object.');
            this.fieldLabels = {};
        } else {
            this.fieldLabels = fieldLabels;
        }
    }
    
    /**
     * Initialize file upload fields
     */
    initFileFields() {
        // Auto-detect file fields if not defined
        if (typeof fileFields === 'undefined' || !fileFields.length) {
            console.warn('fileFields not defined or empty, detecting file inputs automatically...');
            this.fileFields = this.detectFileFields();
            console.log('Auto-detected file fields:', this.fileFields);
        } else {
            this.fileFields = fileFields;
            console.log('Using predefined file fields:', this.fileFields);
        }
    }
    
    /**
     * Auto-detect file fields in the form
     * @returns {Array} Array of file field IDs
     */
    detectFileFields() {
        const detectedFields = [];
        
        // Find all file inputs in the form
        if (this.form) {
            const fileInputs = this.form.querySelectorAll('input[type="file"]');
            console.log(`Found ${fileInputs.length} file inputs in the form`);
            
            fileInputs.forEach(input => {
                if (input.id) {
                    detectedFields.push(input.id);
                    console.log(`Detected file field: ${input.id}`);
                } else {
                    console.warn('Found file input without id attribute:', input);
                }
            });
        } else {
            // Fallback to document-level search if form not loaded
            const fileInputs = document.querySelectorAll('input[type="file"]');
            console.log(`Found ${fileInputs.length} file inputs in the document`);
            
            fileInputs.forEach(input => {
                if (input.id) {
                    detectedFields.push(input.id);
                    console.log(`Detected file field: ${input.id}`);
                } else {
                    console.warn('Found file input without id attribute:', input);
                }
            });
        }
        
        // Use common field names as fallback
        if (detectedFields.length === 0) {
            console.warn('No file fields detected, using common field names as fallback');
            return ['profilePhoto', 'passportDoc', 'nationalIdDoc', 'birthCertificate', 'academicCertificate', 'emiratesId'];
        }
        
        return detectedFields;
    }
    
    /**
     * Get translated text with fallback
     * @param {string} key Translation key
     * @param {string} defaultText Default text if translation not found
     * @returns {string} Translated text
     */
    getTranslatedText(key, defaultText) {
        return this.translations[key] !== undefined ? this.translations[key] : defaultText;
    }
    
    /**
     * Test DOM elements for debugging
     */
    testDOMElements() {
        console.log(this.getTranslatedText('testing_dom', 'Testing key DOM elements...'));
        
        // Test file fields
        if (this.fileFields && this.fileFields.length) {
            this.fileFields.forEach(fileId => {
                const fileInput = document.getElementById(fileId);
                console.log(`${fileId}: ${fileInput ? '✅' : '❌'}`);
                
                const uploadContainer = document.getElementById(`${fileId}Upload`);
                console.log(`${fileId}Upload: ${uploadContainer ? '✅' : '❌'}`);
                
                const previewElement = document.getElementById(`${fileId}Preview`);
                console.log(`${fileId}Preview: ${previewElement ? '✅' : '❌'}`);
            });
        }
        
        // Test nationality fields
        const nationalityFields = ['nationality', 'fatherNationality', 'motherNationality'];
        nationalityFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            console.log(`${fieldId}: ${field ? '✅' : '❌'}`);
        });
        
        // Test document containers
        const documentContainers = ['nationalIdContainer', 'passportContainer', 'iranianDocuments', 'emiratesIdContainer'];
        documentContainers.forEach(containerId => {
            const container = document.getElementById(containerId);
            console.log(`${containerId}: ${container ? '✅' : '❌'}`);
        });
        
        // Test transportation fields
        const transportationFields = ['needTransportation', 'transportationCityContainer', 'transportationRouteContainer', 'transportationLocationContainer'];
        transportationFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            console.log(`${fieldId}: ${field ? '✅' : '❌'}`);
        });
    }
    
    /**
     * Setup button directions based on RTL/LTR
     */
    setupButtonDirections() {
        const isRtl = document.dir === 'rtl' || document.documentElement.lang === 'fa' || document.documentElement.lang === 'ar';
        console.log("Setting up button directions. RTL mode:", isRtl);
        
        // Set appropriate icons for prev/next buttons
        const prevButtons = document.querySelectorAll('.btn-prev');
        const nextButtons = document.querySelectorAll('.btn-next');
        
        prevButtons.forEach(btn => {
            const icon = btn.querySelector('i');
            if (icon) {
                // For prev button: left arrow in LTR, right arrow in RTL
                icon.className = isRtl ? 'fas fa-arrow-right' : 'fas fa-arrow-left';
                console.log("Previous button icon set to:", icon.className);
            }
        });
        
        nextButtons.forEach(btn => {
            const icon = btn.querySelector('i');
            if (icon) {
                // For next button: right arrow in LTR, left arrow in RTL
                icon.className = isRtl ? 'fas fa-arrow-left' : 'fas fa-arrow-right';
                console.log("Next button icon set to:", icon.className);
            }
        });
    }
    
    /**
     * Setup all event listeners
     */
    setupEventListeners() {
        console.log(this.getTranslatedText('setting_up_events', 'Setting up event listeners...'));
        
        // Navigation buttons
        this.setupNavigationListeners();
        
        // Transportation options
        this.setupTransportationListeners();
        
        // Academic grade change
        this.setupAcademicGradeListeners();
        
        // Nationality change
        this.setupNationalityListeners();
        
        // File upload
        this.setupFileUploadListeners();
        
        // Form validation
        this.setupValidationListeners();
        
        // Form submission
        this.setupSubmissionListeners();
        
        // Auto-save
        this.setupAutoSaveListeners();
        
        console.log(this.getTranslatedText('events_setup_complete', 'Event listeners setup completed'));
    }
    
    /**
     * Setup navigation button listeners
     */
    setupNavigationListeners() {
        // Next buttons
        document.querySelectorAll('.btn-next').forEach(btn => {
            btn.addEventListener('click', e => this.goToNextStep(parseInt(e.currentTarget.getAttribute('data-step'))));
        });
        
        // Previous buttons
        document.querySelectorAll('.btn-prev').forEach(btn => {
            btn.addEventListener('click', e => this.goToPrevStep(parseInt(e.currentTarget.getAttribute('data-step'))));
        });
        
        // Progress step navigation
        this.progressSteps.forEach(step => {
            step.addEventListener('click', e => {
                const stepNumber = parseInt(e.currentTarget.getAttribute('data-step'));
                if (stepNumber < this.currentStep || e.currentTarget.classList.contains('clickable')) {
                    this.goToStep(stepNumber);
                }
            });
        });
    }
    
    /**
     * Setup transportation option listeners
     */
    setupTransportationListeners() {
        // Transportation need radio buttons
        const transportationRadios = document.querySelectorAll('input[name="needTransportation"]');
        transportationRadios.forEach(radio => {
            radio.addEventListener('change', e => this.handleTransportationNeedChange(e));
            
            // Initial run with delay for DOM loading
            if (radio.checked) {
                setTimeout(() => {
                    this.handleTransportationNeedChange({ target: radio });
                }, 300);
            }
        });
        
        // City selection
        const transportationCityField = document.getElementById('transportationCity');
        if (transportationCityField) {
            transportationCityField.addEventListener('change', e => this.loadRoutes(e));
            
            // Load routes if value already selected
            if (transportationCityField.value) {
                setTimeout(() => {
                    this.loadRoutes({ target: transportationCityField });
                }, 500);
            }
        }
        
        // Route selection
        const transportationRouteField = document.getElementById('transportationRoute');
        if (transportationRouteField) {
            transportationRouteField.addEventListener('change', e => this.handleRouteChange(e));
        }
    }
    
    /**
     * Setup academic grade listeners
     */
    setupAcademicGradeListeners() {
        const gradeField = document.getElementById('academicGrade');
        if (gradeField) {
            gradeField.addEventListener('change', e => this.handleGradeChange(e));
            
            // Initial run if value already selected
            if (gradeField.value) {
                this.handleGradeChange({ target: gradeField });
            }
        }
    }
    
    /**
     * Setup nationality field listeners
     */
    setupNationalityListeners() {
        // Student nationality
        const nationalityField = document.getElementById('nationality');
        if (nationalityField) {
            nationalityField.addEventListener('change', e => {
                this.handleNationalityChange(e, 'nationalIdContainer', 'passportContainer', 'iranianDocuments', 'emiratesIdContainer');
            });
            
            // Initial run with delay for DOM loading
            setTimeout(() => {
                if (nationalityField.value) {
                    this.handleNationalityChange(
                        { target: nationalityField }, 
                        'nationalIdContainer', 
                        'passportContainer', 
                        'iranianDocuments',
                        'emiratesIdContainer'
                    );
                    console.log(this.getTranslatedText('nationality_change_executed', 'Initial nationality change handler executed'));
                }
            }, 300);
        }
        
        // Father nationality
        const fatherNationalityField = document.getElementById('fatherNationality');
        if (fatherNationalityField) {
            fatherNationalityField.addEventListener('change', e => {
                this.handleNationalityChange(e, 'fatherNationalIdContainer', 'fatherPassportContainer');
            });
            
            // Initial run with delay
            setTimeout(() => {
                if (fatherNationalityField.value) {
                    this.handleNationalityChange(
                        { target: fatherNationalityField }, 
                        'fatherNationalIdContainer', 
                        'fatherPassportContainer'
                    );
                }
            }, 300);
        }
        
        // Mother nationality
        const motherNationalityField = document.getElementById('motherNationality');
        if (motherNationalityField) {
            motherNationalityField.addEventListener('change', e => {
                this.handleNationalityChange(e, 'motherNationalIdContainer', 'motherPassportContainer');
            });
            
            // Initial run with delay
            setTimeout(() => {
                if (motherNationalityField.value) {
                    this.handleNationalityChange(
                        { target: motherNationalityField }, 
                        'motherNationalIdContainer', 
                        'motherPassportContainer'
                    );
                }
            }, 300);
        }
    }
    
    /**
     * Setup file upload listeners
     */
    setupFileUploadListeners() {
        if (this.fileFields && this.fileFields.length) {
            console.log(`Setting up file event listeners for ${this.fileFields.length} fields`);
            
            this.fileFields.forEach(fileId => {
                const fileInput = document.getElementById(fileId);
                if (!fileInput) {
                    console.error(`File input not found: ${fileId}`);
                    return;
                }
                
                console.log(`Setting up file event listeners for ${fileId}`);
                
                // File change event
                fileInput.addEventListener('change', e => {
                    e.stopPropagation();
                    this.handleFileUpload(e);
                });
                
                // Remove file button
                const removeBtn = document.querySelector(`#${fileId}Preview .file-preview-remove`);
                if (removeBtn) {
                    removeBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        e.preventDefault();
                        this.removeFile(fileId);
                    });
                }
                
                // Drag & drop container
                this.setupDragAndDrop(fileId, fileInput);
            });
        } else {
            console.warn(`No file fields defined, skipping file event listeners setup`);
        }
    }
    
    /**
     * Setup drag and drop for a file field
     * @param {string} fileId File field ID
     * @param {HTMLElement} fileInput File input element
     */
    setupDragAndDrop(fileId, fileInput) {
        const dropArea = document.getElementById(`${fileId}Upload`);
        if (!dropArea) return;
        
        // Click on container to trigger file input
        dropArea.addEventListener('click', (e) => {
            if (e.target !== fileInput) {
                e.preventDefault();
                e.stopPropagation();
                fileInput.click();
            }
        });
        
        // Prevent default behavior for drag events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, e => {
                e.preventDefault();
                e.stopPropagation();
            });
        });
        
        // Add highlight class on drag over
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.add('highlight');
            });
        });
        
        // Remove highlight class on drag leave/drop
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.remove('highlight');
            });
        });
        
        // Handle file drop
        dropArea.addEventListener('drop', e => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    }
    
    /**
     * Setup validation-related listeners
     */
    setupValidationListeners() {
        // National ID validation
        const nationalIdFields = ['nationalId', 'fatherNationalId', 'motherNationalId'];
        nationalIdFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', e => this.validateNationalId(e.target));
            }
        });
        
        // Email validation
        const emailFields = ['fatherEmail', 'motherEmail'];
        emailFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', e => this.validateEmail(e.target));
            }
        });
        
        // Phone validation
        const phoneFields = ['contactNumber', 'emergencyContactNumber', 'fatherMobile', 'fatherLandline', 
                          'fatherWhatsapp', 'motherMobile', 'motherLandline', 'motherWhatsapp'];
        phoneFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', e => this.validatePhone(e.target));
            }
        });
        
        // Medical condition fields
        const medicalConditionRadios = document.querySelectorAll('input[name="fatherMedicalCondition"], input[name="motherMedicalCondition"]');
        medicalConditionRadios.forEach(radio => {
            radio.addEventListener('change', e => this.handleMedicalConditionChange(e));
        });
    }
    
    /**
     * Setup form submission listeners
     */
    setupSubmissionListeners() {
        // Review button
        const reviewButton = document.getElementById('reviewButton');
        if (reviewButton) {
            reviewButton.addEventListener('click', e => this.showSummary(e));
        }
        
        // Confirm button
        const confirmButton = document.getElementById('confirmButton');
        if (confirmButton) {
            confirmButton.addEventListener('click', e => this.enableSubmitButton(e));
        }
        
        // Form submission
        if (this.form) {
            this.form.addEventListener('submit', e => this.submitForm(e));
        }
    }
    
    /**
     * Setup auto-save listeners
     */
    setupAutoSaveListeners() {
        if (this.form) {
            // Save on input
            this.form.addEventListener('input', () => this.saveFormData());
            
            // Save periodically
            setInterval(() => this.saveFormData(), 5000);
        }
    }
    
    /**
     * Setup conditional fields
     */
    setupConditionalFields() {
        console.log(this.getTranslatedText('setting_up_conditional', 'Setting up conditional fields...'));
        
        // Find all elements with conditional attributes
        document.querySelectorAll('[data-condition-field]').forEach(element => {
            const conditionField = element.getAttribute('data-condition-field');
            const conditionOperator = element.getAttribute('data-condition-operator');
            const conditionValue = element.getAttribute('data-condition-value');
            
            console.log(`Found conditional element: ${element.id || element.className}, depends on: ${conditionField}`);
            
            // Add listener to the condition field
            const field = document.getElementById(conditionField);
            if (field) {
                // Initial evaluation
                this.evaluateCondition(element, field, conditionOperator, conditionValue);
                
                // Add listener for changes
                field.addEventListener('change', () => {
                    this.evaluateCondition(element, field, conditionOperator, conditionValue);
                });
            } else {
                console.warn(this.getTranslatedText('conditional_field_not_found', 'Conditional field not found:') + ` ${conditionField}`);
            }
        });
    }
    
    /**
     * Evaluate a conditional field
     * @param {HTMLElement} element Conditional element
     * @param {HTMLElement} field Condition field
     * @param {string} operator Comparison operator
     * @param {string} value Comparison value
     */
    evaluateCondition(element, field, operator, value) {
        let result = false;
        
        if (field.type === 'radio') {
            // For radio buttons, check if the selected radio has the specified value
            const checkedRadio = document.querySelector(`input[name="${field.name}"]:checked`);
            const fieldValue = checkedRadio ? checkedRadio.value : '';
            
            switch (operator) {
                case '==':
                    result = fieldValue === value;
                    break;
                case '!=':
                    result = fieldValue !== value;
                    break;
            }
        } else {
            // For other fields
            switch (operator) {
                case '==':
                    result = field.value === value;
                    break;
                case '!=':
                    result = field.value !== value;
                    break;
                case '>':
                    result = parseFloat(field.value) > parseFloat(value);
                    break;
                case '<':
                    result = parseFloat(field.value) < parseFloat(value);
                    break;
                case '>=':
                    result = parseFloat(field.value) >= parseFloat(value);
                    break;
                case '<=':
                    result = parseFloat(field.value) <= parseFloat(value);
                    break;
            }
        }
        
        console.log(`Evaluating condition: ${field.id || field.name} ${operator} ${value} = ${result}`);
        
        // Show/hide the element based on the result
        if (result) {
            element.classList.remove('d-none');
            
            // Enable fields within it
            const inputs = element.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.hasAttribute('data-required')) {
                    input.setAttribute('required', '');
                }
                input.disabled = false;
            });
        } else {
            element.classList.add('d-none');
            
            // Disable fields within it
            const inputs = element.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.hasAttribute('required')) {
                    input.removeAttribute('required');
                    input.setAttribute('data-required', 'true');
                }
                input.disabled = true;
            });
        }
    }
    
    /**
     * Handle transportation need change
     * @param {Event} e Change event
     */
    handleTransportationNeedChange(e) {
        // Get the selected value
        const value = e.target.value;
        console.log(`Transportation need changed to: ${value}`);
        
        // Find related containers
        const cityContainer = document.getElementById('transportationCityContainer');
        const routeContainer = document.getElementById('transportationRouteContainer');
        const stopContainer = document.getElementById('transportationLocationContainer');
        
        // Find related fields
        const cityField = document.getElementById('transportationCity');
        const routeField = document.getElementById('transportationRoute');
        const stopField = document.getElementById('transportationLocation');
        
        // Update visual state of radio buttons
        document.querySelectorAll('.transportation-option').forEach(opt => {
            if (opt.querySelector(`input[value="${value}"]`)) {
                opt.classList.add('selected');
            } else {
                opt.classList.remove('selected');
            }
        });
        
        // Check if transportation is needed (handle multiple language values)
        const positiveValues = ["Yes", "yes", "بله", "نعم", "true", "TRUE", "1"];
        const isPositive = positiveValues.includes(value);
        
        console.log(`Is transportation needed: ${isPositive} (value: ${value})`);
        
        if (isPositive) {
            // Show city container
            if (cityContainer) {
                cityContainer.classList.remove('d-none');
                console.log(this.getTranslatedText('city_container_visible', 'City container is now visible'));
            } else {
                console.warn(this.getTranslatedText('city_container_not_found', 'City container not found!'));
            }
            
            // Enable city field
            if (cityField) {
                cityField.disabled = false;
                
                // Load routes if city already selected
                if (cityField.value && cityField.value !== 'none') {
                    this.loadRoutes({ target: cityField });
                }
            } else {
                console.warn(this.getTranslatedText('city_field_not_found', 'City field not found!'));
            }
            
            // Log DOM state for debugging
            console.log(this.getTranslatedText('current_dom_state', 'Current DOM state:'));
            console.log('- City container:', cityContainer);
            console.log('- Route container:', routeContainer);
            console.log('- City field:', cityField);
        } else {
            // Hide all transportation fields
            if (cityContainer) cityContainer.classList.add('d-none');
            if (routeContainer) routeContainer.classList.add('d-none');
            if (stopContainer) stopContainer.classList.add('d-none');
            
            // Disable all fields
            if (cityField) {
                cityField.disabled = true;
                cityField.value = '';
            }
            if (routeField) {
                routeField.disabled = true;
                routeField.value = '';
            }
            if (stopField) {
                stopField.disabled = true;
                stopField.value = '';
            }
            
            // Clear route description
            const routeDescription = document.getElementById('routeDescription');
            if (routeDescription) {
                routeDescription.textContent = '';
                routeDescription.classList.add('d-none');
            }
        }
        
        // Save form data
        this.saveFormData();
    }
    
    /**
     * Handle academic grade change
     * @param {Event} e Change event
     */
    handleGradeChange(e) {
        const grade = parseInt(e.target.value);
        const majorContainer = document.getElementById('majorContainer');
        const major = document.getElementById('major');
        
        console.log(`Academic grade changed to: ${grade}`);
        
        if (majorContainer && major) {
            // Show major field for grades 10-12
            if (grade >= 10 && grade <= 12) {
                majorContainer.classList.remove('d-none');
                major.setAttribute('required', '');
                major.disabled = false;
                console.log(this.getTranslatedText('major_field_visible', 'Major field is now visible and required'));
            } else {
                majorContainer.classList.add('d-none');
                major.removeAttribute('required');
                major.disabled = true;
                console.log(this.getTranslatedText('major_field_hidden', 'Major field is now hidden and not required'));
            }
        } else {
            console.warn(this.getTranslatedText('major_container_not_found', 'Major container or field not found'));
        }
    }
    
    /**
     * Handle nationality change and document display
     * @param {Event} e Change event
     * @param {string} nationalIdContainerId National ID container ID
     * @param {string} passportContainerId Passport container ID
     * @param {string|null} documentsContainerId Documents container ID (optional)
     * @param {string|null} emiratesIdContainerId Emirates ID container ID (optional)
     */
    handleNationalityChange(e, nationalIdContainerId, passportContainerId, documentsContainerId = null, emiratesIdContainerId = null) {
        const nationality = e.target.value;
        const nationalIdContainer = document.getElementById(nationalIdContainerId);
        const passportContainer = document.getElementById(passportContainerId);
        
        console.log(`Nationality changed to: ${nationality}, containers: ${nationalIdContainerId}, ${passportContainerId}, ${documentsContainerId}, ${emiratesIdContainerId}`);
        
        // Ensure containers exist
        if (!nationalIdContainer || !passportContainer) {
            console.error(this.getTranslatedText('nationality_containers_not_found', 'Nationality containers not found:') + ` ${nationalIdContainerId}, ${passportContainerId}`);
            return;
        }
        
        // Get additional containers
        const emiratesIdContainer = emiratesIdContainerId ? document.getElementById(emiratesIdContainerId) : null;
        const academicCertContainer = document.getElementById('academicCertificate');
        let academicCertForm = null;
        if (academicCertContainer) {
            academicCertForm = academicCertContainer.closest('.form-group');
        }
        
        const iranianDocumentsContainer = documentsContainerId ? document.getElementById(documentsContainerId) : null;
        
        // Handle based on nationality
        if (nationality === 'IR') {
            // For Iranians - show national ID and passport
            nationalIdContainer.classList.remove('d-none');
            passportContainer.classList.remove('d-none');
            
            // Enable fields
            const nationalIdField = nationalIdContainer.querySelector('input');
            const passportField = passportContainer.querySelector('input');
            
            if (nationalIdField) {
                nationalIdField.setAttribute('required', '');
                nationalIdField.disabled = false;
            }
            if (passportField) {
                passportField.setAttribute('required', '');
                passportField.disabled = false;
            }
            
            // Show Iranian documents
            if (iranianDocumentsContainer) {
                iranianDocumentsContainer.classList.remove('d-none');
                console.log(this.getTranslatedText('iranian_docs_visible', 'Iranian documents container is now visible'));
                
                // Enable Iranian document fields
                const docFields = iranianDocumentsContainer.querySelectorAll('input[type="file"]');
                docFields.forEach(field => {
                    if (!field.closest('.d-none')) {
                        field.setAttribute('required', '');
                        field.disabled = false;
                    }
                });
            }
            
            // Show Emirates ID for all nationalities
            if (emiratesIdContainer) {
                emiratesIdContainer.classList.remove('d-none');
                const emiratesIdField = emiratesIdContainer.querySelector('input');
                if (emiratesIdField) {
                    emiratesIdField.setAttribute('required', '');
                    emiratesIdField.disabled = false;
                }
                console.log(this.getTranslatedText('emirates_id_visible_iranian', 'Emirates ID container is visible for Iranian nationality'));
            }
            
            // Show academic certificate for all nationalities
            if (academicCertForm) {
                academicCertForm.classList.remove('d-none');
                const academicCertField = academicCertForm.querySelector('input');
                if (academicCertField) {
                    academicCertField.disabled = false;
                }
                console.log(this.getTranslatedText('academic_cert_visible_iranian', 'Academic certificate is visible for Iranian nationality'));
            }
        } else if (nationality) {
            // For non-Iranians - only passport, academic certificate, and Emirates ID
            nationalIdContainer.classList.add('d-none');
            passportContainer.classList.remove('d-none');
            
            // Disable national ID, enable passport
            const nationalIdField = nationalIdContainer.querySelector('input');
            const passportField = passportContainer.querySelector('input');
            
            if (nationalIdField) {
                nationalIdField.removeAttribute('required');
                nationalIdField.value = ''; // Clear previous value
                nationalIdField.disabled = true;
            }
            if (passportField) {
                passportField.setAttribute('required', '');
                passportField.disabled = false;
            }
            
            // Hide Iranian documents for non-Iranians
            if (iranianDocumentsContainer) {
                iranianDocumentsContainer.classList.add('d-none');
                console.log(this.getTranslatedText('iranian_docs_hidden', 'Iranian documents container is now hidden'));
                
                // Disable Iranian document fields
                const docFields = iranianDocumentsContainer.querySelectorAll('input[type="file"]');
                docFields.forEach(field => {
                    field.removeAttribute('required');
                    field.disabled = true;
                });
            }
            
            // Show Emirates ID for all nationalities
            if (emiratesIdContainer) {
                emiratesIdContainer.classList.remove('d-none');
                const emiratesIdField = emiratesIdContainer.querySelector('input');
                if (emiratesIdField) {
                    emiratesIdField.setAttribute('required', '');
                    emiratesIdField.disabled = false;
                }
                console.log(this.getTranslatedText('emirates_id_visible_non_iranian', 'Emirates ID container is visible for non-Iranian nationality'));
            }
            
            // Show academic certificate for all nationalities
            if (academicCertForm) {
                academicCertForm.classList.remove('d-none');
                const academicCertField = academicCertForm.querySelector('input');
                if (academicCertField) {
                    academicCertField.disabled = false;
                }
                console.log(this.getTranslatedText('academic_cert_visible_non_iranian', 'Academic certificate is visible for non-Iranian nationality'));
            }
        }
    }
    
    /**
     * Handle medical condition change
     * @param {Event} e Change event
     */
    handleMedicalConditionChange(e) {
        const radioName = e.target.name;
        const value = e.target.value;
        let detailsContainerId, detailsFieldId;
        
        console.log(`Medical condition changed: ${radioName} = ${value}`);
        
        // Determine container and field IDs
        if (radioName === 'fatherMedicalCondition') {
            detailsContainerId = 'fatherMedicalConditionDetailsContainer';
            detailsFieldId = 'fatherMedicalConditionDetails';
        } else if (radioName === 'motherMedicalCondition') {
            detailsContainerId = 'motherMedicalConditionDetailsContainer';
            detailsFieldId = 'motherMedicalConditionDetails';
        } else {
            return;
        }
        
        const detailsContainer = document.getElementById(detailsContainerId);
        const detailsField = document.getElementById(detailsFieldId);
        
        if (detailsContainer && detailsField) {
            if (value === 'Yes') {
                detailsContainer.classList.remove('d-none');
                detailsField.setAttribute('required', '');
                detailsField.disabled = false;
                console.log(this.getTranslatedText('medical_details_visible', 'Medical condition details for') + ` ${radioName} ` + this.getTranslatedText('are_now_visible', 'are now visible and required'));
            } else {
                detailsContainer.classList.add('d-none');
                detailsField.removeAttribute('required');
                detailsField.value = '';
                detailsField.disabled = true;
                console.log(this.getTranslatedText('medical_details_hidden', 'Medical condition details for') + ` ${radioName} ` + this.getTranslatedText('are_now_hidden', 'are now hidden'));
            }
        } else {
            console.warn(this.getTranslatedText('medical_details_not_found', 'Medical condition details elements not found:') + ` ${detailsContainerId}, ${detailsFieldId}`);
        }
    }
    
    /**
     * Handle file upload
     * @param {Event} e Change event
     */
    handleFileUpload(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const fileInput = e.target;
        const fileId = fileInput.id;
        const files = fileInput.files;
        
        console.log(`File upload triggered for ${fileId} in language ${this.currentLang}`);
        
        // Check if file is selected
        if (!files || files.length === 0) {
            console.warn(this.getTranslatedText('no_file_selected', 'No file selected'));
            return;
        }
        
        const file = files[0];
        const fileType = file.type;
        const fileSize = file.size;
        
        console.log(`Selected file: ${file.name}, type: ${fileType}, size: ${this.formatFileSize(fileSize)}`);
        
        // Check upload container
        const uploadContainer = document.getElementById(`${fileId}Upload`);
        if (!uploadContainer) {
            console.error(`Upload container not found for ${fileId} (language: ${this.currentLang})`);
            alert(this.getTranslatedText('upload_container_not_found', 'Error: Upload container not found. Please try again or contact support.'));
            return;
        }
        
        // Get allowed settings
        const allowedTypes = uploadContainer.getAttribute('data-allowed-types') ? 
                         uploadContainer.getAttribute('data-allowed-types').split(',') : 
                         ['image/jpeg', 'image/png', 'application/pdf'];
        
        const maxSize = uploadContainer.getAttribute('data-max-size') ? 
                      parseInt(uploadContainer.getAttribute('data-max-size')) : 
                      2097152; // 2MB default
        
        // Validate file type
        if (!allowedTypes.includes(fileType)) {
            this.showFieldError(null, this.getTranslatedText('file_type_error', 'File format not allowed. Please upload a JPEG, PNG or PDF file.'), `${fileId}Error`);
            console.error(`Invalid file type: ${fileType}, allowed types: ${allowedTypes.join(', ')}`);
            document.getElementById(fileId).value = '';
            return;
        }
        
        // Validate file size
        if (fileSize > maxSize) {
            this.showFieldError(null, this.getTranslatedText('file_size_error', 'File size exceeds the allowed limit.'), `${fileId}Error`);
            console.error(`File too large: ${this.formatFileSize(fileSize)}, max allowed: ${this.formatFileSize(maxSize)}`);
            document.getElementById(fileId).value = '';
            return;
        }
        
        // Check and prepare preview
        let previewElement = document.getElementById(`${fileId}Preview`);
        
        if (!previewElement) {
            console.error(`Preview element not found for ${fileId}`);
            alert(this.getTranslatedText('preview_error', 'Error displaying file preview. Please try again or contact support.'));
            return;
        }
        
        // Find preview elements
        const previewImage = previewElement.querySelector('.file-preview-image');
        const previewIcon = previewElement.querySelector('.file-preview-icon');
        const previewName = previewElement.querySelector('.file-preview-name');
        const previewSize = previewElement.querySelector('.file-preview-size');
        
        // Create remove button if missing
        const removeButton = previewElement.querySelector('.file-preview-remove');
        if (!removeButton) {
            const newRemoveButton = document.createElement('button');
            newRemoveButton.type = 'button';
            newRemoveButton.className = 'file-preview-remove';
            newRemoveButton.innerHTML = `<i class="fas fa-trash-alt"></i> ${this.getTranslatedText('delete_file', 'Remove file')}`;
            newRemoveButton.addEventListener('click', (e) => {
                e.stopPropagation();
                e.preventDefault();
                this.removeFile(fileId);
            });
            previewElement.appendChild(newRemoveButton);
        }
        
        // Clear errors
        this.clearFieldError(null, `${fileId}Error`);
        
        // Update file info
        if (previewName) previewName.textContent = file.name;
        if (previewSize) previewSize.textContent = this.formatFileSize(fileSize);
        
        // Show image or icon based on file type
        if (fileType.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (previewImage) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                }
                if (previewIcon) {
                    previewIcon.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        } else {
            // Show icon based on file type
            if (previewIcon) {
                previewIcon.className = 'file-preview-icon';
                previewIcon.innerHTML = `<i class="fas ${fileType === 'application/pdf' ? 'fa-file-pdf' : 'fa-file-alt'}"></i>`;
                previewIcon.style.display = 'flex';
            }
            if (previewImage) {
                previewImage.style.display = 'none';
            }
        }
        
        // Show preview
        previewElement.style.display = 'flex';
        previewElement.classList.add('active');
        
        // Hide upload container
        if (uploadContainer) {
            uploadContainer.classList.add('has-file');
            uploadContainer.style.display = 'none';
        }
        
        console.log(`File preview updated for ${fileId} (language: ${this.currentLang})`);
        
        // Save file info to localStorage
        localStorage.setItem(`file_${fileId}`, JSON.stringify({
            name: file.name,
            size: fileSize,
            type: fileType,
            timestamp: new Date().getTime()
        }));
        
        // Save form data
        this.saveFormData();
    }
    
    /**
     * Remove uploaded file
     * @param {string} fileId File field ID
     */
    removeFile(fileId) {
        console.log(`Removing file for ${fileId}`);
        
        // Reset file input
        const fileInput = document.getElementById(fileId);
        if (fileInput) {
            fileInput.value = '';
        }
        
        // Hide preview
        const previewElement = document.getElementById(`${fileId}Preview`);
        if (previewElement) {
            previewElement.classList.remove('active');
            previewElement.style.display = 'none';
        }
        
        // Show upload container
        const uploadContainer = document.getElementById(`${fileId}Upload`);
        if (uploadContainer) {
            uploadContainer.classList.remove('has-file');
            uploadContainer.style.display = 'flex';
        }
        
        // Remove from localStorage
        localStorage.removeItem(`file_${fileId}`);
    }
    
    /**
     * Format file size to human-readable format
     * @param {number} bytes File size in bytes
     * @returns {string} Formatted file size
     */
    formatFileSize(bytes) {
        if (bytes >= 1024 * 1024) {
            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        } else if (bytes >= 1024) {
            return (bytes / 1024).toFixed(2) + ' KB';
        } else {
            return bytes + ' Bytes';
        }
    }
    
    /**
     * Load routes for selected city
     * @param {Event} e Change event
     */
    loadRoutes(e) {
        const cityId = e.target.value;
        const routeSelect = document.getElementById('transportationRoute');
        const routeContainer = document.getElementById('transportationRouteContainer');
        const stopContainer = document.getElementById('transportationLocationContainer');
        const stopInput = document.getElementById('transportationLocation');
        
        console.log(this.getTranslatedText('loading_routes_for_city', 'Loading routes for city:') + ` ${cityId}`);
        
        if (!routeSelect) {
            console.error(this.getTranslatedText('route_select_not_found', 'Route select element not found'));
            return;
        }
        
        // Clear and disable pickup location
        if (stopInput) {
            stopInput.value = '';
            stopInput.disabled = true;
        }
        
        // Hide pickup location container
        if (stopContainer) {
            stopContainer.classList.add('d-none');
        }
        
        // Handle "no transportation needed" selection
        if (cityId === 'none') {
            // Hide route container
            if (routeContainer) {
                routeContainer.classList.add('d-none');
            }
            
            // Disable route select
            routeSelect.disabled = true;
            routeSelect.innerHTML = `<option value="" selected>${this.getTranslatedText('no_transportation_needed', 'No transportation needed')}</option>`;
            
            // Clear route description
            const routeDescription = document.getElementById('routeDescription');
            if (routeDescription) {
                routeDescription.textContent = '';
                routeDescription.classList.add('d-none');
            }
            
            return;
        }
        
        // Handle empty city selection
        if (!cityId) {
            // Hide route container
            if (routeContainer) {
                routeContainer.classList.add('d-none');
            }
            
            routeSelect.innerHTML = `<option value="" selected>${this.getTranslatedText('select_city_first', 'Please select a city first')}</option>`;
            routeSelect.disabled = true;
            return;
        }
        
        // Show route container
        if (routeContainer) {
            routeContainer.classList.remove('d-none');
        }
        
        // Show loading state
        routeSelect.innerHTML = `<option value="" selected>${this.getTranslatedText('loading_routes', 'Loading routes...')}</option>`;
        routeSelect.disabled = true;
        
        // Show loading spinner
        this.showLoadingSpinner();
        
        // Create AJAX URL
        const ajaxUrl = window.location.href.substring(0, window.location.href.lastIndexOf('/') + 1) + 'includes/get_routes.php';
        
        // Load routes via AJAX
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                city: cityId,
                lang: this.currentLang
            },
            dataType: 'json',
            success: (data) => {
                this.hideLoadingSpinner();
                console.log(this.getTranslatedText('routes_data_received', 'Routes data received:'), data);
                
                // Check for empty response
                if (!data || data.length === 0) {
                    routeSelect.innerHTML = `<option value="" selected>${this.getTranslatedText('no_routes_defined', 'No routes defined for this city')}</option>`;
                    routeSelect.disabled = true;
                    return;
                }
                
                // Check for error response
                if (data.error) {
                    console.error(this.getTranslatedText('api_returned_error', 'API returned error:'), data.error);
                    routeSelect.innerHTML = `<option value="" selected>${this.getTranslatedText('error_loading_routes', 'Error loading routes')}</option>`;
                    
                    // Show error to user
                    const errorElement = document.getElementById('formErrors');
                    if (errorElement) {
                        errorElement.innerHTML = `<strong>${this.getTranslatedText('error', 'Error')}:</strong> ${data.error}`;
                        errorElement.classList.remove('d-none');
                    }
                    return;
                }
                
                // Populate route select
                routeSelect.innerHTML = `<option value="" selected>${this.getTranslatedText('select_route', 'Select a route')}</option>`;
                
                data.forEach(route => {
                    const option = document.createElement('option');
                    option.value = route.id;
                    option.textContent = route.name;
                    option.setAttribute('data-description', route.description || '');
                    routeSelect.appendChild(option);
                });
                
                routeSelect.disabled = false;
                console.log(`${data.length} ` + this.getTranslatedText('routes_loaded', 'routes loaded successfully'));
                
                // Create route description element if missing
                let routeDescriptionElement = document.getElementById('routeDescription');
                if (!routeDescriptionElement) {
                    routeDescriptionElement = document.createElement('div');
                    routeDescriptionElement.id = 'routeDescription';
                    routeDescriptionElement.className = 'mt-2 small text-muted d-none';
                    routeSelect.parentNode.appendChild(routeDescriptionElement);
                }
            },
            error: (xhr, status, error) => {
                this.hideLoadingSpinner();
                console.error(this.getTranslatedText('ajax_error', 'AJAX error:'), status, error);
                
                // Log raw response for debugging
                try {
                    console.log(this.getTranslatedText('response_text', 'Response text:'), xhr.responseText);
                    
                    // Try to parse JSON response
                    const jsonResponse = JSON.parse(xhr.responseText);
                    console.log(this.getTranslatedText('parsed_json_response', 'Parsed JSON response:'), jsonResponse);
                    
                    if (jsonResponse && jsonResponse.error) {
                        console.error(this.getTranslatedText('server_error_message', 'Server error message:'), jsonResponse.error);
                    }
                } catch (e) {
                    console.log(this.getTranslatedText('raw_response_text', 'Raw response text (not JSON):'), xhr.responseText);
                }
                
                routeSelect.innerHTML = `<option value="" selected>${this.getTranslatedText('error_loading_routes', 'Error loading routes')}</option>`;
                
                // Show error to user
                const errorElement = document.getElementById('formErrors');
                if (errorElement) {
                    let errorMsg = `${this.getTranslatedText('server_connection_error', 'Server connection error')}: ${status}`;
                    if (error) errorMsg += ` - ${error}`;
                    
                    errorElement.innerHTML = `<strong>${this.getTranslatedText('error_loading_routes', 'Error loading routes')}:</strong> ${errorMsg}`;
                    errorElement.classList.remove('d-none');
                    
                    // Hide error after 10 seconds
                    setTimeout(() => {
                        errorElement.classList.add('d-none');
                    }, 10000);
                }
            }
        });
    }
    
    /**
     * Handle route selection change
     * @param {Event} e Change event
     */
    handleRouteChange(e) {
        const routeId = e.target.value;
        const stopInput = document.getElementById('transportationLocation');
        const stopContainer = document.getElementById('transportationLocationContainer');
        
        console.log(this.getTranslatedText('route_changed_to', 'Route changed to:') + ` ${routeId}`);
        
        if (!stopInput || !stopContainer) {
            console.error(this.getTranslatedText('stop_input_not_found', 'Stop input or container element not found'));
            return;
        }
        
        if (!routeId) {
            // No route selected
            stopInput.disabled = true;
            stopInput.value = '';
            
            // Hide pickup location container
            stopContainer.classList.add('d-none');
            
            // Hide route description
            const descriptionElement = document.getElementById('routeDescription');
            if (descriptionElement) {
                descriptionElement.classList.add('d-none');
            }
            return;
        }
        
        // Enable pickup location field
        stopInput.disabled = false;
        stopInput.value = '';
        
        // Show pickup location container
        stopContainer.classList.remove('d-none');
        
        // Focus on pickup location field
        stopInput.focus();
        
        // Show route description if available
        const selectedOption = e.target.options[e.target.selectedIndex];
        const routeDescription = selectedOption.getAttribute('data-description');
        
        const descriptionElement = document.getElementById('routeDescription');
        if (descriptionElement) {
            if (routeDescription) {
                descriptionElement.textContent = routeDescription;
                descriptionElement.classList.remove('d-none');
                console.log(this.getTranslatedText('showing_route_description', 'Showing route description:') + ` ${routeDescription}`);
            } else {
                descriptionElement.classList.add('d-none');
            }
        }
    }
    
    /**
     * Go to next step
     * @param {number} currentStep Current step number
     */
    goToNextStep(currentStep) {
        console.log(this.getTranslatedText('attempting_next_step', 'Attempting to go to next step from step') + ` ${currentStep}`);
        if (this.validateStep(currentStep)) {
            this.goToStep(currentStep + 1);
        }
    }
    
    /**
     * Go to previous step
     * @param {number} currentStep Current step number
     */
    goToPrevStep(currentStep) {
        console.log(this.getTranslatedText('going_to_prev_step', 'Going to previous step from step') + ` ${currentStep}`);
        this.goToStep(currentStep - 1);
    }
    
    /**
     * Go to specific step
     * @param {number} step Step number to go to
     */
    goToStep(step) {
        if (step < 1 || step > this.totalSteps) {
            console.warn(this.getTranslatedText('invalid_step_number', 'Invalid step number:') + ` ${step}`);
            return;
        }
        
        console.log(this.getTranslatedText('going_to_step', 'Going to step') + ` ${step}`);
        
        // Hide current step
        this.stepElements.forEach(el => el.classList.remove('active'));
        
        // Show new step
        const currentStepElement = document.getElementById(`step${step}`);
        if (currentStepElement) {
            currentStepElement.classList.add('active');
        } else {
            console.error(this.getTranslatedText('step_element_not_found', 'Step element not found:') + ` step${step}`);
            return;
        }
        
        // Update progress steps
        this.progressSteps.forEach((el, index) => {
            const stepNum = index + 1;
            el.classList.remove('active', 'complete', 'clickable');
            
            if (stepNum < step) {
                el.classList.add('complete', 'clickable');
            } else if (stepNum === step) {
                el.classList.add('active');
            } else if (stepNum <= this.currentStep) {
                // Allow navigation to previously visited steps
                el.classList.add('clickable');
            }
        });
        
        // Store current step
        this.currentStep = step;
        localStorage.setItem('currentStep', step);
        
        // Update progress line
        this.updateProgressLine();
        
        // Scroll to top
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    
    /**
     * Update progress line
     */
    updateProgressLine() {
        // Calculate progress percentage
        const progress = ((this.currentStep - 1) / (this.totalSteps - 1)) * 100;
        
        if (this.progressLine) {
            this.progressLine.style.width = `${progress}%`;
            console.log(this.getTranslatedText('updated_progress_line', 'Updated progress line to') + ` ${progress}%`);
        } else {
            console.warn(this.getTranslatedText('progress_line_not_found', 'Progress line element not found'));
        }
    }
    
    /**
     * Validate current step
     * @param {number} step Step number to validate
     * @returns {boolean} Validation result
     */
    validateStep(step) {
        console.log(this.getTranslatedText('validating_step', 'Validating step') + ` ${step}`);
        
        let isValid = true;
        let errors = [];
        let firstErrorElement = null;
        
        // Find step element
        const stepElement = document.getElementById(`step${step}`);
        if (!stepElement) {
            console.error(this.getTranslatedText('step_element_not_found', 'Step element not found:') + ` step${step}`);
            return false;
        }
        
        // Find required fields
        const requiredFields = stepElement.querySelectorAll('input[required], select[required], textarea[required]');
        
        // Validate required fields
        requiredFields.forEach(field => {
            // Skip hidden or disabled fields
            if (field.closest('.d-none') || field.disabled) {
                return;
            }
            
            if (!field.value.trim()) {
                this.showFieldError(field);
                isValid = false;
                
                // Get field name for error message
                let fieldName = '';
                
                if (field.labels && field.labels[0]) {
                    fieldName = field.labels[0].textContent.replace('*', '').trim();
                } else if (this.fieldLabels && this.fieldLabels[field.name]) {
                    fieldName = this.fieldLabels[field.name];
                } else {
                    fieldName = field.name;
                }
                
                errors.push(fieldName);
                
                if (!firstErrorElement) {
                    firstErrorElement = field;
                }
            } else {
                this.clearFieldError(field);
            }
        });
        
        // Validate required checkboxes
        stepElement.querySelectorAll('input[type="checkbox"][required]').forEach(checkbox => {
            // Skip hidden or disabled checkboxes
            if (checkbox.closest('.d-none') || checkbox.disabled) {
                return;
            }
            
            if (!checkbox.checked) {
                const errorElement = document.getElementById(`${checkbox.id}Error`);
                if (errorElement) {
                    errorElement.textContent = this.getTranslatedText('validation_required', 'This field is required');
                    errorElement.style.display = 'block';
                }
                
                isValid = false;
                
                // Get checkbox label
                let fieldName = '';
                if (checkbox.labels && checkbox.labels[0]) {
                    fieldName = checkbox.labels[0].textContent.trim();
                } else if (this.fieldLabels && this.fieldLabels[checkbox.name]) {
                    fieldName = this.fieldLabels[checkbox.name];
                } else {
                    fieldName = checkbox.name;
                }
                
                errors.push(fieldName);
                
                if (!firstErrorElement) {
                    firstErrorElement = checkbox;
                }
            } else {
                const errorElement = document.getElementById(`${checkbox.id}Error`);
                if (errorElement) {
                    errorElement.textContent = '';
                    errorElement.style.display = 'none';
                }
            }
        });
        
        // Validate required file inputs
        const fileInputs = stepElement.querySelectorAll('input[type="file"][required]');
        fileInputs.forEach(fileInput => {
            // Skip hidden or disabled files
            if (fileInput.closest('.d-none') || fileInput.disabled) {
                return;
            }
            
            const previewElement = document.getElementById(`${fileInput.id}Preview`);
            
            // Check if file is selected or preview is active
            if (!fileInput.files.length && (previewElement && !previewElement.classList.contains('active'))) {
                this.showFieldError(null, this.getTranslatedText('validation_required', 'This field is required'), `${fileInput.id}Error`);
                isValid = false;
                
                // Get file field name
                let fieldName = '';
                if (fileInput.labels && fileInput.labels[0]) {
                    fieldName = fileInput.labels[0].textContent.replace('*', '').trim();
                } else if (this.fieldLabels && this.fieldLabels[fileInput.name]) {
                    fieldName = this.fieldLabels[fileInput.name];
                } else {
                    fieldName = fileInput.name;
                }
                
                errors.push(fieldName);
                
                if (!firstErrorElement) {
                    firstErrorElement = fileInput;
                }
            } else {
                this.clearFieldError(null, `${fileInput.id}Error`);
            }
        });
        
        // Validate special validation fields
        stepElement.querySelectorAll('[data-validation]').forEach(field => {
            // Skip empty, hidden or disabled fields
            if (field.closest('.d-none') || field.disabled || !field.value.trim()) {
                return;
            }
            
            const validationType = field.getAttribute('data-validation');
            let isFieldValid = true;
            let errorMessage = '';
            
            switch (validationType) {
                case 'nationalid':
                    isFieldValid = /^\d{10}$/.test(field.value.trim());
                    errorMessage = this.getTranslatedText('invalid_national_id', 'National ID must be 10 digits.');
                    break;
                case 'email':
                    isFieldValid = this.isValidEmail(field.value);
                    errorMessage = this.getTranslatedText('invalid_email', 'Invalid email format.');
                    break;
                case 'phone':
                    isFieldValid = this.isValidPhone(field.value);
                    errorMessage = this.getTranslatedText('invalid_phone', 'Invalid phone number format.');
                    break;
            }
            
            if (!isFieldValid) {
                this.showFieldError(field, errorMessage);
                isValid = false;
                
                // Get field name
                let fieldName = '';
                if (field.labels && field.labels[0]) {
                    fieldName = field.labels[0].textContent.replace('*', '').trim();
                } else if (this.fieldLabels && this.fieldLabels[field.name]) {
                    fieldName = this.fieldLabels[field.name];
                } else {
                    fieldName = field.name;
                }
                
                errors.push(fieldName);
                
                if (!firstErrorElement) {
                    firstErrorElement = field;
                }
            }
        });
        
        // Show error summary
        const errorElement = document.getElementById('formErrors');
        if (errorElement) {
            if (!isValid) {
                let errorHtml = `<strong>${this.getTranslatedText('error_summary', 'Please fix the following errors:')}</strong><ul>`;
                errors.forEach(err => {
                    errorHtml += `<li>${err}</li>`;
                });
                errorHtml += '</ul>';
                
                errorElement.innerHTML = errorHtml;
                errorElement.classList.remove('d-none');
                
                // Scroll to first error element
                if (firstErrorElement) {
                    firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => {
                        firstErrorElement.focus();
                    }, 500);
                }
            } else {
                errorElement.classList.add('d-none');
                errorElement.innerHTML = '';
            }
        }
        
        console.log(`${this.getTranslatedText('validation_result', 'Validation result for step')} ${step}: ${isValid ? '✅' : '❌'}`);
        if (!isValid) {
            console.log(this.getTranslatedText('validation_errors', 'Validation errors:'), errors);
        }
        
        return isValid;
    }
    
    /**
     * Show field error
     * @param {HTMLElement|null} element Field element
     * @param {string|null} message Error message
     * @param {string|null} errorElementId Error element ID
     */
    showFieldError(element, message = null, errorElementId = null) {
        // Use default message if not provided
        if (!message) {
            message = this.getTranslatedText('validation_required', 'This field is required');
        }
        
        if (element) {
            element.classList.add('is-invalid');
            
            const errorElement = element.nextElementSibling;
            if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        } else if (errorElementId) {
            const errorElement = document.getElementById(errorElementId);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }
    }
    
    /**
     * Clear field error
     * @param {HTMLElement|null} element Field element
     * @param {string|null} errorElementId Error element ID
     */
    clearFieldError(element, errorElementId = null) {
        if (element) {
            element.classList.remove('is-invalid');
            
            const errorElement = element.nextElementSibling;
            if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        } else if (errorElementId) {
            const errorElement = document.getElementById(errorElementId);
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        }
    }
    
    /**
     * Validate email format
     * @param {string} email Email to validate
     * @returns {boolean} Validation result
     */
    isValidEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    
    /**
     * Validate phone number format
     * @param {string} phone Phone number to validate
     * @returns {boolean} Validation result
     */
    isValidPhone(phone) {
        // Phone numbers typically have at least 7 digits and may include +, -, (), and spaces
        const re = /^[+\d\s\-()]{7,20}$/;
        return re.test(String(phone));
    }
    
    /**
     * Validate national ID
     * @param {HTMLElement} element National ID field
     */
    validateNationalId(element) {
        if (element.value.trim()) {
            if (element.value.trim().length !== 10 || !/^\d{10}$/.test(element.value.trim())) {
                this.showFieldError(element, this.getTranslatedText('invalid_national_id', 'National ID must be 10 digits.'));
            } else {
                this.clearFieldError(element);
            }
        } else {
            this.clearFieldError(element);
        }
    }
    
    /**
     * Validate email field
     * @param {HTMLElement} element Email field
     */
    validateEmail(element) {
        if (element.value.trim() && !this.isValidEmail(element.value)) {
            this.showFieldError(element, this.getTranslatedText('invalid_email', 'Invalid email format.'));
        } else {
            this.clearFieldError(element);
        }
    }
    
    /**
     * Validate phone field
     * @param {HTMLElement} element Phone field
     */
    validatePhone(element) {
        if (element.value.trim() && !this.isValidPhone(element.value)) {
            this.showFieldError(element, this.getTranslatedText('invalid_phone', 'Invalid phone number format.'));
        } else {
            this.clearFieldError(element);
        }
    }
    
    /**
     * Show registration summary
     */
    showSummary() {
        console.log(this.getTranslatedText('showing_registration_summary', 'Showing registration summary'));
        
        // Validate all steps before showing summary
        for (let i = 1; i <= 5; i++) {
            if (!this.validateStep(i)) {
                console.warn(this.getTranslatedText('validation_failed_at_step', 'Validation failed at step') + ` ${i}, ` + this.getTranslatedText('redirecting_to_step', 'redirecting to this step'));
                this.goToStep(i);
                return;
            }
        }
        
        // Generate summary HTML
        const summaryContent = document.getElementById('summaryContent');
        if (summaryContent) {
            summaryContent.innerHTML = this.generateSummaryHtml();
            console.log(this.getTranslatedText('summary_content_generated', 'Summary content generated'));
        } else {
            console.error(this.getTranslatedText('summary_content_not_found', 'Summary content element not found'));
        }
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('summaryModal'));
        modal.show();
    }
    
    /**
     * Generate summary HTML
     * @returns {string} Summary HTML
     */
    generateSummaryHtml() {
        console.log(this.getTranslatedText('generating_summary_html', 'Generating summary HTML'));
        let html = '';
        
        // Section 1: Student Information
        html += this.generateStudentInfoSection();
        
        // Section 2: Documents
        html += this.generateDocumentsSection();
        
        // Section 3: Transportation (if selected)
        html += this.generateTransportationSection();
        
        // Section 4: Father's Information
        html += this.generateFatherInfoSection();
        
        // Section 5: Mother's Information
        html += this.generateMotherInfoSection();
        
        // Section 6: Additional Information
        html += this.generateAdditionalInfoSection();
        
        // Section 7: Agreements
        html += this.generateAgreementsSection();
        
        console.log(this.getTranslatedText('summary_generated', 'Summary HTML generated'));
        return html;
    }
    
    /**
     * Generate student information summary section
     * @returns {string} HTML for student information section
     */
    generateStudentInfoSection() {
        let html = `<div class="summary-section mb-4 p-4 bg-light rounded">
            <h4 class="summary-title mb-3 pb-2 border-bottom text-primary">${this.getTranslatedText('student_info_summary', 'Student Information')}</h4>`;
        
        // Check first section fields
        const studentFields = [
            'firstName', 'lastName', 'nationalId', 'passportNumber', 'fatherName',
            'placeOfBirth', 'dateOfBirth', 'religion', 'nationality',
            'academicGrade', 'major', 'residentialAddress', 'contactNumber', 'emergencyContactName', 'emergencyContactNumber'
        ];
        
        // Check existing fields
        for (const fieldName of studentFields) {
            const element = document.getElementById(fieldName);
            if (!element || element.closest('.d-none') || element.disabled) continue;
            
            let value = element.value;
            let label = this.fieldLabels[fieldName] || fieldName;
            
            // Format special values
            if (fieldName === 'dateOfBirth' && value) {
                const date = new Date(value);
                value = date.toLocaleDateString();
            }
            
            // Handle select values
            if (element.tagName === 'SELECT' && value) {
                const selectedOption = element.options[element.selectedIndex];
                value = selectedOption ? selectedOption.textContent : value;
            }
            
            html += `<div class="summary-item row py-2">
                <div class="summary-label col-md-4 fw-bold">${label}:</div>
                <div class="summary-value col-md-8">${value || this.getTranslatedText('not_filled', 'Not filled')}</div>
            </div>`;
        }
        
        html += `</div>`;
        return html;
    }
    
    /**
     * Generate documents summary section
     * @returns {string} HTML for documents section
     */
    generateDocumentsSection() {
        let html = `<div class="summary-section mb-4 p-4 bg-light rounded">
            <h4 class="summary-title mb-3 pb-2 border-bottom text-primary">${this.getTranslatedText('required_documents', 'Required Documents')}</h4>`;
        
        // Check document fields
        const documentFields = ['profilePhoto', 'passportDoc', 'nationalIdDoc', 'birthCertificate', 'academicCertificate', 'emiratesId'];
        
        for (const fieldName of documentFields) {
            const element = document.getElementById(fieldName);
            if (!element || element.closest('.d-none') || element.disabled) continue;
            
            let label = this.fieldLabels[fieldName] || fieldName;
            let status = '';
            
            // Check file status
            const previewElement = document.getElementById(`${fieldName}Preview`);
            if (previewElement && previewElement.classList.contains('active')) {
                const previewName = previewElement.querySelector('.file-preview-name');
                status = previewName ? previewName.textContent : this.getTranslatedText('document_uploaded', 'File uploaded');
            } else {
                status = this.getTranslatedText('not_filled', 'Not filled');
            }
            
            html += `<div class="summary-item row py-2">
                <div class="summary-label col-md-4 fw-bold">${label}:</div>
                <div class="summary-value col-md-8">${status}</div>
            </div>`;
        }
        
        html += `</div>`;
        return html;
    }
    
    /**
     * Generate transportation summary section
     * @returns {string} HTML for transportation section
     */
    generateTransportationSection() {
        const needTransportation = document.querySelector('input[name="needTransportation"]:checked');
        
        if (!needTransportation) {
            return '';
        }
        
        let html = `<div class="summary-section mb-4 p-4 bg-light rounded">
            <h4 class="summary-title mb-3 pb-2 border-bottom text-primary">${this.getTranslatedText('transportation_title', 'School Transportation Information')}</h4>`;
        
        // Need transportation
        html += `<div class="summary-item row py-2">
            <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('need_transportation', 'Do you need school transportation?')}:</div>
            <div class="summary-value col-md-8">${needTransportation.value === 'Yes' ? this.getTranslatedText('yes_option', 'Yes') : this.getTranslatedText('no_option', 'No')}</div>
        </div>`;
        
        if (needTransportation.value === 'Yes') {
            const transportationCity = document.getElementById('transportationCity');
            const transportationRoute = document.getElementById('transportationRoute');
            const transportationLocation = document.getElementById('transportationLocation');
            
            // City
            if (transportationCity && transportationCity.value) {
                html += `<div class="summary-item row py-2">
                    <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('transportation_city', 'City')}:</div>
                    <div class="summary-value col-md-8">${transportationCity.options[transportationCity.selectedIndex].text}</div>
                </div>`;
            }
            
            // Route
            if (transportationRoute && transportationRoute.value) {
                html += `<div class="summary-item row py-2">
                    <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('transportation_route', 'Route')}:</div>
                    <div class="summary-value col-md-8">${transportationRoute.options[transportationRoute.selectedIndex].text}</div>
                </div>`;
                
                // Pickup location
                if (transportationLocation && transportationLocation.value) {
                    html += `<div class="summary-item row py-2">
                        <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('transportation_stop', 'Pickup Location')}:</div>
                        <div class="summary-value col-md-8">${transportationLocation.value}</div>
                    </div>`;
                }
            }
        }
        
        html += `</div>`;
        return html;
    }
    
    /**
     * Generate father information summary section
     * @returns {string} HTML for father information section
     */
    generateFatherInfoSection() {
        let html = `<div class="summary-section mb-4 p-4 bg-light rounded">
            <h4 class="summary-title mb-3 pb-2 border-bottom text-primary">${this.getTranslatedText('father_info_summary', 'Father\'s Information')}</h4>`;
        
        // Check father fields
        const fatherFields = [
            'fatherFullName', 'fatherNationality', 'fatherDateOfBirth', 'fatherNationalId', 'fatherPassportNumber',
            'fatherEducation', 'fatherOccupation', 'fatherLandline',
            'fatherMobile', 'fatherWhatsapp', 'fatherEmail', 'fatherWorkAddress', 'fatherEmployeeCode'
        ];
        
        for (const fieldName of fatherFields) {
            const element = document.getElementById(fieldName);
            if (!element || element.closest('.d-none') || element.disabled) continue;
            
            let value = element.value;
            let label = this.fieldLabels[fieldName] || fieldName;
            
            // Format date values
            if (fieldName === 'fatherDateOfBirth' && value) {
                const date = new Date(value);
                value = date.toLocaleDateString();
            }
            
            // Handle select values
            if (element.tagName === 'SELECT' && value) {
                const selectedOption = element.options[element.selectedIndex];
                value = selectedOption ? selectedOption.textContent : value;
            }
            
            html += `<div class="summary-item row py-2">
                <div class="summary-label col-md-4 fw-bold">${label}:</div>
                <div class="summary-value col-md-8">${value || this.getTranslatedText('not_filled', 'Not filled')}</div>
            </div>`;
        }
        
        // Medical condition
        const fatherMedicalConditionYes = document.querySelector('input[name="fatherMedicalCondition"][value="Yes"]');
        const fatherMedicalConditionNo = document.querySelector('input[name="fatherMedicalCondition"][value="No"]');
        
        html += `<div class="summary-item row py-2">
            <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('has_medical_condition', 'Has Medical Condition')}:</div>
            <div class="summary-value col-md-8">${fatherMedicalConditionYes && fatherMedicalConditionYes.checked ? this.getTranslatedText('yes', 'Yes') : this.getTranslatedText('no', 'No')}</div>
        </div>`;
        
        if (fatherMedicalConditionYes && fatherMedicalConditionYes.checked) {
            const medicalConditionDetails = document.getElementById('fatherMedicalConditionDetails');
            if (medicalConditionDetails) {
                html += `<div class="summary-item row py-2">
                    <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('medical_condition_explanation', 'Medical Condition Details:')}:</div>
                    <div class="summary-value col-md-8">${medicalConditionDetails.value || this.getTranslatedText('not_filled', 'Not filled')}</div>
                </div>`;
            }
        }
        
        html += `</div>`;
        return html;
    }
    
    /**
     * Generate mother information summary section
     * @returns {string} HTML for mother information section
     */
    generateMotherInfoSection() {
        let html = `<div class="summary-section mb-4 p-4 bg-light rounded">
            <h4 class="summary-title mb-3 pb-2 border-bottom text-primary">${this.getTranslatedText('mother_info_summary', 'Mother\'s Information')}</h4>`;
        
        // Check mother fields
        const motherFields = [
            'motherFullName', 'motherNationality', 'motherDateOfBirth', 'motherNationalId', 'motherPassportNumber',
            'motherEducation', 'motherOccupation', 'motherLandline',
            'motherMobile', 'motherWhatsapp', 'motherEmail', 'motherWorkAddress', 'motherEmployeeCode'
        ];
        
        for (const fieldName of motherFields) {
            const element = document.getElementById(fieldName);
            if (!element || element.closest('.d-none') || element.disabled) continue;
            
            let value = element.value;
            let label = this.fieldLabels[fieldName] || fieldName;
            
            // Format date values
            if (fieldName === 'motherDateOfBirth' && value) {
                const date = new Date(value);
                value = date.toLocaleDateString();
            }
            
            // Handle select values
            if (element.tagName === 'SELECT' && value) {
                const selectedOption = element.options[element.selectedIndex];
                value = selectedOption ? selectedOption.textContent : value;
            }
            
            html += `<div class="summary-item row py-2">
                <div class="summary-label col-md-4 fw-bold">${label}:</div>
                <div class="summary-value col-md-8">${value || this.getTranslatedText('not_filled', 'Not filled')}</div>
            </div>`;
        }
        
        // Medical condition
        const motherMedicalConditionYes = document.querySelector('input[name="motherMedicalCondition"][value="Yes"]');
        
        html += `<div class="summary-item row py-2">
            <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('has_medical_condition', 'Has Medical Condition')}:</div>
            <div class="summary-value col-md-8">${motherMedicalConditionYes && motherMedicalConditionYes.checked ? this.getTranslatedText('yes', 'Yes') : this.getTranslatedText('no', 'No')}</div>
        </div>`;
        
        if (motherMedicalConditionYes && motherMedicalConditionYes.checked) {
            const medicalConditionDetails = document.getElementById('motherMedicalConditionDetails');
            if (medicalConditionDetails) {
                html += `<div class="summary-item row py-2">
                    <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('medical_condition_explanation', 'Medical Condition Details:')}:</div>
                    <div class="summary-value col-md-8">${medicalConditionDetails.value || this.getTranslatedText('not_filled', 'Not filled')}</div>
                </div>`;
            }
        }
        
        html += `</div>`;
        return html;
    }
    
    /**
     * Generate additional information summary section
     * @returns {string} HTML for additional information section
     */
    generateAdditionalInfoSection() {
        const specialNotes = document.getElementById('specialNotes');
        if (!specialNotes || !specialNotes.value) {
            return '';
        }
        
        let html = `<div class="summary-section mb-4 p-4 bg-light rounded">
            <h4 class="summary-title mb-3 pb-2 border-bottom text-primary">${this.getTranslatedText('additional_info_summary', 'Additional Information')}</h4>`;
        
        // Special notes
        html += `<div class="summary-item row py-2">
            <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('special_notes', 'Special Notes / Additional Requests')}:</div>
            <div class="summary-value col-md-8">${specialNotes.value}</div>
        </div>`;
        
        html += `</div>`;
        return html;
    }
    
    /**
     * Generate agreements summary section
     * @returns {string} HTML for agreements section
     */
    generateAgreementsSection() {
        let html = `<div class="summary-section mb-4 p-4 bg-light rounded">
            <h4 class="summary-title mb-3 pb-2 border-bottom text-primary">${this.getTranslatedText('agreements', 'Agreements')}</h4>`;
        
        // School policies
        const schoolPolicies = document.getElementById('schoolPolicies');
        html += `<div class="summary-item row py-2">
            <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('school_policies', 'School Policies')}:</div>
            <div class="summary-value col-md-8">${schoolPolicies && schoolPolicies.checked ? this.getTranslatedText('agreed', 'Agreed') : this.getTranslatedText('not_agreed', 'Not Agreed')}</div>
        </div>`;
        
        // Disciplinary rules
        const disciplinaryRules = document.getElementById('disciplinaryRules');
        html += `<div class="summary-item row py-2">
            <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('disciplinary_rules', 'Disciplinary Rules')}:</div>
            <div class="summary-value col-md-8">${disciplinaryRules && disciplinaryRules.checked ? this.getTranslatedText('agreed', 'Agreed') : this.getTranslatedText('not_agreed', 'Not Agreed')}</div>
        </div>`;
        
        // Terms and conditions
        const termsConditions = document.getElementById('termsConditions');
        html += `<div class="summary-item row py-2">
            <div class="summary-label col-md-4 fw-bold">${this.getTranslatedText('terms_agreement_label', 'Terms and Conditions')}:</div>
            <div class="summary-value col-md-8">${termsConditions && termsConditions.checked ? this.getTranslatedText('agreed', 'Agreed') : this.getTranslatedText('not_agreed', 'Not Agreed')}</div>
        </div>`;
        
        html += `</div>`;
        return html;
    }
    
    /**
     * Enable submit button
     */
    enableSubmitButton() {
        console.log(this.getTranslatedText('enabling_submit_button', 'Enabling submit button'));
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('summaryModal'));
        if (modal) {
            modal.hide();
        }
        
        // Enable submit button
        const submitButton = document.getElementById('submitButton');
        if (submitButton) {
            submitButton.removeAttribute('disabled');
            
            // Scroll to button
            submitButton.scrollIntoView({ behavior: 'smooth' });
            
            // Add attention animation
            submitButton.classList.add('pulse-animation');
            setTimeout(() => {
                submitButton.classList.remove('pulse-animation');
            }, 2000);
        } else {
            console.error(this.getTranslatedText('submit_button_not_found', 'Submit button not found'));
        }
    }
    
    /**
     * Submit form
     * @param {Event} e Submit event
     */
    submitForm(e) {
        e.preventDefault();
        console.log(this.getTranslatedText('submitting_form', 'Submitting form...'));
        
        // Disable button and show loading state
        const submitButton = document.getElementById('submitButton');
        let originalText = submitButton ? submitButton.innerHTML : '';
        
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${this.getTranslatedText('submitting_text', 'Submitting...')}`;
        }
        
        // Show loading spinner
        this.showLoadingSpinner();
        
        // Create form data
        const formData = new FormData(this.form);
        
        // Field mappings to ensure server compatibility
        const fieldMappings = {
            'dateOfBirth': 'birthDate',
            'placeOfBirth': 'birthPlace',
            'residentialAddress': 'address',
            'contactNumber': 'phone',
            'contactNumber': 'mainPhone',  // Duplicate mapping
            'emergencyContactName': 'emergencyContact',
            'emergencyContactNumber': 'emergencyPhone',
            'fatherDateOfBirth': 'fatherBirthDate',
            'motherDateOfBirth': 'motherBirthDate'
        };
        
        // Apply mappings
        Object.keys(fieldMappings).forEach(originalName => {
            const targetName = fieldMappings[originalName];
            const element = document.getElementById(originalName);
            
            if (element && element.value && !formData.has(targetName)) {
                formData.append(targetName, element.value);
                console.log(`Added ${targetName} field with value from ${originalName}: ${element.value}`);
            }
        });
        
        // Default gender if missing
        if (!formData.has('gender')) {
            formData.append('gender', 'male');
            console.log('Added default gender: male');
        }
        
        // Ensure all required fields exist
        const requiredFields = [
            'firstName', 'lastName', 'fatherName', 'birthDate', 'birthPlace', 
            'gender', 'religion', 'nationality', 'academicGrade', 
            'fatherFullName', 'fatherNationality', 'fatherBirthDate',
            'motherFullName', 'motherNationality', 'motherBirthDate',
            'address', 'phone', 'emergencyContact', 'emergencyPhone'
        ];
        
        // Add empty values for missing required fields
        requiredFields.forEach(field => {
            if (!formData.has(field)) {
                formData.append(field, '');
                console.log(`Added empty required field: ${field}`);
            }
        });
        
        // Ensure agreement fields exist
        const agreementFields = ['termsConditions', 'disciplinaryRules', 'schoolPolicies'];
        agreementFields.forEach(field => {
            const element = document.getElementById(field);
            if (element && element.checked && !formData.has(field)) {
                formData.append(field, '1');
                console.log(`Added agreement field: ${field}`);
            } else if (!formData.has(field)) {
                formData.append(field, '0');
                console.log(`Added empty agreement field: ${field}`);
            }
        });
        
        // Log form data for debugging
        console.log('Form data being submitted:');
        for (let [key, value] of formData.entries()) {
            // Truncate long values for logging
            const logValue = typeof value === 'string' && value.length > 50 ? 
                value.substring(0, 50) + '...' : value;
            console.log(`${key}: ${logValue}`);
        }
        
        // Submit form via AJAX
        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log(this.getTranslatedText('form_submission_response', 'Form submission response status:') + ` ${response.status}`);
            
            // Get raw response text
            return response.text().then(text => {
                console.log(this.getTranslatedText('raw_response', 'Raw form submission response:'), text.substring(0, 500));
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error(this.getTranslatedText('json_parsing_error', 'JSON parsing error:'), e);
                    throw new Error(this.getTranslatedText('invalid_json_response', 'Invalid JSON response from form submission:') + ` ${text.substring(0, 100)}...`);
                }
            });
        })
        .then(result => {
            this.hideLoadingSpinner();
            console.log(this.getTranslatedText('form_submission_result', 'Form submission result:'), result);
            
            if (result.success) {
                // Clear stored form data
                this.clearFormData();
                
                // Redirect to success page
                console.log(this.getTranslatedText('redirecting_to_success', 'Redirecting to success page with secure token'));
                window.location.href = `registration-success.php?token=${result.token}&lang=${this.currentLang}`;
            } else {
                console.error(this.getTranslatedText('form_submission_error', 'Form submission error:'), result.error);
                
                // Show error message
                const errorElement = document.getElementById('formErrors');
                if (errorElement) {
                    let errorMessage = result.error || this.getTranslatedText('server_error', 'Server error occurred');
                    
                    // Add debug info if available
                    if (result.debug_query) {
                        errorMessage += `<br><small class="text-muted">${result.debug_query}</small>`;
                    }
                    
                    errorElement.innerHTML = `<strong>${this.getTranslatedText('error', 'Error')}:</strong> ${errorMessage}`;
                    errorElement.classList.remove('d-none');
                }
                
                // Re-enable submit button
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                }
                
                // Scroll to top
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        })
        .catch(error => {
            this.hideLoadingSpinner();
            console.error(this.getTranslatedText('ajax_error', 'AJAX error:'), error);
            
            // Show detailed error message
            const errorElement = document.getElementById('formErrors');
            if (errorElement) {
                let errorMessage = error.message || error.toString();
                
                // Show helpful message for known errors
                if (errorMessage.includes('ArgumentCountError')) {
                    errorMessage += '<br><small class="text-muted">This error relates to parameter mismatch in server functions. Please contact support.</small>';
                }
                
                errorElement.innerHTML = `<strong>${this.getTranslatedText('server_connection_error', 'Server connection error')}:</strong> ${errorMessage}`;
                errorElement.classList.remove('d-none');
            }
            
            // Re-enable submit button
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
            
            // Scroll to top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    /**
     * Show loading spinner
     */
    showLoadingSpinner() {
        if (this.loadingSpinner) {
            this.loadingSpinner.classList.add('show');
        }
    }
    
    /**
     * Hide loading spinner
     */
    hideLoadingSpinner() {
        if (this.loadingSpinner) {
            this.loadingSpinner.classList.remove('show');
        }
    }
    
    /**
     * Save form data to localStorage
     */
    saveFormData() {
        if (!this.form) return;
        
        const formData = {};
        
        // Save all field values
        const inputs = this.form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            const name = input.name;
            if (!name) return;
            
            if (input.type === 'checkbox' || input.type === 'radio') {
                formData[name] = input.checked;
            } else if (input.type === 'file') {
                // Files are saved separately
            } else {
                formData[name] = input.value;
            }
        });
        
        // Save to localStorage
        localStorage.setItem('registration_form_data', JSON.stringify(formData));
        localStorage.setItem('registration_form_timestamp', new Date().toISOString());
        
        console.log(this.getTranslatedText('data_saved_localstorage', 'Form data saved to localStorage'));
    }
    
    /**
     * Restore form data from localStorage
     */
    restoreFormData() {
        if (!this.form) return;
        
        // Get saved data
        const savedData = localStorage.getItem('registration_form_data');
        const timestamp = localStorage.getItem('registration_form_timestamp');
        
        console.log(this.getTranslatedText('restoring_form_data', 'Attempting to restore form data from localStorage'));
        
        // Check expiration (30 days)
        if (timestamp) {
            const savedDate = new Date(timestamp);
            const now = new Date();
            const diffDays = Math.floor((now - savedDate) / (1000 * 60 * 60 * 24));
            
            if (diffDays > 30) {
                console.log(this.getTranslatedText('saved_data_expired', 'Saved form data is expired (older than 30 days), clearing it'));
                this.clearFormData();
                return;
            }
        }
        
        if (!savedData) {
            console.log(this.getTranslatedText('no_saved_data', 'No saved form data found'));
            return;
        }
        
        const formData = JSON.parse(savedData);
        if (!formData) {
            console.log(this.getTranslatedText('invalid_saved_data', 'No valid saved form data found'));
            return;
        }
        
        console.log(this.getTranslatedText('found_saved_data', 'Found saved form data:'), formData);
        
        // Fill fields with saved values
        Object.keys(formData).forEach(key => {
            const value = formData[key];
            const element = this.form.querySelector(`[name="${key}"]`);
            
            if (!element) {
                console.warn(this.getTranslatedText('element_not_found', 'Element with name not found:') + ` ${key}`);
                return;
            }
            
            console.log(this.getTranslatedText('restoring_field', 'Restoring field') + ` ${key} ` + this.getTranslatedText('with_value', 'with value:') + ` ${value}`);
            
            if (element.type === 'checkbox' || element.type === 'radio') {
                element.checked = value;
                
                // Trigger change event for radios
                if (element.type === 'radio' && value && element.checked) {
                    element.dispatchEvent(new Event('change'));
                }
            } else {
                element.value = value;
                
                // Trigger special field events
                if (element.id === 'nationality') {
                    this.handleNationalityChange(
                        { target: element }, 
                        'nationalIdContainer', 
                        'passportContainer', 
                        'iranianDocuments',
                        'emiratesIdContainer'
                    );
                } else if (element.id === 'fatherNationality') {
                    this.handleNationalityChange(
                        { target: element }, 
                        'fatherNationalIdContainer', 
                        'fatherPassportContainer'
                    );
                } else if (element.id === 'motherNationality') {
                    this.handleNationalityChange(
                        { target: element }, 
                        'motherNationalIdContainer', 
                        'motherPassportContainer'
                    );
                } else if (element.id === 'academicGrade') {
                    this.handleGradeChange({ target: element });
                } else if (element.id === 'transportationCity' && value) {
                    setTimeout(() => {
                        this.loadRoutes({ target: element });
                    }, 500);
                }
            }
        });
        
        // Restore transportation options
        const needTransportationYes = document.getElementById('needTransportation_Yes');
        const needTransportationNo = document.getElementById('needTransportation_No');
        
        if (needTransportationYes && needTransportationYes.checked) {
            this.handleTransportationNeedChange({ target: needTransportationYes });
        } else if (needTransportationNo && needTransportationNo.checked) {
            this.handleTransportationNeedChange({ target: needTransportationNo });
        }
        
        // Restore file info
        if (this.fileFields && this.fileFields.length) {
            this.fileFields.forEach(fileId => {
                const savedFile = localStorage.getItem(`file_${fileId}`);
                if (!savedFile) return;
                
                try {
                    const fileInfo = JSON.parse(savedFile);
                    const previewElement = document.getElementById(`${fileId}Preview`);
                    const uploadContainer = document.getElementById(`${fileId}Upload`);
                    
                    console.log(`Restoring file preview for ${fileId}:`, fileInfo);
                    
                    if (previewElement) {
                        const previewName = previewElement.querySelector('.file-preview-name');
                        const previewSize = previewElement.querySelector('.file-preview-size');
                        const previewImage = previewElement.querySelector('.file-preview-image');
                        const previewIcon = previewElement.querySelector('.file-preview-icon');
                        
                        if (previewName) previewName.textContent = fileInfo.name;
                        if (previewSize) previewSize.textContent = this.formatFileSize(fileInfo.size);
                        
                        // Show appropriate icon
                        if (fileInfo.type.startsWith('image/')) {
                            if (previewIcon) previewIcon.style.display = 'none';
                            // Can't show actual image, use placeholder
                            if (previewImage) {
                                previewImage.src = 'assets/images/image-placeholder.jpg';
                                previewImage.style.display = 'block';
                            }
                        } else {
                            if (previewImage) previewImage.style.display = 'none';
                            if (previewIcon) {
                                previewIcon.className = 'file-preview-icon';
                                previewIcon.innerHTML = `<i class="fas ${fileInfo.type === 'application/pdf' ? 'fa-file-pdf' : 'fa-file-alt'}"></i>`;
                                previewIcon.style.display = 'flex';
                            }
                        }
                        
                        previewElement.style.display = 'flex';
                        previewElement.classList.add('active');
                        
                        // Hide upload container
                        if (uploadContainer) {
                            uploadContainer.classList.add('has-file');
                            uploadContainer.style.display = 'none';
                        }
                    }
                } catch (error) {
                    console.error(`Error restoring file info for ${fileId}:`, error);
                }
            });
        }
        
        // Restore current step
        const savedStep = localStorage.getItem('currentStep');
        if (savedStep) {
            this.goToStep(parseInt(savedStep));
        }
        
        // Run conditional logic
        this.setupConditionalFields();
        
        console.log(this.getTranslatedText('form_data_restored', 'Form data restored successfully'));
    }
    
    /**
     * Clear stored form data
     */
    clearFormData() {
        console.log(this.getTranslatedText('clearing_form_data', 'Clearing all saved form data'));
        
        // Clear all stored data
        localStorage.removeItem('registration_form_data');
        localStorage.removeItem('registration_form_timestamp');
        localStorage.removeItem('currentStep');
        
        if (this.fileFields && this.fileFields.length) {
            this.fileFields.forEach(fileId => {
                localStorage.removeItem(`file_${fileId}`);
            });
        }
    }
    
    /**
     * Create visual effects for the form
     */
    createVisualEffects() {
        this.createStars();
        this.createMeteors();
    }
    
    /**
     * Create stars effect
     */
    createStars() {
        const cosmic = document.querySelector('.cosmic-bg');
        if (!cosmic) return;
        
        for (let i = 0; i < 50; i++) {
            const star = document.createElement('div');
            star.classList.add('cosmic-star');
            
            const top = Math.random() * 100;
            const left = Math.random() * 100;
            const size = Math.random() * 2 + 1;
            const duration = Math.random() * 3 + 2;
            const delay = Math.random() * 3;
            
            star.style.top = `${top}%`;
            star.style.left = `${left}%`;
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            star.style.animation = `twinkle ${duration}s infinite ${delay}s`;
            
            cosmic.appendChild(star);
        }
    }
    
    /**
     * Create meteors effect
     */
    createMeteors() {
        const cosmic = document.querySelector('.cosmic-bg');
        if (!cosmic) return;
        
        // Function to create a meteor
        const createMeteor = () => {
            const meteor = document.createElement('div');
            meteor.classList.add('meteor');
            
            const top = Math.random() * 30;
            const left = Math.random() * 80 + 20;
            
            meteor.style.top = `${top}%`;
            meteor.style.left = `${left}%`;
            
            cosmic.appendChild(meteor);
            
            setTimeout(() => {
                meteor.remove();
            }, 6000);
        };
        
        // Create initial meteors
        for (let i = 0; i < 3; i++) {
            setTimeout(() => {
                createMeteor();
            }, i * 3000);
        }
        
        // Create periodic meteors
        setInterval(() => {
            createMeteor();
        }, 10000);
    }
}