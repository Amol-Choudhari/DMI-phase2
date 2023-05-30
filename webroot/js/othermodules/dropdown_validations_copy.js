$(document).ready(function() {
	// Define the dropdown options for each category and level
	var dropdownOptions = {
		category1: {
		level1: {
			actions: [
			{ value: '1', text: 'Suspension' },
			{ value: '6', text: 'Show Cause Notice' }
			],
			periodVisible: false
		},
		level2: {
			actions: [
			{ value: '1', text: 'Suspension' }
			],
			periodVisible: true
		},
		// Add more levels and actions as needed
		},
		category2: {
		// Define options for category 2 levels and actions
		},
		// Add more categories with levels and actions as needed
	};

	// Populate the misgrade_level dropdown based on the selected category
	$('#misgrade_category').on('change', function() {
		var selectedCategory = $(this).val();
		var $misgradeLevel = $('#misgrade_level');

		// Clear existing options
		$misgradeLevel.empty();
		$misgradeLevel.append($('<option>', {
		value: '',
		text: '-- Select Misgrading Level --'
		}));

		// Add options based on the selected category and its levels
		if (selectedCategory) {
		var levels = dropdownOptions['category' + selectedCategory];
		Object.keys(levels).forEach(function(level) {
			$misgradeLevel.append($('<option>', {
			value: level,
			text: 'Level ' + level
			}));
		});
		}

		// Trigger the change event for misgrade_level to update actions
		$misgradeLevel.trigger('change');
	});

	// Populate the misgrade_action dropdown based on the selected level
	$('#misgrade_level').on('change', function() {
		var selectedCategory = $('#misgrade_category').val();
		var selectedLevel = $(this).val();
		var $misgradeAction = $('#misgrade_action');

		// Clear existing options
		$misgradeAction.empty();
		$misgradeAction.append($('<option>', {
		value: '',
		text: '-- Select Misgrading Action --'
		}));

		// Add options based on the selected category, level, and actions
		if (selectedCategory && selectedLevel) {
		var actions = dropdownOptions['category' + selectedCategory]['level' + selectedLevel].actions;
		actions.forEach(function(action) {
			$misgradeAction.append($('<option>', {
			value: action.value,
			text: action.text
			}));
		});
		}

		// Trigger the change event for misgrade_action to update the period visibility
		$misgradeAction.trigger('change');
	});

	// Update the visibility of the time_period dropdown based on the selected action
	$('#misgrade_action').on('change', function() {
		var selectedCategory = $('#misgrade_category').val();
		var selectedLevel = $('#misgrade_level').val();
		var selectedAction = $(this).val();
		var periodVisible = dropdownOptions['category' + selectedCategory]['level' + selectedLevel].periodVisible;
		var $timePeriod = $('#time_period');

		if (periodVisible) {
		$timePeriod.show();
		} else {
		$timePeriod.hide();
		}
	});

	// Trigger the change event for misgrade_category to initialize the dropdowns
	$('#misgrade_category').trigger('change');
	});
